<?php

namespace RadiusTheme\RB\Controllers;

class AdminController
{
	public function __construct()
	{
		add_action('wp_ajax_rtrb_save_block_settings', [$this, 'rtrb_save_block_settings']);
		add_action('admin_init', [$this, 'rtrb_active_redirect'], 9999);
	}

	public function rtrb_save_block_settings()
	{
		if (!wp_verify_nonce($_POST['_wpnonce'], 'rtrb-save-admin-settings')) {
			die('Verify nonce security');
		} else {
			$all_blocks = map_deep(wp_unslash($_POST['all_blocks']), 'sanitize_text_field');
			update_option('rtrb_all_blocks', $all_blocks);
		}
		die();
	}

	/**
	 * Remove meta box.
	 *
	 * @return void
	 */
	public function rtrb_active_redirect()
	{
		if (get_option('rtrb_activation_redirect', false)) {
			delete_option('rtrb_activation_redirect');
			wp_safe_redirect(admin_url('admin.php?page=rtrb'));
		}
	}
}
