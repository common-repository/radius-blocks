<?php

namespace RadiusTheme\RB\Controllers;

use RadiusTheme\RB\Controllers\Builder\BuilderAjaxController;
use RadiusTheme\RB\Controllers\Builder\BuilderLoader;
use RadiusTheme\RB\Controllers\Builder\CptHooksController;
use RadiusTheme\RB\Traits\SingletonTrait;

class BuilderController
{
	use SingletonTrait;

	public function __construct()
	{
		// enqueue scripts
		add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
		add_action('template_redirect', [$this, 'template_frontend']);
		add_action('init', [$this, 'register_post'], 0);
		add_action('after_setup_theme', [$this, 'theme_after_setup']);
		add_action('admin_menu', [$this, 'register_settings_menus']);
		add_action('admin_menu', [$this, 'builder_menu']);
		add_action('admin_footer', [$this, 'modal_view']);
		CptHooksController::getInstance();
		BuilderAjaxController::getInstance();
		BuilderLoader::getInstance();
	}

	public function enqueue_scripts()
	{
		$screen = get_current_screen();
		if ($screen->id == 'edit-rtrb_builder') {
			wp_enqueue_style('select2', rtrb()->get_assets_uri('vendors/select2/select2.min.css'));
			wp_enqueue_style('rtrb-builder-admin-style', rtrb()->get_assets_uri('builder/builder-admin-style.css'));
			wp_enqueue_script('select2', rtrb()->get_assets_uri('vendors/select2/select2.min.js'), ['jquery'], true);
			wp_enqueue_script('rtrb-builder-admin-script', rtrb()->get_assets_uri('builder/builder-admin-script.js'), ['jquery'], true);
			wp_localize_script('rtrb-builder-admin-script', 'rtrb_builder', [
				'ajaxurl'  => esc_url(admin_url('admin-ajax.php')),
				'nonce'    => wp_create_nonce('rtrb_builder_nonce'),
				'adminUrl' => esc_url(admin_url('edit.php?post_type=rtrb_builder')),
				'editUrl'  => esc_url(admin_url('post.php?post=%d%&action=edit')),
			]);
		}
	}

	public function register_settings_menus()
	{
		// dashboard, main menu
		add_menu_page(
			esc_html__('Radius Blocks Settings', 'radius-blocks'),
			esc_html__('Radius Blocks', 'radius-blocks'),
			'manage_options',
			'rtrb',
			[$this, 'register_settings_contents__settings'],
			rtrb()->get_assets_uri('img/icons/gray.png'),
			'58.9'
		);
	}

	public function register_settings_contents__settings()
	{
		include_once rtrb()->plugin_path() . '/views/admin/settings.php';
	}

	public function builder_menu()
	{
		$link_our_new_cpt = 'edit.php?post_type=rtrb_builder';
		add_submenu_page('rtrb', esc_html__('Header & Footer Builder', 'radius-blocks'), esc_html__('Header & Footer', 'radius-blocks'), 'manage_options', $link_our_new_cpt);
		add_submenu_page('rtrb', esc_html__('Block Settings', 'radius-blocks'), esc_html__('Settings', 'radius-blocks'), 'manage_options', 'rtrb');
	}

	public function modal_view()
	{
		$screen = get_current_screen();
		if ($screen->id == 'edit-rtrb_builder') {
			include_once rtrb()->plugin_path() . '/views/admin/modal-editor.php';
		}
	}

	public function theme_after_setup()
	{
		if (is_admin()) {
			add_filter('views_edit-rtrb_builder', [$this, 'admin_print_view_tabs']);
		}
	}

	/**
	 * Radius Builder views admin tabs.
	 *
	 * Fired by `views_edit-rtrb_builder` filter.
	 */
	public function admin_print_view_tabs($views)
	{
		$view_type  = '';
		$active_tab = ' nav-tab-active';

		if (!empty($_REQUEST['rtrb_builder_type'])) {
			$view_type  = sanitize_text_field(wp_unslash($_REQUEST['rtrb_builder_type']));
			$active_tab = '';
		}

		$url_args = ['post_type' => 'rtrb_builder'];

		$baseurl = add_query_arg($url_args, admin_url('edit.php'));

		echo '<div id="rtrb-builder-tabs-wrapper" class="nav-tab-wrapper">
					<a class="nav-tab' . esc_attr($active_tab) . '" href="' . esc_url($baseurl) . '">' . esc_html__('All', 'radius-blocks') . '</a>';

		$nxt_type = [
			'header' => __('Header', 'radius-blocks'),
			'footer' => __('Footer', 'radius-blocks'),
		];

		foreach ($nxt_type as $type => $label) :
			$active_tab = '';

			if ($view_type === $type) {
				$active_tab = 'nav-tab-active';
			}

			$type_url = add_query_arg('rtrb_builder_type', $type, $baseurl);

			echo '<a class="nav-tab ' . esc_attr($active_tab) . '" href="' . esc_url($type_url) . '">' . esc_html($label) . '</a>';
		endforeach;

		echo '</div>';

		return $views;
	}

	public function template_frontend()
	{
		if (is_singular('rtrb_builder') && !current_user_can('edit_posts')) {
			wp_redirect(home_url(), 301);
			die;
		}
	}

	public function register_post()
	{
		$builder_name = __('Header & Footer Builder', 'radius-blocks');
		$labels       = [
			'name'                  => $builder_name,
			'singular_name'         => $builder_name,
			'menu_name'             => $builder_name,
			'name_admin_bar'        => $builder_name,
			'archives'              => __('Template Archives', 'radius-blocks'),
			'attributes'            => __('Template Attributes', 'radius-blocks'),
			'parent_item_colon'     => __('Parent Template:', 'radius-blocks'),
			'all_items'             => __('All Templates', 'radius-blocks'),
			'add_new_item'          => __('Add New Template', 'radius-blocks'),
			'add_new'               => __('Add New', 'radius-blocks'),
			'new_item'              => __('New Template', 'radius-blocks'),
			'edit_item'             => __('Edit Template', 'radius-blocks'),
			'update_item'           => __('Update Template', 'radius-blocks'),
			'view_item'             => __('View Template', 'radius-blocks'),
			'view_items'            => __('View Template', 'radius-blocks'),
			'search_items'          => __('Search Template', 'radius-blocks'),
			'not_found'             => __('Not found', 'radius-blocks'),
			'not_found_in_trash'    => __('Not found in Trash', 'radius-blocks'),
			'featured_image'        => __('Featured Image', 'radius-blocks'),
			'set_featured_image'    => __('Set featured image', 'radius-blocks'),
			'remove_featured_image' => __('Remove featured image', 'radius-blocks'),
			'use_featured_image'    => __('Use as featured image', 'radius-blocks'),
			'insert_into_item'      => __('Insert into template', 'radius-blocks'),
			'uploaded_to_this_item' => __('Uploaded to this template', 'radius-blocks'),
			'items_list'            => __('Templates list', 'radius-blocks'),
			'items_list_navigation' => __('Templates list navigation', 'radius-blocks'),
			'filter_items_list'     => __('Filter templates list', 'radius-blocks'),
		];
		$args         = [
			'labels'              => $labels,
			'supports'            => ['title', 'editor', 'revisions'],
			'hierarchical'        => false,
			'rewrite'             => false,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
		];
		register_post_type('rtrb_builder', $args);
	}
}
