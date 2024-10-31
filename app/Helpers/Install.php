<?php

/**
 * Install Helper class.
 */

namespace RadiusTheme\RB\Helpers;

use RadiusTheme\RB\Controllers\BlockLists;

if (!defined('ABSPATH')) {
	exit('This script cannot be accessed directly.');
}

/**
 * Install Helper class.
 */
class Install
{

	public static function activate()
	{
		self::insertDefaultData();
		add_option('rtrb_activation_redirect', true);
	}

	public static function deactivate()
	{
		return '';
	}

	public static function insertDefaultData()
	{
		//block enable disable setting options
		if (!get_option('rtrb_all_blocks')) {
			update_option('rtrb_all_blocks', BlockLists::get_rtrb_blocks());
		}

		//plugins global data options
		if (!get_option('rtrb_options')) {
			$data = get_option('rtrb_options', array());
			$init_data = array(
				'save_version'      => rand(1, 99999)
			);
			if (empty($data)) {
				update_option('rtrb_options', $init_data);
				$GLOBALS['rtrb_settings'] = $init_data;
			} else {
				foreach ($init_data as $key => $single) {
					if (!isset($data[$key])) {
						$data[$key] = $single;
					}
				}
				update_option('rtrb_options', $data);
				$GLOBALS['rtrb_settings'] = $data;
			}
		}
	}
}
