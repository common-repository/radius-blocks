<?php

namespace RadiusTheme\RB\Controllers;

use Exception;
use RadiusTheme\RB\Helpers\Fns;
use RadiusTheme\RB\Controllers\BlockLists;

use WP_Error;

class BlocksControllers
{
	private $enabled_blocks = [];

	public function __construct()
	{
		//block custom category
		add_filter('block_categories_all', [$this, 'rtrb_block_category'], 9999);

		add_action('admin_enqueue_scripts', [&$this, 'frontend_backend_assets']);
		add_action('wp_enqueue_scripts', [&$this, 'frontend_backend_assets']);

		add_action('wp_enqueue_scripts', [&$this, 'frontend_assets']);
		add_action('enqueue_block_editor_assets', [&$this, 'editor_assets']);
		add_action('admin_enqueue_scripts', [&$this, 'admin_assets']);
		add_action('init', [$this, 'rtrb_register_assets']);
		// Save css when block trigger to save data
		add_action('wp_ajax_rtrb_block_css_save', [&$this, 'save_block_css']);
		add_action('wp_ajax_rtrb_block_css_get_posts', [&$this, 'get_posts_call']);
		add_action('wp_ajax_rtrb_block_css_appended', [&$this, 'appended']);

		//for register_meta
		add_action('init', array($this, 'register_meta'));

		//API connection for demo
		add_action('wp_ajax_rtrb_get_layouts', [$this, 'rtrb_get_layouts']);

		// decide how css file will be loaded. default filesystem eg: filesystem or at header
		if (apply_filters('rtrb_block_css_filesystem', true)) {
			add_action('wp_enqueue_scripts', [&$this, 'add_block_css_file'], 15);
		}


		//get enabled blocks
		$this->enabled_blocks = BlockLists::get_enabled_blocks();

		if (function_exists('register_block_type')) {

			if ($this->is_enable_block('gradient_heading')) {
				new Blocks\GradientHeadingBlock();
			}

			if ($this->is_enable_block('infobox')) {
				new Blocks\InfoboxBlock();
			}

			if ($this->is_enable_block('iconbox')) {
				new Blocks\IconboxBlock();
			}

			if ($this->is_enable_block('button')) {
				new Blocks\ButtonBlock();
			}

			if ($this->is_enable_block('accordion')) {
				new Blocks\AccordionBlock();
			}

			if ($this->is_enable_block('team')) {
				new Blocks\TeamBlock();
			}

			if ($this->is_enable_block('testimonial')) {
				new Blocks\TestimonialBlock();
			}

			if ($this->is_enable_block('faq')) {
				new Blocks\FAQBlock();
			}

			if ($this->is_enable_block('dual_button')) {
				new Blocks\DualButtonBlock();
			}

			if ($this->is_enable_block('call_to_action')) {
				new Blocks\CallToActionBlock();
			}

			if ($this->is_enable_block('advanced_heading')) {
				new Blocks\AdvancedHeadingBlock();
			}

			if ($this->is_enable_block('counter')) {
				new Blocks\CounterBlock();
			}

			if ($this->is_enable_block('countdown')) {
				new Blocks\CountdownBlock();
			}

			if ($this->is_enable_block('logo_grid')) {
				new Blocks\LogoGrid();
			}

			if ($this->is_enable_block('flipbox')) {
				new Blocks\FlipboxBlock();
			}

			if ($this->is_enable_block('image_comparison')) {
				new Blocks\ImageComparison();
			}
			if ($this->is_enable_block('image_gallery')) {
				new Blocks\ImageGallery();
			}

			if ($this->is_enable_block('post_grid')) {
				new Blocks\PostGrid();
			}

			if ($this->is_enable_block('post_list')) {
				new Blocks\PostList();
			}

			if ($this->is_enable_block('pricing_table')) {
				new Blocks\PricingTable();
			}

			if ($this->is_enable_block('wrapper')) {
				new Blocks\WrapperBlock();
			}

			if ($this->is_enable_block('row')) {
				new Blocks\RowBlock();
			}

			if ($this->is_enable_block('container')) {
				new Blocks\ContainerBlock();
			}

			if ($this->is_enable_block('social_icons')) {
				new Blocks\SocialIcons();
			}

			if ($this->is_enable_block('icon_list')) {
				new Blocks\IconListBlock();
			}

			if ($this->is_enable_block('advanced_image')) {
				new Blocks\AdvancedImage();
			}

			if ($this->is_enable_block('advanced_tab')) {
				new Blocks\AdvancedTab();
			}

			if ($this->is_enable_block('progress_bar')) {
				new Blocks\ProgressBar();
			}

			if ($this->is_enable_block('advanced_video')) {
				new Blocks\AdvancedVideo();
			}

			if ($this->is_enable_block('search')) {
				new Blocks\SearchBlock();
			}

			if ($this->is_enable_block('header_info')) {
				new Blocks\HeaderInfoBlock();
			}

			if ($this->is_enable_block('advanced_navigation')) {
				new Blocks\AdvancedNavigation();
			}

			if ($this->is_enable_block('copyright')) {
				new Blocks\CopyrightBlock();
			}

			if ($this->is_enable_block('logo_slider')) {
				new Blocks\LogoSlider();
			}

			if ($this->is_enable_block('post_carousel')) {
				new Blocks\PostCarousel();
			}

			if ($this->is_enable_block('testimonial_slider')) {
				new Blocks\TestimonialSlider();
			}

			if ($this->is_enable_block('fluent_form')) {
				new Blocks\FluentForm();
			}

			if ($this->is_enable_block('contact_form7')) {
				new Blocks\ContactForm7();
			}

			if ($this->is_enable_block('notice')) {
				new Blocks\NoticeBlock();
			}

			if ($this->is_enable_block('post_timeline')) {
				new Blocks\PostTimeline();
			}

			if ($this->is_enable_block('news_ticker')) {
				new Blocks\NewsTicker();
			}

			if ($this->is_enable_block('dropcaps')) {
				new Blocks\Dropcaps();
			}

			if ($this->is_enable_block('social_share')) {
				new Blocks\SocialShare();
			}

			if ($this->is_enable_block('image_accordion')) {
				new Blocks\ImageAccordion();
			}

			if ($this->is_enable_block('woo_product_grid')) {
				new Blocks\WooProductGrid();
			}

			if ($this->is_enable_block('woo_product_list')) {
				new Blocks\WooProductList();
			}

			if ($this->is_enable_block('woo_product_carousel')) {
				new Blocks\WooProductCarousel();
			}

			new Api\GetProductsV1();
			new Blocks\PostGridAjax();
		}
	}

