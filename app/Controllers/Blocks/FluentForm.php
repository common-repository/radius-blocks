<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class FluentForm
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_fluent_form']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/fluent-form') && !is_admin()) {
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
			'formId' => array(
				'type' => 'string',
				'default' => '1'
			),

			'formName' => array(
				'type' => 'string',
				'default' => ''
			),

			'labelEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'placeholderEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'errorMessageEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),

			//form box
			'formAlignmentHelper'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'formAlignment'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'formAlignmentHelper', 'condition' => '==', 'value' => 'center'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper.rtrb-fm-alignment-center{margin:0 auto;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'formAlignmentHelper', 'condition' => '==', 'value' => 'right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper.rtrb-fm-alignment-right{margin:0 0 0 auto;}'
					]
				]
			),

			'formMaxWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper{width:{{formMaxWidth}};max-width:100%;}'
					]
				]
			],

			//label style
			'labelTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group label']
				],
			],

			'labelColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group label{color: {{labelColor}} !important; }'
					]
				]
			),

			//input & textarea style
			'inputTATypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), 
					{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea,
					{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select']
				],
			],

			'inputTAColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select{color: {{inputTAColor}} !important; }'
					]
				]
			),
			'inputTABGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner
						 {background-color: {{inputTABGColor}} !important; }'
					]
				]
			),

			'inputWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]),
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select.ff-el-form-control,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices{width:{{inputWidth}};}'
					]
				]
			],

			'inputHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]),
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select.ff-el-form-control{height:{{inputHeight}}; }'
					]
				]
			],

			'textareaWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea{width:{{textareaWidth}};}'
					]
				]
			],

			'textareaHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea{height:{{textareaHeight}}; }'
					]
				]
			],

			"inputTAPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select{{inputTAPadding}}'
					]
				]
			),
			"inputTAMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group{{inputTAMargin}}'
					]
				]
			),

			'inputTABorderType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'inputTABorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):not(.choices__input), 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner{border-style:{{inputTABorderStyle}};}'
					]
				]
			),

			'inputTAHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):not(.choices__input):hover, 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea:hover,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select:hover,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner:hover{border-style:{{inputTAHoverBorderStyle}};}'
					]
				]
			),

			'inputTABorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):not(.choices__input), 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner{border-color:{{inputTABorderColor}};}'
					]
				]
			),
			'inputTAHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):not(.choices__input):hover, 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea:hover,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select:hover,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner:hover{border-color:{{inputTAHoverBorderColor}};}'
					]
				]
			),

			"inputTABorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):not(.choices__input), 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner{{inputTABorderWidth}}'
					]
				]
			),


			"inputTAHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):not(.choices__input):hover, 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea:hover,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select:hover,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner:hover{{inputTAHoverBorderWidth}}'
					]
				]
			),

			"inputTARadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):not(.choices__input), 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner{{inputTARadius}}'
					]
				]
			),

			"inputTAHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):not(.choices__input):hover, 
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group textarea:hover,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group select:hover,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-group .ff-el-input--content .choices[data-type*=select-multiple] .choices__inner:hover{{inputTAHoverRadius}}'
					]
				]
			),

			//checkbox & radio
			'checkboxRNCType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'checkboxRSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper{--checkbox-radio-width:{{checkboxRSize}};--checkbox-radio-height:{{checkboxRSize}};}'
					]
				]
			],

			"checkboxRItemSpace" => array(
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-form-check:not(:last-child){margin-bottom:{{checkboxRItemSpace}}; }'
					]
				]
			),

			'optionLabelColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content .ff-el-form-check-label span{color: {{optionLabelColor}};}'
					]
				]
			),
			'checkboxRNColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=checkbox],
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=radio]{background-color: {{checkboxRNColor}};}'
					]
				]
			),

			'checkboxRCColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=checkbox]:checked::before{color:{{checkboxRCColor}};}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=radio]:checked::before{background-color:{{checkboxRCColor}};}'
					]
				]
			),

			"checkboxRBorderWidth" => array(
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=checkbox],
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=radio]{border-width:{{checkboxRBorderWidth}}; }'
					]
				]
			),

			'checkboxRBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=checkbox],
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=radio]{border-color: {{checkboxRBorderColor}};}'
					]
				]
			),

			"checkboxRounded" => array(
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-input--content input[type=checkbox]{border-radius:{{checkboxRounded}};}'
					]
				]
			),

			//placeholder
			'placeholderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper input::-webkit-input-placeholder,
						{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper textarea::-webkit-input-placeholder{color: {{placeholderColor}} !important; }'
					]
				]
			),

			//section break
			'sectionBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break{background-color: {{sectionBGColor}} !important; }'
					]
				]
			),
			"sectionMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break{{sectionMargin}}'
					]
				]
			),

			"sectionPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break{{sectionPadding}}'
					]
				]
			),


			'sectionHTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break .ff-el-section-title']
				],
			],
			'sectionHTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break .ff-el-section-title{color: {{sectionHTextColor}} !important; }'
					]
				]
			),

			'sectionHBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break .ff-el-section-title{background-color: {{sectionHBGColor}} !important; }'
					]
				]
			),

			//section description
			'sectionDTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break .ff-section_break_desk']
				],
			],
			'sectionDTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break .ff-section_break_desk{color: {{sectionDTextColor}} !important; }'
					]
				]
			),
			'sectionDBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break .ff-section_break_desk{background-color: {{sectionDBGColor}} !important; }'
					]
				]
			),
			'sectionHLineColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-el-section-break hr{border-color: {{sectionHLineColor}} !important; }'
					]
				]
			),

			//custom html
			'customHtmlTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-custom_html > *']
				],
			],
			'customHtmlColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-custom_html{color: {{customHtmlColor}} !important; }'
					]
				]
			),
			'customHtmlBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-custom_html > *{background-color: {{customHtmlBGColor}} !important; }'
					]
				]
			),

			//submit button
			'buttonWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper button.ff-btn-submit{width:{{buttonWidth}};}'
					]
				]
			],

			'buttonHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper button.ff-btn-submit{height:{{buttonHeight}};}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit']
				],
			],

			'buttonColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'buttonTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper button.ff-btn-submit{color: {{buttonTextColor}} !important; }'
					]
				]
			),

			'buttonHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper button.ff-btn-submit:hover{color: {{buttonHoverTextColor}} !important; }'
					]
				]
			),

			'buttonBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper button.ff-btn-submit{background-color: {{buttonBGColor}} !important; }'
					]
				]
			),

			'buttonHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper button.ff-btn-submit:hover{background-color: {{buttonHoverBGColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit{{buttonPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit{{buttonMargin}}'
					]
				]
			),

			'buttonBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'buttonBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit{border-style:{{buttonBorderStyle}};}'
					]
				]
			),

			'buttonHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit:hover{border-style:{{buttonHoverBorderStyle}};}'
					]
				]
			),

			'buttonBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit{border-color:{{buttonBorderColor}};}'
					]
				]
			),
			'buttonHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit:hover{border-color:{{buttonHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit{{buttonBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit:hover{{buttonHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit{{buttonRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit:hover{{buttonHoverRadius}}'
					]
				]
			),

			'buttonShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'buttonShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit']
				],
			],

			'buttonHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block  .ff_submit_btn_wrapper .ff-btn-submit:hover']
				],
			],

			'successTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-message-success']
				],
			],

			'successColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-message-success{color: {{successColor}} !important; }'
					]
				]
			),
			'successBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-message-success{background-color: {{successBGColor}} !important; }'
					]
				]
			),

			'successBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .ff-message-success{border-color: {{successBorderColor}} !important; }'
					]
				]
			),

			//error
			'errorTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .error.text-danger']
				],
			],

			'errorColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .error.text-danger{color: {{errorColor}} !important; }'
					]
				]
			),
			'errorBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .error.text-danger{background-color: {{errorBGColor}} !important; }'
					]
				]
			),
			'errorBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper .fluentform .ff-el-is-error .ff-el-form-control{border-color: {{errorBorderColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-fluent-form-wrapper:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_fluent_form()
	{
		if (defined('FLUENTFORM_VERSION')) {
			wp_register_style(
				'fluent-form-styles-rtrb',
				plugins_url() . '/fluentform/assets/css/fluent-forms-public.css',
				array(),
				RTRB_VERSION,
				'all'
			);

			//For use editor-script
			wp_register_style(
				'fluentform-public-default-rtrb',
				plugins_url() . '/fluentform/assets/css/fluentform-public-default.css',
				array('fluent-form-styles-rtrb', 'rtrb-blocks-frontend-style'),
				RTRB_VERSION,
				'all'
			);
		}

		register_block_type(
			RTRB_PATH_BLOCKS . 'fluent-form',
			[
				'editor_script' 	=> 'rtrb-blocks-editor-script',
				'editor_style'    	=> 'fluentform-public-default-rtrb',
				'render_callback' => [$this, 'render_block'],
				'attributes'      => $this->get_attributes(),
			]
		);
	}

	public function render_block($settings)
	{
		$data = [
			'template'              => 'blocks/fluent-form/layout-1',
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_fluent_form_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
