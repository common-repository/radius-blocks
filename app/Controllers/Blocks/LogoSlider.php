<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class LogoSlider
{

	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_logo_grid']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/logo-slider') && !is_admin()) {
			wp_enqueue_style('rtrb-swiper-style');
			wp_enqueue_script('rtrb-swiper-script');
			wp_enqueue_style('rtrb-blocks-frontend-style');
			wp_enqueue_script('rtrb-frontend-blocks-js');
		}
	}


	public function get_attributes()
	{
		$attributes = [
			'blockId' => [
				'type'    => 'string',
				'default' => '',
			],
			'preview' => [
				'type'    => 'boolean',
				'default' => false,
			],
			'layout'  => [
				'type'    => 'string',
				'default' => '1',
			],

			'sliderOptions' => array(
				"type" => "object",
				"default" => array(
					"autoHeight" => false,
					"loop" => true,
					"autoPlay" => true,
					"stopOnHover" => true,
					"autoPlayDelay" => 2000,
					"autoPlaySlideSpeed" => 2000,
					"spaceBetween" => 20,
					"arrowNavigation" => true,
					"arrowPosition" => "center",
					"arrowStyle" => "1",
					"dotNavigation" => true,
					"dotStyle" => "1",
					"sliderLoader" => true
				),
			),

			'slidesItem'  => [
				'type'    => "object",
				'default' =>  [
					'lg' => 4,
					'md' => 4,
					'sm' => 2
				]
			],

			'arrowPositionStyle'   => array(
				'type'    => 'string',
				'default' => 'center',
			),

			'logoGrid' => [
				'type'    => "array",
				'default' => [
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/logo/radius-theme-logo.png',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"brandName" => "Logo Item # 1",
					],
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/logo/radius-theme-logo.png',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"brandName" => "Logo Item # 2",
					],
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/logo/radius-theme-logo.png',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"brandName" => "Logo Item # 3",
					],
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/logo/radius-theme-logo.png',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"brandName" => "Logo Item # 4",
					],
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/logo/radius-theme-logo.png',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"brandName" => "Logo Item # 5",
					],
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/logo/radius-theme-logo.png',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"brandName" => "Logo Item # 6",
					],

				],
			],

			'logoItemGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider {gap: {{logoItemGap}}; }',
					],
				],
			],
			'logoColumn'  => [
				'type'    => "object",
				'default' => (object) [
					'lg' => 4,
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider {grid-template-columns: repeat({{logoColumn}}, 1fr); }',
					],
				],
			],

			'logoNameDisplay'  => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'logoWidth' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo .rtrb-img-wrap img {width: {{logoWidth}}; }',
					],
				],
			],

			'logoAutoHeight'  => array(
				'type'    => 'boolean',
				'default' => true,
			),

			'logoHeight' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'logoAutoHeight', 'condition' => '==', 'value' => false],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo .rtrb-img-wrap img {height: {{logoHeight}}; }',
					],
				],
			],

			//grid style
			"gridPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo {{gridPadding}}',
					]
				]
			),
			"gridMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo {{gridMargin}}',
					]
				]
			),

			'gridHeight' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo {height: {{gridHeight}};}',
					],
				],
			],

			// Border Control
			'gridBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'gridBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo{border-style:{{gridBorderStyle}};}'
					]
				]
			),

			'gridHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo:hover{border-style:{{gridHoverBorderStyle}};}'
					]
				]
			),

			'gridBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo{border-color:{{gridBorderColor}};}'
					]
				]
			),
			'gridHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo:hover{border-color:{{gridHoverBorderColor}};}'
					]
				]
			),

			"gridBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo{{gridBorderWidth}}'
					]
				]
			),


			"gridHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo:hover{{gridHoverBorderWidth}}'
					]
				]
			),

			"gridRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo{{gridRadius}}'
					]
				]
			),

			"gridHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo:hover{{gridHoverRadius}}'
					]
				]
			),

			'gridShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'gridShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-logo']
				],
			],

			'gridHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-logo:hover']
				],
			],

			'gridFilterType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'gridFilter' => [
				'type' => 'object',
				'default' => (object)['openFilter' => 1, 'filter' => (object)['brightness' => 100, 'contrast' => 100, 'saturate' => 100, 'blur' => 0, 'hue-rotate' => 0], 'opacity' => ''],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-logo .rtrb-img-wrap img']
				],
			],

			'gridHoverFilter' => [
				'type' => 'object',
				'default' => (object)['openFilter' => 1, 'filter' => (object)['brightness' => 100, 'contrast' => 100, 'saturate' => 100, 'blur' => 0, 'hue-rotate' => 0], 'opacity' => '', 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-logo:hover .rtrb-img-wrap img']
				],
			],

			'gridItemBgType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			// bg

			"gridItemBg" => array(
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

						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo'
					]
				]
			),

			"gridItemHoverBg" => array(
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

						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo:hover'
					],
				]
			),
			'gridItemBGOverlayEnable' => array(
				'type'    => 'boolean',
				'default' => false,
			),
			"gridItemBGOverlay" => array(
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
							(object)['key' => 'gridItemBGOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo::before'
					]
				]
			),

			'gridItemBGOverlayOpacity' => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'gridItemBGOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo::before{opacity:{{gridItemBGOverlayOpacity}}}'
					],
				]
			),


			//name style
			'nameTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-logo .rtrb-logo-brand-name']
				],
			],
			'nameColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo .rtrb-logo-brand-name {color: {{nameColor}}; }'
					]
				]
			),
			'nameHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo:hover .rtrb-logo-brand-name {color: {{nameHoverColor}}; }'
					]
				]
			),
			"nameMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo .rtrb-logo-brand-name{{nameMargin}}'
					]
				]
			),

			//arrow Style
			'arrowColorType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'arrowColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn{color: {{arrowColor}}; }'
					]
				]
			),
			'arrowBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn{background-color: {{arrowBGColor}}; }'
					]
				]
			),
			'arrowHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn:hover {color: {{arrowHoverColor}}; }'
					]
				]
			),
			'arrowHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn:hover,
						{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn:hover::after {background-color: {{arrowHoverBGColor}}; }'
					]
				]
			),

			'arrowLeftIcon'   => array(
				'type'    => 'string',
				'default' => 'angle-left',
			),

			'arrowRightIcon'   => array(
				'type'    => 'string',
				'default' => 'angle-right',
			),

			'arrowIconSize' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn {font-size: {{arrowIconSize}};}',
					],
				],
			],

			'arrowSize' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn {width: {{arrowSize}};height: {{arrowSize}}; }',
					],
				],
			],

			'arrowPosition' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => -60,
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'center'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn-prev.rtrb-slider-btn{left:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'center'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn-next.rtrb-slider-btn{right:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'top-right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn{top:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'top-left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn{top:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'bottom-right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn{bottom:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'bottom-left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-btn{bottom:{{arrowPosition}};}',
					],
				],
			],

			'arrowBorderType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'arrowBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{border-style:{{arrowBorderStyle}};}'
					]
				]
			),

			'arrowHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn:hover{border-style:{{arrowHoverBorderStyle}};}'
					]
				]
			),

			'arrowBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{border-color:{{arrowBorderColor}};}'
					]
				]
			),
			'arrowHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn:hover{border-color:{{arrowHoverBorderColor}};}'
					]
				]
			),
			"arrowBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{{arrowBorderWidth}}'
					]
				]
			),
			"arrowHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn:hover{{arrowHoverBorderWidth}}'
					]
				]
			),

			"arrowRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{{arrowRadius}}'
					]
				]
			),

			"arrowHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn:hover,
						{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn:hover::after{{arrowHoverRadius}}'
					]
				]
			),

			//dot style
			'dotColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-pagination .swiper-pagination-bullet,
						{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-pagination .swiper-pagination-bullet-active::after{background-color:{{dotColor}};}'
					]
				]
			),

			'dotActiveColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-pagination .swiper-pagination-bullet-active{background-color:{{dotActiveColor}};}'
					]
				]
			),

			'dotBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-pagination .swiper-pagination-bullet{border-color:{{dotBorderColor}};}'
					]
				]
			),

			'dotSize' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-pagination .swiper-pagination-bullet{width:{{dotSize}};height:{{dotSize}};}',
					],
				],
			],

			'dotGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-pagination{gap:{{dotGap}};}',
					],
				],
			],

			'dotPosition' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider .rtrb-slider-pagination{bottom:{{dotPosition}};}',
					],
				],
			],
			//slider loader 
			'sliderLoaderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-swiper-main-wrapper .rtrb-swiper-lazy-preloader .spinner .path{stroke:{{sliderLoaderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-logo-slider:hover']
				],
			],


		];

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_logo_grid()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'logo-slider',
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
		$layout = '1';
		$data = [
			'template'              => 'blocks/logo-slider/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_logo_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
