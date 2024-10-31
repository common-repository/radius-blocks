<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class ContactForm7
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_contact_form7']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/contact-form7') && !is_admin()) {
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
				'default' => '12600'
			),

			'isHtml' => array(
				'type' => 'boolean',
				'default' => false
			),

			'formJson' => array(
				'type'    => 'object',
				'default' => null,
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper.rtrb-cf7-alignment-center{margin:0 auto;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'formAlignmentHelper', 'condition' => '==', 'value' => 'right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper.rtrb-cf7-alignment-right{margin:0 0 0 auto;}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper{width:{{formMaxWidth}};max-width:100%;}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form label,
					{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form .wpcf7-list-item-label']
				],
			],

			'labelColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.wpcf7-form:not(input) {color: {{labelColor}};}'
					]
				]
			),

			'labelToInputGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select{margin-top:{{labelToInputGap}};}'
					]
				]
			],

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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=submit]),
					{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
					{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select']
				],
			],

			'inputTAColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select {color: {{inputTAColor}} !important;}'
					]
				]
			),

			'inputTABGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select{background-color: {{inputTABGColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select{width:{{inputWidth}} !important;}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 selec{height:{{inputHeight}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea{width:{{textareaWidth}} !important;}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea{height:{{textareaHeight}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select{{inputTAPadding}}'
					]
				]
			),
			"inputTAMargin" => array(
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form>p {margin-bottom:{{inputTAMargin}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select{border-style:{{inputTABorderStyle}};}'
					]
				]
			),

			'inputTAHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]):hover, 
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea:hover,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select:hover{border-style:{{inputTAHoverBorderStyle}};}'
					]
				]
			),

			'inputTABorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select{border-color:{{inputTABorderColor}};}'
					]
				]
			),
			'inputTAHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]):hover,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea:hover,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select:hover{border-color:{{inputTAHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select{{inputTABorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]):hover, 
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea:hover,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select:hover{{inputTAHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]),
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select{{inputTARadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 input:not([type=radio]):not([type=checkbox]):not([type=submit]):hover, 
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 textarea:hover,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 select:hover{{inputTAHoverRadius}}'
					]
				]
			),

			//placeholder
			'placeholderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper input::-webkit-input-placeholder,
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper textarea::-webkit-input-placeholder{color: {{placeholderColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper{--checkbox-radio-width:{{checkboxRSize}};--checkbox-radio-height:{{checkboxRSize}}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form span.wpcf7-list-item:not(:last-child){margin-right:{{checkboxRItemSpace}}; }'
					]
				]
			),

			'optionLabelColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form .wpcf7-list-item-label{color: {{optionLabelColor}};}'
					]
				]
			),
			'checkboxRNColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=checkbox],
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=radio]{background-color: {{checkboxRNColor}};}'
					]
				]
			),

			'checkboxRCColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=radio]:checked::before{background-color:{{checkboxRCColor}};}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=checkbox]:checked::before{color:{{checkboxRCColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=checkbox],
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=radio]{border-width:{{checkboxRBorderWidth}}; }'
					]
				]
			),

			'checkboxRBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=checkbox],
						{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=radio]{border-color: {{checkboxRBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form input[type=checkbox]{border-radius:{{checkboxRounded}};}'
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
						'selector' => '{{RTRB}}.rtrb-block  .wpcf7 input.wpcf7-form-control.wpcf7-submit{width:{{buttonWidth}};}'
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
						'selector' => '{{RTRB}}.rtrb-block  .wpcf7 input.wpcf7-form-control.wpcf7-submit{height:{{buttonHeight}};}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block  .wpcf7 input.wpcf7-form-control.wpcf7-submit']
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
						'selector' => '{{RTRB}}.rtrb-block  .wpcf7 input.wpcf7-form-control.wpcf7-submit{color: {{buttonTextColor}} !important; }'
					]
				]
			),

			'buttonHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover{color: {{buttonHoverTextColor}} !important; }'
					]
				]
			),

			'buttonBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .wpcf7 input.wpcf7-form-control.wpcf7-submit{background-color: {{buttonBGColor}} !important; }'
					]
				]
			),

			'buttonHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block  .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover{background-color: {{buttonHoverBGColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit{{buttonPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit{{buttonMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit{border-style:{{buttonBorderStyle}};}'
					]
				]
			),

			'buttonHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover{border-style:{{buttonHoverBorderStyle}};}'
					]
				]
			),

			'buttonBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit{border-color:{{buttonBorderColor}};}'
					]
				]
			),
			'buttonHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover{border-color:{{buttonHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit{{buttonBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover{{buttonHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit{{buttonRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover{{buttonHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit']
				],
			],

			'buttonHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover']
				],
			],

			//validation
			'validationTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7-not-valid-tip']
				],
			],

			'validationColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7-not-valid-tip{color: {{validationColor}} !important; }'
					]
				]
			),
			'validationBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7-not-valid{border-color: {{validationBorderColor}} !important; }'
					]
				]
			),

			//success
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.sent .wpcf7-response-output']
				],
			],

			'successColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.sent .wpcf7-response-output{color: {{successColor}} !important; }'
					]
				]
			),
			'successBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.sent .wpcf7-response-output{background-color: {{successBGColor}} !important; }'
					]
				]
			),
			'successBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.sent .wpcf7-response-output{border-color: {{successBorderColor}} !important; }'
					]
				]
			),
			"successPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.sent .wpcf7-response-output{{successPadding}}'
					]
				]
			),
			"successMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.sent .wpcf7-response-output{{successMargin}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.invalid .wpcf7-response-output']
				],
			],

			'errorColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.invalid .wpcf7-response-output{color: {{errorColor}} !important; }'
					]
				]
			),
			'errorBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.invalid .wpcf7-response-output{background-color: {{errorBGColor}} !important; }'
					]
				]
			),
			'errorBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.invalid .wpcf7-response-output{border-color: {{errorBorderColor}} !important; }'
					]
				]
			),
			"errorMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.invalid .wpcf7-response-output{{errorMargin}}'
					]
				]
			),
			"errorPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper .wpcf7 form.invalid .wpcf7-response-output{{errorPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-contact-form7-wrapper:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_contact_form7()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'contact-form7',
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
		$data = [
			'template'              => 'blocks/contact-form7/layout-1',
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_fluent_form_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
