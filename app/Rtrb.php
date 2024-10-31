<?php

use RadiusTheme\RB\Controllers\ActionHooks;
use RadiusTheme\RB\Controllers\AdminController;
use RadiusTheme\RB\Controllers\BlocksControllers;
use RadiusTheme\RB\Controllers\FilterHooks;
use RadiusTheme\RB\Traits\SingletonTrait;
use RadiusTheme\RB\Controllers\BuilderController;
use RadiusTheme\RB\Helpers\Install;
use RadiusTheme\RB\Controllers\Admin\AdminInit;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

require_once RTRB_PATH . 'vendor/autoload.php';

if ( ! class_exists( Rtrb::class ) ) {
	/**
	 * Main initialization class.
	 */
	final class Rtrb {


		use SingletonTrait;

		/**
		 * Class constructor
		 */
		public function __construct() {
			$this->define_constants();
			if ( ! isset( $GLOBALS['rtrb_settings'] ) ) {
				$GLOBALS['rtrb_settings'] = get_option( 'rtrb_options' );
			}
			FilterHooks::init();
			ActionHooks::init();
			BuilderController::getInstance();
			new BlocksControllers();
			if ( is_admin() ) {
				new AdminController();
				AdminInit::getInstance();
			}

			$this->load_hooks();
		}

		/**
		 * Get the template path.
		 *
		 * @return string
		 */
		public function get_template_path() {
			return apply_filters( 'rtrb_template_path', 'radius-blocks/' );
		}

		/**
		 * Get the plugin template path
		 *
		 * @return string
		 */
		public function get_plugin_template_path() {
			return $this->plugin_path() . '/templates';
		}

		/**
		 * Get Ajax URL.
		 *
		 * @return string
		 */
		public function ajax_url() {
			return admin_url( 'admin-ajax.php', 'relative' );
		}

		/**
		 * Generate assets file url
		 *
		 * @param string $file File.
		 *
		 * @return string
		 */
		public function get_assets_uri( $file ) {
			$file = ltrim( $file, '/' );

			return trailingslashit( RTRB_URL . '/assets' ) . $file;
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( RTRB_FILE ) );
		}

		/**
		 * Define constant.
		 *
		 * @return void
		 */
		private function define_constants() {
			if ( ! defined( 'RTRB_URL' ) ) {
				define( 'RTRB_URL', plugins_url( '', RTRB_FILE ) );
			}
			if ( ! defined( 'RTRB_PATH_BLOCKS' ) ) {
				define( 'RTRB_PATH_BLOCKS', RTRB_PATH . 'blocks/' );
			}
		}

		/**
		 * Fire plugin active and deactivate.
		 *
		 * @return void
		 */
		private function load_hooks() {
			register_activation_hook( RTRB_FILE, [ Install::class, 'activate' ] );
			register_deactivation_hook( RTRB_FILE, [ Install::class, 'deactivate' ] );
		}

		/**
		 * Pro check.
		 *
		 * @return boolean
		 */
		public function hasPro() {
			return class_exists( 'RtrbPro' );
		}
	}

	/**
	 * @return Rtrb
	 */
	function rtrb() {
		return Rtrb::getInstance();
	}

	rtrb();
}
