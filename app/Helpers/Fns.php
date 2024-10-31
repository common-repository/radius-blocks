<?php

namespace RadiusTheme\RB\Helpers;

use RadiusTheme\RB\Controllers\Builder\BuilderLoader;
use RadiusTheme\RB\Models\Builder\GutenbergEditor;
use RadiusTheme\RB\Models\Builder\RtrbBuilder;

class Fns
{
	public static $icon_json;

	/**
	 * @param        $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed|void
	 */
	public static function locate_template($template_name, $template_path = '', $default_path = '')
	{
		$template_name = $template_name . ".php";
		if (!$template_path) {
			$template_path = rtrb()->get_template_path();
		}

		if (!$default_path) {
			$default_path = rtrb()->plugin_path() . '/templates/';
		}
		// Look within passed path within the theme - this is priority.
		$template_files = [
			trailingslashit($template_path) . $template_name
		];

		$template = locate_template(apply_filters('rtrb_locate_template_files', $template_files, $template_name, $template_path, $default_path));

		// Get default template/.
		if (!$template) {
			$template = trailingslashit($default_path) . $template_name;
		}

		return apply_filters('rtrb_locate_template', $template, $template_name);
	}

	/**
	 * Template Content
	 *
	 * @param string $template_name Template name.
	 * @param array $args Arguments. (default: array).
	 * @param string $template_path Template path. (default: '').
	 * @param string $default_path Default path. (default: '').
	 */
	static function get_template($template_name, $args = null, $template_path = '', $default_path = '')
	{

		if (!empty($args) && is_array($args)) {
			extract($args); // @codingStandardsIgnoreLine
		}

		$located = self::locate_template($template_name, $template_path, $default_path);


		if (!file_exists($located)) {
			_doing_it_wrong(__FUNCTION__, sprintf(__('%s does not exist.', 'radius-blocks'), '<code>' . $located . '</code>'), '1.0.0');

			return;
		}

		// Allow 3rd party plugin filter template file from their plugin.
		$located = apply_filters('rtrb_get_template', $located, $template_name, $args);

		do_action('rtrb_before_template_part', $template_name, $located, $args);

		include $located;

		do_action('rtrb_after_template_part', $template_name, $located, $args);
	}

	/**
	 * Get template content and return
	 *
	 * @param string $template_name Template name.
	 * @param array $args Arguments. (default: array).
	 * @param string $template_path Template path. (default: '').
	 * @param string $default_path Default path. (default: '').
	 *
	 * @return string
	 */
	static public function get_template_html($template_name, $args = [], $template_path = '', $default_path = '')
	{
		ob_start();
		self::get_template($template_name, $args, $template_path, $default_path);
		return ob_get_clean();
	}

	public static function block_load_icons()
	{
		$json_file = RTRB_PATH . "assets/icons/gbicons.json";
		if (!file_exists($json_file)) {
			return [];
		}

		// Function has already run.
		if (null !== self::$icon_json) {
			return self::$icon_json;
		}
		$str = FileSystem::get_instance()->get_filesystem()->get_contents($json_file);
		//$str   = file_get_contents($json_file);
		$json_data = json_decode($str, true);
		if ($json_data === null && json_last_error() !== JSON_ERROR_NONE) {
			return [];
		}

		self::$icon_json = $json_data;

		return self::$icon_json;
	}

	/**
	 * Generate SVG.
	 *
	 * @param array $icon Decoded fontawesome json file data.
	 */
	public static function render_svg_html($icon)
	{
		$icon = sanitize_text_field(esc_attr($icon));

		$json = self::block_load_icons();
		if (isset($json[$icon]) && !empty($json[$icon])) {
			$path = isset($json[$icon]['svg']['brands']) ? $json[$icon]['svg']['brands']['path'] : $json[$icon]['svg']['solid']['path'];
			$view = isset($json[$icon]['svg']['brands']) ? $json[$icon]['svg']['brands']['viewBox'] : $json[$icon]['svg']['solid']['viewBox'];

			if (!empty($view) && is_array($view)) {
				$view = implode(' ', $view);
			}

			return sprintf(
				'<svg xmlns="https://www.w3.org/2000/svg" viewBox="%s" width="1em" height="1em" fill="currentColor"><path d="%s"></path></svg>',
				esc_attr($view),
				esc_attr($path)
			);
		}
	}

