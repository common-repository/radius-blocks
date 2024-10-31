<?php

namespace RadiusTheme\RB\Controllers\Builder;

use RadiusTheme\RB\Traits\SingletonTrait;

class BuilderAjaxController
{

	use SingletonTrait;

	public function __construct()
	{
		add_action('wp_ajax_rtrb_builder_ajax_singular_list', [$this, 'get_singular_list']);
		add_action('wp_ajax_rtrb_builder_ajax_builder_update', [$this, 'update_builder']);
		add_action('wp_ajax_rtrb_builder_ajax_builder_get', [$this, 'get_builder']);
	}

	public function get_builder()
	{
		if (!current_user_can('manage_options')) {
			wp_send_json_error();
		}
		$id   = !empty($_REQUEST['id']) ? absint($_REQUEST['id']) : 0;
		$post = get_post($id);
		$data = [];
		if ($post) {
			$data = [
				'title'                  => $post->post_title,
				'status'                 => $post->post_status,
				'activation'             => !empty(get_post_meta($post->ID, 'rtrb_builder_activation', true)),
				'type'                   => get_post_meta($post->ID, 'rtrb_builder_type', true),
				'condition_a'            => get_post_meta($post->ID, 'rtrb_builder_condition_a', true),
				'condition_singular'     => get_post_meta($post->ID, 'rtrb_builder_condition_singular', true),
				'condition_singular_ids' => get_post_meta($post->ID, 'rtrb_builder_condition_singular_ids', true),
				'condition_archive'      => get_post_meta($post->ID, 'rtrb_builder_condition_archive', true),
			];
		}

		wp_send_json_success($data);
	}

	public function update_builder()
	{
		if (!current_user_can('manage_options')) {
			wp_send_json_error();
		}

		$id = !empty($_REQUEST['id']) ? absint($_REQUEST['id']) : 0;

		$title                   = empty($_REQUEST['title']) ? ('Radius Builder Template #' . time()) : sanitize_text_field($_REQUEST['title']);
		$activation              = !empty($_REQUEST['activation']) ? 1 : 0;
		$type                    = !empty($_REQUEST['type']) && in_array($_REQUEST['type'], ['header', 'footer', 'page', 'section'], true) ? sanitize_text_field($_REQUEST['type']) : 'header';
		$_condition_a            = !empty($_REQUEST['condition_a']) ? sanitize_text_field($_REQUEST['condition_a']) : '';
		$_condition_singular     = !empty($_REQUEST['condition_singular']) ? sanitize_text_field($_REQUEST['condition_singular']) : '';
		$_condition_singular_ids = !empty($_REQUEST['condition_singular_ids']) ? array_map('absint', $_REQUEST['condition_singular_ids']) : '';
		$_condition_archive      = !empty($_REQUEST['condition_archive']) ? sanitize_text_field($_REQUEST['condition_archive']) : 'all';
		$_condition_a            = ($type == 'section') ? '' : $_condition_a;
		$_condition_singular     = ($type == 'section') ? '' : $_condition_singular;
		$_condition_singular_ids = ($type == 'section') ? '' : (is_array($_condition_singular_ids) && !empty($_condition_singular_ids) ? $_condition_singular_ids : '');
		$_condition_archive      = ($type == 'section') ? '' : $_condition_archive;
		$post_data               = [
			'post_title'  => $title,
			'post_status' => 'publish',
			'post_type'   => 'rtrb_builder',
		];
		$post  = $id ? get_post($id) : null;
		if ($post == null) {
			$id = wp_insert_post($post_data);
		} else {
			$post_data['ID'] = $id;
			wp_update_post($post_data);
		}

		update_post_meta($id, '_wp_page_template', 'rtrb_builder_canvas');
		update_post_meta($id, 'rtrb_builder_activation', $activation);
		update_post_meta($id, 'rtrb_builder_type', $type);
		delete_post_meta($id, 'rtrb_builder_condition_a');
		delete_post_meta($id, 'rtrb_builder_condition_singular');
		delete_post_meta($id, 'rtrb_builder_condition_singular_ids');
		delete_post_meta($id, 'rtrb_builder_condition_archive');
		$condition_a = $condition_singular = $condition_singular_ids = $condition_archive = '';
		if ('section' !== $type) {
			$condition_a = $_condition_a;
			update_post_meta($id, 'rtrb_builder_condition_a', $_condition_a);
			if ('singular' === $condition_a) {
				$condition_singular = $_condition_singular;
				update_post_meta($id, 'rtrb_builder_condition_singular', $_condition_singular);
				if ($condition_singular === 'selective') {
					$condition_singular_ids = $_condition_singular_ids;
					update_post_meta($id, 'rtrb_builder_condition_singular_ids', $_condition_singular_ids);
				}
			}

			if ('archive' === $condition_a) {
				$condition_archive = $_condition_archive;
				update_post_meta($id, 'rtrb_builder_condition_archive', $_condition_archive);
			}
		}

		// if wpml is active and wpml not set for this post
		if (defined('ICL_SITEPRESS_VERSION')) {
			global $sitepress;
			$wpml_element_type = apply_filters('wpml_element_type', 'rtrb_builder');
			$sitepress->set_element_language_details($id, $wpml_element_type, false, $sitepress->get_current_language(), null, false);
		}

		$cond = ucwords(
			str_replace(
				'_',
				' ',
				$condition_a
					. (($condition_a == 'singular')
						? (($condition_singular != '')
							? (' > ' . $condition_singular
								. (!empty($condition_singular_ids) && is_array($condition_singular_ids)
									? ' > ' . implode(', ', $condition_singular_ids)
									: ''))
							: '')
						: ($condition_a == 'archive'
							? (($condition_archive != '')
								? ' > ' . $condition_archive
								: '') : ''))
			)
		);

		$data = [
			'id'         => $id,
			'title'      => $title,
			'type'       => $type,
			'activation' => !empty($activation),
			'cond_text'  => $cond,
			'type_html'  => (ucfirst($type) . ($activation
				? ('<span class="rtrb-builder-status active">' . esc_html__('Active', 'radius-blocks') . '</span>')
				: ('<span class="rtrb-builder-status inactive">' . esc_html__('Inactive', 'radius-blocks') . '</span>'))),
		];

		wp_send_json_success($data);
	}

	public function get_singular_list()
	{
		$query_args = [
			'post_status'    => 'publish',
			'posts_per_page' => 15,
			'post_type'      => 'any',
		];

		if (isset($_REQUEST['ids']) && is_array($_REQUEST['ids']) && !empty($_REQUEST['ids'])) {
			$query_args['post__in'] = array_map('absint', $_REQUEST['ids']);
		}
		if (isset($_REQUEST['s'])) {
			$query_args['s'] = sanitize_text_field($_REQUEST['s']);
		}

		$query   = new \WP_Query($query_args);
		$options = [];
		if ($query->have_posts()) :

			while ($query->have_posts()) {
				$query->the_post();
				$options[] = [
					'id'   => get_the_ID(),
					'text' => get_the_title(),
				];
			}
		endif;
		wp_reset_postdata();

		wp_send_json(['results' => $options]);
	}
}
