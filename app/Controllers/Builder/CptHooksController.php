<?php

namespace RadiusTheme\RB\Controllers\Builder;

use RadiusTheme\RB\Helpers\Fns;
use RadiusTheme\RB\Traits\SingletonTrait;

class CptHooksController
{
	use SingletonTrait;

	public function __construct()
	{
		add_action('admin_init', [$this, 'add_author_support_to_column'], 10);
		add_filter('manage_rtrb_builder_posts_columns', [$this, 'set_columns']);
		add_action('manage_rtrb_builder_posts_custom_column', [$this, 'render_column'], 10, 2);
		add_filter('parse_query', [$this, 'query_filter']);
	}

	public function add_author_support_to_column()
	{
		add_post_type_support('rtrb_builder', 'author');
	}


	/**
	 * Set custom column for template list.
	 */
	public function set_columns($columns)
	{

		$date_column   = $columns['date'];
		$author_column = $columns['author'];

		unset($columns['date']);
		unset($columns['author']);

		$columns['type']      = esc_html__('Type', 'radius-blocks');
		$columns['condition'] = esc_html__('Conditions', 'radius-blocks');
		$columns['date']      = $date_column;
		$columns['author']    = $author_column;

		return $columns;
	}

	/**
	 * Render Column
	 *
	 * Enqueue js and css to frontend.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function render_column($column, $post_id)
	{
		switch ($column) {
			case 'type':
				$type   = get_post_meta($post_id, 'rtrb_builder_type', true);
				$active = get_post_meta($post_id, 'rtrb_builder_activation', true);

				$output = ucfirst($type) . ($active
					? ('<span class="rtrb-builder-status active">' . esc_html__('Active', 'radius-blocks') . '</span>')
					: ('<span class="rtrb-builder-status inactive">' . esc_html__('Inactive', 'radius-blocks') . '</span>'));

				echo wp_kses($output, Fns::rtrb_get_allowed_html_tags());

				break;
			case 'condition':
				$cond = [
					'condition_a'            => get_post_meta($post_id, 'rtrb_builder_condition_a', true),
					'condition_singular'     => get_post_meta($post_id, 'rtrb_builder_condition_singular', true),
					'condition_singular_ids' => get_post_meta($post_id, 'rtrb_builder_condition_singular_ids', true),
					'condition_archive'      => get_post_meta($post_id, 'rtrb_builder_condition_archive', true),
				];

				echo esc_html(ucwords(
					str_replace(
						'_',
						' ',
						$cond['condition_a']
							. (($cond['condition_a'] == 'singular')
								? (($cond['condition_singular'] != '')
									? (' > ' . $cond['condition_singular']
										. (!empty($cond['condition_singular_ids']) && is_array($cond['condition_singular_ids'])
											? ' > ' . implode(', ', $cond['condition_singular_ids'])
											: ''))
									: '')
								: ($cond['condition_a'] == 'archive'
									? (($cond['condition_archive'] != '')
										? ' > ' . $cond['condition_archive']
										: '') : ''))
					)
				));

				break;
		}
	}

	public function query_filter($query)
	{
		global $pagenow;
		$current_page = isset($_GET['post_type']) ? sanitize_text_field(wp_unslash($_GET['post_type'])) : '';

		if (
			is_admin()
			&& 'rtrb_builder' == $current_page
			&& 'edit.php' == $pagenow
			&& isset($_GET['rtrb_builder_type'])
			&& $_GET['rtrb_builder_type'] != ''
			&& $_GET['rtrb_builder_type'] != 'all'
		) {
			$type                              = sanitize_text_field(wp_unslash($_GET['rtrb_builder_type']));
			$query->query_vars['meta_key']     = 'rtrb_builder_type';
			$query->query_vars['meta_value']   = $type;
			$query->query_vars['meta_compare'] = '=';
		}
	}
}