	/**
	 * @return void
	 */
	public function rtrb_get_layouts()
	{

		$BASE_URL = "https://radiusblocks.com/wp-json/rttpgapi/v1/layouts/";
		// Verify the request.
		check_ajax_referer('rtrb-nonce', 'nonce');

		// It's good let's do some capability check.
		$user          = wp_get_current_user();
		$allowed_roles = ['editor', 'administrator', 'author'];

		if (!array_intersect($allowed_roles, $user->roles)) {
			wp_die(__('You don\'t have permission to perform this action', 'rtrb'));
		}

		// Cool, we're almost there, let's check the user authenticity a little bit, shall we!
		if (!is_user_logged_in() && $user->ID !== sanitize_text_field($_REQUEST['user_id'])) {
			wp_die(__('You don\'t have proper authorization to perform this action', 'rtrb'));
		}

		$status            = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
		$post_args         = ['timeout' => 120];
		$post_args['body'] = ['status' => $status];
		$layoutRequest     = wp_remote_post($BASE_URL, $post_args);
		if (is_wp_error($layoutRequest)) {
			wp_send_json_error(['messages' => $layoutRequest->get_error_messages()]);
		}
		$layoutData = json_decode($layoutRequest['body'], true);

		wp_send_json_success($layoutData);
	}

