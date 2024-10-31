<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class PostCarousel
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_post_carousel']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/post-carousel') && !is_admin()) {
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
			'layoutType'   => array(
				'type'    => 'string',
				'default' => 'grid',
			),
			'layout'   => array(
				'type'    => 'string',
				'default' => '1',
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
					'lg' => 3,
					'md' => 2,
					'sm' => 1
				]
			],
			'arrowPositionStyle'   => array(
				'type'    => 'string',
				'default' => 'center',
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
				'default' => '',
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
				'default' => 42,
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
				'default' => 100,
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post {{columnPadding}}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post{border-style:{{columnBorderStyle}};}'
					]
				]
			),

			'columnHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post:hover{border-style:{{columnHoverBorderStyle}};}'
					]
				]
			),

			'columnBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post{border-color:{{columnBorderColor}};}'
					]
				]
			),
			'columnHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post:hover{border-color:{{columnHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post{{columnBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post:hover{{columnHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post{{columnRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post:hover{{columnHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post']
				],
			],

			'columnHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post:hover']
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

						'selector' => '{{RTRB}}.rtrb-block .rtrb-post'
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

						'selector' => '{{RTRB}}.rtrb-block .rtrb-post:hover'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post::before{opacity:{{columnItemBGOverlayOpacity}}}'
					],
				]
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-img{{thumbnailRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-img{{thumbnailMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-content{{contentBoxPadding}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-title']
				],
			],
			'titleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-title a{color: {{titleColor}}; }'
					]
				]
			),
			'titleHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-title a:hover{color: {{titleHoverColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-title{{titleMargin}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-excerpt']
				],
			],
			'excerptColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-excerpt {color: {{excerptColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-excerpt{{excerptMargin}}'
					]
				]
			),

			// cat meta style

			'catMetaBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'catBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'catHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'catShadowType'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'catBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'catBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'catBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta{background: {{catBGColor}}; }'
					]
				]
			),

			'catHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'catHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta:hover
						{background: {{catHoverBGColor}} ; }'
					]
				]
			),

			'catGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'catBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta
						{background: {{catGradientColor}}; }'
					]
				]
			),

			'catHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'catHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta:hover
						{background: {{catHoverGradientColor}};  }'
					]
				]
			),

			'catMetaShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta']
				],
			],

			'catMetaHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta:hover']
				],
			],

			'catBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta{border-style:{{catBorderStyle}};}'
					]
				]
			),

			'catHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta:hover{border-style:{{catHoverBorderStyle}};}'
					]
				]
			),
			'catBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta{border-color:{{catBorderColor}};}'
					]
				]
			),
			'catHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta:hover{border-color:{{catHoverBorderColor}};}'
					]
				]
			),
			"catBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta{{catBorderWidth}}'
					]
				]
			),


			"catHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta:hover{{catHoverBorderWidth}}'
					]
				]
			),

			"catRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta{{catRadius}}'
					]
				]
			),

			"catHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta:hover{{catHoverRadius}}'
					]
				]
			),

			'catMetaTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta']
				],
			],
			'catMetaAlign' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-cat-meta-list {justify-content: {{catMetaAlign}}; }',
					],
				],
			],
			'catMetaGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-cat-meta-list {column-gap: {{catMetaGap}}; }',
					],
				],
			],
			'catMetaToTextGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-meta-list .rtrb-meta{gap: {{catMetaToTextGap}}; }',
					],
				],
			],
			'catMetaRowGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-cat-meta-list {row-gap: {{catMetaRowGap}}; }',
					],
				],
			],
			"catMetaPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-cat-meta-list .rtrb-meta{{catMetaPadding}}'
					]
				]
			),
			"catMetaMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-cat-meta-list{{catMetaMargin}}'
					]
				]
			),
			"categoryColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta{color: {{categoryColor}}; }'
					]
				]
			),

			"categoryHoverColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post-cat-meta-list .rtrb-meta:hover{color: {{categoryHoverColor}}; }'
					]
				]
			),

			//meta style
			'headerMetaAlign' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-meta-list {justify-content: {{headerMetaAlign}}; }',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-meta-list {column-gap: {{headerMetaGap}}; }',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-meta-list {row-gap: {{headerMetaRowGap}}; }',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-post .rtrb-post-meta-list{{headerMetaMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn{color: {{arrowColor}}; }'
					]
				]
			),
			'arrowBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn{background-color: {{arrowBGColor}}; }'
					]
				]
			),
			'arrowHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn:hover {color: {{arrowHoverColor}}; }'
					]
				]
			),
			'arrowHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn:hover,
						{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn:hover::after {background-color: {{arrowHoverBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn {width: {{arrowSize}};height: {{arrowSize}}; }',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn-prev.rtrb-slider-btn{left:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'center'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn-next.rtrb-slider-btn{right:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'top-right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn{top:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'top-left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn{top:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'bottom-right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn{bottom:{{arrowPosition}};}',
					],
					(object) [
						'depends' => [
							(object)['key' => "arrowPositionStyle", 'condition' => '==', 'value' => 'bottom-left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-btn{bottom:{{arrowPosition}};}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-pagination .swiper-pagination-bullet-active{background-color:{{dotActiveColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-pagination .swiper-pagination-bullet{width:{{dotSize}};height:{{dotSize}};}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-pagination{gap:{{dotGap}};}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel .rtrb-slider-pagination{bottom:{{dotPosition}};}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-listing-post-carousel:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_post_carousel()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'post-carousel',
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
		$layoutType = isset($settings['layoutType']) ? $settings['layoutType'] : 'grid';
		$layout = isset($settings['layout']) ? $settings['layout'] : '1';

		$the_loops = PostGridAjax::rtrb_post_query($settings);

		$data = [
			'template'              => 'blocks/post-carousel/' . $layoutType . '/layout-' . $layout,
			'settings'              => $settings,
			'the_loops'				=> $the_loops,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_post_grid_block_data', $data);

		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
