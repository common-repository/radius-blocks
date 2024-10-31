<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class DualButtonBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_dual_button']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/dual-button') && !is_admin()) {
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
			'buttonType'   => array(
				'type'    => 'string',
				'default' => 'rt-fill-btn',
			),
			//button one
			'buttonOneText'   => array(
				'type'    => 'string',
				'default' => 'Radius Button',
			),
			'buttonOneURL'   => array(
				'type'    => 'string',
				'default' => '#',
			),
			'buttonOneIconEnable'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'buttonOneIcon'   => array(
				'type'    => 'string',
				'default' => 'arrow-right',
			),
			'buttonOneIconPosition'   => array(
				'type'    => 'string',
				'default' => 'right',
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonOneIconPosition', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one {flex-direction:row-reverse; }'
					]
				]
			),

			//button two
			'buttonTwoText'   => array(
				'type'    => 'string',
				'default' => 'Radius Button',
			),
			'buttonTwoURL'   => array(
				'type'    => 'string',
				'default' => '#',
			),
			'buttonTwoIconEnable'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'buttonTwoIcon'   => array(
				'type'    => 'string',
				'default' => 'arrow-right',
			),
			'buttonTwoIconPosition'   => array(
				'type'    => 'string',
				'default' => 'right',
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonTwoIconPosition', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two {flex-direction:row-reverse; }'
					]
				]
			),

			//buttons
			'buttonOpenWindow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'buttonNofollow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'buttonAlignment'   => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper {justify-content: {{buttonAlignment}}; }'
					]
				]
			),

			'buttonWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-dual-button .rtrb-button {width:{{buttonWidth}}; }'
					]
				]
			],

			'buttonGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-dual-button {gap:{{buttonGap}}; }'
					]
				]
			],

			'buttonIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button .rt-btn-icon{font-size:{{buttonIconSize}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{gap:{{buttonIconGap}}; }'
					]
				]
			],


			//buttons style
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button']
				],
			],

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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{{buttonPadding}}'
					]
				]
			),

			//button one style
			'buttonOneTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one{color: {{buttonOneTextColor}} !important; }'
					]
				]
			),
			'buttonOneHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:hover{color: {{buttonOneHoverTextColor}} !important; }'
					]
				]
			),

			'buttonOneIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one .rt-btn-icon{color: {{buttonOneIconColor}} !important; }'
					]
				]
			),

			'buttonOneHoverIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:hover .rt-btn-icon{color: {{buttonOneHoverIconColor}} !important; }'
					]
				]
			),
			'buttonOneBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonOneBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'buttonOneHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'buttonOneBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonOneBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-shutter-in-vertical:before
						{background: {{buttonOneBGColor}} !important; }'
					]
				]
			),

			'buttonOneHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonOneHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-shutter-in-vertical
						{background: {{buttonOneHoverBGColor}} !important; }'
					]
				]
			),

			'buttonOneGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonOneBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-shutter-in-vertical:before 
						{background: {{buttonOneGradientColor}} !important; }'
					]
				]
			),

			'buttonOneHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonOneHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one.rt-shutter-in-vertical 
						{background: {{buttonOneHoverGradientColor}} !important; }'
					]
				]
			),

			'buttonOneBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'buttonOneBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one{border-style:{{buttonOneBorderStyle}};}'
					]
				]
			),

			'buttonOneHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:hover{border-style:{{buttonOneHoverBorderStyle}};}'
					]
				]
			),

			'buttonOneBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one{border-color:{{buttonOneBorderColor}};}'
					]
				]
			),
			'buttonOneHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:hover{border-color:{{buttonOneHoverBorderColor}};}'
					]
				]
			),

			"buttonOneBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one{{buttonOneBorderWidth}}'
					]
				]
			),


			"buttonOneHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:hover{{buttonOneHoverBorderWidth}}'
					]
				]
			),

			"buttonOneRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one{{buttonOneRadius}}'
					]
				]
			),

			"buttonOneHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:hover{{buttonOneHoverRadius}}'
					]
				]
			),


			'buttonOneShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonOneShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one']
				],
			],

			'buttonOneHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--one:hover']
				],
			],


			//button two style
			'buttonTwoTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two{color: {{buttonTwoTextColor}} !important; }'
					]
				]
			),
			'buttonTwoHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:hover{color: {{buttonTwoHoverTextColor}} !important; }'
					]
				]
			),
			'buttonTwoIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two .rt-btn-icon{color: {{buttonTwoIconColor}} !important; }'
					]
				]
			),

			'buttonTwoHoverIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:hover .rt-btn-icon{color: {{buttonTwoHoverIconColor}} !important; }'
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
			'buttonTwoBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonTwoBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-shutter-in-vertical:before
						{background: {{buttonTwoBGColor}} !important; }'
					]
				]
			),

			'buttonTwoHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonTwoHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-shutter-in-vertical
						{background: {{buttonTwoHoverBGColor}} !important; }'
					]
				]
			),

			'buttonTwoGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonTwoBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-shutter-in-vertical:before 
						{background: {{buttonTwoGradientColor}} !important; }'
					]
				]
			),

			'buttonTwoHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonTwoHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two.rt-shutter-in-vertical 
						{background: {{buttonTwoHoverGradientColor}} !important; }'
					]
				]
			),


			'buttonTwoBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'buttonTwoBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two{border-style:{{buttonTwoBorderStyle}};}'
					]
				]
			),

			'buttonTwoHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:hover{border-style:{{buttonTwoHoverBorderStyle}};}'
					]
				]
			),

			'buttonTwoBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two{border-color:{{buttonTwoBorderColor}};}'
					]
				]
			),
			'buttonTwoHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:hover{border-color:{{buttonTwoHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two{{buttonTwoBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:hover{{buttonTwoHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two{{buttonTwoRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:hover{{buttonTwoHoverRadius}}'
					]
				]
			),

			'buttonTwoShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonTwoShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two']
				],
			],

			'buttonTwoHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn--two:hover']
				],
			],

			//connector
			'connectorDisplay' => [
				'type' => 'boolean',
				'default' => true
			],
			'connectorType' => [
				'type' => 'string',
				'default' => 'text'
			],
			'connectorText' => [
				'type' => 'string',
				'default' => 'OR'
			],
			'connectorIcon' => [
				'type' => 'string',
				'default' => 'arrows-alt-h'
			],
			'connectorIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-dual-btn-connector__inner{font-size:{{connectorIconSize}}; }'
					]
				]
			],
			'connectorSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-dual-btn-connector__inner{width:{{connectorSize}};height:{{connectorSize}} }'
					]
				]
			],

			//connector style
			'connectorTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn-connector__inner']
				],
			],

			'connectorBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn-connector__inner{background: {{connectorBGColor}} !important; }'
					]
				]
			),

			'connectorTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn-connector__inner{color: {{connectorTextColor}} !important; }'
					]
				]
			),

			'connectorBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn-connector__inner{border-style:{{connectorBorderStyle}};}'
					]
				]
			),
			'connectorBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn-connector__inner{border-color:{{connectorBorderColor}};}'
					]
				]
			),
			"connectorBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn-connector__inner{{connectorBorderWidth}}'
					]
				]
			),

			"connectorRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn-connector__inner{{connectorRadius}}'
					]
				]
			),

			'connectorShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rt-dual-btn-connector__inner']
				],
			],

			//advance
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper{{buttonMargin}}'
					]
				]
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:before{transition-duration:{{buttonTransitionDuration}}ms;}'
					]
				]
			),
		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_dual_button()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'dual-button',
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
		$button_one_icon = '';
		if (!empty($settings['buttonOneIcon'])) :
			$button_one_icon = Fns::render_svg_html($settings['buttonOneIcon']);
		endif;

		$button_two_icon = '';
		if (!empty($settings['buttonTwoIcon'])) :
			$button_two_icon = Fns::render_svg_html($settings['buttonTwoIcon']);
		endif;

		$layout = '1';

		$data = [
			'template'              => 'blocks/dual-button/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];
		$data['button_one_icon'] =  $button_one_icon;
		$data['button_two_icon'] =  $button_two_icon;

		$data = apply_filters('rtrb_dual-button_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