	public function rtrb_register_assets()
	{
		//register swiper file
		wp_register_style(
			'rtrb-swiper-style',
			rtrb()->get_assets_uri('vendors/swiper/css/swiper-bundle.min.css'),
			array(),
			RTRB_VERSION,
			'all'
		);

		wp_register_script(
			'rtrb-swiper-script',
			rtrb()->get_assets_uri('vendors/swiper/js/swiper-bundle.min.js'),
			array("jquery"),
			RTRB_VERSION,
			true
		);

		//localize script both frontend and backend
		wp_enqueue_script(
			'rtrb-blocks-localize',
			rtrb()->get_assets_uri('js/rtrb-blocks-localize.js'),
			array(),
			RTRB_VERSION,
			false
		);

		$localize_obj = [
			'plugin'     => RTRB_URL,
			'ajaxurl'    => admin_url('admin-ajax.php'),
			'site_url'   => site_url(),
			'admin_url'  => admin_url(),
			'rtrb_nonce' => wp_create_nonce('rtrb-nonce'),
			'post_types' => Fns::get_post_types(),
			'all_taxonomy' => Fns::get_related_taxonomy(),
			'all_term_list'  => Fns::get_all_taxonomy_guten(),
			'all_users' => Fns::get_all_users(),
			'fluent_form_lists' => json_encode(Fns::get_fluent_forms_list()),
			'is_fluent_form_active' => defined('FLUENTFORM') ? true : false,
			'contact_form_lists' => json_encode(Fns::get_contact_forms_list()),
			'is_contact_form_active' => class_exists('WPCF7_ContactForm'),
			'is_woocommerce_active' => class_exists('WooCommerce'),
			'enabled_blocks' => BlockLists::get_all_rtrb_blocks(),
			'hasPro'          => rtrb()->hasPro(),
		];

		wp_localize_script(
			'rtrb-blocks-localize',
			'rtrbParams',
			apply_filters('rtrb_localize_script', $localize_obj)
		);
	}


	public function add_block_css_file()
	{
		$this->set_css_style(get_the_ID());
	}

	public function frontend_assets()
	{
		wp_register_script(
			'rtrb-frontend-blocks-js',
			rtrb()->get_assets_uri('js/frontend-blocks.js'),
			['jquery'],
			RTRB_VERSION,
			true
		);
	}

	public function admin_assets()
	{
		wp_enqueue_style('rtrb-admin', rtrb()->get_assets_uri('css/admin.css'), '', RTRB_VERSION);

		global $pagenow;
		if ($pagenow === 'admin.php' && isset($_GET['page']) && $_GET['page'] === 'rtrb') {

			wp_enqueue_script(
				'rtrb-admin-settings',
				rtrb()->get_assets_uri('js/rtrb-admin-settings.js'),
				['jquery', 'rtrb-sweetalert'],
				RTRB_VERSION,
				true
			);

			wp_enqueue_script(
				'rtrb-sweetalert',
				rtrb()->get_assets_uri('vendors/sweetalert/sweetalert.min.js'),
				['jquery'],
				RTRB_VERSION,
				true
			);

			wp_enqueue_script(
				'rtrb-admin-block-settings',
				rtrb()->get_assets_uri('admin/app.admin.js'),
				array('wp-i18n', 'wp-element', 'wp-hooks', 'wp-util', 'wp-components'),
				RTRB_VERSION,
				true
			);
			wp_localize_script('rtrb-admin-block-settings', 'rtrbAdminSettings', array(
				'all_blocks' => BlockLists::get_all_rtrb_blocks(),
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('rtrb-save-admin-settings'),
			));
		}
	}

	public function frontend_backend_assets()
	{
		wp_register_style(
			'rtrb-blocks-frontend-style',
			rtrb()->get_assets_uri('css/frontend.css'),
			array(),
			RTRB_VERSION,
			'all'
		);

		wp_enqueue_script(
			'rtrb-animation',
			rtrb()->get_assets_uri('js/rtrb-animation-load.js'),
			array(),
			RTRB_VERSION,
			true
		);

		wp_enqueue_style(
			'rtrb-animation',
			rtrb()->get_assets_uri('vendors/animate/animate.min.css'),
			array(),
			RTRB_VERSION,
			'all'
		);

		//google font load
		global $post;
		if ($post && isset($post->ID)) {
			$meta_fonts = get_post_meta($post->ID, '_rtrb_font_attr', true);
			if (!empty($meta_fonts)) {
				$meta_fonts = array_unique(explode(',', $meta_fonts));
				$system = array(
					'Arial',
					'Tahoma',
					'Verdana',
					'Helvetica',
					'Times New Roman',
					'Trebuchet MS',
					'Georgia',
				);
				$google_fonts = '';
				$google_fonts_attr = ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
				foreach ($meta_fonts as $font) {
					if (!in_array($font, $system, true) && !empty($font)) {
						$google_fonts .= str_replace(' ', '+', trim($font)) . $google_fonts_attr . '|';
					}
				}
				if (!empty($google_fonts)) {
					$font_query_args = array(
						'family' => $google_fonts,
					);
					wp_register_style(
						'rtrb-block-fonts',
						add_query_arg($font_query_args, '//fonts.googleapis.com/css'),
						array()
					);
					wp_enqueue_style('rtrb-block-fonts');
				}
				// Reset.
				$google_fonts = '';
			}
		}
	}

