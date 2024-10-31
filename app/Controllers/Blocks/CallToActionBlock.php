<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class CallToActionBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_call_to_action']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/call-to-action') && !is_admin()) {
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
			'layout'   => array(
				'type'    => 'string',
				'default' => '1',
			),
			'preview'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'titleDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'tagName'   => array(
				'type'    => 'string',
				'default' => "h3",
			),
			'titleText'   => array(
				'type'    => 'string',
				'default' => "Let's Work Together With Gutenberg",
			),
			'descDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'descText'   => array(
				'type'    => 'string',
				'default' => "The Radius Blocks Library for WordPress Gutenberg Editor. Radius Blocks plugin is compatible with all the themes that can be edited with Gutenberg",
			),
			'contentAlignment'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}} .rtrb-cta
						 {text-align:{{contentAlignment}};}'
					]
				]
			),

			//Button one
			'buttonEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'buttonType'   => array(
				'type'    => 'string',
				'default' => 'rt-fill-btn',
			),
			'iconEnable'   => array(
				'type'    => 'boolean',
				'default' => false,
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
			'buttonIcon'   => array(
				'type'    => 'string',
				'default' => 'arrow-right',
			),
			'buttonSize'   => array(
				'type'    => 'string',
				'default' => 'rt-btn-sm',
			),

			'buttonWidthType'   => array(
				'type'    => 'string',
				'default' => 'auto',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonWidthType', 'condition' => '==', 'value' => 'full'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{display: flex; }'
					]
				]
			),
			'buttonFixedWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonWidthType', 'condition' => '==', 'value' => 'fixed'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1 {width:{{buttonFixedWidth}}; }'
					]
				]
			],

			'buttonIconPosition'   => array(
				'type'    => 'string',
				'default' => 'right',
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonIconPosition', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1 {flex-direction:row-reverse; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1 .rt-btn-icon{font-size:{{buttonIconSize}}; }'
					]
				]
			],

			'buttonIconGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{gap:{{buttonIconGap}}; }'
					]
				]
			],

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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1']
				],
			],

			'buttonTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{color: {{buttonTextColor}} !important; }'
					]
				]
			),

			'buttonHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:hover{color: {{buttonHoverTextColor}} !important; }'
					]
				]
			),

			'buttonIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1 .rt-btn-icon{color: {{buttonIconColor}} !important; }'
					]
				]
			),

			'buttonHoverIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:hover .rt-btn-icon{color: {{buttonHoverIconColor}} !important; }'
					]
				]
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{{buttonPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{{buttonMargin}}'
					]
				]
			),



			'buttonBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{border-style:{{buttonBorderStyle}};}'
					]
				]
			),

			'buttonHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:hover{border-style:{{buttonHoverBorderStyle}};}'
					]
				]
			),

			'buttonBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{border-color:{{buttonBorderColor}};}'
					]
				]
			),
			'buttonHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:hover{border-color:{{buttonHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{{buttonBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:hover{{buttonHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1{{buttonRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:hover{{buttonHoverRadius}}'
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
			'buttonIconHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rt-icon-left-to-right',
			),
			'buttonTransitionDuration'   => array(
				'type'    => 'number',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:before{transition-duration:{{buttonTransitionDuration}}ms;}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-shutter-in-vertical:before
						{background: {{buttonBGColor}} ; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-shutter-in-vertical
						{background: {{buttonHoverBGColor}} ; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-shutter-in-vertical:before 
						{background: {{buttonGradientColor}} ; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1.rt-shutter-in-vertical 
						{background: {{buttonHoverGradientColor}} ;  }'
					]
				]
			),

			'buttonShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1']
				],
			],

			'buttonHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn1:hover']
				],
			],

			//Button Two

			'buttonTwoEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'buttonTwoType'   => array(
				'type'    => 'string',
				'default' => 'rt-fill-btn',
			),
			'iconEnableTwo'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'buttonTwoText'   => array(
				'type'    => 'string',
				'default' => 'Read More',
			),
			'buttonTwoURL'   => array(
				'type'    => 'string',
				'default' => '#',
			),
			'buttonTwoOpenWindow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'buttonTwoNofollow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'buttonTwoIcon'   => array(
				'type'    => 'string',
				'default' => 'arrow-right',
			),
			'buttonTwoSize'   => array(
				'type'    => 'string',
				'default' => 'rt-btn-sm',
			),
			'buttonTwoAlignment'   => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper {text-align: {{buttonTwoAlignment}}; }'
					]
				]
			),
			'buttonTwoWidthType'   => array(
				'type'    => 'string',
				'default' => 'auto',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonTwoWidthType', 'condition' => '==', 'value' => 'full'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{display: flex; }'
					]
				]
			),
			'buttonTwoFixedWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonTwoWidthType', 'condition' => '==', 'value' => 'fixed'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2 {width:{{buttonTwoFixedWidth}}; }'
					]
				]
			],

			'buttonTwoIconPosition'   => array(
				'type'    => 'string',
				'default' => 'right',
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonTwoIconPosition', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2 {flex-direction:row-reverse; }'
					]
				]
			),

			'buttonTwoIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2 .rt-btn-icon{font-size:{{buttonTwoIconSize}}; }'
					]
				]
			],

			'buttonTwoIconGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{gap:{{buttonTwoIconGap}}; }'
					]
				]
			],

			'buttonTwoTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2']
				],
			],

			'buttonTwoTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{color: {{buttonTwoTextColor}} !important; }'
					]
				]
			),

			'buttonTwoHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:hover{color: {{buttonTwoHoverTextColor}} !important; }'
					]
				]
			),

			'buttonTwoIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2 .rt-btn-icon{color: {{buttonTwoIconColor}} !important; }'
					]
				]
			),

			'buttonTwoHoverIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:hover .rt-btn-icon{color: {{buttonTwoHoverIconColor}} !important; }'
					]
				]
			),

			"buttonTwoPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{{buttonTwoPadding}}'
					]
				]
			),

			"buttonTwoMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{{buttonTwoMargin}}'
					]
				]
			),

			'buttonTwoBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{border-style:{{buttonTwoBorderStyle}};}'
					]
				]
			),

			'buttonTwoHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:hover{border-style:{{buttonTwoHoverBorderStyle}};}'
					]
				]
			),

			'buttonTwoBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{border-color:{{buttonTwoBorderColor}};}'
					]
				]
			),
			'buttonTwoHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:hover{border-color:{{buttonTwoHoverBorderColor}};}'
					]
				]
			),

			"buttonTwoBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{{buttonTwoBorderWidth}}'
					]
				]
			),


			"buttonTwoHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:hover{{buttonTwoHoverBorderWidth}}'
					]
				]
			),

			"buttonTwoRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2{{buttonTwoRadius}}'
					]
				]
			),

			"buttonTwoHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:hover{{buttonTwoHoverRadius}}'
					]
				]
			),

			'buttonTwoBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonTwoBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'buttonTwoHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'buttonTwoShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonTwoBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonTwoHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rt-btn-no-effect',
			),
			'buttonTwoIconHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rt-icon-left-to-right',
			),
			'buttonTwoTransitionDuration'   => array(
				'type'    => 'number',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:before{transition-duration:{{buttonTwoTransitionDuration}}ms;}'
					]
				]
			),

			'buttonTwoBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-shutter-in-vertical:before
						{background: {{buttonTwoBGColor}} ; }'
					]
				]
			),

			'buttonTwoHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-shutter-in-vertical
						{background: {{buttonTwoHoverBGColor}} ; }'
					]
				]
			),

			'buttonTwoGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-shutter-in-vertical:before 
						{background: {{buttonTwoGradientColor}} ; }'
					]
				]
			),

			'buttonTwoHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2.rt-shutter-in-vertical 
						{background: {{buttonTwoHoverGradientColor}} ;  }'
					]
				]
			),

			'buttonTwoShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2']
				],
			],

			'buttonTwoHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rtrb-btn2:hover']
				],
			],



			//title style
			'titleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta__title{color:{{titleColor}};}'
					]
				]
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-cta__title']
				],
			],
			"titleMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta__title{{titleMargin}}'
					]
				]
			),

			//desc style
			'descColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta__desc{color:{{descColor}};}'
					]
				]
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-cta__desc']
				],
			],
			"descMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta__desc{{descMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-cta:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-cta']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-cta:hover']
				],
			],
		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_call_to_action()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'call-to-action',
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
		$button_icon = '';
		if (!empty($settings['buttonIcon'])) :
			$button_icon = Fns::render_svg_html($settings['buttonIcon']);
		endif;

		$button_icon2 = '';
		if (!empty($settings['buttonTwoIcon'])) :
			$button_icon2 = Fns::render_svg_html($settings['buttonTwoIcon']);
		endif;

		$layout = '1';
		$data = [
			'template'              => 'blocks/call-to-action/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];
		$data['button_icon'] =  $button_icon;

		$data['button_icon2'] =  $button_icon2;

		$data = apply_filters('rtrb_call_to_action_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
