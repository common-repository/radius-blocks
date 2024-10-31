<?php

namespace RadiusTheme\RB\Controllers\Builder\Support;

use RadiusTheme\RB\Helpers\Fns;

class GenesisSupport
{

	/**
	 * Run all the Actions / Filters.
	 */
	function __construct($template_ids)
	{
		if (!empty($template_ids['header'])) {
			add_action('template_redirect', [$this, 'remove_theme_header_markup'], 10);
			add_action('ocean_header', [$this, 'add_plugin_header_markup']);
			add_action('genesis_header', [$this, 'genesis_header_markup_open'], 16);
			add_action('genesis_header', [$this, 'genesis_header_markup_close'], 25);
		}

		if (!empty($template_ids['footer'])) {
			add_action('template_redirect', [$this, 'remove_theme_footer_markup'], 10);
			add_action('genesis_footer', [$this, 'genesis_footer_markup_open'], 16);
			add_action('genesis_footer', [$this, 'genesis_footer_markup_close'], 25);
			add_action('ocean_footer', [$this, 'add_plugin_footer_markup']);
		}
	}

	// header actions
	public function remove_theme_header_markup()
	{
		for ($priority = 0; $priority < 16; $priority++) {
			remove_all_actions('genesis_header', $priority);
		}
	}

	/**
	 * Open markup for header.
	 */
	public function genesis_header_markup_open()
	{

		genesis_markup(
			[
				'html5'   => '<header %s>',
				'xhtml'   => '<div id="header">',
				'context' => 'site-header',
			]
		);

		genesis_structural_wrap('header');
	}

	/**
	 * Close MArkup for header.
	 */
	public function genesis_header_markup_close()
	{

		genesis_structural_wrap('header', 'close');
		genesis_markup(
			[
				'html5' => '</header>',
				'xhtml' => '</div>',
			]
		);
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
		for ($priority = 0; $priority < 16; $priority++) {
			remove_all_actions('genesis_footer', $priority);
		}
	}

	/**
	 * Open markup for footer.
	 */
	public function genesis_footer_markup_open()
	{

		genesis_markup(
			[
				'html5'   => '<footer %s>',
				'xhtml'   => '<div id="footer" class="footer">',
				'context' => 'site-footer',
			]
		);
		genesis_structural_wrap('footer', 'open');
	}

	/**
	 * Close markup for footer.
	 */
	public function genesis_footer_markup_close()
	{

		genesis_structural_wrap('footer', 'close');
		genesis_markup(
			[
				'html5' => '</footer>',
				'xhtml' => '</div>',
			]
		);
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
