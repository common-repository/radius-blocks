<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class AdvancedNavigation
{
	public function __construct()
	{
		add_action('init', [$this, 'register_nav']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/advanced-navigation') && !is_admin()) {
			wp_enqueue_style('rtrb-blocks-frontend-style');
		}
	}

	public function register_nav()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'advanced-navigation',
			[
				'editor_script' 	=> 'rtrb-blocks-editor-script',
				'editor_style'    	=> 'rtrb-blocks-frontend-style',
				'render_callback' => [$this, 'render_block'],
			]
		);
	}

	public function render_block($settings, $content)
	{
		return $content;
	}
}
