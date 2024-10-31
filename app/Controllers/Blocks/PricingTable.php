<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class PricingTable
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
		add_action('init', [$this, 'register_pricing_table']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/pricing-table') && !is_admin()) {
			wp_enqueue_style('rtrb-blocks-frontend-style');
		}
	}

	public function get_attributes()
	{
		$attributes = array(
			'blockId'     => array(
				'type'    => 'string',
				'default' => '',
			),

			'preview'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			"layout" => array(
				"type" => "string",
				"default" => "1"
			),
			'titleText' => array(
				'type'    => 'string',
				'default' => 'Standard',
			),
			'subTitleDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'subTitleText' => array(
				'type'    => 'string',
				'default' => 'Pricing tables makes it easy to create and publish beautiful pricing tables.',
			),
			'saveMessageDisplay'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'saveMessageText' => array(
				'type'    => 'string',
				'default' => 'Save Up to 15%',
			),
			'contentAlignment' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-table-inner{text-align:{{contentAlignment}}; }'
					]
				]
			),

			//header icon/image
			'headerMediaType'   => array(
				'type'    => 'string',
				'default' => 'none',
			),

			'headerImageId'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'headerImageUrl'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'headerIcon' => array(
				'type'    => 'string',
				'default' => 'paper-plane',
			),
			'headerIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-icon{font-size:{{headerIconSize}}; }'
					]
				]
			],
			'headerImageWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-image{max-width:{{headerImageWidth}}; }'
					]
				]
			],
			'headerImageHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-image{height:{{headerImageHeight}}; }'
					]
				]
			],


			//price
			'salePriceDisplay'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'price' => array(
				'type'    => 'string',
				'default' => '39',
			),
			'salePrice' => array(
				'type'    => 'string',
				'default' => '19',
			),
			'currency' => array(
				'type'    => 'string',
				'default' => '$',
			),
			'currencyPosition' => array(
				'type'    => 'string',
				'default' => 'left',
			),
			'unit' => array(
				'type'    => 'string',
				'default' => 'mo',
			),
			'unitSep' => array(
				'type'    => 'string',
				'default' => '/',
			),

			//button
			'buttonDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'buttonText'   => array(
				'type'    => 'string',
				'default' => 'Purchase Now',
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
			'iconEnable'   => array(
				'type'    => 'boolean',
				'default' => false,
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

			//badge
			'badgeDisplay'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'badgeStyle' => array(
				'type'    => 'string',
				'default' => '3',
			),
			'badgeText' => array(
				'type'    => 'string',
				'default' => 'Featured',
			),
			'badgePosition' => array(
				'type'    => 'string',
				'default' => 'right',
			),
			'featureListStyle' => array(
				'type'    => 'string',
				'default' => 'rt-list-with-icon',
			),
			'featureListIcon' => array(
				'type'    => 'boolean',
				'default' => true,
			),

			//feature
			'features' => [
				'type' => "array",
				'default' => [
					[
						"icon" => "check",
						"text" => "3 Regular Ads ",
						"color" => "#03bb89"
					],
					[
						"icon" => "check",
						"text" => "No Featured Ads",
						"color" => "#03bb89"
					],
					[
						"icon" => "check",
						"text" => "No Ads will be bumped up",
						"color" => "#03bb89"
					],
					[
						"icon" => "check",
						"text" => "Limited Support ",
						"color" => "#03bb89"
					]
				],
			],

			//icon/image style
			'iconColor' => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-icon {color:{{iconColor}}; }']
				],
			),

			"mediaPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media{{mediaPadding}}'
					]
				]
			),

			'mediaBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media {border-style:{{mediaBorderStyle}};}'
					]
				]
			),

			'mediaBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media {border-color:{{mediaBorderColor}};}'
					]
				]
			),

			"mediaBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media {{mediaBorderWidth}}'
					]
				]
			),

			"mediaRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media {{mediaRadius}}'
					]
				]
			),

			'mediaBGNormalHover'   => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'mediaBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'mediaHoverBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'mediaBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mediaBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media{background: {{mediaBGColor}}; }'
					]
				]
			),

			'mediaHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mediaHoverBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media{background: {{mediaHoverBGColor}}; }'
					]
				]
			),

			'mediaGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mediaBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media{background-image: {{mediaGradientColor}}; }'
					]
				]
			),

			'mediaHoverGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'mediaHoverBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media{background-image: {{mediaHoverGradientColor}}; }'
					]
				]
			),

			'mediaShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-media']
				],
			],


			//header style
			"headerPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-header{{headerPadding}}'
					]
				]
			),
			"topAreaPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-table-top{{topAreaPadding}}'
					]
				]
			),

			"headerMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-header{{headerMargin}}'
					]
				]
			),
			"headerBGColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-header { background-color:{{headerBGColor}}; }'
				]]
			),
			'topAreaBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'topAreaBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'topAreaBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-table-top:before{background: {{topAreaBGColor}}; }'
					]
				]
			),

			'topAreaGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'topAreaBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-table-top:before{background: {{topAreaGradientColor}}; }'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-header .rtrb-pricing-title']
				],
			],
			"titleColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-header .rtrb-pricing-title { color:{{titleColor}}; }'
				]]
			),

			'subTitleTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-header .rtrb-pricing-sub-title']
				],
			],
			"subTitleColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-header .rtrb-pricing-sub-title { color:{{subTitleColor}}; }'
				]]
			),
			"subTitleMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-header .rtrb-pricing-sub-title{{subTitleMargin}}'
					]
				]
			),

			//price style
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-wrap']
				],
			],

			"priceColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-wrap { color:{{priceColor}}; }'
				]]
			),
			'currencyTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-wrap .rtrb-currency']
				],
			],
			'currVerticalPos' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-wrap .rtrb-currency{top:{{currVerticalPos}}; }'
					]
				]
			],
			"priceWrapMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-wrap{{priceWrapMargin}}'
					]
				]
			),
			'orginalPriceTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-orginal-price']
				],
			],
			"orginalPriceColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-orginal-price { color:{{orginalPriceColor}}; }'
				]]
			),
			'orginalPriceCurrencyTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-orginal-price .rtrb-currency']
				],
			],
			"orginalPriceCurrencyColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-orginal-price .rtrb-currency { color:{{orginalPriceCurrencyColor}}; }'
				]]
			),

			"orginalPriceMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-orginal-price{{orginalPriceMargin}}'
					]
				]
			),


			'salePriceTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-sale-price .rtrb-price']
				],
			],
			"salePriceColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-sale-price .rtrb-price { color:{{salePriceColor}}; }'
				]]
			),
			'salePriceCurrencyTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-sale-price .rtrb-currency']
				],
			],
			"salePriceCurrencyColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-sale-price .rtrb-currency { color:{{salePriceCurrencyColor}}; }'
				]]
			),

			"salePriceMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-sale-price{{salePriceMargin}}'
					]
				]
			),

			'priceUnitTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-period']
				],
			],
			"priceUnitColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-period { color:{{priceUnitColor}}; }'
				]]
			),
			"priceUnitMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-price-period{{priceUnitMargin}}'
					]
				]
			),

			// save msg
			'saveMsgTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .save-amount']
				],
			],
			"saveMsgColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .save-amount { color:{{saveMsgColor}}; }'
				]]
			),

			'saveMsgBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'saveMsgBgColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'saveMsgBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .save-amount{background: {{saveMsgBgColor}}; }'
					]
				]
			),

			'saveMsgBgGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'saveMsgBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .save-amount{background: {{saveMsgBgGradientColor}}; }'
					]
				]
			),

			"saveMsgPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .save-amount{{saveMsgPadding}}'
					]
				]
			),

			"saveMsgWrapMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .save-msg-wrap{{saveMsgWrapMargin}}'
					]
				]
			),

			//feature style
			"featureSpacing" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-body{{featureSpacing}}'
					]
				]
			),
			"featurePadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-body{{featurePadding}}'
					]
				]
			),

			'featureListAlignment' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list{text-align:{{featureListAlignment}}; }'
					]
				]
			),

			'featureTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item']
				],
			],

			"featureColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item{ color:{{featureColor}}; }'
				]]
			),
			"featureIconColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item .list-icon{ color:{{featureIconColor}}; }'
				]]
			),
			'featureItemGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item:not(:last-of-type){margin-bottom:{{featureItemGap}}; }'
					]
				]
			],
			'featureIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item .list-icon{font-size:{{featureIconSize}}; }'
					]
				]
			],

			'featureIconGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item .list-icon{margin-right:{{featureIconGap}}; }'
					]
				]
			],
			"featureBulletColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item:before{ background:{{featureBulletColor}}; }'
				]]
			),
			'featureBulletSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item:before{width:{{featureBulletSize}}; height:{{featureBulletSize}}; }'
					]
				]
			],
			'featureBulletGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item:before{margin-right:{{featureBulletGap}}; }'
					]
				]
			],
			"featureNumberColor" => array(
				"type" => "string",
				"default" => "",
				'style' => [(object)[
					'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item:before{ color:{{featureNumberColor}}; }'
				]]
			),
			'featureNumberSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item:before{font-size:{{featureNumberSize}}; height:{{featureBulletSize}}; }'
					]
				]
			],
			'featureNumberGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-feature-list .rtrb-feature-list-item:before{margin-right:{{featureNumberGap}}; }'
					]
				]
			],

			//button
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
			"buttonWrapMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-button-wrap{{buttonWrapMargin}}'
					]
				]
			),
			'buttonWrapHrColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-button-wrap .horizontal-bar{background: {{buttonWrapHrColor}}; }'
					]
				]
			),
			'buttonWrapHrHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-pricing-button-wrap .horizontal-bar{height:{{buttonWrapHrHeight}}; }'
					]
				]
			],


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

			//badge style
			'badgeTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-ribbon-span']
				],
			],
			'badgeColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-ribbon-span{color: {{badgeColor}}; }']
				],
			),
			'badgeBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'badgeBGColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'badgeBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-ribbon-span:before,
						{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-ribbon-span .triangle-bar{background: {{badgeBGColor}}; }'
					]
				]
			),
			'badgeGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'badgeBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-ribbon-span:before,
						{{RTRB}}.rtrb-block .rtrb-pricing-table .rtrb-ribbon-span .triangle-bar {background: {{badgeGradientColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-pricing-table-inner:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_pricing_table()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'pricing-table',
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
			'template'              => 'blocks/pricing-table/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_pricing_table_block_data', $data);

		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