	/**
	 * wp_kses allowed html.
	 *
	 * @return array|\bool[][]
	 */
	public static function kses_allowed_svg()
	{
		$defaults = wp_kses_allowed_html('post');
		$svg_args = [
			'svg'   => [
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true,
			],
			'g'     => ['fill' => true],
			'title' => ['title' => true],
			'path'  => ['d' => true, 'fill' => true,],
		];

		return array_merge($defaults, $svg_args);
	}

	/**
	 * Get allowed html tag in wp_kses.
	 * 
	 * @access public
	 */
	public static function rtrb_get_allowed_html_tags($level = 'basic')
	{
		$allowed_html = [
			'b'      => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'i'      => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'u'      => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'br'     => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'em'     => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'del'    => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'ins'    => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'sub'    => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'sup'    => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'code'   => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'mark'   => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'small'  => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'strike' => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'abbr'   => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'span'   => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'strong' => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'hr'     => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'a'      => [
				'href'  => [],
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
		];

		if ('intermediate' === $level) {
			$tags = [
				'a'       => [
					'href'  => [],
					'title' => [],
					'class' => [],
					'id'    => [],
					'style' => [],
				],
				'img'     => [
					'src'     => [],
					'alt'     => [],
					'height'  => [],
					'width'   => [],
					'class'   => [],
					'id'      => [],
					'style'   => [],
					'srcset'  => [],
					'loading' => [],
					'sizes'   => [],
				],
				'time'    => [
					'datetime' => [],
					'class'    => [],
					'id'       => [],
					'style'    => [],
				],
				'cite'    => [
					'title' => [],
					'class' => [],
					'id'    => [],
					'style' => [],
				],
				'acronym' => [
					'title' => [],
					'class' => [],
					'id'    => [],
					'style' => [],
				],
				'svg'     => [
					'class'           => [],
					'aria-hidden'     => [],
					'aria-labelledby' => [],
					'role'            => [],
					'xmlns'           => [],
					'width'           => [],
					'height'          => [],
					'viewbox'         => [],
					'fill'            => []
				],
				'g'       => [
					'fill' => []
				],
				'title'   => [
					'title' => []
				],
				'path'    => [
					'd'    => [],
					'fill' => [],
				],
				'span'   => [
					'class' => [],
					'id'    => [],
					'style' => [],
				],
				'ul'   => [
					'class' => [],
					'id'    => [],
					'style' => [],
				],

				'li'   => [
					'class' => [],
					'id'    => [],
					'style' => [],
				],


			];

			$allowed_html = array_merge($allowed_html, $tags);
		}

		return $allowed_html;
	}

	/**
	 * Get basic html tag in wp_kses.
	 * 
	 * @access public
	 */
	public static function rtrb_kses_basic($string = '')
	{
		return wp_kses($string, self::rtrb_get_allowed_html_tags());
	}

	/**
	 * Get intermediate html tag in wp_kses.
	 * 
	 * @access public
	 */
	public static function rtrb_kses_intermediate($string = '')
	{
		return wp_kses($string, self::rtrb_get_allowed_html_tags('intermediate'));
	}

	/**
	 * Get accordion expanded item.
	 * 
	 * @access public
	 */
	public static function is_expanded_item($settings, $index)
	{

		$accordionType = $settings['accordionType'];
		$selectedTab   = $settings['selectedTab'];
		$expandedTabs  = $settings['expandedTabs'];

		// if ($accordionType === "accordion") {
		// 	return $selectedTab === $index;
		// }

		if ($accordionType === "accordion") {
			return 0 === $index;
		}

		if ($accordionType === "toggle") {
			return in_array($index, $expandedTabs);
		}
	}

	public static function is_active_item($settings, $index)
	{
		$activeItem = $settings['activeItem'];
		$itemNumber = (int)$settings['itemNumber'] - 1;
		if ($activeItem) {
			return $itemNumber === $index;
		}
	}

	/**
	 * Get Post Types.
	 * 
	 * @access public
	 */
	public static function get_post_types()
	{

		$post_types = get_post_types(
			array(
				'public'       => true,
				'show_in_rest' => true,
			),
			'objects'
		);

		$options = array();

		foreach ($post_types as $post_type) {
			if ('product' === $post_type->name) {
				continue;
			}

			if ('attachment' === $post_type->name) {
				continue;
			}

			$options[] = array(
				'value' => $post_type->name,
				'label' => $post_type->label,
			);
		}

		return apply_filters('rtrb_loop_post_types', $options);
	}

	/**
	 * Get all taxonomies.
	 * 
	 * @access public
	 */
	public static function get_related_taxonomy()
	{

		$post_types = self::get_post_types();

		$return_array = array();

		foreach ($post_types as $key => $value) {
			$post_type = $value['value'];

			$taxonomies = get_object_taxonomies($post_type, 'objects');
			$data       = array();

			foreach ($taxonomies as $tax_slug => $tax) {
				if (!$tax->public || !$tax->show_ui || !$tax->show_in_rest) {
					continue;
				}

				$data[$tax_slug] = $tax;

				$terms = get_terms($tax_slug);

				$related_tax = array();

				if (!empty($terms)) {
					foreach ($terms as $t_index => $t_obj) {
						$related_tax[] = array(
							'id'    => $t_obj->term_id,
							'name'  => $t_obj->name,
							'child' => get_term_children($t_obj->term_id, $tax_slug),
						);
					}
					$return_array[$post_type]['terms'][$tax_slug] = $related_tax;
				}
			}

			$return_array[$post_type]['taxonomy'] = $data;
		}

		return apply_filters('rtrb_post_loop_taxonomies', $return_array);
	}

	public static function get_all_users()
	{
		$users = [];
		$u     = get_users(apply_filters('rtrb_author_arg', []));
		if (!empty($u)) {
			foreach ($u as $user) {
				$users[] = array('value' => $user->ID, 'label' => $user->display_name);
			}
		}
		return $users;
	}

	public static function get_all_taxonomy_guten()
	{
		$post_types     = Fns::get_post_types_for_taxonomy();
		$taxonomies     = get_taxonomies([], 'objects');
		$all_taxonomies = [];
		foreach ($taxonomies as $taxonomy => $object) {
			if (!isset($object->object_type[0]) || !in_array($object->object_type[0], array_keys($post_types)) || in_array($taxonomy, Fns::get_excluded_taxonomy())) {
				continue;
			}
			$all_taxonomies[$taxonomy] = Fns::get_terms_by_texonomy($taxonomy);
		}

		return $all_taxonomies;
	}

	public static function get_post_types_for_taxonomy()
	{
		$post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
		$post_types = wp_list_pluck($post_types, 'label', 'name');
		return array_diff_key($post_types, ['elementor_library', 'attachment']);
	}

	public static function get_excluded_taxonomy()
	{
		return [
			'post_format',
			'nav_menu',
			'link_category',
			'wp_theme',
			'elementor_library_type',
			'elementor_library_type',
			'elementor_library_category',
			'product_visibility',
			'product_shipping_class',
		];
	}

	public static function get_terms_by_texonomy($cat)
	{
		$terms = get_terms([
			'taxonomy'   => $cat,
			'hide_empty' => true,
		]);

		$options = [];
		if (!empty($terms) && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				$options[$term->term_id] = $term->name;
			}
		}
		return $options;
	}

