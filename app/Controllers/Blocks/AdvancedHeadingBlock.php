<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class AdvancedHeadingBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_advanced_heading']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/advanced-heading') && !is_admin()) {
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

			'subHeadingColorType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'alignment' => array(
				'type' => 'object',
				'default' => [
					'lg' => 'left'
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading {text-align: {{alignment}} !important;}'
					]
				]
			),

			'tagName'   => array(
				'type'    => 'string',
				'default' => 'h2',
			),
			'subheadingText'   => array(
				'type'    => 'string',
				'default' => 'Radius Blocks Sub-Heading',
			),
			'displaySubheading'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'displaySeparator'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'separatorPosition'   => array(
				'type'    => 'string',
				'default' => 'bottom',
			),

			'headingText'   => array(
				'type'    => 'string',
				'default' => 'Radius Blocks Heading',
			),

			'descriptionText'   => array(
				'type'    => 'string',
				'default' => 'The Radius Blocks Library for WordPress Gutenberg Editor. Radius Blocks plugin is compatible with all the themes that can be edited with Gutenberg',
			),

			'displayDescription'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'subTitleBarLeft'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'subTitleBarRight'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'subHeadingPosition'   => array(
				'type'    => 'string',
				'default' => 'bottom',
			),

			'headingHeight'   => array(
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading {height:{{headingHeight}};}'
					]
				]
			),

			//style

			//separator style
			'seperatorStyle'   => array(
				'type'    => 'string',
				'default' => 'solid',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-ah-separator-line{border-style: {{seperatorStyle}} !important; }']
				],
			),
			'separatorColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-ah-separator-line{border-color: {{separatorColor}} !important; }']
				],
			),

			'separatorHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading:hover .rtrb-ah-separator-line{border-color: {{separatorHoverColor}} !important; }']
				],
			),
			'separatorWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => 100,
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-ah-separator-line{width:{{separatorWidth}};}'
					]
				]
			],
			'separatorHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => 2,
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-ah-separator-line{border-width:{{separatorHeight}};}'
					]
				]
			],
			"separatorMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-ah-separator-line{{separatorMargin}}'
					]
				]
			),


			//subheading
			'subHeadingTagName'   => array(
				'type'    => 'string',
				'default' => 'span',
			),
			'subheadingTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__sub-title']
				],
			],
			'subheadingColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'subheadingColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__sub-title{color: {{subheadingColor}} !important; }']
				],
			),

			'subheadingHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__sub-title:hover{color: {{subheadingHoverColor}} !important; }']
				],
			),
			'subheadingGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'subHeadingColorType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__sub-title{background: {{subheadingGradientColor}};
						-webkit-background-clip: text;
						-webkit-text-fill-color: transparent; }'
					]
				]
			),

			"subheadingMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-advanced-heading__sub-title-wrap{{subheadingMargin}}'
					]
				]
			),

			//heading
			'headingTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__title']
				],
			],

			'headingColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'headingColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__title{color: {{headingColor}} !important; }'
					]
				]
			),

			'headingHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__title:hover{color: {{headingHoverColor}} !important; }'
					]
				]
			),

			"headingMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-advanced-heading__title-wrap {{headingMargin}}'
					]
				]
			),

			//description
			'descriptionTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__desc']
				],
			],
			'descriptionColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'descriptionColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__desc{color: {{descriptionColor}} !important; }']
				],
			),

			'descriptionHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading__desc:hover{color: {{descriptionHoverColor}} !important; }']
				],
			),

			"descriptionMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-advanced-heading__desc-wrap {{descriptionMargin}}'
					]
				]
			),

			// bars
			'subTitleBarWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rt-sub-title-bar{width:{{subTitleBarWidth}};}'
					]
				]
			],
			'subTitleBarHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rt-sub-title-bar{height:{{subTitleBarHeight}};}'
					]
				]
			],
			'subTitleToBarGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rtrb-advanced-heading__sub-title{gap:{{subTitleToBarGap}};}'
					]
				]
			],
			"subTitleBarBG" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rt-sub-title-bar'
					]
				]
			),
			"subTitleBarRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading .rt-sub-title-bar{{subTitleBarRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-advanced-heading:hover']
				],
			],
		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_advanced_heading()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'advanced-heading',
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
			'template'              => 'blocks/advanced-heading/layout',
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_advanced_heading_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
