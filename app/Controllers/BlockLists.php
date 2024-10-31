<?php

namespace RadiusTheme\RB\Controllers;

class BlockLists
{

	public static function get_all_rtrb_blocks()
	{
		$all_blocks = get_option('rtrb_all_blocks');

		if (empty($all_blocks)) {
			return self::get_rtrb_blocks();
		}
		if (count(self::get_rtrb_blocks()) > count($all_blocks)) {
			return array_merge(self::get_rtrb_blocks(), $all_blocks);
		}
		return $all_blocks;
	}

	public static function get_enabled_blocks()
	{
		$blocks = self::get_all_rtrb_blocks();
		$enabled_blocks = array_filter($blocks, function ($a) {
			return $a['visibility'] === "true" ? $a : false;
		});
		return $enabled_blocks;
	}

	public static function get_rtrb_blocks()
	{
		$default_blocks = [
			'accordion' => [
				'label' => __('Accordion', 'radius-blocks'),
				'value' => 'accordion',
				'visibility' => 'true',
			],
			'advanced_heading' => [
				'label' => __('Advanced Heading', 'radius-blocks'),
				'value' => 'advanced_heading',
				'visibility' => 'true',
			],
			'button' => [
				'label' => __('Button', 'radius-blocks'),
				'value' => 'button',
				'visibility' => 'true',
			],
			'call_to_action' => [
				'label' => __('Call To Action', 'radius-blocks'),
				'value' => 'call_to_action',
				'visibility' => 'true',
			],
			'container' => [
				'label' => __('Container', 'radius-blocks'),
				'value' => 'container',
				'visibility' => 'true',
			],
			'countdown' => [
				'label' => __('Countdown', 'radius-blocks'),
				'value' => 'countdown',
				'visibility' => 'true',
			],

			'counter' => [
				'label' => __('Counter', 'radius-blocks'),
				'value' => 'counter',
				'visibility' => 'true',
			],

			'dual_button' => [
				'label' => __('Dual Button', 'radius-blocks'),
				'value' => 'dual_button',
				'visibility' => 'true',
			],

			'faq' => [
				'label' => __('FAQ', 'radius-blocks'),
				'value' => 'faq',
				'visibility' => 'true',
			],

			'flipbox' => [
				'label' => __('Flipbox', 'radius-blocks'),
				'value' => 'flipbox',
				'visibility' => 'true',
			],

			'gradient_heading' => [
				'label' => __('Gradient Heading', 'radius-blocks'),
				'value' => 'gradient_heading',
				'visibility' => 'true',
			],

			'iconbox' => [
				'label' => __('Icon Box', 'radius-blocks'),
				'value' => 'iconbox',
				'visibility' => 'true',
			],

			'notice' => [
				'label' => __('Notice', 'radius-blocks'),
				'value' => 'notice',
				'visibility' => 'true',
			],

			'image_comparison' => [
				'label' => __('Image Comparison', 'radius-blocks'),
				'value' => 'image_comparison',
				'visibility' => 'true',
			],

			'image_gallery' => [
				'label' => __('Image Gallery', 'radius-blocks'),
				'value' => 'image_gallery',
				'visibility' => 'true',
			],

			'infobox' => [
				'label' => __('Infobox', 'radius-blocks'),
				'value' => 'infobox',
				'visibility' => 'true',
			],

			'logo_grid' => [
				'label' => __('Logo Grid', 'radius-blocks'),
				'value' => 'logo_grid',
				'visibility' => 'true',
			],
			'post_grid' => [
				'label' => __('Post Grid', 'radius-blocks'),
				'value' => 'post_grid',
				'visibility' => 'true',
			],
			'post_list' => [
				'label' => __('Post List', 'radius-blocks'),
				'value' => 'post_list',
				'visibility' => 'true',
			],
			'pricing_table' => [
				'label' => __('Pricing Table', 'radius-blocks'),
				'value' => 'pricing_table',
				'visibility' => 'true',
			],
			'row' => [
				'label' => __('Row', 'radius-blocks'),
				'value' => 'row',
				'visibility' => 'true',
			],
			'team' => [
				'label' => __('Team Member', 'radius-blocks'),
				'value' => 'team',
				'visibility' => 'true',
			],
			'testimonial' => [
				'label' => __('Testimonial', 'radius-blocks'),
				'value' => 'testimonial',
				'visibility' => 'true',
			],

			'wrapper' => [
				'label' => __('Wrapper', 'radius-blocks'),
				'value' => 'wrapper',
				'visibility' => 'true',
			],

			'social_icons' => [
				'label' => __('Social Icons', 'radius-blocks'),
				'value' => 'social_icons',
				'visibility' => 'true',
			],

			'advanced_image' => [
				'label' => __('Advanced Image', 'radius-blocks'),
				'value' => 'advanced_image',
				'visibility' => 'true',
			],

			'icon_list' => [
				'label' => __('Icon List', 'radius-blocks'),
				'value' => 'icon_list',
				'visibility' => 'true',
			],

			'advanced_tab' => [
				'label' => __('Advanced Tab', 'radius-blocks'),
				'value' => 'advanced_tab',
				'visibility' => 'true',
			],

			'progress_bar' => [
				'label' => __('Progress Bar', 'radius-blocks'),
				'value' => 'progress_bar',
				'visibility' => 'true',
			],

			'advanced_video' => [
				'label' => __('Advanced Video', 'radius-blocks'),
				'value' => 'advanced_video',
				'visibility' => 'true',
			],

			'search' => [
				'label' => __('Search', 'radius-blocks'),
				'value' => 'search',
				'visibility' => 'true',
			],

			'header_info' => [
				'label' => __('Header Info', 'radius-blocks'),
				'value' => 'header_info',
				'visibility' => 'true',
			],

			'advanced_navigation' => [
				'label' => __('Advanced Navigation', 'radius-blocks'),
				'value' => 'advanced_navigation',
				'visibility' => 'true',
			],

			'copyright' => [
				'label' => __('Copyright Text', 'radius-blocks'),
				'value' => 'copyright',
				'visibility' => 'true',
			],

			'logo_slider' => [
				'label' => __('Logo Slider', 'radius-blocks'),
				'value' => 'logo_slider',
				'visibility' => 'true',
			],
			'post_carousel' => [
				'label' => __('Post Carousel', 'radius-blocks'),
				'value' => 'post_carousel',
				'visibility' => 'true',
			],
			'testimonial_slider' => [
				'label' => __('Testimonial Slider', 'radius-blocks'),
				'value' => 'testimonial_slider',
				'visibility' => 'true',
			],
			'fluent_form' => [
				'label' => __('Fluent Form', 'radius-blocks'),
				'value' => 'fluent_form',
				'visibility' => 'true',
			],
			'contact_form7' => [
				'label' => __('Contact Form7', 'radius-blocks'),
				'value' => 'contact_form7',
				'visibility' => 'true',
			],
			'post_timeline' => [
				'label' => __('Post Timeline', 'radius-blocks'),
				'value' => 'post_timeline',
				'visibility' => 'true',
			],
			'news_ticker' => [
				'label' => __('News Ticker', 'radius-blocks'),
				'value' => 'news_ticker',
				'visibility' => 'true',
			],
			'dropcaps' => [
				'label' => __('Dropcaps', 'radius-blocks'),
				'value' => 'dropcaps',
				'visibility' => 'true',
			],
			'social_share' => [
				'label' => __('Social Share', 'radius-blocks'),
				'value' => 'social_share',
				'visibility' => 'true',
			],
			'image_accordion' => [
				'label' => __('Image Accordion', 'radius-blocks'),
				'value' => 'image_accordion',
				'visibility' => 'true',
			],
			'woo_product_grid' => [
				'label' => __('Woo Product Grid', 'radius-blocks'),
				'value' => 'woo_product_grid',
				'visibility' => 'true',
			],
			'woo_product_list' => [
				'label' => __('Woo Product List', 'radius-blocks'),
				'value' => 'woo_product_list',
				'visibility' => 'true',
			],
			'woo_product_carousel' => [
				'label' => __('Woo Product Carousel', 'radius-blocks'),
				'value' => 'woo_product_carousel',
				'visibility' => 'true',
			],
		];

		$pro_blocks = apply_filters('rtrb_blocks_pro', []);
		$merged_blocks = array_merge($default_blocks, $pro_blocks);
		return $merged_blocks;
	}
}
