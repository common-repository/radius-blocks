<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class FlipboxBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_flipbox']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/flipbox') && !is_admin()) {
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

			'flipBehavior' => array(
				'type'    => 'string',
				'default' => 'hover',
			),
			'fbSelectedSide' => array(
				'type'    => 'string',
				'default' => 'front',
			),
			'fbIsHover' => [
				'type'    => 'boolean',
				'default' => false,
			],
			'flipboxDirection'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'flipTransitionDuration'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block > .rtrb-fliper:is(.rt-flip-zoom-in, .rt-flip-zoom-out, .rt-flip-fade-in, .rt-3d-flip) > .rtrb-fliper-wrapper .rtrb-flip-front,
						{{RTRB}}.rtrb-block > .rtrb-fliper:is(.rt-flip-zoom-in, .rt-flip-zoom-out, .rt-flip-fade-in, .rt-3d-flip) > .rtrb-fliper-wrapper .rtrb-flip-back,
						{{RTRB}}.rtrb-block > .rtrb-fliper:is(.rt-3d-flip):hover > .rtrb-fliper-wrapper .rtrb-flip-front,
						{{RTRB}}.rtrb-block > .rtrb-fliper:is(.rt-3d-flip):hover > .rtrb-fliper-wrapper .rtrb-flip-back,
						{{RTRB}}.rtrb-block > .rtrb-fliper:not(.rt-flip-zoom-in):not(.rt-flip-zoom-out):not(.rt-flip-fade-in):not(.rt-3d-flip) > .rtrb-fliper-wrapper
						{transition-duration:{{flipTransitionDuration}}ms;}'
					]
				]
			),

			//settings
			'flipBoxWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fliper{max-width:{{flipBoxWidth}}; }'
					]
				]
			],

			'flipBoxHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-fliper{height:{{flipBoxHeight}}; }'
					]
				]
			],
			'mediaToContentSpacing' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flipbox{gap:{{mediaToContentSpacing}}; }'
					]
				]
			],
			'flipboxFrontMedia'   => array(
				'type'    => 'string',
				'default' => 'icon',
			),

			'fbFrontIcon'   => array(
				'type'    => 'string',
				'default' => 'box',
			),
			'fbFrontIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon {font-size:{{fbFrontIconSize}}; }'
					]
				]
			],
			'fbFrontImageUrl'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'fbFrontImageId'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'fbFrontImageId'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'fbFrontImageWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front img{width:{{fbFrontImageWidth}}; }'
					]
				]
			],
			'fbFrontImageAutoHeight'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'fbFrontImageHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front img{height:{{fbFrontImageHeight}}; }'
					]
				]
			],


			'flipboxBackMedia'   => array(
				'type'    => 'string',
				'default' => 'icon',
			),
			'fbBackIcon'   => array(
				'type'    => 'string',
				'default' => 'box',
			),
			'fbBackIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon{font-size:{{fbBackIconSize}}; }'
					]
				]
			],
			'fbBackImageUrl'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'fbBackImageId'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'fbBackImageId'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'fbBackImageWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back img{width:{{fbBackIconSize}}; }'
					]
				]
			],
			'fbBackImageAutoHeight'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'fbBackImageHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back img {height:{{fbBackIconSize}}; }'
					]
				]
			],

			//front side content
			'fbFrontTitleDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'fbFrontTitleText'   => array(
				'type'    => 'string',
				'default' => "Radius Blocks Front Title",
			),
			'fbFrontDescDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'fbFrontDescText'   => array(
				'type'    => 'string',
				'default' => "Radius Blocks Front Content",
			),
			'fbFrontContentAlignment'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox {text-align:{{fbFrontContentAlignment}};}'
					]
				]
			),
			'fbFrontVerticalAlignment'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox {justify-content:{{fbFrontVerticalAlignment}};}'
					]
				]
			),

			//back side content
			'fbBackTitleDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'fbBackTitleText'   => array(
				'type'    => 'string',
				'default' => "Radius Blocks Back Title",
			),
			'fbBackDescDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'fbBackDescText'   => array(
				'type'    => 'string',
				'default' => "Radius Blocks Back Content",
			),
			'fbBackContentAlignment'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox{text-align:{{fbBackContentAlignment}};}'
					]
				]
			),
			'fbBackVerticalAlignment'   => array(
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox {justify-content:{{fbBackVerticalAlignment}};}'
					]
				]
			),

			//front side flipbox style
			"fbFrontItemPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front{{fbFrontItemPadding}}'
					]
				]
			),
			'fbFrontTitleColor'   => array(
				'type'    => 'string',
				'default' => '#ffffff',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-title{color:{{fbFrontTitleColor}};}'
					]
				]
			),

			"fbFrontTitleMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-title{{fbFrontTitleMargin}}'
					]
				]
			),

			'fbFrontDescColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-short-desc{color:{{fbFrontDescColor}};}'
					]
				]
			),

			"fbFrontDescMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-short-desc{{fbFrontDescMargin}}'
					]
				]
			),
			'fbFrontBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front{border-style:{{fbFrontBorderStyle}};}'
					]
				]
			),

			'fbFrontBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front{border-color:{{fbFrontBorderColor}};}'
					]
				]
			),

			"fbFrontBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front{{fbFrontBorderWidth}}'
					]
				]
			),

			"fbFrontRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front{{fbFrontRadius}}'
					]
				]
			),
			'fbFrontShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front']
				],
			],

			//Back side flipbox style
			"fbBackItemPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back{{fbBackItemPadding}}'
					]
				]
			),

			'fbBackTitleColor'   => array(
				'type'    => 'string',
				'default' => '#ffffff',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-title{color:{{fbBackTitleColor}};}'
					]
				]
			),

			"fbBackTitleMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-title{{fbBackTitleMargin}}'
					]
				]
			),

			'fbBackDescColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-short-desc{color:{{fbBackDescColor}};}'
					]
				]
			),

			"fbBackDescMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-short-desc{{fbBackDescMargin}}'
					]
				]
			),


			'fbBackBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back{border-style:{{fbBackBorderStyle}};}'
					]
				]
			),

			'fbBackBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back{border-color:{{fbBackBorderColor}};}'
					]
				]
			),

			"fbBackBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back{{fbBackBorderWidth}}'
					]
				]
			),

			"fbBackRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back{{fbBackRadius}}'
					]
				]
			),
			'fbBackShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back']
				],
			],

			//bg
			"fbFrontBG" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front'
					]
				]
			),

			'fbFrontOverlayEnable' => array(
				'type'    => 'boolean',
				'default' => false,
			),


			"fbFrontOverlay" => array(
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
							(object)['key' => 'fbFrontOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front::before'
					]
				]
			),

			'fbFrontBGOverlayOpacity' => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'fbFrontOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front::before{
								opacity:{{fbFrontBGOverlayOpacity}}
							}'
					],
				]
			),

			"fbBackBG" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back'
					]
				]
			),

			'fbBackOverlayEnable' => array(
				'type'    => 'boolean',
				'default' => false,
			),


			"fbBackOverlay" => array(
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
							(object)['key' => 'fbBackOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back::before'
					]
				]
			),

			'fbBackBGOverlayOpacity' => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'fbBackOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back::before{
								opacity:{{fbBackBGOverlayOpacity}}
							}'
					],
				]
			),

			//front media style
			//icon
			'fbFrontIconColor' => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon {color:{{fbFrontIconColor}};}'
					]
				]
			),
			'fbFrontIconBGColor' => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon {background:{{fbFrontIconBGColor}};}'
					]
				]
			),
			"fbFrontIconMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon {{fbFrontIconMargin}}'
					]
				]
			),
			"fbFrontIconPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon{{fbFrontIconPadding}}'
					]
				]
			),

			'fbFrontIconBorderType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'fbFrontIconBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon{border-style:{{fbFrontIconBorderStyle}};}'
					]
				]
			),

			'fbFrontIconBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon{border-color:{{fbFrontIconBorderColor}};}'
					]
				]
			),

			"fbFrontIconBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon{{fbFrontIconBorderWidth}}'
					]
				]
			),

			"fbFrontIconRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon{{fbFrontIconRadius}}'
					]
				]
			),

			'fbFrontIconHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon:hover{border-style:{{fbFrontIconHoverBorderStyle}};}'
					]
				]
			),

			'fbFrontIconHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon:hover{border-color:{{fbFrontIconHoverBorderColor}};}'
					]
				]
			),

			"fbFrontIconHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon:hover{{fbFrontIconHoverBorderWidth}}'
					]
				]
			),

			"fbFrontIconHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-icon:hover{{fbFrontIconHoverRadius}}'
					]
				]
			),
			//image
			"fbFrontImagePadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-front .rtrb-flipbox-media-image{{fbFrontImagePadding}}'
					]
				]
			),

			//back media style
			//icon
			'fbBackIconColor' => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon {color:{{fbBackIconColor}};}'
					]
				]
			),
			'fbBackIconBGColor' => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon {background:{{fbBackIconBGColor}};}'
					]
				]
			),
			"fbBackIconMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon{{fbBackIconMargin}}'
					]
				]
			),
			"fbBackIconPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon{{fbBackIconPadding}}'
					]
				]
			),

			'fbBackIconBorderType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'fbBackIconBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon{border-style:{{fbBackIconBorderStyle}};}'
					]
				]
			),

			'fbBackIconBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon{border-color:{{fbBackIconBorderColor}};}'
					]
				]
			),

			"fbBackIconBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon{{fbBackIconBorderWidth}}'
					]
				]
			),

			"fbBackIconRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon{{fbBackIconRadius}}'
					]
				]
			),

			'fbBackIconHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon:hover{border-style:{{fbBackIconHoverBorderStyle}};}'
					]
				]
			),

			'fbBackIconHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon:hover{border-color:{{fbBackIconHoverBorderColor}};}'
					]
				]
			),

			"fbBackIconHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon:hover{{fbBackIconHoverBorderWidth}}'
					]
				]
			),

			"fbBackIconHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-icon:hover{{fbBackIconHoverRadius}}'
					]
				]
			),


			//image
			"fbBackImagePadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-flip-back .rtrb-flipbox-media-image{{fbBackImagePadding}}'
					]
				]
			),


			//typography
			'flipboxTitleTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-flipbox .rtrb-flipbox-title']
				],
			],
			'flipboxDescTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-flipbox .rtrb-flipbox-short-desc']
				],
			],


			//link settings
			'fbBackLinkType'   => array(
				'type'    => 'string',
				'default' => '',
			),
			//box
			'fbBackLink'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'fbBackLinkOpenWindow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'fbBackLinkNofollow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			//button
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
				'default' => 'Radius Button',
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
				'default' => '',
			),
			'buttonAlignment'   => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper {text-align: {{buttonAlignment}}; }'
					]
				]
			),
			'buttonWidthType'   => array(
				'type'    => 'string',
				'default' => 'auto',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonWidthType', 'condition' => '==', 'value' => 'full'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{display: flex; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button {width:{{buttonFixedWidth}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button {flex-direction:row-reverse; }'
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

			'buttonTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{color: {{buttonTextColor}} !important; }'
					]
				]
			),

			'buttonHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:hover{color: {{buttonHoverTextColor}} !important; }'
					]
				]
			),

			'buttonIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button .rt-btn-icon{color: {{buttonIconColor}} !important; }'
					]
				]
			),

			'buttonHoverIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:hover .rt-btn-icon{color: {{buttonHoverIconColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{{buttonPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper{{buttonMargin}}'
					]
				]
			),



			'buttonBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{border-style:{{buttonBorderStyle}};}'
					]
				]
			),

			'buttonHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:hover{border-style:{{buttonHoverBorderStyle}};}'
					]
				]
			),

			'buttonBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{border-color:{{buttonBorderColor}};}'
					]
				]
			),
			'buttonHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:hover{border-color:{{buttonHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{{buttonBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:hover{{buttonHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button{{buttonRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:hover{{buttonHoverRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:before{transition-duration:{{buttonTransitionDuration}}ms;}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-shutter-in-vertical:before
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-shutter-in-vertical
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-rectangle-in:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-shutter-in-horizontal:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-shutter-in-vertical:before 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:before,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-position-aware-btn .rt-aware,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-rectangle-in,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-shutter-in-horizontal,
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button.rt-shutter-in-vertical 
						{background: {{buttonHoverGradientColor}} ;  }'
					]
				]
			),

			'buttonShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button']
				],
			],

			'buttonHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button:hover']
				],
			],


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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper {{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper {{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper{ 
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper::before'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper::before{
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-flipbox-wrapper:hover']
				],
			],
		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_flipbox()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'flipbox',
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
		$button_icon = $fbFrontIcon = $fbBackIcon = '';
		if (!empty($settings['buttonIcon'])) :
			$button_icon = Fns::render_svg_html($settings['buttonIcon']);
		endif;

		if (!empty($settings['fbFrontIcon'])) :
			$fbFrontIcon = Fns::render_svg_html($settings['fbFrontIcon']);
		endif;
		if (!empty($settings['fbBackIcon'])) :
			$fbBackIcon = Fns::render_svg_html($settings['fbBackIcon']);
		endif;


		$layout = '1';
		$data = [
			'template'              => 'blocks/flipbox/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];
		$data['button_icon'] =  $button_icon;
		$data['fbFrontIcon'] =  $fbFrontIcon;
		$data['fbBackIcon'] =  $fbBackIcon;


		$data = apply_filters('rtrb_call_to_action_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