	public static function get_the_title($post_id, $data = [])
	{
		$title      = $originalTitle = get_the_title($post_id);
		$limit      = isset($data['titleWord']) ? absint($data['titleWord']) : 0;
		$limit_type = isset($data['titleLimitType']) ? trim($data['titleLimitType']) : 'character';
		if ($limit) {
			if ($limit_type == "word") {
				$limit = $limit + 1;
				$title = explode(' ', $title, $limit);
				if (count($title) >= $limit) {
					array_pop($title);
					$title = implode(" ", $title);
				} else {
					$title = $originalTitle;
				}
			} else {
				if ($limit > 0 && strlen($title) > $limit) {
					$title = mb_substr($title, 0, $limit, "utf-8");
					$title = preg_replace('/\W\w+\s*(\W*)$/', '$1', $title);
				}
			}
		}

		return apply_filters('rtrb_get_the_title', $title, $post_id, $data, $originalTitle);
	}

	public static function get_the_excerpt($post_id, $data = [])
	{
		$type = $data['excerptType'];
		$post = get_post($post_id);
		if (empty($post)) {
			return '';
		}
		if ($type == 'full_content') {
			$content = get_the_content(null, false, $post_id);
			return apply_filters('rtrb_content_full', $content, $post_id, $data);
		} else if ($type == 'full_excerpt') {
			$excerpt = get_the_excerpt($post_id);
			$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
			return apply_filters('rtrb_excerpt_full', $excerpt, $post_id, $data);
		} else {
			$defaultExcerpt = get_the_excerpt($post_id);
			$limit   = isset($data['excerptWord']) && $data['excerptWord'] ? abs($data['excerptWord']) : 0;
			$more    = $data['excerptMoreText'];
			$excerpt = preg_replace('`\[[^\]]*\]`', '', $defaultExcerpt);
			$excerpt = strip_shortcodes($excerpt);
			$excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
			$excerpt = str_replace('…', '', $excerpt);
			if ($limit) {
				$excerpt = wp_strip_all_tags($excerpt);
				if ($type == "word") {
					$limit      = $limit + 1;
					$rawExcerpt = $excerpt;
					$excerpt    = explode(' ', $excerpt, $limit);
					if (count($excerpt) >= $limit) {
						array_pop($excerpt);
						$excerpt = implode(" ", $excerpt);
					} else {
						$excerpt = $rawExcerpt;
					}
				} else {
					$excerpt = self::rtrbCharacterLimit($limit, $excerpt);
				}
				$excerpt = stripslashes($excerpt);
			} else {
				$allowed_html = [
					'a'      => [
						'href'  => [],
						'title' => [],
					],
					'strong' => [],
					'b'      => [],
					'br'     => [[]],
				];
				$excerpt      = nl2br(wp_kses($excerpt, $allowed_html));
			}
			$excerpt = ($more ? $excerpt . " " . $more : $excerpt);

			return apply_filters('rtrb_get_the_excerpt', $excerpt, $post_id, $data, $defaultExcerpt);
		}
	}

