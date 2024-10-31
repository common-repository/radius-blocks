<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class ImageAccordion
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_image_accordion']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/image-accordion') && !is_admin()) {
			wp_enqueue_style('fancybox-style');
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
						"title" => "Image Accordion Title 1",
						"content" => 'Eum Temporibus Corporis Amet Optio Quaerat QuiaNam Repellendus',
						"image" => [
							"url" => RTRB_URL . '/assets/img/blocks/placeholder.png',
							"id" => "",
						],
						"enableProject" => true,
						"projectLink" => '#',
						"projectIcon" => '',
						"enablePopup" => true,
						"popupIcon" => ''
					],
					[
						"title" => "Image Accordion Title 2",
						"content" => 'Eum Temporibus Corporis Amet Optio Quaerat QuiaNam Repellendus',
						"image" => [
							"url" => RTRB_URL . '/assets/img/blocks/placeholder.png',
							"id" => "",
						],
						"enableProject" => true,
						"projectLink" => '#',
						"projectIcon" => '',
						"enablePopup" => true,
						"popupIcon" => ''
					],

					[
						"title" => "Image Accordion Title 3",
						"content" => 'Eum Temporibus Corporis Amet Optio Quaerat QuiaNam Repellendus',
						"image" => [
							"url" => RTRB_URL . '/assets/img/blocks/placeholder.png',
							"id" => "",
						],
						"enableProject" => true,
						"projectLink" => '#',
						"projectIcon" => '',
						"enablePopup" => true,
						"popupIcon" => ''
					],
					[
						"title" => "Image Accordion Title 4",
						"content" => 'Eum Temporibus Corporis Amet Optio Quaerat QuiaNam Repellendus',
						"image" => [
							"url" => RTRB_URL . '/assets/img/blocks/placeholder.png',
							"id" => "",
						],
						"enableProject" => true,
						"projectLink" => '#',
						"projectIcon" => '',
						"enablePopup" => true,
						"popupIcon" => ''
					],
				],
			],
			'styleType' => [
				'type' => "object",
				'default' => [
					'lg' => 'vertical',
					'md' => 'vertical',
					'sm' => 'vertical'
				],
			],
			'activeItem' => [
				'type' => "boolean",
				'default' => false,
			],

			'itemNumber' => [
				'type' => "string",
				'default' => ''
			],

			'activeType' => [
				'type' => "string",
				'default' => "hover",
			],

			'selectedTab' => [
				'type' => "number",
				'default' => '',
			],

			//image item
			'itemGap'   => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper {gap: {{itemGap}}; }'
					]
				]
			),
			'overlayType' => [
				'type' => "string",
				'default' => 'classic',
			],

			'itemOverlayColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'overlayType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item::before{background: {{itemOverlayColor}}; }'
					]
				]
			),
			'itemOverlayGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'overlayType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item::before{background: {{itemOverlayGradientColor}};}'
					]
				]
			),
			'activeOverlayType' => [
				'type' => "string",
				'default' => 'classic',
			],

			'activeItemOverlayColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'overlayType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-hover .item:hover::before,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-hover .item.checkedItem::before,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-click .item.item-active::before,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-click .item.checkedItem::before
						{background: {{activeItemOverlayColor}}; }'
					]
				]
			),

			'activeItemOverlayGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'overlayType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-hover .item:hover::before,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-hover .item.checkedItem::before,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-click .item.item-active::before,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-click .item.checkedItem::before
						{background: {{activeItemOverlayGradientColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner{{contentPadding}}'
					]
				]
			),
			'itemBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item{border-style:{{itemBorderStyle}} ;}'
					]
				]
			),
			'itemBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item{border-color:{{itemBorderColor}};}'
					]
				]
			),
			"itemBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item{{itemBorderWidth}}'
					]
				]
			),
			"itemRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item{{itemRadius}}'
					]
				]
			),

			//title style
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .title,
					{{RTRB}}.rtrb-block .rtrb-image-accordion-style-3 .item .title-wrap .title,
					{{RTRB}}.rtrb-block .rtrb-image-accordion-style-3 .item .title-wrap .title svg,
					{{RTRB}}.rtrb-block .rtrb-image-accordion-style-3 .item .title-wrap .number']
				],
			],

			'titleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .title,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-style-3 .item .title-wrap .title,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-style-3 .item .title-wrap .title svg,
					{{RTRB}}.rtrb-block .rtrb-image-accordion-style-3 .item .title-wrap .number {color: {{titleColor}}; }'
					]
				]
			),

			'titleSpacing'   => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .title,
						{{RTRB}}.rtrb-block .rtrb-image-accordion-style-3 .item .title-wrap .title {margin-bottom: {{titleSpacing}}; }'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content p.desc']
				],
			],
			'contentColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content p.desc {color: {{contentColor}}; }'
					]
				]
			),
			'contentSpacing'   => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content p.desc {margin-bottom: {{contentSpacing}}; }'
					]
				]
			),

			//action button
			'actionBtnDimension'   => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li .link {width: {{actionBtnDimension}}; height:{{actionBtnDimension}}; }'
					]
				]
			),
			'actionBtnLeftSpacing'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list{gap: {{actionBtnLeftSpacing}}px; }'
					]
				]
			),
			'actionBtnBorderWidth'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li .link {border-width: {{actionBtnBorderWidth}}px; }'
					]
				]
			),

			"actionBtnMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list{{actionBtnMargin}}'
					]
				]
			),

			'actionBtnColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'popupIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li:first-child .link svg{color: {{popupIconColor}}; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li:first-child .link{border-color:{{popupIconColor}} }'
					]
				]
			),
			'linkIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li:last-child .link svg{color: {{linkIconColor}};border-color:{{linkIconColor}}}'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li:last-child .link{border-color:{{linkIconColor}} }'
					]
				]
			),
			'actionBtnBgColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li .link{background-color: {{actionBtnBgColor}}; }'
					]
				]
			),
			'popupIconHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li:first-child .link:hover svg{color: {{popupIconHoverColor}}; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li:first-child .link:hover{border-color:{{popupIconHoverColor}} }'
					]
				]
			),
			'linkIconHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li:last-child .link:hover svg{color: {{linkIconHoverColor}}; }'
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li:last-child .link:hover{border-color:{{linkIconHoverColor}} }'
					]
				]
			),
			'actionBtnBgHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-accordion-wrapper .item .content .inner .link-list li .link:hover{background: {{actionBtnBgHoverColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block {{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block {{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block '
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
						'selector' => '{{RTRB}}.rtrb-block:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block { 
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
						'selector' => '{{RTRB}}.rtrb-block::before'
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
						'selector' => '{{RTRB}}.rtrb-block::before{
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
						'selector' => '{{RTRB}}.rtrb-block {border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block {border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block {{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block {{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block ']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_image_accordion()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'image-accordion',
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
		if (!is_admin()) {
			wp_enqueue_script('fancybox-js');
		}

		$layout = ($settings['layout'] == '1' || $settings['layout'] == '2') ? '12' : $settings['layout'];
		$data = [
			'template'              => 'blocks/image-accordion/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_image_accordion_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
