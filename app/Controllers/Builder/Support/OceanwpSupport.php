<?php

namespace RadiusTheme\RB\Controllers\Builder\Support;

use RadiusTheme\RB\Helpers\Fns;

class OceanwpSupport
{
	private $header;
	private $footer;

	/**
	 * Run all the Actions / Filters.
	 */
	function __construct($template_ids)
	{
		$this->header = $template_ids['header'];
		$this->footer = $template_ids['footer'];

		if ($this->header != null) {
			add_action('template_redirect', [$this, 'remove_theme_header_markup'], 10);
			add_action('ocean_header', [$this, 'add_plugin_header_markup']);
		}

		if ($this->footer != null) {
			add_action('template_redirect', [$this, 'remove_theme_footer_markup'], 10);
			add_action('ocean_footer', [$this, 'add_plugin_footer_markup']);
		}
	}

	// header actions
	public function remove_theme_header_markup()
	{
		remove_action('ocean_top_bar', 'oceanwp_top_bar_template');
		remove_action('ocean_header', 'oceanwp_header_template');
		remove_action('ocean_page_header', 'oceanwp_page_header_template');
	}

	public function add_plugin_header_markup()
	{
		do_action('rtrb/builder/before_header');
		echo '<header class="rtrb-builder-content rtrb-builder-content-header">';
		Fns::render_builder_content('header');
		echo '</header>';
		do_action('rtrb/builder/after_header');
	}


	// footer actions
	public function remove_theme_footer_markup()
	{
		remove_action('ocean_footer', 'oceanwp_footer_template');
	}

	public function add_plugin_footer_markup()
	{
		do_action('rtrb/builder/before_footer');
		echo '<footer class="rtrb-builder-content rtrb-builder-content-footer">';
		Fns::render_builder_content('footer');
		echo '</footer>';
		do_action('rtrb/builder/after_footer');
	}
}
