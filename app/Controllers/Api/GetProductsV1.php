<?php

namespace RadiusTheme\RB\Controllers\Api;

use WP_Query;

class GetProductsV1
{
	public function __construct()
	{
		add_action("rest_api_init", [$this, 'register_product_route']);
		add_action('wp_ajax_rtrb_add_to_cart', [$this, 'woo_product_add_to_cart']);
		add_action('wp_ajax_nopriv_rtrb_add_to_cart', [$this, 'woo_product_add_to_cart']);
	}

	public function woo_product_add_to_cart()
	{
		$product_id = $_POST['product_id'];
		$quantity = $_POST['quantity'];

		$result = WC()->cart->add_to_cart($product_id, $quantity);

		if ($result) {
			$response = array(
				'success' => true,
				'cart_url' => wc_get_cart_url()
			);
		} else {
			$response = array(
				'success' => false,
				'message' => __('Unable to add item to cart', 'your-text-domain')
			);
		}

		wp_send_json($response);
		wp_die();
	}

	public function register_product_route()
	{
		register_rest_route('rtrb/v1', 'products', [
			'methods'             => 'POST',
			'callback'            => [$this, 'get_all_products'],
			'permission_callback' => function () {
				return true;
			}
		]);
	}

	public function get_all_products($data)
	{
		$results = self::rtrb_product_query($data);

		if (!empty($results["products"])) {
			wp_send_json_success($results);
		} else {
			wp_send_json_error("no product found");
		}
	}

