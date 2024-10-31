<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class IconListBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
		add_action('init', [$this, 'register_iconList']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/icon-list') && !is_admin()) {
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

			//social icons
			'mediaType'   => array(
				'type'    => 'string',
				'default' => 'icon',
			),
			'imageId'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'imageUrl'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'listIcon'   => array(
				'type'    => 'string',
				'default' => 'arrow-circle-right',
			),

			'iconLists' => [
				'type' => "array",
				'default' => [
					[
						"label" => "List item 1",
						"overrideMedia" => false,
						"mediaType" => "icon",
						"image" => [
							"url" => "",
							"id" => "",
						],
						"icon" => "",
						"url" => "#",
						"openWindow" => false,
						"color" => "",
						"background" => "",
					],
					[
						"label" => "List item 2",
						"overrideMedia" => false,
						"mediaType" => "icon",
						"image" => [
							"url" => "",
							"id" => "",
						],
						"icon" => "",
						"url" => "#",
						"openWindow" => false,
						"color" => "",
						"background" => "",
					],
					[
						"label" => "List item 3",
						"overrideMedia" => false,
						"mediaType" => "icon",
						"image" => [
							"url" => "",
							"id" => "",
						],
						"icon" => "",
						"url" => "#",
						"openWindow" => false,
						"color" => "",
						"background" => "",
					],

				],
			],

			'listItemGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => 12,
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-layout {gap:{{listItemGap}}; }'
					]
				]
			],

			'layoutType' => array(
				'type'    => 'string',
			),

			'contentLayout' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-layout{flex-direction:{{contentLayout}}; }'
					]
				]
			),

			'contentAlignment' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-vertical .rtrb-icon-list-item,
						{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-horizontal 
						{justify-content:{{contentAlignment}}; }'
					]
				]
			),

			'iconAlignment' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item{align-items:{{iconAlignment}}; }'
					]
				]
			),

			'displayLabel' => [
				'type' => 'boolean',
				'default' => true
			],

			'listItemIconLabelGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => 12,
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item {gap:{{listItemIconLabelGap}}; }'
					]
				]
			],

			'iconPosition' => array(
				'type'    => 'string',
				'default' => 'before'
			),

			//list item style
			'listItemTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item']
				],
			],

			'listItemColorType' => [
				'type' => 'string',
				'default' => 'normal'
			],
			'listItemColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item {color: {{listItemColor}}; }'
					]
				]
			),
			'listItemHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item:hover {color: {{listItemHoverColor}} !important; }'
					]
				]
			),
			'listItemBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item {background-color: {{listItemBGColor}}; }'
					]
				]
			),
			'listItemHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item:hover {background-color: {{listItemHoverBGColor}} !important; }'
					]
				]
			),

			"listItemPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item {{listItemPadding}}'
					]
				]
			),

			'listItemBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'listItemBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item{border-style:{{listItemBorderStyle}};}'
					]
				]
			),

			'listItemHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item:hover{border-style:{{listItemHoverBorderStyle}};}'
					]
				]
			),

			'listItemBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item{border-color:{{listItemBorderColor}};}'
					]
				]
			),
			'listItemHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item:hover{border-color:{{listItemHoverBorderColor}};}'
					]
				]
			),

			"listItemBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item{{listItemBorderWidth}}'
					]
				]
			),

			"listItemHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item:hover{{listItemHoverBorderWidth}}'
					]
				]
			),

			"listItemRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item{{listItemRadius}}'
					]
				]
			),

			"listItemHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item:hover{{listItemHoverRadius}}'
					]
				]
			),

			//icons style
			'iconColorType' => [
				'type' => 'string',
				'default' => 'normal'
			],
			'iconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-media {color: {{iconColor}}; }'
					]
				]
			),
			'iconHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-media:hover {color: {{iconHoverColor}} !important; }'
					]
				]
			),
			'iconBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-media {background-color: {{iconBGColor}}; }'
					]
				]
			),
			'iconHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-media:hover {background-color: {{iconHoverBGColor}} !important; }'
					]
				]
			),

			'iconListSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-media.rtrb-icon {font-size:{{iconListSize}}; }',
					],
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-media img {width:{{iconListSize}}; }',
					]
				]
			],

			"iconDimention" => array(
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media{ width:{{iconDimention}};height:{{iconDimention}} }'
					]
				]
			),

			'iconBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'iconBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media{border-style:{{iconBorderStyle}};}'
					]
				]
			),

			'iconHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media:hover{border-style:{{iconHoverBorderStyle}};}'
					]
				]
			),

			'iconBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media{border-color:{{iconBorderColor}};}'
					]
				]
			),
			'iconHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media:hover{border-color:{{iconHoverBorderColor}};}'
					]
				]
			),

			"iconBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media{{iconBorderWidth}}'
					]
				]
			),

			"iconHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media:hover{{iconHoverBorderWidth}}'
					]
				]
			),

			"iconRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media{{iconRadius}}'
					]
				]
			),

			"iconHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list .rtrb-icon-list-item .rtrb-media:hover{{iconHoverRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-icon-list:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_iconList()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'icon-list',
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
			'template'              => 'blocks/icon-list/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];
		$data = apply_filters('rtrb_icon_list_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
