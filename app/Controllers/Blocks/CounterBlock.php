<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class CounterBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_counter']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue'], 5);
		add_action('enqueue_block_editor_assets', [$this, 'editor_assets']);
	}

	public function editor_assets()
	{
		wp_enqueue_style('odometercss');
		wp_enqueue_script('appearjs');
		wp_enqueue_script('odometerjs');
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/counter') && !is_admin()) {
			wp_enqueue_style('odometercss');
			wp_enqueue_style('rtrb-blocks-frontend-style');
			wp_enqueue_script('rtrb-frontend-blocks-js');
		}
	}

	public function get_attributes()
	{
		$attributes = array(
			'blockId' => array(
				'type'    => 'string',
				'default' => '',
			),
			//general
			'layout'   => array(
				'type'    => 'string',
				'default' => '1',
			),

			'preview'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'counterBoxWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner {width:{{counterBoxWidth}}; }'
					]
				]
			],

			'counterBoxHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner {height:{{counterBoxHeight}}; }'
					]
				]
			],

			'counterAlignment'   => array(
				'type' => 'object',
				'default' => ['lg' => ''],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter  {justify-content: {{counterAlignment}};display:flex; }'
					]
				]
			),

			//media
			'mediaType'   => array(
				'type'    => 'string',
				'default' => 'icon',
			),
			'mediaDirection'   => array(
				'type'    => 'object',
				'default' => ['lg' => 'column'],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__inner {flex-direction: {{mediaDirection}}; }'
					]
				]
			),
			'mediaAlignment'   => array(
				'type' => 'object',
				'default' => ['lg' => 'center'],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media {align-self: {{mediaAlignment}}; }'
					]
				]
			),

			'boxIcon'   => array(
				'type'    => 'string',
				'default' => 'smile',
			),

			'imageId'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'imageUrl'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'iconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media--icon {font-size:{{iconSize}}; }'
					]
				]
			],

			'iconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media--icon{color:{{iconColor}};}'
					]
				]
			),

			'imageWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media--image {width:{{imageWidth}}; }'
					]
				]
			],

			'imageAutoHeight' => [
				'type' => 'boolean',
				'default' => true
			],

			'imageHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'imageAutoHeight', 'condition' => '!=', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media--image {height:{{imageHeight}}; }'
					]
				]
			],
			'mediaBottomSpacing' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => ''
				],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-counter__inner {gap:{{mediaBottomSpacing}}; }']
				],
			],
			"mediaPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media {{mediaPadding}}'
					]
				]
			),

			'mediaBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media {border-style:{{mediaBorderStyle}};}'
					]
				]
			),

			'mediaBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media {border-color:{{mediaBorderColor}};}'
					]
				]
			),

			"mediaBorderWidth" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => '0 0 0 0'
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media {{mediaBorderWidth}}'
					]
				]
			),

			"mediaRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media {{mediaRadius}}'
					]
				]
			),

			'mediaShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media']
				],
			],

			'mediaBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'mediaBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'mediaHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'mediaBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mediaBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media:after, {{RTRB}}.rtrb-block .rtrb-counter__media:before{background: {{mediaBGColor}}; }'
					]
				]
			),

			'mediaHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mediaHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media:before{background: {{mediaHoverBGColor}}; }'
					]
				]
			),

			'mediaGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mediaBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media:after, {{RTRB}}.rtrb-block .rtrb-counter__media:before{background-image: {{mediaGradientColor}}; }'
					]
				]
			),

			'mediaHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mediaHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__media:before{background-image: {{mediaHoverGradientColor}}; }'
					]
				]
			),

			//title
			'titleDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'titleText'   => array(
				'type'    => 'string',
				'default' => 'Happy Customers',
			),
			'titleTag'   => array(
				'type'    => 'string',
				'default' => 'h3',
			),
			'titleTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-counter__title']
				],
			],
			'titleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__title{color: {{titleColor}}; }'
					]
				]
			),

			'titleMargin' => [
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__title {{titleMargin}}'
					]
				]
			],

			"contentBoxPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__content {{contentBoxPadding}}'
					]
				]
			),
			'contentAlignment'   => array(
				'type'    => 'object',
				'default' => ['lg' => 'center'],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__content
						 {text-align:{{contentAlignment}};}'
					]
				]
			),
			'contentItemAlign'   => array(
				'type' => 'object',
				'default' => ['lg' => 'center'],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__content {align-self: {{contentItemAlign}}; }'
					]
				]
			),
			'contentBoxAlign'   => array(
				'type' => 'object',
				'default' => ['lg' => 'center'],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__inner {justify-content: {{contentBoxAlign}}; }'
					]
				]
			),

			// counter number
			'numberValue'   => array(
				'type'    => 'string',
				'default' => '3000',
			),
			'numberAnimationDuration'   => array(
				'type'    => 'string',
				'default' => '2000',
			),
			'counterFormat'   => array(
				'type'    => 'string',
				'default' => '(,ddd)',
			),
			'numberTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap']
				],
			],
			'numberColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap{color: {{numberColor}}; }'
					]
				]
			),

			'numberMargin' => [
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap {{numberMargin}}'
					]
				]
			],

			// counter suffix
			'suffixDisplay'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'suffixValue'   => array(
				'type'    => 'string',
				'default' => '+',
			),
			'suffixFontSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap .rt-counter-suffix{font-size:{{suffixFontSize}}; }'
					]
				]
			],
			'suffixColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap .rt-counter-suffix{color: {{suffixColor}}; }'
					]
				]
			),
			'suffixMargin' => [
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap .rt-counter-suffix{{suffixMargin}}'
					]
				]
			],

			// counter prefix
			'prefixDisplay'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'prefixValue'   => array(
				'type'    => 'string',
				'default' => '+',
			),
			'prefixFontSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap .rt-counter-prefix{font-size:{{prefixFontSize}}; }'
					]
				]
			],
			'prefixColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap .rt-counter-prefix{color: {{prefixColor}}; }'
					]
				]
			),
			'prefixMargin' => [
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap .rt-counter-prefix{{prefixMargin}}'
					]
				]
			],

			'titleSuffixPrefixSpacing' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => ''
				],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-counter__number-wrap {gap:{{titleSuffixPrefixSpacing}}; }']
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner::after'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner::after{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner{border-color:{{mainWrapBorderColor}};}'
					]
				]
			),

			"mainWrapBorderWidth" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => '0 0 0 0'
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner:hover{border-color:{{mainWrapHoverBorderColor}};}'
					]
				]
			),

			"mainWrapHoverBorderWidth" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => '0 0 0 0'
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-counter .rtrb-counter__inner:hover']
				],
			],
		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_counter()
	{
		wp_register_style(
			'odometercss',
			rtrb()->get_assets_uri('vendors/odometer/css/odometer-theme-default.css'),
			array(),
			RTRB_VERSION,
			'all'
		);

		wp_register_script(
			'appearjs',
			rtrb()->get_assets_uri('vendors/appear/js/appear.min.js'),
			array('jquery'),
			RTRB_VERSION,
			true
		);
		wp_register_script(
			'odometerjs',
			rtrb()->get_assets_uri('vendors/odometer/js/odometer.min.js'),
			array('jquery'),
			RTRB_VERSION,
			true
		);

		register_block_type(
			RTRB_PATH_BLOCKS . 'counter',
			[
				'editor_script' 	=> 'rtrb-blocks-editor-script',
				'editor_script' 	=> 'odometerjs',
				'editor_style'    	=> 'rtrb-blocks-frontend-style',
				'editor_style'    	=> 'odometercss',
				'render_callback' => [$this, 'render_block'],
				'attributes'      => $this->get_attributes(),
			]
		);
	}

	public function render_block($settings)
	{
		if (!is_admin()) {
			wp_enqueue_script('appearjs');
			wp_enqueue_script('odometerjs');
		}

		$box_icon = $button_icon = '';
		if (!empty($settings['boxIcon'])) :
			$box_icon = Fns::render_svg_html($settings['boxIcon']);
		endif;

		if (!empty($settings['buttonIcon'])) :
			$button_icon = Fns::render_svg_html($settings['buttonIcon']);
		endif;

		$layoutArray = ['1', '2', '3', '4'];
		$layout = isset($settings['layout']) ? $settings['layout'] : '1';
		if (in_array($layout, $layoutArray, true)) {
			$layout = '1';
		}

		$data = [
			'template'              => 'blocks/counter/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data['box_icon']  =  $box_icon;
		$data['button_icon'] =  $button_icon;

		$data = apply_filters('rtrb_counter_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}