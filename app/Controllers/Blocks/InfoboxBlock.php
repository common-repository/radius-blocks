<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class InfoboxBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_infobox']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/infobox') && !is_admin()) {
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box .rtrb-info-box__inner {flex-direction: {{mediaDirection}}; }'
					]
				]
			),
			'mediaAlignment'   => array(
				'type' => 'object',
				'default' => ['lg' => 'center'],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media {align-self: {{mediaAlignment}}; }'
					]
				]
			),

			'boxIcon'   => array(
				'type'    => 'string',
				'default' => 'desktop',
			),

			'iconHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rt-effect-none',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media--icon {font-size:{{iconSize}}; }'
					]
				]
			],

			'iconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media--icon{color:{{iconColor}};}'
					]
				]
			),
			'iconColorHover'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__inner:hover .rtrb-info-box__media--icon{color:{{iconColorHover}};}'
					]
				]
			),
			'iconBorderColorHover'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__inner:hover .rtrb-info-box__media--icon{border-color:{{iconBorderColorHover}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box .rtrb-info-box__media--image {width:{{imageWidth}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box .rtrb-info-box__media--image {height:{{imageHeight}}; }'
					]
				]
			],
			'mediaBottomSpacing' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => ''
				],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__inner {gap:{{mediaBottomSpacing}}; }']
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media {{mediaPadding}}'
					]
				]
			),

			'mediaBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media {border-style:{{mediaBorderStyle}};}'
					]
				]
			),

			'mediaBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media {border-color:{{mediaBorderColor}};}'
					]
				]
			),
			'mediaBorderTopColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box.rt-top-to-bottom.rtrb-info-box--style-2 .rtrb-info-box__media 
						{border-top-color:{{mediaBorderTopColor}};}'
					]
				]
			),
			'mediaBorderBottomColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box.rt-bottom-to-top.rtrb-info-box--style-2 .rtrb-info-box__media 
						{border-bottom-color:{{mediaBorderBottomColor}};}'
					]
				]
			),
			'mediaBorderLeftColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box.rt-left-to-right.rtrb-info-box--style-2 .rtrb-info-box__media 
						{border-left-color:{{mediaBorderLeftColor}};}'
					]
				]
			),
			'mediaBorderRightColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box.rt-right-to-left.rtrb-info-box--style-2 .rtrb-info-box__media 
						{border-right-color:{{mediaBorderRightColor}};}'
					]
				]
			),

			"mediaBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media {{mediaBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media {{mediaRadius}}'
					]
				]
			),

			'mediaShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media']
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media:after, {{RTRB}}.rtrb-block .rtrb-info-box__media:before{background: {{mediaBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media:before{background: {{mediaHoverBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media:after, {{RTRB}}.rtrb-block .rtrb-info-box__media:before{background-image: {{mediaGradientColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__media:before{background-image: {{mediaHoverGradientColor}}; }'
					]
				]
			),


			'mediaCountEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'mediaCountNumber'   => array(
				'type'    => 'string',
				'default' => "01",
			),

			'mediaCountColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box--style-3 .rtrb-info-box-counter,
						{{RTRB}}.rtrb-block .rtrb-info-box--style-4 .rtrb-info-box__header .rt-box-counter
						{color: {{mediaCountColor}}; }'
					]
				]
			),
			'mediaCountBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box--style-3 .rtrb-info-box-counter,
						{{RTRB}}.rtrb-block .rtrb-info-box--style-4 .rtrb-info-box__header .rt-box-counter 
						{background-color: {{mediaCountBGColor}}; }'
					]
				]
			),
			'mediaCountBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box--style-3 .rtrb-info-box-counter,
						{{RTRB}}.rtrb-block .rtrb-info-box--style-6 .rtrb-info-box__header .rt-box-counter
						{border-color: {{mediaCountBorderColor}}; }'
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
				'default' => 'Radius Blocks Info Box Title',
			),
			'titleLinkEnable'   => array(
				'type'    => 'boolean',
				'default' => false
			),
			'titleURL'   => array(
				'type'    => 'string',
			),
			'titleOpenWindow'   => array(
				'type'    => 'boolean',
				'default' => false
			),
			'titleNofollow'   => array(
				'type'    => 'boolean',
				'default' => false
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__title']
				],
			],
			'titleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__title{color: {{titleColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__title {{titleMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__content {{contentBoxPadding}}'
					]
				]
			),
			'contentAlignment'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__content
						 {text-align:{{contentAlignment}};}'
					]
				]
			),


			//Description
			'descDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),

			'descText'   => array(
				'type'    => 'string',
				'default' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy',
			),
			'descTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__excerpt']
				],
			],

			'descMargin' => [
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__content  .rtrb-info-box__excerpt {{descMargin}}'
					]
				]
			],

			'descColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__excerpt{color: {{descColor}} !important; }'
					]
				]
			),

			//button
			'buttonType'   => array(
				'type'    => 'string',
				'default' => 'rt-read-more-text-btn',
			),
			'buttonEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'buttonText'   => array(
				'type'    => 'string',
				'default' => 'Read More',
			),
			'buttonURL'   => array(
				'type'    => 'string',
				'default' => '#',
			),
			'buttonOpenWindow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'buttonNofollow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'buttonIconEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'buttonIcon'   => array(
				'type'    => 'string',
				'default' => 'arrow-right',
			),
			"buttonPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button{{buttonPadding}}'
					]
				]
			),
			"buttonMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button{{buttonMargin}}'
					]
				]
			),
			'buttonTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button']
				],
			],

			'buttonTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button{color: {{buttonTextColor}} !important; }'
					]
				]
			),

			'buttonHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:hover{color: {{buttonHoverTextColor}} !important; }'
					]
				]
			),

			'buttonIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button .rt-btn-icon{color: {{buttonIconColor}} !important; }'
					]
				]
			),

			'buttonHoverIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:hover .rt-btn-icon{color: {{buttonHoverIconColor}} !important; }'
					]
				]
			),

			'buttonIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button .rt-btn-icon{font-size:{{buttonIconSize}}; }'
					]
				]
			],

			'buttonBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button{border-style:{{buttonBorderStyle}};}'
					]
				]
			),

			'buttonHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:hover{border-style:{{buttonHoverBorderStyle}};}'
					]
				]
			),

			'buttonBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button{border-color:{{buttonBorderColor}};}'
					]
				]
			),
			'buttonHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:hover{border-color:{{buttonHoverBorderColor}};}'
					]
				]
			),

			"buttonBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button{{buttonBorderWidth}}'
					]
				]
			),


			"buttonHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:hover{{buttonHoverBorderWidth}}'
					]
				]
			),

			"buttonRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button{{buttonRadius}}'
					]
				]
			),

			"buttonHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:hover{{buttonHoverRadius}}'
					]
				]
			),

			'buttonBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'buttonHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'buttonShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rt-btn-no-effect',
			),
			'buttonTransitionDuration'   => array(
				'type'    => 'number',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block  .rtrb-button,
						{{RTRB}}.rtrb-block.rtrb-block  .rtrb-button:before{transition-duration:{{buttonTransitionDuration}}ms;}'
					]
				]
			),


			'buttonBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:before,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-shutter-in-vertical:before
						{background: {{buttonBGColor}}; }'
					]
				]
			),

			'buttonHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:before,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-rectangle-in,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-shutter-in-vertical
						{background: {{buttonHoverBGColor}}; }'
					]
				]
			),

			'buttonGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:before,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-shutter-in-vertical:before
						{background-image: {{buttonGradientColor}}; }'
					]
				]
			),

			'buttonHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:before,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-rectangle-in,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button.rt-shutter-in-vertical
						{background-image: {{buttonHoverGradientColor}}; }'
					]
				]
			),

			'buttonShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button']
				],
			],

			'buttonHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box .rtrb-button:hover']
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner:before'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__inner::after'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-info-box__inner::after{
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-block .rtrb-info-box__inner:hover']
				],
			],

			'blockCustomCss' => [
				'type' => "string",
				'default' => "",
				'style' => [
					(object)['selector' => ""]
				],
			],
		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_infobox()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'infobox',
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
		$box_icon = $button_icon = '';
		if (!empty($settings['boxIcon'])) :
			$box_icon = Fns::render_svg_html($settings['boxIcon']);
		endif;

		if (!empty($settings['buttonIcon'])) :
			$button_icon = Fns::render_svg_html($settings['buttonIcon']);
		endif;

		$layoutArray = ['1', '2', '3'];
		$layout = isset($settings['layout']) ? $settings['layout'] : '1';
		if (in_array($layout, $layoutArray, true)) {
			$layout = '1';
		}

		$data = [
			'template'              => 'blocks/infobox/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data['box_icon']  =  $box_icon;
		$data['button_icon'] =  $button_icon;

		$data = apply_filters('rtrb_infobox_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
