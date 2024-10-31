<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class AccordionBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_accordion']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/accordion') && !is_admin()) {
			wp_enqueue_style('rtrb-blocks-frontend-style');
			wp_enqueue_script('rtrb-frontend-blocks-js');
		}
	}

	public function get_attributes($default = false)
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

			'accordions' => [
				'type' => "array",
				'default' => [
					[
						"title" => "Radius Blocks Accordion Item 1",
						"content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy",
						"icon" => "chart-area"
					],
					[
						"title" => "Radius Blocks Accordion Item 2",
						"content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy",
						"icon" => "trophy"
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

			'accordionItemGap'   => array(
				'type'    => 'number',
				'default' => (object)[
					'lg' => '',
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__list {gap: {{accordionItemGap}}; }'
					]
				]
			),

			'tabTitleTagName' => [
				'type' => "string",
				'default' => "h4",
			],

			// tab icon style
			'displayIcon' => [
				'type' => "boolean",
				'default' => true,
			],

			'tabIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-accordion-icon {color: {{tabIconColor}}; }'
					]
				]
			),
			'tabHoverIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rtrb-accordion__header:hover .rt-accordion-icon {color: {{tabHoverIconColor}}; }'
					]
				]
			),


			'tabIcon' => [
				'type' => "string",
				'default' => "chevron-down",
			],

			'tabExpandedIcon' => [
				'type' => "string",
				'default' => "chevron-up",
			],

			'tabIconPosition'   => array(
				'type'    => 'string',
				'default' => 'right',
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'tabIconPosition', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header {flex-direction:row-reverse; }'
					]
				]
			),

			'tabIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-accordion-icon{font-size:{{tabIconSize}}; }'
					]
				]
			],

			'tabIconBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'tabIconBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'tabIconHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'tabIconBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tabIconBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon {background: {{tabIconBGColor}}; }'
					]
				]
			),

			'tabIconHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tabIconHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover
						{background: {{tabIconHoverBGColor}}; }'
					]
				]
			),

			'tabIconGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tabIconBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon{background: {{tabIconGradientColor}}; }'
					]
				]
			),

			'tabIconHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tabIconHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover
						{background: {{tabIconHoverGradientColor}}; }'
					]
				]
			),

			"tabIconMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon{{tabIconMargin}}'
					]
				]
			),
			"tabIconPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon{{tabIconPadding}}'
					]
				]
			),
			'tabIconBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'tabIconBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon{border-style:{{tabIconBorderStyle}};}'
					]
				]
			),

			'tabIconHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover{border-style:{{tabIconHoverBorderStyle}};}'
					]
				]
			),

			'tabIconBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon{border-color:{{tabIconBorderColor}};}'
					]
				]
			),
			'tabIconHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover{border-color:{{tabIconHoverBorderColor}};}'
					]
				]
			),

			"tabIconBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon{{tabIconBorderWidth}}'
					]
				]
			),


			"tabIconHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover{{tabIconHoverBorderWidth}}'
					]
				]
			),

			"tabIconRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon{{tabIconRadius}}'
					]
				]
			),

			"tabIconHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rt-accordion-icon:hover{{tabIconHoverRadius}}'
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

			//tab style
			'tabTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header .rtrb-accordion-title']
				],
			],
			'tabTitleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header .rtrb-accordion-title {color: {{tabTitleColor}}; }'
					]
				]
			),
			'tabTitleHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover .rtrb-accordion-title {color: {{tabTitleHoverColor}}; }'
					]
				]
			),

			'tabTitleAlign' => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion-title-wrap {justify-content: {{tabTitleAlign}}; }'
					]
				]
			),

			'tabBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'tabBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'tabHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'tabBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tabBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header {background: {{tabBGColor}} !important; }'
					]
				]
			),

			'tabHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tabHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover
						{background: {{tabHoverBGColor}} !important; }'
					]
				]
			),

			'tabGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tabBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{background: {{tabGradientColor}} !important; }'
					]
				]
			),

			'tabHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tabHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header:hover
						{background: {{tabHoverGradientColor}} !important; }'
					]
				]
			),

			"tabMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{{tabMargin}}'
					]
				]
			),
			"tabPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__header{{tabPadding}}'
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

			'tabTitleIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-icon {color: {{tabTitleIconColor}}; }'
					]
				]
			),
			'tabTitleActiveIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-expand-tab .rt-icon {color: {{tabTitleActiveIconColor}}; }'
					]
				]
			),
			'tabTitleIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion .rt-icon {font-size:{{tabTitleIconSize}}; }'
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


			'tabBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'tabBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__item  .rtrb-accordion__header{border-style:{{tabBorderStyle}} ;}'
					]
				]
			),

			'tabHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__item  .rtrb-accordion__header:hover{border-style:{{tabHoverBorderStyle}};}'
					]
				]
			),

			'tabBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__item  .rtrb-accordion__header{border-color:{{tabBorderColor}};}'
					]
				]
			),
			'tabHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__item  .rtrb-accordion__header:hover{border-color:{{tabHoverBorderColor}};}'
					]
				]
			),

			"tabBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__item  .rtrb-accordion__header{{tabBorderWidth}}'
					]
				]
			),


			"tabHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__item  .rtrb-accordion__header:hover{{tabHoverBorderWidth}}'
					]
				]
			),

			"tabRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__item  .rtrb-accordion__header{{tabRadius}}'
					]
				]
			),

			"tabHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion__item  .rtrb-accordion__header:hover{{tabHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-content']
				],
			],
			'contentColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-content {color: {{contentColor}}; }'
					]
				]
			),

			'contentAlign' => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-widget {text-align: {{contentAlign}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rt-widget {background: {{contentBGColor}} !important; }'
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
						{background: {{contentHoverBGColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rt-widget{background: {{contentGradientColor}} !important; }'
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
						{background: {{contentHoverGradientColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-accordion']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-accordion:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_accordion()
	{
		register_block_type(
			//'rtrb/accordion',
			RTRB_PATH_BLOCKS . 'accordion',
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
		$tabIcon = $tabExpandedIcon = '';
		if (!empty($settings['tabIcon'])) :
			$tabIcon = Fns::render_svg_html($settings['tabIcon']);
		endif;

		if (!empty($settings['tabExpandedIcon'])) :
			$tabExpandedIcon = Fns::render_svg_html($settings['tabExpandedIcon']);
		endif;

		$layout = '1';

		$data = [
			'template'              => 'blocks/accordion/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];
		$data['tabIcon'] =  $tabIcon;
		$data['tabExpandedIcon'] = $tabExpandedIcon;

		$data = apply_filters('rtrb_accordion_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
