<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class TestimonialSlider
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
		add_action('init', [$this, 'register_testimonial']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/testimonial-slider') && !is_admin()) {
			wp_enqueue_style('rtrb-swiper-style');
			wp_enqueue_script('rtrb-swiper-script');
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
				'default' => '2',
			),
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
					'lg' => 1,
					'md' => 1,
					'sm' => 1
				]
			],

			'testimonials' => [
				'type'    => "array",
				'default' => [
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/testimonial/default-testimonial.jpg',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"name" => "Leslie Alexander",
						"designation" => "Senior Artist",
						"message" => "“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae tellus tincidunt, venenatis turpis sit amet, auctor nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.”"
					],
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/testimonial/default-testimonial.jpg',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"name" => "Leslie Alexander",
						"designation" => "Senior Artist",
						"message" => "“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae tellus tincidunt, venenatis turpis sit amet, auctor nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.”"
					],
					[
						"imageUrl"   => RTRB_URL . '/assets/img/blocks/testimonial/default-testimonial.jpg',
						"imageId"    => "",
						"link"  => false,
						"url" => "#",
						"openWindow" => false,
						"name" => "Leslie Alexander",
						"designation" => "Senior Artist",
						"message" => "“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae tellus tincidunt, venenatis turpis sit amet, auctor nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.”"
					]

				],
			],

			//image
			'imageDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),

			'imageWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img {width:{{imageWidth}};}'
					]
				]
			],

			'imageAutoHeight' => [
				'type' => 'boolean',
				'default' => true
			],

			'imageHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'imageAutoHeight', 'condition' => '!=', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img {height:{{imageHeight}};}'
					]
				]
			],

			//content
			'nameDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'designationDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'messageDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'contentAlignment' => array(
				'type' => 'string',
				'default' => 'center',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial {text-align: {{contentAlignment}}; }'
					]
				]
			),
			'nameTagName'   => array(
				'type'    => 'string',
				'default' => 'h3',
			),

			//quote icon
			'quoteDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'quoteSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-quote-icon {font-size:{{quoteSize}};}'
					]
				]
			],

			//image style
			"imageMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img{{imageMargin}}'
					]
				]
			),

			"imagePadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img{{imagePadding}}'
					]
				]
			),

			'imageBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'imageBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img{border-style:{{imageBorderStyle}};}'
					]
				]
			),

			'imageHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img:hover{border-style:{{imageHoverBorderStyle}};}'
					]
				]
			),

			'imageBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img{border-color:{{imageBorderColor}};}'
					]
				]
			),
			'imageHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img:hover{border-color:{{imageHoverBorderColor}};}'
					]
				]
			),

			"imageBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img{{imageBorderWidth}}'
					]
				]
			),

			"imageHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img:hover{{imageHoverBorderWidth}}'
					]
				]
			),

			"imageRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img{{imageRadius}}'
					]
				]
			),

			"imageHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img img:hover{{imageHoverRadius}}'
					]
				]
			),


			'imageAfterBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img::after{border-style:{{imageAfterBorderStyle}};}'
					]
				]
			),

			'imageAfterBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img::after{border-color:{{imageAfterBorderColor}};}'
					]
				]
			),

			"imageAfterBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img::after{{imageAfterBorderWidth}}'
					]
				]
			),

			"imageAfterRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-img::after{{imageAfterRadius}}'
					]
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-name']
				],
			],
			'nameColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-name{color: {{nameColor}}; }'
					]
				]
			),
			"namePadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-name{{namePadding}}'
					]
				]
			),

			//designation style
			'designationTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-designation']
				],
			],
			'designationColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-designation {color: {{designationColor}}; }'
					]
				]
			),
			"designationPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__author-designation{{designationPadding}}'
					]
				]
			),

			//message style
			'messageTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__description p']
				],
			],
			'messageColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__description p {color: {{messageColor}}; }'
					]
				]
			),
			'messageSepColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__description p:after {background-color: {{messageSepColor}}; }'
					]
				]
			),
			"messagePadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial__description p{{messagePadding}}'
					]
				]
			),

			//quote style
			'quoteColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-quote-icon{color: {{quoteColor}}; }'
					]
				]
			),
			'quoteBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rt-quote-icon{background-color: {{quoteBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{color: {{arrowColor}}; }'
					]
				]
			),
			'arrowBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{background-color: {{arrowBGColor}}; }'
					]
				]
			),
			'arrowHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn:hover {color: {{arrowHoverColor}}; }'
					]
				]
			),
			'arrowHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn:hover,
						{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn:hover::after {background-color: {{arrowHoverBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn {width: {{arrowSize}};height: {{arrowSize}}; }',
					],
				],
			],

			'arrowPositionStyle'   => array(
				'type'    => 'string',
				'default' => 'center',
			),

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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn-prev.rtrb-slider-btn{left:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'center'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn-next.rtrb-slider-btn{right:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'top-right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{top:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'top-left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{top:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'bottom-right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{bottom:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'bottom-left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-btn{bottom:{{arrowPosition}};}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-pagination .swiper-pagination-bullet-active{background-color:{{dotActiveColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-pagination .swiper-pagination-bullet{width:{{dotSize}};height:{{dotSize}};}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-pagination{gap:{{dotGap}};}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-swiper-container .rtrb-slider-pagination{bottom:{{dotPosition}};}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-testimonial:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_testimonial()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'testimonial-slider',
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
		$quote_icon = '';
		$quote_icon = Fns::render_svg_html('quote-right');

		$layout = isset($settings['layout']) ? $settings['layout'] : '1';
		$data = [
			'template'              => 'blocks/testimonial-slider/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data['quote_icon'] = $quote_icon;

		$data = apply_filters('rtrb_testimonial_slider_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
