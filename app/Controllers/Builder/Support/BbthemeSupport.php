<?php

namespace RadiusTheme\RB\Controllers\Builder\Support;

use RadiusTheme\RB\Helpers\Fns;

class BbthemeSupport {
	private $header;
	private $footer;

	/**
	 * Run all the Actions / Filters.
	 */
	function __construct( $template_ids ) {
		$this->header = $template_ids['header'];
		$this->footer = $template_ids['footer'];

		if ( $this->header != null ) {
			add_filter( 'fl_header_enabled', '__return_false' );
			add_action( 'fl_before_header', [ $this, 'add_plugin_header_markup' ] );
		}

		if ( $this->footer != null ) {
			add_filter( 'fl_footer_enabled', '__return_false' );
			add_action( 'fl_after_content', [ $this, 'add_plugin_footer_markup' ] );
		}
	}

	// header actions
	public function add_plugin_header_markup() {

		if ( class_exists( '\FLTheme' ) ) {
			$header_layout = \FLTheme::get_setting( 'fl-header-layout' );

			if ( 'none' == $header_layout || is_page_template( 'tpl-no-header-footer.php' ) ) {
				return;
			}
		}

		do_action( 'rtrb/builder/before_header' );
		?>
		<header id="masthead" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
			<div class="rtrb-builder-content rtrb-builder-content-header">
				<?php Fns::render_builder_content( 'header' ); ?>
			</div>
		</header>
		<style>
			[data-type="header"] {
				display: none !important;
			}
		</style>
		<?php
		do_action( 'rtrb/builder/after_header' );
	}


	// footer actions
	public function add_plugin_footer_markup() {
		if ( is_page_template( 'tpl-no-header-footer.php' ) ) {
			return;
		}

		do_action( 'rtrb/builder/before_footer' );
		?>

		<footer itemscope="itemscope" itemtype="https://schema.org/WPFooter">
			<?php Fns::render_builder_content( 'footer' ); ?>
		</footer>

		<?php
		do_action( 'rtrb/builder/after_footer' );
	}
}