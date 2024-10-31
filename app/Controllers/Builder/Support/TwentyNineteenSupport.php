<?php

namespace RadiusTheme\RB\Controllers\Builder\Support;

class TwentyNineteenSupport {

	/**
	 * Run all the Actions / Filters.
	 */
	function __construct( $template_ids ) {
		if ( ! empty( $template_ids['header'] ) ) {
			add_action( 'get_header', [ $this, 'get_header' ] );
		}
		if ( ! empty( $template_ids['footer'] ) ) {
			add_action( 'get_footer', [ $this, 'get_footer' ] );
		}
	}

	public function get_header( $name ) {
		add_action(
			'rtrb/builder/after_header',
			function () {
				echo '<div id="page" class="site">';
				echo '<div id="content" class="site-content">';
			}
		);
		require rtrb()->get_plugin_template_path() . '/builder/header.php';

		$templates = [];
		$name      = (string) $name;
		if ( '' !== $name ) {
			$templates[] = "header-{$name}.php";
		}

		$templates[] = 'header.php';

		// Avoid running wp_head hooks again
		remove_all_actions( 'wp_head' );
		ob_start();
		// It cause a `require_once` so, in the get_header it self it will not be required again.
		locate_template( $templates, true );
		ob_get_clean();
	}

	public function get_footer( $name ) {
		add_action(
			'rtrb/builder/after_footer',
			function () {
				echo '</div></div>';
			}
		);

		require rtrb()->get_plugin_template_path() . '/builder/footer.php';

		$templates = [];
		$name      = (string) $name;
		if ( '' !== $name ) {
			$templates[] = "footer-{$name}.php";
		}

		$templates[] = 'footer.php';

		ob_start();
		// It cause a `require_once` so, in the get_header it self it will not be required again.
		locate_template( $templates, true );
		ob_get_clean();
	}
}