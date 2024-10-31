<?php

use RadiusTheme\RB\Helpers\Fns;
use RadiusTheme\RB\Models\MenuWalker;

$wrap_class = 'rtrb-block rtrb-block-frontend ';
if ( isset( $settings['blockId'] ) ) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if ( isset( $settings['className'] ) && ! empty( $settings['className'] ) ) {
	$wrap_class .= ' ' . $settings['className'];
}

$block_wrap_class = 'rtrb-nav-menu-wrap';
?>
<div class="<?php echo esc_attr( $wrap_class ); ?>">
	<div class="rtrb-nav-menu-wrap">
		<button class="rtrb-menu-hamburger rtrb-menu-toggler">
			<span class="rtrb-menu-hamburger-icon"></span><span class="rtrb-menu-hamburger-icon"></span><span
				class="rtrb-menu-hamburger-icon"></span>
		</button>
		<?php

		/**
		 * Main Menu Container
		 */
		$link = $target = $nofollow = '';

		if ( isset( $settings['elementskit_nav_menu_logo_link_to'] ) && $settings['elementskit_nav_menu_logo_link_to'] == 'home' ) {
			$link = get_home_url();
		} elseif ( isset( $settings['elementskit_nav_menu_logo_link'] ) ) {
			$link     = $settings['elementskit_nav_menu_logo_link']['url'];
			$target   = ( $settings['elementskit_nav_menu_logo_link']['is_external'] != "on" ? "" : "_blank" );
			$nofollow = ( $settings['elementskit_nav_menu_logo_link']['nofollow'] != "on" ? "" : "nofollow" );
		}

		$metadata = \ElementsKit_Lite\Utils::img_meta( esc_attr( $settings['elementskit_nav_menu_logo']['id'] ) );
		$markup   = '
				<div class="elementskit-nav-identity-panel">
					<div class="elementskit-site-title">
						<a class="elementskit-nav-logo" href="' . esc_url( $link ) . '" target="' . ( ! empty( $target ) ? esc_attr( $target ) : '_self' ) . '" rel="' . esc_attr( $nofollow ) . '">
                            ' . \Elementskit_Lite\Utils::get_attachment_image_html( $settings, 'elementskit_nav_menu_logo', 'full' ) . '
						</a> 
					</div>
					<button class="rtrb-menu-close rtrb-menu-toggler" type="button">X</button>
				</div>
			';

		$container_classes = [
			'rtrb-menu-container rtrb-menu-offcanvas-elements rtrb-navbar-nav-default',
			$settings['rtrb_style_tab_submenu_item_arrow'],
			'rtrb-nav-menu-one-page-' . $settings['rtrb_one_page_enable'],
			! empty( $settings['rtrb_nav_dropdown_as'] ) ? $settings['rtrb_nav_dropdown_as'] : 'rtrb-nav-dropdown-hover',
		];

		$args = [
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>' . $markup,
			'container'       => 'div',
			'container_id'    => 'rtrb-megamenu-' . $settings['elementskit_nav_menu'],
			'container_class' => join( ' ', $container_classes ),
			'menu'            => $settings['elementskit_nav_menu'],
			'menu_class'      => 'rtrb-navbar-nav ' . $settings['rtrb_main_menu_position'] . ' submenu-click-on-' . $settings['submenu_click_area'],
			'depth'           => 4,
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'walker'          => new MenuWalker()
		];

		wp_nav_menu( $args );
		?>
		<div class="rtrb-menu-overlay rtrb-menu-offcanvas-elements rtrb-menu-toggle rtrb-nav-menu--overlay"></div>
		<span class="rtrb-nav-menu--empty-fallback">&nbsp;</span>
	</div>
</div>