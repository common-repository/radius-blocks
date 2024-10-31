<?php

namespace RadiusTheme\RB\Controllers\Builder\Support;

use RadiusTheme\RB\Helpers\Fns;
use RadiusTheme\RB\Traits\SingletonTrait;

class MyListingSupport
{
	use SingletonTrait;

	public function init($template_ids)
	{
		global $rtrb_builder_template_ids;

		$rtrb_builder_template_ids = $template_ids;
		if (!function_exists('hfe_render_header')) {
			function hfe_render_header()
			{
				global $rtrb_builder_template_ids;
				if (empty($rtrb_builder_template_ids['header'])) {
					return;
				}

				do_action('rtrb/builder/before_header');
				echo '<header class="rtrb-builder-content rtrb-builder-content-header">';
				Fns::render_builder_content('header');
				echo '</header>';
				do_action('rtrb/builder/after_header');
			}
		}

		if (!function_exists('get_hfe_header_id')) {
			function get_hfe_header_id()
			{
				global $rtrb_builder_template_ids;

				return $rtrb_builder_template_ids['header'];
			}
		}

		if (!function_exists('hfe_render_footer')) {
			function hfe_render_footer()
			{
				global $rtrb_builder_template_ids;
				if (empty($rtrb_builder_template_ids['footer'])) {
					return;
				}

				do_action('rtrb/builder/before_footer');
				echo '<footer class="rtrb-builder-content rtrb-builder-content-footer">';
				Fns::render_builder_content('footer');
				echo '</footer>';
				do_action('rtrb/builder/after_footer');
			}
		}

		if (!function_exists('get_hfe_footer_id')) {
			function get_hfe_footer_id()
			{
				global $rtrb_builder_template_ids;

				return $rtrb_builder_template_ids['footer'];
			}
		}
	}
}
