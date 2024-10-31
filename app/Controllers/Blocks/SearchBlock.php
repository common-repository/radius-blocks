<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class SearchBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
		add_action('init', [$this, 'register_search']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/search') && !is_admin()) {
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
			'preview'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'layout'   => array(
				'type'    => 'string',
				'default' => '1',
			),

			'wrapperAlignment' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '!=', 'value' => '1'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box-wrapper{text-align:{{wrapperAlignment}};}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => '1'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box-wrapper{justify-content:{{wrapperAlignment}};display:flex}'
					]
				]
			),
			//input serarch field
			'placeholderDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'placeholderText'   => array(
				'type'    => 'string',
				'default' => 'Type & Hit Enter',
			),
			'searchIconDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'customWidth' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'unit' => '%'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-1 .rtrb-search-form {width: {{customWidth}}; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form .rtrb-search-input{width: {{customWidth}} !important; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .rtrb-search-form .rtrb-search-input{width: {{customWidth}}; }'
					],

				],
			],
			'iconType'   => array(
				'type'    => 'string',
				'default' => 'icon',
			),
			'buttonText'   => array(
				'type'    => 'string',
				'default' => 'Search',
			),

			//input style
			'inputTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-input::-webkit-input-placeholder,
					{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-input'],
					(object)['selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input']

				],
			],

			'inputColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-input::-webkit-input-placeholder,
						{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-input{color: {{inputColor}}; }'
					],
					(object)['selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input{color: {{inputColor}} !important; }']
				]
			),
			'inputBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-input {background-color: {{inputBGColor}}; }'
					],
					(object)['selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input{background-color: {{inputBGColor}} !important; }']
				]
			),
			"inputPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-input{{inputPadding}}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input{{inputPadding}}'
					]
				]
			),

			'inputBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'inputBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form{border-style:{{inputBorderStyle}};}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input{border-style:{{inputBorderStyle}};}'
					],
				]
			),

			'inputHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form:hover{border-style:{{inputHoverBorderStyle}};}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input:hover{border-style:{{inputHoverBorderStyle}};}'
					]
				]
			),

			'inputBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form{border-color:{{inputBorderColor}};}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input{border-color:{{inputBorderColor}};}'
					]
				]
			),
			'inputHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form:hover{border-color:{{inputHoverBorderColor}};}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input:hover{border-color:{{inputHoverBorderColor}};}'
					]
				]
			),

			"inputBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form{{inputBorderWidth}}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input{{inputBorderWidth}}'
					]
				]
			),

			"inputHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form:hover{{inputHoverBorderWidth}}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input:hover{{inputHoverBorderWidth}}'
					]
				]
			),

			"inputRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form{{inputRadius}}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input{{inputRadius}}'
					]
				]
			),

			"inputHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form:hover{{inputHoverRadius}}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input:hover{{inputHoverRadius}}'
					]
				]
			),

			'inputShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'inputShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form'],
					(object)['selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input']
				],
			],

			'inputHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form:hover'],
					(object)['selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form input[type=search].rtrb-search-input:hover']
				],
			],

			//button style
			'buttonColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn {color: {{buttonColor}}; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form .rtrb-search-btn {color: {{buttonColor}} !important; }'
					]
				]
			),
			'buttonHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn:hover {color: {{buttonHoverColor}} !important; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form .rtrb-search-btn:hover {color: {{buttonHoverColor}} !important; }'
					]
				]
			),
			'buttonBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn {background-color: {{buttonBGColor}} !important; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form .rtrb-search-btn {background-color: {{buttonBGColor}} !important; }'
					]
				]
			),
			'buttonHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn:hover {background-color: {{buttonHoverBGColor}} !important; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form .rtrb-search-btn:hover {background-color: {{buttonHoverBGColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn {width:{{buttonWidth}}; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form .rtrb-search-btn {width:{{buttonWidth}}; }'
					],
				]
			],

			'buttonSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn {font-size:{{buttonSize}}; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-form .rtrb-search-btn {font-size:{{buttonSize}}; }'
					]
				]
			],

			//button border
			'buttonBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn{border-style:{{buttonBorderStyle}};}'
					]
				]
			),

			'buttonHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn:hover{border-style:{{buttonHoverBorderStyle}};}'
					]
				]
			),

			'buttonBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn{border-color:{{buttonBorderColor}};}'
					]
				]
			),
			'buttonHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn:hover{border-color:{{buttonHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn{{buttonBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn:hover{{buttonHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn{{buttonRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-form .rtrb-search-btn:hover{{buttonHoverRadius}}'
					]
				]
			),

			//search icon style
			'searchIconColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'searchIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {color: {{searchIconColor}}; }'
					]
				]
			),
			'searchIconHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon:hover {color: {{searchIconHoverColor}} !important; }'
					]
				]
			),
			'searchIconBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {background-color: {{searchIconBGColor}}; }'
					]
				]
			),
			'searchIconHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon:hover {background-color: {{searchIconHoverBGColor}} !important; }'
					]
				]
			),

			'searchIconWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {width:{{searchIconWidth}}; }'
					],
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '!=', 'value' => '1'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {height:{{searchIconWidth}}; }'
					]
				]
			],

			'searchIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {font-size:{{searchIconSize}}; }'
					]
				]
			],

			'searchIconBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'searchIconBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {border-style:{{searchIconBorderStyle}};}'
					]
				]
			),

			'searchIconHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon :hover{border-style:{{searchIconHoverBorderStyle}};}'
					]
				]
			),

			'searchIconBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {border-color:{{searchIconBorderColor}};}'
					]
				]
			),
			'searchIconHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon :hover{border-color:{{searchIconHoverBorderColor}};}'
					]
				]
			),

			"searchIconBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {{searchIconBorderWidth}}'
					]
				]
			),

			"searchIconHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon :hover{{searchIconHoverBorderWidth}}'
					]
				]
			),

			"searchIconRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon {{searchIconRadius}}'
					]
				]
			),

			"searchIconHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box .rtrb-search-icon :hover{{searchIconHoverRadius}}'
					]
				]
			),

			//close Icon
			'closeIconColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'closeIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-close-btn{color: {{closeIconColor}} !important; }'
					]
				]
			),
			'closeIconHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-close-btn:hover {color: {{closeIconHoverColor}} !important; }'
					]
				]
			),
			'closeIconBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-close-btn {background-color: {{closeIconBGColor}} !important; }'
					]
				]
			),
			'closeIconHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-close-btn:hover {background-color: {{closeIconHoverBGColor}} !important; }'
					]
				]
			),

			'closeIconWidthHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-close-btn{width:{{closeIconWidthHeight}};height:{{closeIconWidthHeight}} }'
					],
				]
			],

			'closeIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-close-btn {font-size:{{closeIconSize}}; }'
					]
				]
			],
			'closeIconPosition' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-close-btn {top:{{closeIconPosition}}; }'
					]
				]
			],
			"closeIconRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-search-box-overlay .rtrb-search-close-btn {{closeIconRadius}}'
					]
				]
			),


			//search box
			'searchBoxBgColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-search-box-overlay {background: {{searchBoxBgColor}} !important; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-field {background: {{searchBoxBgColor}} !important; }'
					]

				]
			),

			'searchBoxPositionStyle'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'searchBoxPosition' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'searchBoxPositionStyle', 'condition' => '==', 'value' => 'top'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-open.header-search-field{ top:{{searchBoxPosition}};}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'searchBoxPositionStyle', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-open.header-search-field{ left:{{searchBoxPosition}};right:initial;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'searchBoxPositionStyle', 'condition' => '==', 'value' => 'right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-open.header-search-field{ right:{{searchBoxPosition}};left:initial;}'
					]
				]
			],

			'searchBoxShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-field'],
				],
			],

			"searchBoxPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-field{{searchBoxPadding}}'
					]
				]
			),

			'searchBoxBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-field {border-style:{{searchBoxBorderStyle}};}'
					]
				]
			),

			'searchBoxBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-field {border-color:{{searchBoxBorderColor}};}'
					]
				]
			),

			"searchBoxBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-field {{searchBoxBorderWidth}}'
					]
				]
			),

			"searchBoxRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box.rtrb-search-box-style-3 .header-search-field {{searchBoxRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-search-box:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-search-box']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-search-box:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_search()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'search',
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
			'template'              => 'blocks/search/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];
		$data = apply_filters('rtrb_search_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