	public function editor_assets()
	{

		$script_block_asset_path = RTRB_PATH . "assets/blocks/main.asset.php";
		$script_block_dependencies = require($script_block_asset_path);

		$blocks_dependencies_thirdparty = array(
			'rtrb-swiper-script',
		);

		$blocks_dependencies_marged = array_merge(
			$script_block_dependencies['dependencies'],
			$blocks_dependencies_thirdparty
		);

		/**
		 * Register all block depecdencies
		 */
		wp_register_script(
			'rtrb-blocks-editor-script',
			rtrb()->get_assets_uri('blocks/main.js'),
			$blocks_dependencies_marged,
			$script_block_dependencies['version'],
			true
		);

		wp_enqueue_style('rtrb-blocks-css', rtrb()->get_assets_uri('blocks/main.css'), array(), RTRB_VERSION);

		//enqueue swiper style in editor
		wp_enqueue_style('rtrb-swiper-style');

		//enable disable block 
		//		$block_enabledisable_dependencies = include_once RTRB_PATH . "assets/admin/blocks-enable-disable/main.asset.php";
		$block_enabledisable_dependencies['dependencies'][] =  'rtrb-blocks-localize';
		$block_enabledisable_dependencies['dependencies'][] = 'rtrb-blocks-editor-script';
		wp_enqueue_script(
			"rtrb-blocks-enable-disable",
			rtrb()->get_assets_uri('admin/blocks-enable-disable/main.js'),
			$block_enabledisable_dependencies['dependencies'],
			RTRB_VERSION,
			true
		);
	}

	/**
	 * Save Import CSS in the top of the File
	 *
	 * @return void Array of the Custom Message
	 */
	public function save_block_css()
	{

		try {
			if (!current_user_can('edit_posts')) {
				throw new Exception(__('User permission error', 'radius-blocks'));
			}
			global $wp_filesystem;
			if (!$wp_filesystem) {
				require_once(ABSPATH . 'wp-admin/includes/file.php');
			}

			$post_id = !empty($_POST['post_id']) ? sanitize_text_field($_POST['post_id']) : '';
			$blockCss = !empty($_POST['block_css']) ? sanitize_text_field($_POST['block_css']) : '';

			if ($post_id == 'rtrb-widget' && isset($_POST['has_block'])) {
				update_option($post_id, $blockCss);
				wp_send_json_success(['message' => __('Widget CSS Saved', 'radius-blocks')]);
			}

			$post_id        =  absint($post_id);
			$filename       = "rtrb-block-css-{$post_id}.css";
			$upload_dir_url = wp_upload_dir();
			$dir            = trailingslashit($upload_dir_url['basedir']) . 'rtrb/';

			if (!empty($_POST['has_block'])) {
				Fns::set_setting('save_version', rand(1, 99999));
				update_post_meta($post_id, '_rtrb_block_active', 1);
				$block_css = $this->set_top_css($blockCss);
				WP_Filesystem(false, $upload_dir_url['basedir'], true);
				if (!$wp_filesystem->is_dir($dir)) {
					$wp_filesystem->mkdir($dir);
				}
				if (!$wp_filesystem->put_contents($dir . $filename, $block_css)) {
					wp_send_json_error(['message' => __('CSS can not be saved due to permission!!!', 'radius-blocks')]);
				}

				update_post_meta($post_id, '_rtrb_block_css', $block_css);
				wp_send_json_success(['message' => __('Css file has been updated', 'radius-blocks')]);
			} else {
				delete_post_meta($post_id, '_rtrb_block_active');
				if (file_exists($dir . $filename)) {
					unlink($dir . $filename);
				}
				delete_post_meta($post_id, '_rtrb_block_css');
				wp_send_json_success(['message' => __('Data Delete Done', 'radius-blocks')]);
			}
		} catch (Exception $e) {
			wp_send_json_error(['message' => $e->getMessage()]);
		}
	}