	public static function rtrb_product_query($data)
	{
		if (!class_exists('WooCommerce')) {
			return [];
		}

		$results = [];
		$excluded_ids = null;
		$showPagination = $data['showPagination'] == 'true' ? true : false;
		$args = [
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'orderby'        => isset($data['orderby']) ? $data['orderby'] : 'date',
			'order'          => isset($data['order']) ? $data['order'] : 'desc',
			'offset'         => isset($data['offset']) ? $data['offset'] : 0
		];

		//orderby
		if (isset($data['orderby'])) {
			switch ($data['orderby']) {
				case 'price':
					$args['meta_key'] = '_price';
					$args['orderby']  = 'meta_value_num';
					break;
				case 'popular':
					$args['meta_key'] = 'total_sales';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = 'desc';
					break;
				case 'rating';
					$args['meta_key'] = '_wc_average_rating';
					$args['orderby']  = 'meta_value_num';
					break;
				default:
					$args['orderby'] = $data['orderby'];
					break;
			}
		}

		//include
		if ($data['include']) {
			$post_ids = explode(',', $data['include']);
			$post_ids = array_map('trim', $post_ids);

			$args['post__in'] = $post_ids;

			if ($excluded_ids != null && is_array($excluded_ids)) {
				$args['post__in'] = array_diff($post_ids, $excluded_ids);
			}
		}

		if ($showPagination) {
			$_paged        = is_front_page() ? "page" : "paged";
			$args['paged'] = get_query_var($_paged) ? absint(get_query_var($_paged)) : 1;
		}

		//autors
		if (!empty($data['authors'])) {
			$args['author__in'] = wp_list_pluck($data['authors'], 'value');
		}

		//taxonomies
		if (!empty($data['productTaxonomies'])) {
			foreach ($data['productTaxonomies'] as $index => $texonomy) {
				if (!empty($texonomy['options'])) {
					$args['tax_query'][] = [
						'taxonomy' => $texonomy['name'],
						'field'    => 'term_id',
						'terms'    => wp_list_pluck($texonomy['options'], 'value'),
					];
				}
			}
		}

		//taxonomy relation
		if (!empty($args['tax_query']) && $data['taxnomyRelation']) {
			$args['tax_query']['relation'] = $data['taxnomyRelation'];
		}

		if ($data['limit']) {
			if (!$showPagination) {
				$args['posts_per_page'] = $data['limit'];
			} else {
				$tempArgs                   = $args;
				$tempArgs['posts_per_page'] = $data['limit'];
				$tempArgs['paged']          = 1;
				$tempArgs['fields']         = 'ids';
				$tempQ                      = new \WP_Query($tempArgs);
				if (!empty($tempQ->posts)) {
					$args['post__in']       = $tempQ->posts;
					$args['posts_per_page'] = $data['limit'];
				}
			}
		} else {
			$_posts_per_page = 8;
			$args['posts_per_page'] = $_posts_per_page;
		}

		if ($showPagination && $data['displayPerPage']) {
			$args['posts_per_page'] = $data['displayPerPage'];
		}

		//exclude or offset
		if ($data['exclude'] || $data['offset']) {
			$excluded_ids = [];
			if ($data['exclude']) {
				$excluded_ids = explode(',', $data['exclude']);
				$excluded_ids = array_map('trim', $excluded_ids);
			}

			$offset_posts = [];
			if ($data['offset']) {
				$_temp_args = $args;
				unset($_temp_args['paged']);
				$_temp_args['posts_per_page'] = $data['offset'];
				$_temp_args['fields'] = 'ids';
				$offset_posts = get_posts($_temp_args);
			}

			$excluded_post_ids    = array_merge($offset_posts, $excluded_ids);
			$args['post__not_in'] = array_unique($excluded_post_ids);
		}
		$loop = new WP_Query($args);

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

		if ($loop->have_posts()) {

			while ($loop->have_posts()) {
				$loop->the_post();

				$products = [];
				$post_id  = get_the_ID();
				$product  = wc_get_product($post_id);

				$products['id']               = $post_id;
				$products['title']            = get_the_title();
				$products["thumbnail"]        = get_the_post_thumbnail($post_id, $thumbnailSize);
				$products['permalink']        = get_permalink();
				$products['excerpt']          = strip_tags(get_the_content());
				$products['excerpt_full']     = strip_tags(get_the_excerpt());
				$products['time']             = get_the_date();
				$products['currency_symbol'] = get_woocommerce_currency_symbol();
				$products['price']            = $product->get_price();
				$products['price_sale']       = $product->get_sale_price();
				$products['price_regular']    = $product->get_regular_price();
				$products['discount']         = ($products['price_sale'] && $products['price_regular']) ? round(($products['price_regular'] - $products['price_sale']) / $products['price_regular'] * 100) . '%' : '';
				$products['sale']             = $product->is_on_sale();
				$products['price_html']       = $product->get_price_html();
				$products['stock']            = $product->get_stock_status();
				$products['featured']         = $product->is_featured();
				$products['rating_count']     = $product->get_rating_count();
				$products['rating_average']   = $product->get_average_rating();
				$products['add_to_cart_url']  = $product->add_to_cart_url();
				$products['add_to_cart_text'] = $product->add_to_cart_text();
				$products['type']             = $product->get_type();

				// image
				if (has_post_thumbnail()) {
					$thumb_id    = get_post_thumbnail_id($post_id);
					$image_sizes = get_intermediate_image_sizes();
					$image_src   = [];
					foreach ($image_sizes as $key => $value) {
						$image_src[$value] = wp_get_attachment_image_src($thumb_id, $value, false)[0];
					}
					$products['image'] = $image_src;
				}

				// tag
				$tag = get_the_terms($post_id, (isset($request['tag']) ? esc_attr($request['tag']) : 'product_tag'));
				if (!empty($tag)) {
					$all_tag = [];
					foreach ($tag as $val) {
						$all_tag[] = ['term_id' => $val->term_id, 'slug' => $val->slug, 'name' => $val->name, 'url' => get_term_link($val->term_id)];
					}
					$products['tag'] = $all_tag;
				}

				// cat
				$cat = get_the_terms($post_id, (isset($request['cat']) ? esc_attr($request['cat']) : 'product_cat'));
				if (!empty($cat)) {
					$all_cats = [];
					foreach ($cat as $val) {
						$all_cats[] = ['term_id' => $val->term_id, 'slug' => $val->slug, 'name' => $val->name, 'url' => get_term_link($val->term_id)];
					}
					$products['category'] = $all_cats;
				}

				$results[] = $products;
			}

			wp_reset_postdata();
		}

		return [
			"total_page" => $loop->max_num_pages,
			'products' => $results
		];
	}
}
