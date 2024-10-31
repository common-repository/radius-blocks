<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class PostTimeline
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_post_timeline']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/post-timeline') && !is_admin()) {
			wp_enqueue_style('rtrb-swiper-style');
			wp_enqueue_script('rtrb-swiper-script');
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
			'layoutType'   => array(
				'type'    => 'string',
				'default' => 'grid',
			),
			'layout'   => array(
				'type'    => 'string',
				'default' => '1',
			),

			//slider
			'sliderOptions' => array(
				"type" => "object",
				"default" => array(
					"autoHeight" => false,
					"loop" => true,
					"autoPlay" => false,
					"stopOnHover" => true,
					"autoPlayDelay" => 2000,
					"autoPlaySlideSpeed" => 2000,
					"spaceBetween" => 20,
					"arrowNavigation" => false,
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
					'lg' => 3,
					'md' => 1,
					'sm' => 1
				]
			],
			'arrowPositionStyle'   => array(
				'type'    => 'string',
				'default' => 'center',
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



			//query
			'postType'   => array(
				'type'    => 'string',
				'default' => 'post',
			),
			'postInclude'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'postExclude'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'postLimit'   => array(
				'type'    => 'number',
				'default' => 3,
			),
			'postOffset'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'postTaxonomies'   => array(
				'type'    => 'object',
				'default' => []
			),
			'postAuthors'   => array(
				'type'    => 'array',
			),
			'postKeyword'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'postTaxnomyRelation'   => array(
				'type'    => 'string',
				'default' => 'OR',
			),
			'postOrderBy'   => array(
				'type'    => 'string',
				'default' => 'date',
			),
			'postSortOrder'   => array(
				'type'    => 'string',
				'default' => 'asc',
			),
			'postStatus'   => array(
				'type'    => 'string',
				'default' => 'publish',
			),

			//pagination
			'postShowPagination'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'postDisplayPerPage'   => array(
				'type'    => 'number',
				'default' => 6,
			),

			'page'   => array(
				'type'    => 'number',
				'default' => 1,
			),

			//layout settings
			'layout4MinimumHeight' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper-style-4 .rtrb-post-timeline-list {min-height: {{layout4MinimumHeight}}; }',
					],
				],
			],

			'postColumnGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-timeline-list {gap: {{postColumnGap}}; }',
					],
				],
			],
			'postColumn'  => [
				'type'    => "object",
				'default' => (object) [
					'lg' => 3,
					'md' => 2,
					'sm' => 1,
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-grid {grid-template-columns: repeat({{postColumn}}, 1fr); }',
					],
				],
			],
			'columnEqualHeight'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'columnEqualHeightVal'   => array(
				'type'    => 'boolean',
				'default' => true,
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'columnEqualHeight', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-grid .rtrb-post-grid {height: 100%; }'
					]
				]
			),
			'thumbnailDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'thumbnailFixedHeight'   => array(
				'type'    => 'boolean',
				'default' => true,
			),

			'thumbnailHeight' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-img-wrap.fixed-height{height: {{thumbnailHeight}}; }',
					],
				],
			],

			"thumbnailSize" => array(
				"type" => "string",
				"default" => "medium_large",
			),

			"customThumbnailWidth" => array(
				"type" => "number",
				"default" => 400,
			),

			"customThumbnailHeight" => array(
				"type" => "number",
				"default" => 280,
			),
			'thumbnailWidth' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-img-wrap {width: {{thumbnailWidth}}; }',
					],
				],
			],

			'titleDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),

			'titleTag'   => array(
				'type'    => 'string',
				'default' => 'h3',
			),
			'titleLimitType'   => array(
				'type'    => 'string',
				'default' => 'character',
			),
			'titleWord'   => array(
				'type'    => 'number',
				'default' => 52,
			),
			'excerptType'   => array(
				'type'    => 'string',
				'default' => 'character',
			),
			'excerptDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),

			'excerptWord'   => array(
				'type'    => 'number',
				'default' => 85,
			),
			'excerptMoreText'   => array(
				'type'    => 'string',
				'default' => '...',
			),

			'readMoreDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'readMoreBTNText'   => array(
				'type'    => 'string',
				'default' => 'Read More',
			),
			'buttonIcon'   => array(
				'type'    => 'string',
				'default' => 'arrow-right',
			),
			'iconEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'buttonHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rt-btn-no-effect',
			),
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
			'categoryDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'categoryPosition'   => array(
				'type'    => 'string',
				'default' => 'rt-above-title',
			),
			'metaDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'metaIconDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'metaPosition'   => array(
				'type'    => 'string',
				'default' => 'above_excerpt',
			),
			'metaSep'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'metaList'   => array(
				'type'    => 'array',
				'default' => [
					// ['label' => 'Author Avatar', 'value' => 'avatar'],
					['label' => 'Author Name', 'value' => 'author'],
					['label' => 'Publish Date', 'value' => 'date'],
				]
			),

			//connector
			'connectorIcon' => array(
				'type'    => 'string',
				'default' => 'calendar-alt',
			),
			'connectorIconSize' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-date-wrap .rtrb-calender-icon{font-size: {{connectorIconSize}}; }',
					],
				],
			],
			'connectorIconBgSize' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-date-wrap .rtrb-calender-icon{width: {{connectorIconBgSize}};height:{{connectorIconBgSize}} }',
					],
				],
			],
			'connectorThickness' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '!=', 'value' => '4'],
							(object)['key' => 'layout', 'condition' => '!=', 'value' => '2'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-timeline-inner::before{width: {{connectorThickness}}; }',
					],
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => '2'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-timeline-inner::before{height: {{connectorThickness}}; }',
					],
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => '4'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-timeline-inner::before{
							height: {{connectorThickness}}; 
						}',
					],
				],
			],


			//column style
			"columnPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main{{columnPadding}}',
					]
				]
			),

			// Border Control
			'columnBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'columnBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main{border-style:{{columnBorderStyle}};}'
					]
				]
			),

			'columnHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main:hover{border-style:{{columnHoverBorderStyle}};}'
					]
				]
			),

			'columnBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main{border-color:{{columnBorderColor}};}'
					]
				]
			),
			'columnHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main:hover{border-color:{{columnHoverBorderColor}};}'
					]
				]
			),

			"columnBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main{{columnBorderWidth}}'
					]
				]
			),


			"columnHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main:hover{{columnHoverBorderWidth}}'
					]
				]
			),

			"columnRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main{{columnRadius}}'
					]
				]
			),

			"columnHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main:hover{{columnHoverRadius}}'
					]
				]
			),

			'columnShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			'columnShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main']
				],
			],

			'columnHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main:hover']
				],
			],

			'columnItemBgType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),

			// bg
			"columnItemBg" => array(
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

						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main'
					]
				]
			),

			"columnItemHoverBg" => array(
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

						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main:hover'
					],
				]
			),
			'columnItemBGOverlayEnable' => array(
				'type'    => 'boolean',
				'default' => false,
			),
			"columnItemBGOverlay" => array(
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
							(object)['key' => 'columnItemBGOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main::before'
					]
				]
			),

			'columnItemBGOverlayOpacity' => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'columnItemBGOverlayEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main::before{opacity:{{columnItemBGOverlayOpacity}}}'
					],
				]
			),

			//caret style
			'enableCaret' => array(
				'type' => 'boolean',
				'default' => false,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main::after {content:inherit; }'
					]
				]
			),

			'caretBGColor' => array(
				'type' => 'string',
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-main::after {background:{{caretBGColor}}; }'
					]
				]
			),

			'caretSize' => array(
				'type' => 'object',
				'default' => [
					'lg' => '',
				],
				'style' => []
			),

			//thumbnail style
			'imageHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rtrb-img-effect-none',
			),
			'overlayStyle' => [
				'type' => "string",
				'default' => ''
			],
			"thumbnailRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-card-img-wrap{{thumbnailRadius}}'
					]
				]
			),

			"thumbnailMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-card-img-wrapt .rtrb-post-img{{thumbnailMargin}}'
					]
				]
			),
			'imageOverlayBGEnable'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'imageOverlayNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'imageOverlayBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'imageOverlayHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'imageOverlayBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'imageOverlayBGType', 'condition' => '==', 'value' => 'classic'],
							(object)['key' => 'imageOverlayBGEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-wrap > a::after,{{RTRB}}.rtrb-block .rtrb-img-wrap > a::before{background: {{imageOverlayBGColor}}; }'
					]
				]
			),
			'imageOverlayGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'imageOverlayBGType', 'condition' => '==', 'value' => 'gradient'],
							(object)['key' => 'imageOverlayBGEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-wrap > a::after,{{RTRB}}.rtrb-block .rtrb-img-wrap > a::before{background: {{imageOverlayGradientColor}}; }'
					]
				]
			),

			'imageOverlayHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'imageOverlayHoverBGType', 'condition' => '==', 'value' => 'classic'],
							(object)['key' => 'imageOverlayBGEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-wrap > a::before{background: {{imageOverlayHoverBGColor}}; }'
					]
				]
			),
			'imageOverlayHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'imageOverlayHoverBGType', 'condition' => '==', 'value' => 'gradient'],
							(object)['key' => 'imageOverlayBGEnable', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-img-wrap > a::before{background: {{imageOverlayHoverGradientColor}}; }'
					]
				]
			),


			// content box style
			"contentBoxPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-card-content-wrap{{contentBoxPadding}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-card-title-wrap .rtrb-card-title a']
				],
			],
			'titleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-card-title-wrap .rtrb-card-title a{color: {{titleColor}}; }'
					]
				]
			),
			'titleHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-card-title-wrap .rtrb-card-title a:hover{color: {{titleHoverColor}}; }'
					]
				]
			),
			"titleMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-card-title-wrap .rtrb-card-title a{{titleMargin}}'
					]
				]
			),

			//excerpt style
			'excerptTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-card-description-wrap p']
				],
			],
			'excerptColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-card-description-wrap p {color: {{excerptColor}}; }'
					]
				]
			),
			"excerptMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-card-description-wrap p{{excerptMargin}}'
					]
				]
			),

			//meta style
			'catMetaToTextGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-meta{gap: {{catMetaToTextGap}}; }',
					],
				],
			],
			'headerMetaAlign' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list {justify-content: {{headerMetaAlign}}; }',
					],
				],
			],
			'headerMetaGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list {column-gap: {{headerMetaGap}}; }',
					],
				],
			],
			'headerMetaRowGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list {row-gap: {{headerMetaRowGap}}; }',
					],
				],
			],
			"headerMetaMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list{{headerMetaMargin}}'
					]
				]
			),

			"metaColorNormalHover" => array(
				"type"    => "string",
				"default" => 'normal'
			),

			'metaColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-meta{color: {{metaColor}}; }'
					]
				]
			),
			'metaIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-meta .meta-icon{color: {{metaIconColor}}; }'
					]
				]
			),
			'metaSepColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list li:after{color: {{metaSepColor}}; }'
					]
				]
			),
			"authorColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-author .rtrb-meta a{color: {{authorColor}}; }'
					]
				]
			),

			"tagColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-tag-items a.rtrb-meta{color: {{tagColor}}; }'
					]
				]
			),

			"authorHoverColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-author .rtrb-meta a:hover{color: {{authorHoverColor}}; }'
					]
				]
			),

			"tagHoverColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-tag-items a.rtrb-meta:hover{color: {{tagHoverColor}}; }'
					]
				]
			),

			'metaTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-meta']
				],
			],

			"avatarRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-meta-list .rtrb-avatar img{{avatarRadius}}'
					]
				]
			),



			// button
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
						{{RTRB}}.rtrb-block .rtrb-button-wrapper .rtrb-button .rt-aware,
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
						{background: {{buttonBGColor}}; }'
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
						{background: {{buttonGradientColor}}; }'
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
						{background: {{buttonHoverGradientColor}};  }'
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

			//connector style
			'connectorIconBgType' => array(
				"type"    => "string",
				"default" => 'classic',
			),

			"connectorColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post-timeline-inner::before{background: {{connectorColor}};}']
				],
			),

			"connectorIconColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-date-wrap .rtrb-calender-icon{color: {{connectorIconColor}};}']
				],
			),

			"connectorIconBgColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-date-wrap .rtrb-calender-icon{background: {{connectorIconBgColor}} !important;}']
				],
			),

			"connectorIconBgGradient" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-date-wrap .rtrb-calender-icon{background: {{connectorIconBgGradient}} !important;}']
				],
			),
			"dateColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-date-wrap .rtrb-date-text{color: {{dateColor}};}']
				],
			),

			"dateBgColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-timeline-card-date-wrap .rtrb-date-text{background: {{dateBgColor}};}']
				],
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper{ 
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper::before'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper::before{
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-post-timeline-wrapper:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_post_timeline()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'post-timeline',
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

		$the_loops = PostGridAjax::rtrb_post_query($settings);

		$data = [
			'template'              => 'blocks/post-timeline/layout-' . $layout,
			'settings'              => $settings,
			'the_loops'				=> $the_loops,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_post_timeline_block_data', $data);

		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