	/**
	 * Save Import CSS in the top of the File
	 *
	 * @param STRING
	 *
	 * @return STRING
	 * @since v.1.0.0
	 */
	public function set_top_css($get_css = '')
	{
		$css_url     = "@import url('https://fonts.googleapis.com/css?family=";
		$font_exists = substr_count($get_css, $css_url);
		if ($font_exists) {
			$pattern = sprintf('/%s(.+?)%s/ims', preg_quote($css_url, '/'), preg_quote("');", '/'));
			if (preg_match_all($pattern, $get_css, $matches)) {
				$fonts   = $matches[0];
				$get_css = str_replace($fonts, '', $get_css);
				if (preg_match_all('/font-weight[ ]?:[ ]?[\d]{3}[ ]?;/', $get_css, $matche_weight)) {
					$weight = array_map(function ($val) {
						$process = trim(str_replace(['font-weight', ':', ';'], '', $val));
						if (is_numeric($process)) {
							return $process;
						}
					}, $matche_weight[0]);
					foreach ($fonts as $key => $val) {
						$fonts[$key] = str_replace("');", '', $val) . ':' . implode(',', $weight) . "');";
					}
				}
				$fonts   = array_unique($fonts);
				$get_css = implode('', $fonts) . $get_css;
			}
		}

		return $get_css;
	}


	/**
	 * Save Import CSS in the top of the File
	 *
	 *
	 * @return void
	 * @throws Exception
	 * @since v.1.0.0
	 */
	public function appended()
	{
		if (!current_user_can('edit_posts')) {
			wp_send_json_success(new WP_Error('rtrb_block_user_permission', __('User permission error', 'radius-blocks')));
		}
		global $wp_filesystem;
		if (!$wp_filesystem) {
			require_once(ABSPATH . 'wp-admin/includes/file.php');
		}
		$post    = $_POST;
		$css     = $post['inner_css'];
		$post_id = (int) sanitize_text_field($post['post_id']);
		if ($post_id) {
			Fns::set_setting('save_version', rand(1, 99999));
			$upload_dir_url = wp_upload_dir();
			$filename       = "rtrb-block-css-$post_id.css";
			$dir            = trailingslashit($upload_dir_url['basedir']) . 'rtrb/';
			WP_Filesystem(false, $upload_dir_url['basedir'], true);
			if (!$wp_filesystem->is_dir($dir)) {
				$wp_filesystem->mkdir($dir);
			}
			$oldContent = $wp_filesystem->get_contents($dir . $filename);
			$css = $oldContent . $css;
			if (!$wp_filesystem->put_contents($dir . $filename, $css)) {
				wp_send_json_error(['message' => __('CSS can not be saved due to permission!!!', 'radius-blocks')]);
			}
			wp_send_json_success(['message' => __('Data append done', 'radius-blocks')]);
		} else {
			wp_send_json_error(['message' => __('Data not found!!', 'radius-blocks')]);
		}
	}

	/**
	 * Save Import CSS in the top of the File
	 *
	 * @return void
	 */
	public function get_posts_call()
	{
		$post_id = absint($_POST['postId']);
		if ($post_id) {
			wp_send_json_success(get_post($post_id)->post_content);
		} else {
			wp_send_json_error(new WP_Error('rtrb_block_data_not_found', __('Data not found!!', 'radius-blocks')));
		}
	}

	/**
	 * Get All Reusable ID
	 *
	 * @return array Arg
	 */
	public function reusable_id($post_id)
	{
		$reusable_id = [];
		if ($post_id) {
			$post = get_post($post_id);
			if (has_blocks($post->post_content)) {
				$blocks = parse_blocks($post->post_content);
				foreach ($blocks as $key => $value) {
					if (isset($value['attrs']['ref'])) {
						$reusable_id[] = $value['attrs']['ref'];
					}
				}
			}
		}

		return $reusable_id;
	}

