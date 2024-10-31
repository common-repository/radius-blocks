<?php

namespace RadiusTheme\RB\Controllers\Builder;

use RadiusTheme\RB\Controllers\Builder\Support\AstraSupport;
use RadiusTheme\RB\Controllers\Builder\Support\BbthemeSupport;
use RadiusTheme\RB\Controllers\Builder\Support\GeneratePressSupport;
use RadiusTheme\RB\Controllers\Builder\Support\GenesisSupport;
use RadiusTheme\RB\Controllers\Builder\Support\MyListingSupport;
use RadiusTheme\RB\Controllers\Builder\Support\OceanwpSupport;
use RadiusTheme\RB\Controllers\Builder\Support\ThemeSupport;
use RadiusTheme\RB\Controllers\Builder\Support\TwentyNineteenSupport;
use RadiusTheme\RB\Helpers\Fns;
use RadiusTheme\RB\Traits\SingletonTrait;

class BuilderLoader
{
	use SingletonTrait;

	protected $templates;
	public $header_template;
	public $footer_template;

	protected $current_theme;
	protected $current_template;

	protected $post_type = 'rtrb_builder';

	public function __construct()
	{
		add_action('wp', [$this, 'hooks']);
		add_action('wp_enqueue_scripts', [$this, 'load_pages_enqueue_styles']);
	}

	public function load_pages_enqueue_styles()
	{
		$template_ids = self::template_ids();
		if (!empty($template_ids)) {
			foreach ($template_ids as $template_type => $post_id) {
				$page_builder_instance = Fns::get_active_page_builder($post_id);
				if (is_callable([$page_builder_instance, 'enqueue_scripts'])) {
					$page_builder_instance->enqueue_scripts();
				}
			}
		}
	}

	public function hooks()
	{
		$this->current_template = basename(get_page_template_slug());
		if ($this->current_template == 'rtrb_builder_canvas') {
			return;
		}

		$this->current_theme = get_template();
		$template_ids        = self::template_ids();

		switch ($this->current_theme) {
			case 'astra':
				new AstraSupport($template_ids);
				break;

			case 'generatepress':
			case 'generatepress-child':
				new GeneratePressSupport($template_ids);
				break;

			case 'oceanwp':
			case 'oceanwp-child':
				new OceanwpSupport($template_ids);
				break;

			case 'bb-theme':
			case 'bb-theme-child':
				new BbthemeSupport($template_ids);
				break;

			case 'genesis':
			case 'genesis-child':
				new GenesisSupport($template_ids);
				break;

			case 'twentynineteen':
				new TwentyNineteenSupport($template_ids);
				break;

			case 'my-listing':
			case 'my-listing-child':
				$support = MyListingSupport::getInstance();
				$support->init($template_ids);
				break;

			default:
				new ThemeSupport($template_ids);
				break;
		}
	}

	public static function template_ids()
	{
		$cached = wp_cache_get('rtrb_builder_ids');
		if (false !== $cached) {
			return $cached;
		}

		$instance = self::getInstance();
		$instance->the_filter();

		$ids = [
			'header' => $instance->header_template,
			'footer' => $instance->footer_template,
		];

		wp_cache_set('rtrb_builder_ids', $ids);

		return $ids;
	}


