<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class NewsTicker {
	protected $attributes = [];

	public function __construct() {
		add_action('init', [$this, 'register_news_ticker']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
		add_action('enqueue_block_editor_assets', [$this, 'editor_assets']);
	}

	public function editor_assets() {
		wp_enqueue_script('acmeticker');
	}

	public function rtrb_blcoks_css_enqueue() {
		if (Fns::rtrb_has_block('rtrb/news-ticker') && !is_admin()) {
			wp_enqueue_style('rtrb-blocks-frontend-style');
			wp_enqueue_script('rtrb-frontend-blocks-js');
		}
	}

	public function get_attributes($default = false) {
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

			//news ticker
			'tickerOptions' => array(
				"type" => "object",
				"default" => array(
					"tickerType" => 'horizontal',
					"tickerControl" => false,
					"direction" => 'right',
					"speed" => 1500,
					"stopOnHover" => true,
					"openNewTab" => true,
					"preLoader" => true
				),
			),

			//ticker label
			'tickerLabel'   => array(
				'type'    => 'string',
				'default' => 'BREAKING NEWS',
			),

			'tickerLabelIconEnable'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'tickerLabelIcon'   => array(
				'type'    => 'string',
				'default' => 'bolt',
			),
			'tickerLabelIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label .rtrb-news-ticker-label-icon{font-size:{{tickerLabelIconSize}}; }'
					]
				]
			],

			'tickerLabelIconGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{gap:{{tickerLabelIconGap}}; }'
					]
				]
			],

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

			"thumbnailSize" => array(
				"type" => "string",
				"default" => "medium_large",
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

			//style ticker body
			'tickerBodyTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker .rtrb-single-news']
				],
			],
			'tickerBodyColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker .rtrb-single-news{color: {{tickerBodyColor}}; }'
					]
				]
			),
			"tickerBodyPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker {{tickerBodyPadding}}',
					]
				]
			),

			// Border Control
			'tickerBodyBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker{border-style:{{tickerBodyBorderStyle}};}'
					]
				]
			),

			'tickerBodyBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker{border-color:{{tickerBodyBorderColor}};}'
					]
				]
			),

			"tickerBodyBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker{{tickerBodyBorderWidth}}'
					]
				]
			),

			"tickerBodyRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker{{tickerBodyRadius}}'
					]
				]
			),

			'tickerBodyShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker']
				],
			],

			'tickerBodyBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'tickerBodyBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tickerBodyBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker{background: {{tickerBodyBGColor}}; }'
					]
				]
			),

			'tickerBodyGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tickerBodyBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker{background: {{tickerBodyGradientColor}}; }'
					]
				]
			),


			// ticker label
			'tickerLabelTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label .rtrb-news-ticker-label-text']
				],
			],

			'tickerLabelTextColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label .rtrb-news-ticker-label-text{color: {{tickerLabelTextColor}} !important; }'
					]
				]
			),

			'tickerLabelIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label .rtrb-news-ticker-label-icon{color: {{tickerLabelIconColor}} !important; }'
					]
				]
			),


			"tickerLabelPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{{tickerLabelPadding}}'
					]
				]
			),

			'tickerLabelBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{border-style:{{tickerLabelBorderStyle}};}'
					]
				]
			),

			'tickerLabelBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{border-color:{{tickerLabelBorderColor}};}'
					]
				]
			),

			'tickerLabelBorderBottomColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{border-bottom-color:{{tickerLabelBorderBottomColor}};}'
					]
				]
			),


			"tickerLabelBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{{tickerLabelBorderWidth}}'
					]
				]
			),

			"tickerLabelRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{{tickerLabelRadius}}'
					]
				]
			),

			'tickerLabelBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),

			'tickerLabelBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tickerLabelBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{background: {{tickerLabelBGColor}}; }'
					]
				]
			),

			'tickerLabelGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'tickerLabelBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-label{background: {{tickerLabelGradientColor}}; }'
					]
				]
			),


			//style ticker navigation

			"navLeftIcon" => array(
				"type"    => "string",
				"default" => ''
			),
			"navRightIcon" => array(
				"type"    => "string",
				"default" => ''
			),
			'navIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow{font-size:{{navIconSize}}; }'
					]
				]
			],
			"navStyle" => array(
				"type"    => "string",
				"default" => 'normal'
			),
			"navColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow{color: {{navColor}} !important;}']
				],
			),
			"navBGColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow{background-color: {{navBGColor}} !important;}']
				],
			),
			"navHoverColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow:hover{color: {{navHoverColor}} !important;}']
				],
			),

			"navHoverBGColor" => array(
				"type"    => "string",
				"default" => '',
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow:after{background: {{navHoverBGColor}} !important;}']
				],
			),

			'navGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls {gap:{{navGap}}; }'
					]
				]
			],
			'navWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow {width:{{navWidth}};height:{{navWidth}}; }'
					]
				]
			],

			"navPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow{{navPadding}}'
					]
				]
			),

			'navBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'navBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow{border-style:{{navBorderStyle}};}'
					]
				]
			),

			'navHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow:hover{border-style:{{navHoverBorderStyle}};}'
					]
				]
			),

			'navBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow{border-color:{{navBorderColor}};}'
					]
				]
			),
			'navHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow:hover{border-color:{{navHoverBorderColor}};}'
					]
				]
			),

			"navBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow{{navBorderWidth}}'
					]
				]
			),

			"navHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow:hover{{navHoverBorderWidth}}'
					]
				]
			),

			"navRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow{{navRadius}}'
					]
				]
			),

			"navHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-news-ticker-controls .rtrb-news-ticker-arrow:hover{{navHoverRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-ticker-wrapper:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_news_ticker() {
		wp_register_script(
			'acmeticker',
			rtrb()->get_assets_uri('vendors/ticker/acmeticker.min.js'),
			array("jquery"),
			RTRB_VERSION,
			true
		);

		register_block_type(
			RTRB_PATH_BLOCKS . 'news-ticker',
			[
				'editor_script' 	=> 'rtrb-blocks-editor-script',
				'editor_script' 	=> 'acmeticker',
				'editor_style'    	=> 'rtrb-blocks-frontend-style',
				'render_callback' => [$this, 'render_block'],
				'attributes'      => $this->get_attributes(),
			]
		);
	}

	public function render_block($settings) {
		if (!is_admin()) {
			wp_enqueue_script('acmeticker');
		}


		$layout = isset($settings['layout']) ? $settings['layout'] : '1';

		$the_loops = PostGridAjax::rtrb_post_query($settings);

		$data = [
			'template'              => 'blocks/news-ticker/layout-1',
			'settings'              => $settings,
			'the_loops'				=> $the_loops,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_news_ticker_block_data', $data);

		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
