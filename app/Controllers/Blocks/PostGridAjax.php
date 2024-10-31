<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class PostGridAjax
{
	public function __construct()
	{
		add_action('wp_ajax_nopriv_rtrb_post_grid_data', [$this, 'rtrb_post_grid_data']);
		add_action('wp_ajax_rtrb_post_grid_data', [$this, 'rtrb_post_grid_data']);

		//get categories for category box block
		add_action('wp_ajax_nopriv_rtrb_get_image_size', [$this, 'rtrb_get_image_size']);
		add_action('wp_ajax_rtrb_get_image_size', [$this, 'rtrb_get_image_size']);

		add_action('wp_ajax_rtrb_cf7_shortcode', array($this, 'rtrb_cf7_shortcode'));
		add_action('wp_ajax_nopriv_rtrb_rtrb_cf7_shortcode', array($this, 'rtrb_cf7_shortcode'));
	}

	public function rtrb_cf7_shortcode()
	{
		if (!wp_verify_nonce($_POST['rtrb_nonce'], 'rtrb-nonce')) {
			wp_send_json_error(esc_html__('Session Expired!!', 'radius-blocks'));
		}

		$formId = intval($_POST['formId']);
		$formId = Fns::is_contact_form_exist($formId);

		if (!empty($formId)) {
			$data['html'] = do_shortcode('[contact-form-7 id="' . $formId . '" ajax="true"]');
		} else {
			$data['html'] = '<p>' . __('Please select a valid Contact Form 7.', 'radius-blocks') . '</p>';
		}
		wp_send_json_success($data);
	}

	public static function rtrb_post_query($data, $prefix = '')
	{
		$results = [];
		$postShowPagination = $data['postShowPagination'] == 'true' ? true : false;

		$args = [
			'post_type'   => [$data['postType']],
			'post_status' => $data['postStatus'],
		];

		$excluded_ids = null;

		if ($data['postInclude']) {
			$post_ids = explode(',', $data['postInclude']);
			$post_ids = array_map('trim', $post_ids);

			$args['post__in'] = $post_ids;

			if ($excluded_ids != null && is_array($excluded_ids)) {
				$args['post__in'] = array_diff($post_ids, $excluded_ids);
			}
		}

		if ($postShowPagination) {
			$_paged        = is_front_page() ? "page" : "paged";
			$args['paged'] = get_query_var($_paged) ? absint(get_query_var($_paged)) : 1;
		}

		if ($orderby = $data['postOrderBy']) {
			$args['orderby'] = $orderby;
		}

		if ($data['postSortOrder']) {
			$args['order'] = $data['postSortOrder'];
		}

		if (!empty($data['postAuthors'])) {
			$args['author__in'] = wp_list_pluck($data['postAuthors'], 'value');
		}

		if (!empty($data['postTaxonomies'])) {
			foreach ($data['postTaxonomies'] as $index => $texonomy) {
				if (!empty($texonomy['options'])) {
					$args['tax_query'][] = [
						'taxonomy' => $texonomy['name'],
						'field'    => 'term_id',
						'terms'    => wp_list_pluck($texonomy['options'], 'value'),
					];
				}
			}
		}

		if (!empty($args['tax_query']) && $data['postTaxnomyRelation']) {
			$args['tax_query']['relation'] = $data['postTaxnomyRelation'];
		}

		if ($data['postKeyword']) {
			$args['s'] = $data['postKeyword'];
		}

		if ($data['postLimit']) {
			if (!$postShowPagination) {
				$args['posts_per_page'] = $data['postLimit'];
			} else {
				$tempArgs                   = $args;
				$tempArgs['posts_per_page'] = $data['postLimit'];
				$tempArgs['paged']          = 1;
				$tempArgs['fields']         = 'ids';
				$tempQ                      = new \WP_Query($tempArgs);
				if (!empty($tempQ->posts)) {
					$args['post__in']       = $tempQ->posts;
					$args['posts_per_page'] = $data['postLimit'];
				}
			}
		} else {
			$_posts_per_page = 9;
			$args['posts_per_page'] = $_posts_per_page;
		}

		if ($postShowPagination && $data['postDisplayPerPage']) {
			$args['posts_per_page'] = $data['postDisplayPerPage'];
		}

		if ($data['postExclude'] || $data['postOffset']) {

			$excluded_ids = [];
			if ($data['postExclude']) {
				$excluded_ids = explode(',', $data['postExclude']);
				$excluded_ids = array_map('trim', $excluded_ids);
			}

			$offset_posts = [];
			if ($data['postOffset']) {
				$_temp_args = $args;
				unset($_temp_args['paged']);
				$_temp_args['posts_per_page'] = $data['postOffset'];
				$_temp_args['fields'] = 'ids';
				$offset_posts = get_posts($_temp_args);
			}

			$excluded_post_ids    = array_merge($offset_posts, $excluded_ids);
			$args['post__not_in'] = array_unique($excluded_post_ids);
		}

		$postTaxonomies = [
			'category' => 'category',
			'post_tag' => 'post_tag',
		];

		//thumbnail size
		$thumbnailSize = '';
		if ($data['thumbnailSize']) {
			$thumbnailSize = $data['thumbnailSize'];
			if ('custom' == $thumbnailSize) {
				if (isset($data['customThumbnailWidth']) && isset($data['customThumbnailHeight'])) {
					$thumbnailSize = array(
						$data['customThumbnailWidth'],
						$data['customThumbnailHeight'],
					);
				}
			}
		}

		$query  = new \WP_Query($args);
		if ($query->have_posts()) {
			$pCount = 1;

			while ($query->have_posts()) :
				$query->the_post();
				$post_id = get_the_ID();
				$pCount++;

				$results[] = [
					"ID" => $post_id,
					"title" => get_the_title(),
					"thumbnail" => get_the_post_thumbnail($post_id, $thumbnailSize),
					"taxonomy_terms" => self::taxonomy_terms($postTaxonomies, $post_id),
					"excerpt" => get_the_excerpt($post_id),
					"content" => get_the_content(),
					"date" => get_the_date(),
					"author" => get_the_author(),
					"author_link" => get_the_author_link(),
					"post_link" => get_post_permalink(),
					"avatar" => get_avatar(get_the_author(), 50, '', 'avatar'),
					"category" => self::get_texonomy_by_term('category', $post_id),
					"meta_category" => self::get_texonomy_by_term('category', $post_id, true),
					"post_tag" => self::get_texonomy_by_term('post_tag', $post_id, true)
				];

			endwhile;
			wp_reset_postdata();
		}


		return [
			"args" => $args,
			"total_post" => $query->found_posts,
			"total_page" => $query->max_num_pages,
			"posts" => $results,
			"query" => $query,
			"settings" => $data
		];
	}

	public static function taxonomy_terms($postTaxonomies, $post_id)
	{
		$tax_terms = [];

		if (!empty($postTaxonomies)) {
			foreach ($postTaxonomies as $index => $texonomy) {
				$taxTerms = wp_get_object_terms($post_id, $index);
				//$html = '';
				if (!empty($taxTerms)) {
					$terms = array();
					foreach ($taxTerms as $taxTerm) {
						$terms[] = sprintf(
							'<a href="%s">%s</a>',
							get_term_link($taxTerm),
							$taxTerm->name
						);
					}
					//$html = implode(', ', $terms);
				}

				if (!empty($terms)) {
					$tax_terms[$index] = $terms;
					$terms = [];
				}
			}
		}

		return $tax_terms;
	}

	public static function get_texonomy_by_term($taxnomy_name, $post_id, $seperate = false)
	{
		$terms = [];
		$html = '';
		$taxTerms = wp_get_object_terms($post_id, $taxnomy_name);
		if (!empty($taxTerms)) {
			foreach ($taxTerms as $taxTerm) {
				$terms[] = sprintf(
					'<a  href="%s" class="rtrb-meta">%s</a>',
					get_term_link($taxTerm),
					$taxTerm->name
				);
			}
			$html = implode(', ', $terms);
		}

		if ($seperate) {
			return $html;
		}
		return $terms;
	}

	public function rtrb_post_grid_data()
	{
		if (!wp_verify_nonce($_POST['rtrb_nonce'], 'rtrb-nonce')) {
			wp_send_json_error(esc_html__('Session Expired!!', 'radius-blocks'));
		}

		$data = map_deep(wp_unslash($_POST['attributes']), 'sanitize_text_field');

		$results = self::rtrb_post_query($data);

		if (!empty($results["posts"])) {
			wp_send_json_success($results);
		} else {
			wp_send_json_error("no post found");
		}
	}

	public function rtrb_get_image_size()
	{
		global $_wp_additional_image_sizes;
		if (!wp_verify_nonce($_POST['rtrb_nonce'], 'rtrb-nonce')) {
			wp_send_json_error(esc_html__('Session Expired!!', 'radius-blocks'));
		}

		$sizes = array();
		$image_name_sizes = array();
		foreach (get_intermediate_image_sizes() as $s) {
			$sizes[$s] = array(0, 0);
			if (in_array($s, array('thumbnail', 'medium', 'medium_large', 'large'))) {
				$sizes[$s][0] = get_option($s . '_size_w');
				$sizes[$s][1] = get_option($s . '_size_h');
			} else {
				if (isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$s])) {
					$sizes[$s] = array($_wp_additional_image_sizes[$s]['width'], $_wp_additional_image_sizes[$s]['height']);
				}
			}
		}
		foreach ($sizes as $size => $atts) {
			$remove_uh_sizes = str_replace('_', ' ', $size);
			$remove_uh_sizes = ucwords(str_replace('-', ' ', $remove_uh_sizes));
			$image_name_sizes[$size] = $remove_uh_sizes . ' ' . implode('x', $atts);
		}

		if (rtrb()->hasPro()) {
			$image_name_sizes['custom'] = 'Custom';
		}

		if (!empty($image_name_sizes)) {
			wp_send_json_success($image_name_sizes);
		} else {
			wp_send_json_error("no image size");
		}
		wp_die();
	}
}
