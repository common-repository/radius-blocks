<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class AdvancedImage
{

	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_image']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue'], 5);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/advanced-image') && !is_admin()) {
			wp_enqueue_style('fancybox-style');
			wp_enqueue_style('rtrb-blocks-frontend-style');
		}
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

			'imageStyle' => [
				'type' => "string",
				'default' => 'rounded'
			],

			'image' => [
				'type'    => 'object',
			],

			'imageAlignment' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => 'center',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block{text-align:{{imageAlignment}}; }'
					]
				]
			),

			'imageWidth' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image .rtrb-img-inner,
						{{RTRB}}.rtrb-block .rtrb-advanced-image .rtrb-img-inner img
						 {width: {{imageWidth}}; }',
					],
				],
			],

			'imageHeight' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image .rtrb-img-inner,
						{{RTRB}}.rtrb-block .rtrb-advanced-image .rtrb-img-inner img {height: {{imageHeight}}; }',
					],
				],
			],

			'enableLink' => [
				'type' => "boolean",
				'default' => false
			],

			'imageLink' => [
				'type' => "string",
			],

			'imageOpenWindow' => [
				'type' => "boolean",
				'default' => false
			],

			'imageHoverEffect' => [
				'type' => "string",
				'default' => 'none'
			],
			'mainImageHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rtrb-img-effect-none',
			),
			'overlayStyle' => [
				'type' => "string",
				'default' => 'zoominout'
			],
			'captionDisplay' => [
				'type'    => 'boolean',
				'default' => false,
			],

			'captionPosition' => [
				'type'    => 'string',
				'default' => 'center-center',
			],


			//image style
			'imageBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'imageBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner{border-style:{{imageBorderStyle}};}'
					]
				]
			),

			'imageHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner:hover{border-style:{{imageHoverBorderStyle}};}'
					]
				]
			),

			'imageBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner{border-color:{{imageBorderColor}};}'
					]
				]
			),
			'imageHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner:hover{border-color:{{imageHoverBorderColor}};}'
					]
				]
			),

			"imageBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner{{imageBorderWidth}}'
					]
				]
			),

			"imageHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner:hover{{imageHoverBorderWidth}}'
					]
				]
			),

			"imageRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner{{imageRadius}}'
					]
				]
			),

			"imageHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner:hover{{imageHoverRadius}}'
					]
				]
			),

			'imageShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'imageShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner']
				],
			],

			'imageHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner:hover']
				],
			],

			'imageFilterType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'imageFilter' => [
				'type' => 'object',
				'default' => (object)['openFilter' => 1, 'filter' => (object)['brightness' => 100, 'contrast' => 100, 'saturate' => 100, 'blur' => 0, 'hue-rotate' => 0], 'opacity' => ''],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-area .rtrb-img']
				],
			],

			'imageHoverFilter' => [
				'type' => 'object',
				'default' => (object)['openFilter' => 1, 'filter' => (object)['brightness' => 100, 'contrast' => 100, 'saturate' => 100, 'blur' => 0, 'hue-rotate' => 0], 'opacity' => ''],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-area .rtrb-img-inner:hover .rtrb-img']
				],
			],

			'imageItemBgType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),


			// overlay style
			'imgBoxOverlayColorType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'imgBoxOverlayNormalColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'imgBoxOverlayColorType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-area .rtrb-img-inner:after {background: {{imgBoxOverlayNormalColor}} !important; }'
					],
				]
			),

			'imgBoxOverlayGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'imgBoxOverlayColorType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-area .rtrb-img-inner:after {background: {{imgBoxOverlayGradientColor}} !important; }'
					],
				]
			),

			//caption style
			'captionBoxWidth' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'unit' => '%',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner .rtrb-img-caption-wrap {max-width: {{captionBoxWidth}}; width: 100% }',
					],
				],
			],
			'capTextAlign'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner .rtrb-img-caption-wrap
						 {text-align:{{capTextAlign}};}'
					]
				]
			),

			"capBoxPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner .rtrb-img-caption-wrap{{capBoxPadding}}'
					]
				]
			),
			'captionBoxColorType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'captionBoxBgNormalColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'captionBoxColorType', 'condition' => '==', 'value' => 'classic'],
							(object)['key' => 'imageHoverEffect', 'condition' => '==', 'value' => 'none'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner .rtrb-img-caption-wrap {background: {{captionBoxBgNormalColor}} !important; }'
					],
				]
			),

			'captionBoxBgHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'captionBoxColorType', 'condition' => '==', 'value' => 'classic'],
							(object)['key' => 'imageHoverEffect', 'condition' => '==', 'value' => 'none'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner .rtrb-img-caption-wrap:hover {background: {{captionBoxBgHoverColor}} !important; }'
					],
				]
			),
			'captionBoxBgGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'captionBoxColorType', 'condition' => '==', 'value' => 'gradient'],
							(object)['key' => 'imageHoverEffect', 'condition' => '==', 'value' => 'none'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner .rtrb-img-caption-wrap {background: {{captionBoxBgGradientColor}} !important; }'
					],
				]
			),

			// title
			'capTitleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner .rtrb-caption {color: {{capTitleColor}}; }'
					]
				]
			),
			'capTitleTypo' => [
				'type' => 'object',
				'default' => (object)[
					'openTypography' => 1,
					'size' => (object)['lg' => '', 'unit' => 'px'],
					'spacing' => (object)['lg' => '', 'unit' => 'px'],
					'height' => (object)['lg' => '', 'unit' => 'px'],
					'transform' => '',
					'weight' => ''
				],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-inner .rtrb-caption']
				],
			],

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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-image:hover']
				],
			],

		];

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_image()
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
		register_block_type(
			RTRB_PATH_BLOCKS . 'advanced-image',
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
			wp_enqueue_script('fancybox-js');
		}

		$data = [
			'template'              => 'blocks/advanced-image/layout',
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_image_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
