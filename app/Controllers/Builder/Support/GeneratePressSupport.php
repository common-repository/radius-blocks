<?php

namespace RadiusTheme\RB\Controllers\Builder\Support;

use RadiusTheme\RB\Helpers\Fns;

class GeneratePressSupport
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
			add_action('generate_header', [$this, 'add_plugin_header_markup']);
		}

		if ($this->footer != null) {
			add_action('template_redirect', [$this, 'remove_theme_footer_markup'], 10);
			add_action('generate_footer', [$this, 'add_plugin_footer_markup']);
		}
	}

	// header actions
	public function remove_theme_header_markup()
	{
		remove_action('generate_header', 'generate_construct_header');
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
		remove_action('generate_footer', 'generate_construct_footer_widgets', 5);
		remove_action('generate_footer', 'generate_construct_footer');
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
