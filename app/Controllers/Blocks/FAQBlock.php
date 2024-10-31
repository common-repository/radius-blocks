<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class FAQBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_faq']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/faq') && !is_admin()) {
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
			'layoutText'   => array(
				'type'    => 'string',
				'default' => 'Count',
			),

			'accordions' => [
				'type' => "array",
				'default' => [
					[
						"title" => "Radius Blocks FAQ Item 1",
						"content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy",
					],
					[
						"title" => "Radius Blocks FAQ Item 2",
						"content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy",
					],
				],
			],

			'accordionType' => [
				'type' => "string",
				'default' => "accordion",
			],

			'selectedTab' => [
				'type' => "number",
				'default' => 0,
			],
			'expandedTabs' => [
				'type' => "array",
				'default' => [0],
			],

			'faqItemGap'   => array(
				'type'    => 'number',
				'default' => (object)[
					'lg' => '',
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__list,
						{{RTRB}}.rtrb-block .rtrb-faq-list {gap: {{faqItemGap}}; }'
					]
				]
			),

			'titleTagName' => [
				'type' => "string",
				'default' => "h4",
			],

			// faq icon style
			'displayIcon' => [
				'type' => "boolean",
				'default' => true,
			],

			'faqIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count{color: {{faqIconColor}}; }'
					]
				]
			),
			'faqIconHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '
						{{RTRB}}.rtrb-block .rtrb-faq:hover .rtrb-faq__count,
						{{RTRB}}.rtrb-block .rtrb-accordion__item .rtrb-accordion__header:hover .rt-accordion-icon{color: {{faqIconHoverColor}}; }'
					]
				]
			),

			'faqIcon' => [
				'type' => "string",
				'default' => "plus",
			],

			'faqExpandedIcon' => [
				'type' => "string",
				'default' => "minus",
			],

			'faqIconPosition'   => array(
				'type'    => 'string',
				'default' => 'left',
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'faqIconPosition', 'condition' => '==', 'value' => 'right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header {flex-direction:row; }'
					]
				]
			),

			'faqIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count{font-size:{{faqIconSize}}; }'
					]
				]
			],
			'faqIconBoxSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-faq__count{width:{{faqIconBoxSize}}; height:{{faqIconBoxSize}}; }'
					]
				]
			],

			'faqIconBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'faqIconBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'faqIconHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'faqIconBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'faqIconBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count {background: {{faqIconBGColor}}; }'
					]
				]
			),

			'faqIconHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'faqIconHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover,
						{{RTRB}}.rtrb-block .rtrb-faq .rtrb-faq__count:after 
						{background: {{faqIconHoverBGColor}}; }'
					]
				]
			),

			'faqIconGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'faqIconBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count
						{background: {{faqIconGradientColor}}; }'
					]
				]
			),

			'faqIconHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'faqIconHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover,
						{{RTRB}}.rtrb-block .rtrb-faq .rtrb-faq__count:after 
						{background: {{faqIconHoverGradientColor}}; }'
					]
				]
			),

			"faqIconMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count
						{{faqIconMargin}}'
					]
				]
			),
			"faqIconPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count{{faqIconPadding}}'
					]
				]
			),
			'faqIconBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'faqIconBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count{border-style:{{faqIconBorderStyle}};}'
					]
				]
			),

			'faqIconHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover,
						{{RTRB}}.rtrb-block .rtrb-faq__count:hover{border-style:{{faqIconHoverBorderStyle}};}'
					]
				]
			),

			'faqIconBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count{border-color:{{faqIconBorderColor}};}'
					]
				]
			),
			'faqIconHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover,
						{{RTRB}}.rtrb-block .rtrb-faq__count:hover{border-color:{{faqIconHoverBorderColor}};}'
					]
				]
			),

			"faqIconBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count{{faqIconBorderWidth}}'
					]
				]
			),


			"faqIconHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover,
						{{RTRB}}.rtrb-block .rtrb-faq__count:hover{{faqIconHoverBorderWidth}}'
					]
				]
			),

			"faqIconRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon,
						{{RTRB}}.rtrb-block .rtrb-faq__count{{faqIconRadius}}'
					]
				]
			),

			"faqIconHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover,
						{{RTRB}}.rtrb-block .rtrb-faq__count:hover:after{{faqIconHoverRadius}}'
					]
				]
			),

			'activeTabIconBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-expand-tab .rt-accordion-icon{background: {{activeTabIconBGColor}}; }'
					]
				]
			),
			'activeTabIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-expand-tab .rt-accordion-icon{color: {{activeTabIconColor}}; }'
					]
				]
			),

			//question style
			'faqTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header .rtrb-accordion-title,
					{{RTRB}}.rtrb-block .rtrb-faq__title']
				],
			],
			'faqTitleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header .rtrb-accordion-title,
						{{RTRB}}.rtrb-block .rtrb-faq__title {color: {{faqTitleColor}}; }'
					]
				]
			),
			'faqTitleHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover .rtrb-accordion-title,
						{{RTRB}}.rtrb-block .rtrb-faq:hover .rtrb-faq__title {color: {{faqTitleHoverColor}}; }'
					]
				]
			),

			'faqTitleAlign' => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion-title-wrap{justify-content: {{faqTitleAlign}}; }'
					]
				]
			),

			'faqTitleAlign135' => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-faq__title {text-align: {{faqTitleAlign135}}; }'
					]
				]
			),

			'faqBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'faqBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'faqHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'faqBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'faqBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header {background: {{faqBGColor}}; }'
					]
				]
			),

			'faqHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'faqHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover
						{background: {{faqHoverBGColor}}; }'
					]
				]
			),

			'faqGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'faqBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{background: {{faqGradientColor}}; }'
					]
				]
			),

			'faqHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'faqHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover
						{background: {{faqHoverGradientColor}}; }'
					]
				]
			),

			"faqMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{{faqMargin}}'
					]
				]
			),
			"faqPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{{faqPadding}}'
					]
				]
			),
			'activeTabBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-expand-tab .rtrb-accordion__header {background: {{activeTabBGColor}}; }'
					]
				]
			),
			'activeTabBGGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'contentBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-expand-tab .rtrb-accordion__header{background: {{activeTabBGGradientColor}}; }'
					]
				]
			),
			'activeTabTitleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-expand-tab .rtrb-accordion__header .rtrb-accordion-title {color: {{activeTabTitleColor}}; }'
					]
				]
			),

			'displayTitleIcon' => [
				'type' => "boolean",
				'default' => false,
			],

			'faqTitleIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-icon {color: {{faqTitleIconColor}}; }'
					]
				]
			),
			'faqTitleActiveIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-expand-tab .rt-icon {color: {{faqTitleActiveIconColor}}; }'
					]
				]
			),
			'faqTitleIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-icon {font-size:{{faqTitleIconSize}}; }'
					]
				]
			],
			'titleIconGap'   => array(
				'type'    => 'number',
				'default' => (object)[
					'lg' => '',
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion-title-wrap {gap: {{titleIconGap}}; }'
					]
				]
			),


			'faqBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'faqBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{border-style:{{faqBorderStyle}};}'
					]
				]
			),

			'faqHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover{border-style:{{faqHoverBorderStyle}};}'
					]
				]
			),

			'faqBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{border-color:{{faqBorderColor}};}'
					]
				]
			),
			'faqHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover{border-color:{{faqHoverBorderColor}};}'
					]
				]
			),

			"faqBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{{faqBorderWidth}}'
					]
				]
			),


			"faqHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover{{faqHoverBorderWidth}}'
					]
				]
			),

			"faqRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{{faqRadius}}'
					]
				]
			),

			"faqHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover{{faqHoverRadius}}'
					]
				]
			),

			//content style
			'contentTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-content,
					{{RTRB}}.rtrb-block .rtrb-faq__des']
				],
			],
			'contentColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-content,
						{{RTRB}}.rtrb-block .rtrb-faq__des {color: {{contentColor}}; }'
					]
				]
			),

			'contentAlign' => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-widget,
						{{RTRB}}.rtrb-block .rtrb-faq__des {text-align: {{contentAlign}}; }'
					]
				]
			),


			'contentBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'contentBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'contentHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'contentBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'contentBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-widget {background: {{contentBGColor}}; }'
					]
				]
			),

			'contentHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'contentHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-widget:hover
						{background: {{contentHoverBGColor}}; }'
					]
				]
			),

			'contentGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'contentBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-widget{background: {{contentGradientColor}}; }'
					]
				]
			),

			'contentHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'contentHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-widget:hover
						{background: {{contentHoverGradientColor}}; }'
					]
				]
			),

			"contentMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-widget{{contentMargin}}'
					]
				]
			),
			"contentPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-widget{{contentPadding}}'
					]
				]
			),
			'contentBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'contentBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-widget{border-style:{{contentBorderStyle}};}'
					]
				]
			),

			'contentHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-widget:hover{border-style:{{contentHoverBorderStyle}};}'
					]
				]
			),

			'contentBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-widget{border-color:{{contentBorderColor}};}'
					]
				]
			),
			'contentHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-widget:hover{border-color:{{contentHoverBorderColor}};}'
					]
				]
			),

			"contentBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-widget{{contentBorderWidth}}'
					]
				]
			),


			"contentHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-widget:hover{{contentHoverBorderWidth}}'
					]
				]
			),

			"contentRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-widget{{contentRadius}}'
					]
				]
			),

			"contentHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-widget:hover{{contentHoverRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
						{{RTRB}}.rtrb-block .rtrb-faq-list{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
						{{RTRB}}.rtrb-block .rtrb-faq-list{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
						{{RTRB}}.rtrb-block .rtrb-faq-list'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover,
						{{RTRB}}.rtrb-block .rtrb-faq-list:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
						{{RTRB}}.rtrb-block .rtrb-faq-list{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion::before,
						{{RTRB}}.rtrb-block .rtrb-faq-list:before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion::before,
						{{RTRB}}.rtrb-block .rtrb-faq-list:before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
						{{RTRB}}.rtrb-block .rtrb-faq-list{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
						{{RTRB}}.rtrb-block .rtrb-faq-list{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
						{{RTRB}}.rtrb-block .rtrb-faq-list{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
						{{RTRB}}.rtrb-block .rtrb-faq-list{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover,
						{{RTRB}}.rtrb-block .rtrb-faq-list:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover,
						{{RTRB}}.rtrb-block .rtrb-faq-list:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover,
						{{RTRB}}.rtrb-block .rtrb-faq-list:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover,
						{{RTRB}}.rtrb-block .rtrb-faq-list:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-accordion,
					{{RTRB}}.rtrb-block .rtrb-faq-list']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover,
					{{RTRB}}.rtrb-block .rtrb-faq-list:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_faq()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'faq',
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
		$faqIcon = $faqExpandedIcon = '';
		if (!empty($settings['faqIcon'])) :
			$faqIcon = Fns::render_svg_html($settings['faqIcon']);
		endif;

		if (!empty($settings['faqExpandedIcon'])) :
			$faqExpandedIcon = Fns::render_svg_html($settings['faqExpandedIcon']);
		endif;

		$layoutArray = ['1', '3', '5'];
		$layout = isset($settings['layout']) ? $settings['layout'] : '1-3-5';
		if (in_array($layout, $layoutArray, true)) {
			$layout = '1-3-5';
		} else {
			$layout = '2-4';
		}

		$data = [
			'template'              => 'blocks/faq/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];
		$data['faqIcon'] =  $faqIcon;
		$data['faqExpandedIcon'] = $faqExpandedIcon;

		$data = apply_filters('rtrb_faq_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