	protected function the_filter()
	{
		$arg             = [
			'posts_per_page' => -1,
			'orderby'        => 'id',
			'order'          => 'DESC',
			'post_status'    => 'publish',
			'post_type'      => $this->post_type,
			'meta_query'     => [
				[
					'key'     => 'rtrb_builder_activation',
					'value'   => 1,
					'compare' => '=',
				],
			],
		];
		$this->templates = get_posts($arg);

		// entire site
		if (!is_admin()) {
			$filters = [
				[
					'key'   => 'condition_a',
					'value' => 'entire_site',
				],
			];
			$this->get_header_footer($filters);
		}

		// all archive
		if (is_archive()) {
			$filters = [
				[
					'key'   => 'condition_a',
					'value' => 'archive',
				],
			];
			$this->get_header_footer($filters);
		}

		// all singular
		if (is_page() || is_single() || is_404()) {
			$filters = [
				[
					'key'   => 'condition_a',
					'value' => 'singular',
				],
				[
					'key'   => 'condition_singular',
					'value' => 'all',
				],
			];
			$this->get_header_footer($filters);
		}

		// all pages, all posts, 404 page
		if (is_page()) {
			$filters = [
				[
					'key'   => 'condition_a',
					'value' => 'singular',
				],
				[
					'key'   => 'condition_singular',
					'value' => 'all_pages',
				],
			];
			$this->get_header_footer($filters);
		} elseif (is_single()) {
			$filters = [
				[
					'key'   => 'condition_a',
					'value' => 'singular',
				],
				[
					'key'   => 'condition_singular',
					'value' => 'all_posts',
				],
			];
			$this->get_header_footer($filters);
		} elseif (is_404()) {
			$filters = [
				[
					'key'   => 'condition_a',
					'value' => 'singular',
				],
				[
					'key'   => 'condition_singular',
					'value' => '404page',
				],
			];
			$this->get_header_footer($filters);
		}

		// singular selective
		if (is_page() || is_single()) {
			$filters = [
				[
					'key'   => 'condition_a',
					'value' => 'singular',
				],
				[
					'key'   => 'condition_singular',
					'value' => 'selective',
				],
				[
					'key'   => 'condition_singular_ids',
					'value' => get_the_ID(),
				],
			];
			$this->get_header_footer($filters);
		}

		// homepage
		if (is_home() || is_front_page()) {
			$filters = [
				[
					'key'   => 'condition_a',
					'value' => 'singular',
				],
				[
					'key'   => 'condition_singular',
					'value' => 'front_page',
				],
			];
			$this->get_header_footer($filters);
		}
	}

	protected function get_header_footer($filters)
	{
		$template_id = [];

		if ($this->templates != null) {
			foreach ($this->templates as $template) {
				$template    = $this->get_full_data($template);
				$match_found = true;

				// WPML Language Check
				if (defined('ICL_LANGUAGE_CODE')) :
					$current_lang = apply_filters('wpml_post_language_details', null, $template['ID']);

					if (!empty($current_lang) && !$current_lang['different_language'] && ($current_lang['language_code'] == ICL_LANGUAGE_CODE)) :
						$template_id[$template['type']] = $template['ID'];
					endif;
				endif;

				foreach ($filters as $filter) {
					if ($filter['key'] == 'condition_singular_ids') {
						$ids = $template[$filter['key']];
						if (!in_array($filter['value'], $ids)) {
							$match_found = false;
						}
					} elseif ($template[$filter['key']] != $filter['value']) {
						$match_found = false;
					}
					if ($filter['key'] == 'condition_a' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
						$match_found = false;
					}
					if ($match_found && $filter['key'] == 'condition_a' && $template[$filter['key']] == 'archive' && $template['condition_archive'] && 'all' !== $template['condition_archive']) {
						if (('category' === $template['condition_archive'] && !is_category())
							&& ('post_tag' === $template['condition_archive'] && !is_tag())
							&& !is_tax($template['condition_archive'])
						) {
							$match_found = false;
						}
					}
				}

				if ($match_found) {
					if ($template['type'] == 'header') {
						$this->header_template = isset($template_id['header']) ? $template_id['header'] : $template['ID'];
					}
					if ($template['type'] == 'footer') {
						$this->footer_template = isset($template_id['footer']) ? $template_id['footer'] : $template['ID'];
					}
				}
			}
		}
	}

	/**
	 * @param $post
	 *
	 * @return array
	 */
	protected function get_full_data($post)
	{
		if ($post != null) {
			$singular_ids = get_post_meta($post->ID, 'rtrb_builder_condition_singular_ids', true);
			$singular_ids = is_array($singular_ids) ? $singular_ids : [];

			return array_merge(
				(array) $post,
				[
					'type'                   => get_post_meta($post->ID, 'rtrb_builder_type', true),
					'condition_a'            => get_post_meta($post->ID, 'rtrb_builder_condition_a', true),
					'condition_singular'     => get_post_meta($post->ID, 'rtrb_builder_condition_singular', true),
					'condition_singular_ids' => $singular_ids,
					'condition_archive'      => get_post_meta($post->ID, 'rtrb_builder_condition_archive', true),
				]
			);
		}

		return [];
	}
}
