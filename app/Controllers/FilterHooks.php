<?php

namespace RadiusTheme\RB\Controllers;

/**
 * Filter hooks class.
 */
class FilterHooks {

	/**
	 * Init method.
	 *
	 * @return void
	 */
	public static function init() {
		add_filter( 'body_class', [ __CLASS__, 'body_class' ] );
		add_filter( 'admin_body_class', [ __CLASS__, 'body_class' ] );
		add_filter( 'rtrb_block_attributes', [ __CLASS__, 'block_attributes' ] );
	}

	/**
	 * Override body classes.
	 *
	 * @param mixed|string $classes receive.
	 * @return mixed|string
	 */
	public static function body_class( $classes ) {
		if ( ! is_admin() ) {
			$classes[] = ' radius-frontend rtrb-body-wrap ';
		} else {
			$classes .= ' radius-editor rtrb-body-wrap ';
		}
		return $classes;
	}

	/**
	 * Override block attributes.
	 *
	 * @param array $atts receive.
	 * @return array
	 */
	public static function block_attributes( $atts ) {
		$atts['blockCustomCss'] = [
			'type'    => 'string',
			'default' => '',
			'style'   => [
				(object) [ 'selector' => '' ],
			],
		];

		return $atts;
	}
}