	public static function rtrbCharacterLimit($limit, $excerpt)
	{
		$excerpt = preg_replace(" ([.*?])", '', $excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, $limit);
		$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		$excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
		return $excerpt;
	}

	public static function pagination($max_pages)
	{
		global $paged;

		if (!empty(get_query_var('page')) || !empty(get_query_var('paged'))) {
			$paged = is_front_page() ? absint(get_query_var('page')) : absint(get_query_var('paged'));
		} else {
			$paged = 1;
		}

		if ($max_pages > 1) {
			$big = 9999999;
			return paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format'        => '?paged=%#%',
				'current' => $paged,
				'total' => $max_pages,
				'prev_text'          => sprintf(__('<span>%1$s</span>', 'radius-blocks'), self::render_svg_html('angle-double-left')),
				'next_text'          => sprintf(__('<span>%1$s</span>', 'radius-blocks'), self::render_svg_html('angle-double-right')),
			));
		}
	}

	public static function get_block_content($content)
	{
		return !empty($content) ? $content : '';
	}

	public static function builder_archive_conditions_list()
	{
		$conditions     = [
			'all-archives' => [
				'label'   => 'All',
				'options' => ['all' => __('All Archives', 'radius-blocks'),]
			]
		];
		$get_post_types = get_post_types(['show_in_nav_menus' => true], 'objects');
		foreach ($get_post_types as $post_type => $postTypeObject) {
			if (!get_post_type_archive_link($post_type)) {
				continue;
			}
			$conditions[$post_type]['label']   = $postTypeObject->label;
			$conditions[$post_type]['options'][$post_type . '_archive'] = sprintf(__('Default %s Archive', 'radius-blocks'), $postTypeObject->label);

			$taxonomies      = get_object_taxonomies($post_type, 'objects');
			$taxonomies_list = wp_filter_object_list($taxonomies, [
				'public'            => true,
				'show_in_nav_menus' => true,
			]);

			foreach ($taxonomies_list as $taxonomy) {
				$conditions[$post_type]['options'][$taxonomy->name] = sprintf(__('%s : %s', 'radius-blocks'), $postTypeObject->label, $taxonomy->label);
			}
		}


		return $conditions;
	}

	public static function get_active_page_builder($post_id)
	{
		global $wp_post_types;
		//$post = get_post($post_id);
		$has_rest_support = $wp_post_types['rtrb_builder']->show_in_rest;
		if ($has_rest_support) {
			return new GutenbergEditor($post_id);
		}
		return new RtrbBuilder($post_id);
	}

	/**
	 * @param $type string header|footer
	 *
	 * @return void
	 */
	public static function render_builder_content($type)
	{
		$template = BuilderLoader::template_ids();
		if (empty($template[$type])) {
			return;
		}
		$post_id = $template[$type];

		$builder = self::get_active_page_builder($post_id);
		$builder->render_content();
	}

	/**
	 * Has block function which searches as well in reusable blocks.
	 *
	 * @param mixed $block_name Full Block type to look for.
	 * @return bool
	 */
	public static function rtrb_has_block($block_name)
	{
		if (has_block($block_name)) {
			return true;
		}
		if (has_block('core/block')) {
			$content = get_post_field('post_content');
			$blocks = parse_blocks($content);
			return self::rtrb_search_reusable_blocks_innerblocks($blocks, $block_name);
		}
		return false;
	}

	/**
	 * Search for the selected block within inner blocks.
	 *
	 * The helper function for rtrb_has_block() function.
	 *
	 * @param array $blocks Blocks to loop through.
	 * @param string $block_name Full Block type to look for.
	 * @return bool
	 */
	public static function rtrb_search_reusable_blocks_innerblocks($blocks, $block_name)
	{
		foreach ($blocks as $block) {
			if (isset($block['innerBlocks']) && !empty($block['innerBlocks'])) {
				self::rtrb_search_reusable_blocks_innerblocks($block['innerBlocks'], $block_name);
			} elseif ('core/block' === $block['blockName'] && !empty($block['attrs']['ref']) && has_block($block_name, $block['attrs']['ref'])) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Get Global Plugin Settings
	 * @param STRING  key of the settings
	 * @return ARRAY
	 */
	public static function get_setting($key = '')
	{
		$data = $GLOBALS['rtrb_settings'];
		if ($key != '') {
			return isset($data[$key]) ? $data[$key] : '';
		} else {
			return $data;
		}
	}


	/**
	 * set settings
	 * 
	 * @param STRING  key and options
	 * @return NULL
	 */
	public static function set_setting($key = '', $val = '')
	{
		if ($key != '') {
			$data = $GLOBALS['rtrb_settings'];
			$data[$key] = $val;
			update_option('rtrb_options', $data);
			$GLOBALS['rtrb_settings'] = $data;
		}
	}

	/**
	 * Get FluentForms List
	 *
	 * @return array
	 */
	public static function get_fluent_forms_list()
	{
		$options = array();

		if (defined('FLUENTFORM')) {
			global $wpdb;
			$options[0]['label'] = __('Select a Form', 'radius-blocks');
			$options[0]['value'] = '';
			$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}fluentform_forms");

			if (!empty($result)) {
				foreach ($result as $key => $form) {
					$options[$key + 1]['label'] = $form->title;
					$options[$key + 1]['value'] = $form->id;
					$options[$key + 1]['attr'] = self::get_form_attr($form->id);
				}
			}
		}

		return $options;
	}

	/**
	 * Get Form Attribute
	 */
	public static function get_form_attr($form_id)
	{
		return  \FluentForm\App\Helpers\Helper::getFormMeta($form_id, 'template_name');
	}

	/**
	 * Get Contact form7 Lists
	 *
	 * @return array
	 */
	public static function get_contact_forms_list()
	{
		$options = array();
		if (class_exists('WPCF7_ContactForm')) {
			$options[0]['label'] = __('Select a Form', 'radius-blocks');
			$options[0]['value'] = '';

			$args             = array(
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => -1,
			);
			$forms            = get_posts($args);

			if (!empty($forms)) {
				foreach ($forms as $key => $form) {
					$options[$key + 1]['label'] = $form->post_title;
					$options[$key + 1]['value'] = $form->ID;
				}
			}
		}

		return $options;
	}

	public static function rtrb_social_share_link($id, $network)
	{
		if (empty($network)) {
			return;
		}

		$post_title = get_the_title($id);
		$post_link = get_the_permalink($id);

		if ('facebook' == $network) {
			return esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $post_link);
		} elseif ('linkedin' == $network) {
			return esc_url('https://www.linkedin.com/shareArticle?title=' . $post_title . "&url=" . $post_link . '&mini=true');
		} elseif ('twitter' == $network) {
			return esc_url("https://twitter.com/share?text=" . $post_title . "&url=" . $post_link);
		} elseif ('pinterest' == $network) {
			return esc_url('https://pinterest.com/pin/create/button/?url=' . $post_link);
		} elseif ('reddit' == $network) {
			return esc_url('https://www.reddit.com/submit?url=' . $post_link . "&title=" . $post_title);
		} elseif ('tumblr' == $network) {
			return esc_url('https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $post_link);
		} elseif ('whatsapp' == $network) {
			return esc_url('https://api.whatsapp.com/send?text=' . $post_title . " " . $post_link);
		} elseif ('telegram' == $network) {
			return esc_url('https://telegram.me/share/url?url=' . $post_link . '&text=' . $post_title);
		} elseif ('pocket' == $network) {
			return esc_url('https://getpocket.com/edit?url=' . $post_link);
		} elseif ('envelope' == $network) {
			return esc_url('mailto:?subject=' . $post_title . '&body=' . $post_link);
		} elseif ('xing' == $network) {
			return esc_url('https://www.xing.com/spi/shares/new?url=' . $post_link);
		} elseif ('vk' == $network) {
			return esc_url('https://vk.com/share.php?url=' . $post_link);
		}
	}

	public static function rtrb_change_cart_text($pType, $settings)
	{
		$text = '';
		switch ($pType) {
			case 'simple':
				$text = $settings['simpleProductCartText'];
				break;
			case 'variable':
				$text = $settings['variableProductCartText'];
				break;
			case 'grouped':
				$text = $settings['groupedProductCartText'];
				break;
			case 'external':
				$text = $settings['externalProductCartText'];
				break;
			default:
				$text = '';
				break;
		}
		return '<span class="btn-text">' . $text . '</span>';
	}

	public static function is_contact_form_exist($form_id)
	{
		global $wpdb;
		$query = $wpdb->prepare(
			"SELECT ID FROM {$wpdb->prefix}posts WHERE ID = %d AND post_status = 'publish'",
			$form_id
		);
		$result = $wpdb->get_results($query);
		return !empty($result) ? $result[0]->ID : '';
	}
}
