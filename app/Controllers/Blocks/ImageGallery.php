<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class ImageGallery
{

	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_image_gallery']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue'], 5);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/image-gallery') && !is_admin()) {
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
				'default' => 'grid',
			],
			'displayPresetLayout'  => [
				'type'    => 'boolean',
				'default' => false,
			],
			'gridPresetLayout'  => [
				'type'    => 'string',
				'default' => '',
			],

			'images' => [
				'type' => "array",
				'default' => []
			],

			'sources' => [
				'type' => "array",
				'default' => []
			],
			'newImage' => [
				'type' => "string",
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
				'default' => '',
			],
			'imageGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => 20,
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'grid'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper.rtrb-gallery-style-grid {gap: {{imageGap}}; }',
					],
				],
			],
			'imageGapMasonry' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'masonry'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper.rtrb-gallery-style-masonry {gap: {{imageGapMasonry}};}',
					],
				],
			],
			'imageMasonryItemMarginBottom' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'masonry'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper.rtrb-gallery-style-masonry .rtrb-img-gallery-item { margin-bottom : {{imageMasonryItemMarginBottom}};}',
					],
				],
			],

			'imageColumn' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => 3,
					'md' => 3,
					'sm' => 1,
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'grid'],
							(object)['key' => 'gridPresetLayout', 'condition' => '==', 'value' => ''],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper.rtrb-gallery-style-grid {grid-template-columns: repeat({{imageColumn}},1fr); }',
					],
				],
			],
			'imageColumnMasonry' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => 3,
					'md' => 3,
					'sm' => 1,
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'masonry'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper.rtrb-gallery-style-masonry {columns: {{imageColumnMasonry}}; }',
					],
				],
			],

			'disableLightBox'  => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'disableLightBoxCaption'  => array(
				'type'    => 'boolean',
				'default' => false,
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-gallery-wrap:after {background: {{imgBoxOverlayNormalColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-gallery-wrap:after {background: {{imgBoxOverlayGradientColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-caption-wrap {max-width: {{captionBoxWidth}}; width: 100% }',
					],
				],
			],
			'capTextAlign'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-caption-wrap
						 {text-align:{{capTextAlign}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-caption-wrap {background: {{captionBoxBgNormalColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-caption-wrap:hover {background: {{captionBoxBgHoverColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-caption-wrap {background: {{captionBoxBgGradientColor}} !important; }'
					],
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-caption-wrap{{capBoxPadding}}'
					]
				]
			),


			// title
			'capTitleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-caption {color: {{capTitleColor}}; }'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-caption']
				],
			],

			"capTitleMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-caption{{capTitleMargin}}'
					]
				]
			),

			// description
			'capDescColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-short-desc {color: {{capDescColor}}; }'
					]
				]
			),
			'capDescTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-short-desc']
				],
			],

			"capDescMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-short-desc{{capDescMargin}}'
					]
				]
			),

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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap{border-style:{{imageBorderStyle}};}'
					]
				]
			),

			'imageHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap:hover{border-style:{{imageHoverBorderStyle}};}'
					]
				]
			),

			'imageBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap{border-color:{{imageBorderColor}};}'
					]
				]
			),
			'imageHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap:hover{border-color:{{imageHoverBorderColor}};}'
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
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap{{imageBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap:hover{{imageHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap{{imageRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap:hover{{imageHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap']
				],
			],

			'imageHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrap:hover']
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-gallery-img']
				],
			],

			'imageHoverFilter' => [
				'type' => 'object',
				'default' => (object)['openFilter' => 1, 'filter' => (object)['brightness' => 100, 'contrast' => 100, 'saturate' => 100, 'blur' => 0, 'hue-rotate' => 0], 'opacity' => ''],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery-wrapper .rtrb-img-gallery-item:hover .rtrb-gallery-img']
				],
			],

			'imageItemBgType'   => array(
				'type'    => 'string',
				'default' => 'normal',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-img-gallery:hover']
				],
			],


		];

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_image_gallery()
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
			RTRB_PATH_BLOCKS . 'image-gallery',
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
			'template'              => 'blocks/image-gallery/layout',
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_image_gallery_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
