<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Controllers\Api\GetProductsV1;

use RadiusTheme\RB\Helpers\Fns;

class WooProductList
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_product_list']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/woo-product-list') && !is_admin()) {
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
				'default' => 'list',
			),
			'layout'   => array(
				'type'    => 'string',
				'default' => '1',
			),

			//query
			'postType'   => array(
				'type'    => 'string',
				'default' => 'product',
			),
			'include'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'exclude'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'limit'   => array(
				'type'    => 'number',
				'default' => '',
			),
			'offset'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'productTaxonomies'   => array(
				'type'    => 'object',
				'default' => []
			),
			'authors'   => array(
				'type'    => 'array',
			),
			'taxnomyRelation'   => array(
				'type'    => 'string',
				'default' => 'OR',
			),
			'orderby'   => array(
				'type'    => 'string',
				'default' => 'date',
			),
			'order'   => array(
				'type'    => 'string',
				'default' => 'asc',
			),

			//cart text
			'cartCustomBtnTextEnable'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'simpleProductCartText'   => array(
				'type'    => 'string',
				'default' => 'Add to cart',
			),
			'variableProductCartText'   => array(
				'type'    => 'string',
				'default' => 'Select options',
			),
			'groupedProductCartText'   => array(
				'type'    => 'string',
				'default' => 'View Products',
			),
			'externalProductCartText'   => array(
				'type'    => 'string',
				'default' => 'Buy Now',
			),
			//pagination
			'showPagination'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'displayPerPage'   => array(
				'type'    => 'number',
				'default' => 6,
			),

			'page'   => array(
				'type'    => 'number',
				'default' => 1,
			),

			//layout settings
			'postColumnGap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => 20,
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-wrap {gap: {{postColumnGap}}; }',
					],
				],
			],
			'postColumn'  => [
				'type'    => "object",
				'default' => [
					'lg' => 2,
					'md' => 1,
					'sm' => 1,
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-list {grid-template-columns: repeat({{postColumn}}, 1fr); }',
					],
				],
			],
			'columnEqualHeight'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'ratingDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'priceDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'saleBadgeDisplay'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'columnEqualHeightVal'   => array(
				'type'    => 'boolean',
				'default' => true,
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'columnEqualHeight', 'condition' => '==', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-list .rtrb-product-list {height: 100%; }'
					]
				]
			),
			'thumbnailFixedHeight'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'thumbnailHeight' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-img-wrap.fixed-height{height: {{thumbnailHeight}}; }',
					],
				],
			],

			"thumbnailSize" => array(
				"type" => "string",
				"default" => "thumbnail",
			),

			"customThumbnailWidth" => array(
				"type" => "number",
				"default" => 192,
			),

			"customThumbnailHeight" => array(
				"type" => "number",
				"default" => 172,
			),
			'thumbnailWidth' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-img-wrap {width: {{thumbnailWidth}}; }',
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
				'default' => 'word',
			),
			'titleWord'   => array(
				'type'    => 'number',
				'default' => 7,
			),

			'categoryDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'categoryPosition'   => array(
				'type'    => 'string',
				'default' => 'rt-above-title',
			),

			'saleText'   => array(
				'type'    => 'string',
				'default' => 'Sale',
			),

			'salePosition'   => array(
				'type'    => 'string',
				'default' => 'left',
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'salePosition', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{left:0;right: inherit;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'salePosition', 'condition' => '==', 'value' => 'right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{right:0;left:inherit;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'salePosition', 'condition' => '==', 'value' => 'topleft'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{top:0;left:0;right: inherit;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'salePosition', 'condition' => '==', 'value' => 'topright'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{top:0;right:0;left: inherit;}'
					]
				]
			),

			'salePositionValue'   => array(
				'type'    => 'number',
				'default' => -15,
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'salePosition', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{left:{{salePositionValue}}px;right: inherit;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'salePosition', 'condition' => '==', 'value' => 'right'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{right:{{salePositionValue}}px;left:inherit;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'salePosition', 'condition' => '==', 'value' => 'topleft'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{top:{{salePositionValue}}px;}'
					],
					(object) [
						'depends' => [
							(object)['key' => 'salePosition', 'condition' => '==', 'value' => 'topright'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{top:{{salePositionValue}}px;}'
					]
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product {{columnPadding}}',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product{border-style:{{columnBorderStyle}};}'
					]
				]
			),

			'columnHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product:hover{border-style:{{columnHoverBorderStyle}};}'
					]
				]
			),

			'columnBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product{border-color:{{columnBorderColor}};}'
					]
				]
			),
			'columnHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product:hover{border-color:{{columnHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product{{columnBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product:hover{{columnHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product{{columnRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product:hover{{columnHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product']
				],
			],

			'columnHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product:hover']
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

						'selector' => '{{RTRB}}.rtrb-block .rtrb-product'
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

						'selector' => '{{RTRB}}.rtrb-block .rtrb-product:hover'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product::before{opacity:{{columnItemBGOverlayOpacity}}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-img-wrap img,
						{{RTRB}}.rtrb-block .rtrb-product .rtrb-img-wrap > a::before,
						{{RTRB}}.rtrb-block .rtrb-product .rtrb-img-wrap > a::after{{thumbnailRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-img-content .rtrb-img-wrap{{thumbnailMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-content{{contentBoxPadding}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-title']
				],
			],
			'titleColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-title a{color: {{titleColor}}; }'
					]
				]
			),
			'titleHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-title a:hover{color: {{titleHoverColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-title{{titleMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a{background: {{catBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a:hover
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a:hover
						{background: {{catHoverGradientColor}};  }'
					]
				]
			),

			'catMetaShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a']
				],
			],

			'catMetaHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a:hover']
				],
			],

			'catBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a{border-style:{{catBorderStyle}};}'
					]
				]
			),

			'catHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a:hover{border-style:{{catHoverBorderStyle}};}'
					]
				]
			),
			'catBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a{border-color:{{catBorderColor}};}'
					]
				]
			),
			'catHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a:hover{border-color:{{catHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a{{catBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a:hover{{catHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a{{catRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a:hover{{catHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a']
				],
			],
			'catMetaAlign' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-cat-list {justify-content: {{catMetaAlign}}; }',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-cat-list {column-gap: {{catMetaGap}}; }',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-meta-list .rtrb-meta{gap: {{catMetaToTextGap}}; }',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-cat-list {row-gap: {{catMetaRowGap}}; }',
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-cat-list li a{{catMetaPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-cat-list{{catMetaMargin}}'
					]
				]
			),
			"categoryColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a{color: {{categoryColor}}; }'
					]
				]
			),

			"categoryHoverColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product-cat-list li a:hover{color: {{categoryHoverColor}}; }'
					]
				]
			),

			//Price Style
			'priceTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-price']
				],
			],

			'priceColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-price{color: {{priceColor}}; }'
					]
				]
			),

			'regularPriceColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-price del{color: {{regularPriceColor}}; }'
					]
				]
			),
			"priceMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-price{{priceMargin}}'
					]
				]
			),
			//rating style
			'ratingColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .ratings-list li svg{color: {{ratingColor}}; }'
					]
				]
			),
			'selectedRatingColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .ratings-list li.selected svg{color: {{selectedRatingColor}}; }'
					]
				]
			),

			"ratingMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .ratings-list{{ratingMargin}}'
					]
				]
			),
			'ratingIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .ratings-list li svg{font-size:{{ratingIconSize}}; }'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a']
				],
			],

			'buttonTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a{color: {{buttonTextColor}} !important; }'
					]
				]
			),

			'buttonHoverTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a:hover{color: {{buttonHoverTextColor}} !important; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a{{buttonPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a{border-style:{{buttonBorderStyle}};}'
					]
				]
			),

			'buttonHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a:hover{border-style:{{buttonHoverBorderStyle}};}'
					]
				]
			),

			'buttonBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a{border-color:{{buttonBorderColor}};}'
					]
				]
			),
			'buttonHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a:hover{border-color:{{buttonHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a{{buttonBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a:hover{{buttonHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a{{buttonRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a:hover{{buttonHoverRadius}}'
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
			'buttonBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'buttonBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a{background: {{buttonBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a:hover{background: {{buttonHoverBGColor}} ; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a:hover
						{background: {{buttonHoverGradientColor}};  }'
					]
				]
			),

			'buttonShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a']
				],
			],

			'buttonHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-action-btn li a:hover']
				],
			],
			'buttonIcon'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'iconEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),

			'buttonIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-wrap .rtrb-product .rtrb-action-btn li a>svg{font-size:{{buttonIconSize}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-wrap .rtrb-product .rtrb-action-btn li a{gap:{{buttonIconGap}}; }'
					]
				]
			],
			'buttonIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-wrap .rtrb-product .rtrb-action-btn li a>svg{color: {{buttonIconColor}} !important; }'
					]
				]
			),
			'buttonHoverIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-listing-wrap .rtrb-product .rtrb-action-btn li a:hover svg{color: {{buttonHoverIconColor}} !important; }'
					]
				]
			),
			//salebadege style
			'saleBadgeTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge']
				],
			],
			"saleBadgeColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{color: {{saleBadgeColor}};}']
				],
			),
			"saleBadgeBgColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{background-color: {{saleBadgeBgColor}};}']
				],
			),
			'saleBadgeBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{border-style:{{saleBadgeBorderStyle}} ;}'
					]
				]
			),
			'saleBadgeBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{border-color:{{saleBadgeBorderColor}};}'
					]
				]
			),
			"saleBadgeBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{{saleBadgeBorderWidth}}'
					]
				]
			),
			"saleBadgeRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-product .rtrb-product-sale-badge{{saleBadgeRadius}}'
					]
				]
			),

			//pagination style
			"pageNumberStyle" => array(
				"type"    => "object",
				"default" => 'normal'
			),
			"pageNumberColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers{color: {{pageNumberColor}};}']
				],
			),
			"pageNumberBGColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers{background-color: {{pageNumberBGColor}};}']
				],
			),
			"pageNumberHoverColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers:hover{color: {{pageNumberHoverColor}};}']
				],
			),

			"pageNumberHoverBGColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers:hover{background-color: {{pageNumberHoverBGColor}};}']
				],
			),
			"pageNumberActiveColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers.current{color: {{pageNumberActiveColor}};}']
				],
			),
			"pageNumberActiveBGColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers.current{background-color: {{pageNumberActiveBGColor}};}']
				],
			),
			"pageNumberActiveBorderColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers.current{border-color: {{pageNumberActiveBorderColor}};}']
				],
			),
			'pageNumberTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers']
				],
			],
			'paginationGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-wrap .rtrb-pagination-nav {gap:{{paginationGap}}; }'
					]
				]
			],
			'pageNumberWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-wrap .rtrb-pagination-nav .page-numbers {width:{{pageNumberWidth}}; }'
					]
				]
			],
			'pageNumberHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-wrap .rtrb-pagination-nav .page-numbers {height:{{pageNumberHeight}}; }'
					]
				]
			],
			"pageNumberMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-wrap{{pageNumberMargin}}'
					]
				]
			),
			"pageNumberPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers{{pageNumberPadding}}'
					]
				]
			),

			'pageNumberBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'pageNumberBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers{border-style:{{pageNumberBorderStyle}};}'
					]
				]
			),

			'pageNumberHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers:hover{border-style:{{pageNumberHoverBorderStyle}};}'
					]
				]
			),

			'pageNumberBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers{border-color:{{pageNumberBorderColor}};}'
					]
				]
			),
			'pageNumberHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers:hover{border-color:{{pageNumberHoverBorderColor}};}'
					]
				]
			),

			"pageNumberBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers{{pageNumberBorderWidth}}'
					]
				]
			),


			"pageNumberHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers:hover{{pageNumberHoverBorderWidth}}'
					]
				]
			),

			"pageNumberRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers{{pageNumberRadius}}'
					]
				]
			),

			"pageNumberHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pagination-nav .page-numbers:hover{{pageNumberHoverRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper{ 
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper::before'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper::before{
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-product-list-wrapper:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_product_list()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'woo-product-list',
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
		$layoutType = isset($settings['layoutType']) ? $settings['layoutType'] : 'list';
		$layout = isset($settings['layout']) ? $settings['layout'] : '1';

		$the_loops = GetProductsV1::rtrb_product_query($settings);

		$data = [
			'template'              => 'blocks/woo-product-list/' . $layoutType . '/layout-' . $layout,
			'settings'              => $settings,
			'the_loops'				=> $the_loops,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_product_grid_block_data', $data);

		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