	/**
	 * Set CSS Style
	 *
	 * @return void
	 */
	public function set_css_style($post_id)
	{
		$builder_args = [
			'post_type' => 'rtrb_builder',
			'post_status' => 'publish',
			'fields'          => 'ids',
			'posts_per_page'  => -1,
			'meta_query' => [
				[
					'key'   => 'rtrb_builder_activation',
					'value' => '1',
				]
			]
		];

		if ($post_id) {
			$post_ids = [];
			$post_ids[] = $post_id;
			$builder_post_ids = get_posts($builder_args);
			$postids = !empty($builder_post_ids) ? array_unique(array_merge($post_ids, $builder_post_ids)) : $post_ids;

			foreach ($postids as $post_id) {
				$upload_dir_url     = wp_get_upload_dir();
				$upload_css_dir_url = trailingslashit($upload_dir_url['basedir']);
				$css_dir_path       = $upload_css_dir_url . "rtrb/rtrb-block-css-$post_id.css";

				$css_dir_url = trailingslashit($upload_dir_url['baseurl']);
				if (is_ssl()) {
					$css_dir_url = str_replace('http://', 'https://', $css_dir_url);
				}

				// Reusable CSS
				$reusable_id = $this->reusable_id($post_id);
				foreach ($reusable_id as $id) {
					$reusable_dir_path = $upload_css_dir_url . "rtrb/rtrb-block-css-$id.css";
					if (file_exists($reusable_dir_path)) {
						$css_url = $css_dir_url . "rtrb/rtrb-block-css-$id.css";
						wp_enqueue_style("rtrb-block-post-$id", $css_url, [], Fns::get_setting('save_version'), 'all');
					} else {
						$css = get_post_meta($id, '_rtrb_block_css', true);
						if ($css) {
							wp_enqueue_style("rtrb-block-post-$id", $css, false, Fns::get_setting('save_version'));
						}
					}
				}

				if (file_exists($css_dir_path)) {
					$css_url = $css_dir_url . "rtrb/rtrb-block-css-$post_id.css";
					wp_enqueue_style('rtrb-blocks-frontend-style');
					wp_enqueue_script('rtrb-frontend-blocks-js');
					wp_enqueue_style("rtrb-block-post-$post_id", $css_url, [], Fns::get_setting('save_version'), 'all');
				} else if ($css = get_post_meta($post_id, '_rtrb_block_css', true)) {
					wp_enqueue_style('rtrb-blocks-frontend-style');
					wp_enqueue_script('rtrb-frontend-blocks-js');
					wp_enqueue_style("rtrb-block-post-$post_id", $css, false, Fns::get_setting('save_version'));
				}
			}
		} else {
			$builder_post_ids = get_posts($builder_args);
			foreach ($builder_post_ids as $post_id) {
				$upload_dir_url     = wp_get_upload_dir();
				$upload_css_dir_url = trailingslashit($upload_dir_url['basedir']);
				$css_dir_path       = $upload_css_dir_url . "rtrb/rtrb-block-css-$post_id.css";

				$css_dir_url = trailingslashit($upload_dir_url['baseurl']);
				if (is_ssl()) {
					$css_dir_url = str_replace('http://', 'https://', $css_dir_url);
				}
				if (file_exists($css_dir_path)) {
					$css_url = $css_dir_url . "rtrb/rtrb-block-css-$post_id.css";
					wp_enqueue_style('rtrb-blocks-frontend-style');
					wp_enqueue_script('rtrb-frontend-blocks-js');
					wp_enqueue_style("rtrb-block-post-$post_id", $css_url, [], Fns::get_setting('save_version'), 'all');
				}
			}
		}
	}

	public function rtrb_block_category($categories)
	{
		$rtrb_header_footer_category = [
			'slug'  => 'rtrb-header-footer',
			'title' => __('Radius Blocks Header & Footer', 'radius-blocks'),
		];

		$rtrb_category = [
			'slug'  => 'rtrb-radius-blocks',
			'title' => __('Radius Blocks', 'radius-blocks'),
		];

		$modifiedCategory[0] = $rtrb_header_footer_category;
		$modifiedCategory[2] = $rtrb_category;

		return array_merge($modifiedCategory, $categories);
	}


	public function register_meta()
	{
		register_meta(
			'post',
			'_rtrb_font_attr',
			array(
				'show_in_rest'  => true,
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can('edit_posts');
				},
			)
		);
	}

	private function is_enable_block($key = null)
	{
		if (is_null($key)) {
			return true;
		}
		if (isset($this->enabled_blocks[$key])) {
			return true;
		}
		return false;
	}
}
