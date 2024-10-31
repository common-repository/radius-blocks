<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class AdvancedVideo
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_video']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue'], 5);
		add_action('enqueue_block_editor_assets', [$this, 'editor_assets']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/advanced-video') && !is_admin()) {
			wp_enqueue_style('rtrb-blocks-frontend-style');
			wp_enqueue_script('rtrb-frontend-blocks-js');
		}
	}
	public function editor_assets()
	{
		wp_enqueue_style('fancybox-style');
		wp_enqueue_script('fancybox');
	}

	public function get_attributes()
	{
		$attributes = [
			'blockId' => [
				'type'    => 'string',
				'default' => '',
			],
			'preview' => [
				'type'    => 'boolean',
				'default' => false,
			],
			'layout'  => [
				'type'    => 'string',
				'default' => '1',
			],

			'videoSource' => [
				'type' => "string",
				'default' => 'external'
			],

			'videoURL' => [
				'type' => "string",
				'default' => 'https://www.youtube.com/watch?v=z1hbfGutsYo&t=1s'
			],

			'videoObj' => [
				'type'    => 'object',
			],

			'enableOverlay' => [
				'type'    => 'boolean',
				'default' => true
			],
			'videoPopupShowHide' => [
				'type' => "boolean",
				'default' => false
			],

			'overlayImgObj' => [
				'type'    => 'object',
				'default' => [
					'id' => '',
					'url' => RTRB_URL . '/assets/img/blocks/advanced-video/overlay-img.png',
					'alt' => 'overlay image'
				]
			],

			'videoPlayIconType' => [
				'type' => "string",
				'default' => 'icon'
			],

			'videoPlayImgObj' => [
				'type'    => 'object',
				'default' => [
					'id' => '',
					'url' => '',
					'alt' => 'play Icon image'
				]
			],

			'videoPlayIcon' => [
				'type' => "string",
				'default' => 'play'
			],

			'autoPlayOnOff' => [
				'type' => "boolean",
				'default' => true
			],

			'muteOnOff' => [
				'type' => "boolean",
				'default' => true
			],

			'loopOnOff' => [
				'type' => "boolean",
				'default' => false
			],

			'showControlOnOff' => [
				'type' => "boolean",
				'default' => false
			],

			'overlayColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video .rtrb-video-overlay{background-color:{{overlayColor}};}'
					]
				]
			),

			//video style
			'videoWidth' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'unit' => '%'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video .rtrb-advanced-video-wrapper {width: {{videoWidth}}; }'
					],
				],
			],
			'videoHeight' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'unit' => '%'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video .rtrb-advanced-video-wrapper {padding-top: {{videoHeight}}; }'
					],
				],
			],
			'videoBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'videoBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video{border-style:{{videoBorderStyle}};}'
					]
				]
			),

			'videoHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video:hover{border-style:{{videoHoverBorderStyle}};}'
					]
				]
			),

			'videoBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video{border-color:{{videoBorderColor}};}'
					]
				]
			),
			'videoHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video:hover{border-color:{{videoHoverBorderColor}};}'
					]
				]
			),

			"videoBorderWidth" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					],
					'type' => 'border'
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video{{videoBorderWidth}}'
					]
				]
			),

			"videoHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video:hover{{videoHoverBorderWidth}}'
					]
				]
			),

			"videoRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video{{videoRadius}}'
					]
				]
			),

			"videoHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video:hover{{videoHoverRadius}}'
					]
				]
			),

			'videoShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'videoShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video']
				],
			],

			'videoHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video:hover']
				],
			],


			// overlay style
			'playIconArea' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video .rtrb-advanced-video-area .rtrb-play-icon {width: {{playIconArea}};height:{{playIconArea}}; }'
					],
				],
			],
			'playIconSize' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video .rtrb-advanced-video-area .rtrb-play-icon {font-size: {{playIconSize}}; }'
					],
				],
			],
			'playBgColorType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'playColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video .rtrb-advanced-video-area .rtrb-play-icon {color: {{playColor}} !important; }'
					],
				]
			),

			'playBgNormalColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'playBgColorType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video .rtrb-advanced-video-area .rtrb-play-icon {background: {{playBgNormalColor}} !important; }'
					],
				]
			),

			'playBgGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'playBgColorType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-video .rtrb-advanced-video-area .rtrb-play-icon {background: {{playBgGradientColor}} !important; }'
					],
				]
			),
			'fancyboxColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '.rtrb-body-wrap button.carousel__button.is-close {color: {{fancyboxColor}} !important; }'
					],
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area { 
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area::before'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area::before{
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-advanced-video-main-area:hover']
				],
			],


		];

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_video()
	{
		wp_register_style(
			'fancybox-style',
			rtrb()->get_assets_uri('vendors/fancybox/css/fancybox.min.css'),
			array(),
			RTRB_VERSION,
		);

		wp_register_script(
			'fancybox-js',
			rtrb()->get_assets_uri('vendors/fancybox/js/fancybox.min.js'),
			array("jquery"),
			RTRB_VERSION,
			true
		);

		wp_register_script(
			'react-player',
			'//unpkg.com/react-player/dist/ReactPlayer.standalone.js',
			array('jquery'),
			RTRB_VERSION,
			true
		);
		register_block_type(
			RTRB_PATH_BLOCKS . 'advanced-video',
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
		if (!is_admin()) {
			wp_enqueue_style('fancybox-style');
			wp_enqueue_script('fancybox-js');
			wp_enqueue_script('react-player');
		}
		$data = [
			'template'              => 'blocks/advanced-video/layout',
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_advanced_video_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
