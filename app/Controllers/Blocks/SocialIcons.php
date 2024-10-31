<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class SocialIcons
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
		add_action('init', [$this, 'register_socialIcons']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/social-icons') && !is_admin()) {
			wp_enqueue_style('rtrb-blocks-frontend-style');
		}
	}

	public function get_attributes()
	{
		$attributes = array(
			'blockId' => array(
				'type'    => 'string',
				'default' => '',
			),
			'preview'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'layout'   => array(
				'type'    => 'string',
				'default' => '1',
			),

			//social icons
			'socialIconDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'socialIcons' => [
				'type' => "array",
				'default' => [
					[
						"title" => "Facebook",
						"color" => "",
						"background" => "",
						"url" => "https://www.facebook.com/radiustheme/",
						"iconType" => "icon",
						"image" => [
							"url" => "",
							"id" => "",
						],
						"icon" => "facebook-f",
						"openWindow" => false,
						"colorType" => "normal"
					],
					[
						"title" => "Twitter",
						"color" => "",
						"background" => "",
						"url" => "https://twitter.com/radiustheme/",
						"iconType" => "icon",
						"image" => [
							"url" => "",
							"id" => "",
						],
						"icon" => "twitter",
						"openWindow" => false,
						"colorType" => "normal"
					],
					[
						"title" => "Instagram",
						"color" => "",
						"background" => "",
						"url" => "https://www.instagram.com/radiustheme/",
						"iconType" => "icon",
						"image" => [
							"url" => "",
							"id" => "",
						],
						"icon" => "instagram",
						"openWindow" => false,
						"colorType" => "normal"
					],
					[
						"title" => "Linkedin",
						"color" => "",
						"background" => "",
						"url" => "https://www.linkedin.com/company/radiustheme/",
						"iconType" => "icon",
						"image" => [
							"url" => "",
							"id" => "",
						],
						"icon" => "linkedin-in",
						"openWindow" => false,
						"colorType" => "normal"
					],
					[
						"title" => "Youtube",
						"color" => "",
						"background" => "",
						"url" => "https://www.youtube.com/c/RadiusTheme",
						"iconType" => "icon",
						"image" => [
							"url" => "",
							"id" => "",
						],
						"icon" => "youtube",
						"openWindow" => false,
						"colorType" => "normal"
					],
				],
			],
			'socialOpenWindow'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'socialNofollow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'socialIconAlignment' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper .rtrb-social-list{justify-content:{{socialIconAlignment}}; }'
					]
				]
			),

			//social icons style
			'socialIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link {color: {{socialIconColor}}; }'
					]
				]
			),
			'socialIconHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link:hover {color: {{socialIconHoverColor}} !important; }'
					]
				]
			),
			'socialIconBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link {background-color: {{socialIconBGColor}}; }'
					]
				]
			),
			'socialIconHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link:hover {background-color: {{socialIconHoverBGColor}} !important; }'
					]
				]
			),

			'socialIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link {font-size:{{socialIconSize}}; }'
					]
				]
			],
			'socialIconGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => 10,
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper .rtrb-social-list {gap:{{socialIconGap}}; }'
					]
				]
			],

			"socialIconPadding" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link {{socialIconPadding}}'
					]
				]
			),

			'socialIconBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'socialIconBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link{border-style:{{socialIconBorderStyle}};}'
					]
				]
			),

			'socialIconHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link:hover{border-style:{{socialIconHoverBorderStyle}};}'
					]
				]
			),

			'socialIconBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link{border-color:{{socialIconBorderColor}};}'
					]
				]
			),
			'socialIconHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link:hover{border-color:{{socialIconHoverBorderColor}};}'
					]
				]
			),

			"socialIconBorderWidth" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link{{socialIconBorderWidth}}'
					]
				]
			),

			"socialIconHoverBorderWidth" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link:hover{{socialIconHoverBorderWidth}}'
					]
				]
			),

			"socialIconRadius" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link{{socialIconRadius}}'
					]
				]
			),

			"socialIconHoverRadius" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link:hover{{socialIconHoverRadius}}'
					]
				]
			),
			//icon
			"socialIconColorType" => array(
				"type"    => "boolean",
				"default" => 'normal'
			),
			'socialIcon2Color'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link .rtrb-social-icon {color: {{socialIcon2Color}}; }'
					]
				]
			),
			'socialIcon2HoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link .rtrb-social-icon:hover {color: {{socialIcon2HoverColor}} !important; }'
					]
				]
			),
			'socialIcon2BGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link .rtrb-social-icon {background-color: {{socialIcon2BGColor}}; }'
					]
				]
			),
			'socialIcon2HoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-list .rtrb-social-item .rtrb-social-link .rtrb-social-icon:hover {background-color: {{socialIcon2HoverBGColor}} !important; }'
					]
				]
			),


			//advance
			"mainWrapMargin" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper{{mainWrapMargin}}'
					]
				]
			),
			"mainWrapPadding" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper{{mainWrapPadding}}'
					]
				]
			),

			"mainWrapBG" => array(
				"type"    => "object",
				"default" => (object)[
					'openBGColor' => 0,
					'type' => 'classic',
					'classic' => (object)[
						'color' => '',
						'img' => (object)['imgURL' => '', 'imgID' => ''],
						'imgProperty' => (object)[
							'imgPosition' => (object)['lg' => ''],
							'imgAttachment' => (object)['lg' => ''],
							'imgRepeat' => (object)['lg' => ''],
							'imgSize' => (object)['lg' => ''],
						]
					],
					'gradient' => null
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper'
					]
				]
			),

			"mainWrapHoverBG" => array(
				"type"    => "object",
				"default" => (object)[
					'openBGColor' => 0,
					'type' => 'classic',
					'classic' => (object)[
						'color' => '',
						'img' => (object)['imgURL' => '', 'imgID' => ''],
						'imgProperty' => (object)[
							'imgPosition' => (object)['lg' => ''],
							'imgAttachment' => (object)['lg' => ''],
							'imgRepeat' => (object)['lg' => ''],
							'imgSize' => (object)['lg' => ''],
						]
					],
					'gradient' => null
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper{ 
							transition: background {{mainWrapHoverBGTransition}}s;
                        }'
					],
				]
			),

			"mainWrapBGOverlay" => array(
				"type"    => "object",
				"default" => (object)[
					'openBGColor' => 0,
					'type' => 'classic',
					'classic' => (object)[
						'color' => '',
						'img' => (object)['imgURL' => '', 'imgID' => ''],
						'imgProperty' => (object)[
							'imgPosition' => (object)['lg' => ''],
							'imgAttachment' => (object)['lg' => ''],
							'imgRepeat' => (object)['lg' => ''],
							'imgSize' => (object)['lg' => ''],
						]
					],
					'gradient' => null
				],
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mainWrapBGOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper::before'
					]
				]
			),

			'mainWrapBGOverlayOpacity' => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mainWrapBGOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper::before{
							opacity:{{mainWrapBGOverlayOpacity}}
						}'
					],
				]
			),

			'mainWrapBGOverlayEnable' => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'mainWrapBGType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'mainWrapBorderType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'mainWrapBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper{border-color:{{mainWrapBorderColor}};}'
					]
				]
			),

			"mainWrapBorderWidth" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper{{mainWrapBorderWidth}}'
					]
				]
			),

			"mainWrapRadius" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper:hover{border-color:{{mainWrapHoverBorderColor}};}'
					]
				]
			),

			"mainWrapHoverBorderWidth" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper:hover{{mainWrapHoverBorderWidth}}'
					]
				]
			),

			"mainWrapHoverRadius" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper:hover{{mainWrapHoverRadius}}'
					]
				]
			),

			'mainWrapShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'mainWrapShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-social-wrapper:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_socialIcons()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'social-icons',
			[
				'editor_script' 	=> 'rtrb-blocks-editor-script',
				'editor_style'    	=> 'rtrb-blocks-frontend-style',
				'render_callback' => [$this, 'render_block'],
				'attributes'      => $this->get_attributes(),
			]
		);
	}

	public function render_block($settings)
	{
		$layout = isset($settings['layout']) ? $settings['layout'] : '1';
		$data = [
			'template'              => 'blocks/social-icons/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];
		$data = apply_filters('rtrb_social_icons_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
