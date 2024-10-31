<?php

/**
 * Plugin Name: Radius Blocks - WordPress Gutenberg Blocks
 * Plugin URI:  https://radiustheme.com/demo/wordpress/radius-blocks
 * Description: Included all necessary blocks for gutenberg page editor with advanced settings for container, row, column, post grid, dual button, gallery, faq etc.  
 * Version:     2.1.2
 * Author:      RadiusTheme
 * Author URI:  https://radiustheme.com
 * Text Domain: radius-blocks
 * Domain Path: /languages
 */

defined('ABSPATH') || die('Keep Silent');

define('RTRB_VERSION', '2.1.2');
define('RTRB_FILE', __FILE__);
define('RTRB_PATH', plugin_dir_path(RTRB_FILE));
define('RTRB_PLUGIN_URL', plugins_url('', __FILE__));

if (!class_exists('Rtrb')) {
	require_once 'app/Rtrb.php';
}
