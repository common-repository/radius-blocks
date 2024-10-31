<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class ProgressBar
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_progress_bar']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/progress-bar') && !is_admin()) {
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
				'default' => 'line',
			),
			'labelText'   => array(
				'type'    => 'string',
				'default' => "Progress bar",
			),
			'progressCount'   => array(
				'type'    => 'number',
				'default' => 50,
			),
			'progressCountDisplay' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'stripeDisplay' => array(
				'type'    => 'boolean',
				'default' => false,
			),

			//settings
			'customWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'line'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-progressbar-line-container{width:{{customWidth}};}'
					]
				]
			],

			'customHeight' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'line'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-line-fill,
						{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-line{height:{{customHeight}}; }'
					]
				]
			],

			'circleSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-circle,
						{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-half_circle .rtrb-pb-circle{height:{{circleSize}};width:{{circleSize}}; }'
					],
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'half_circle'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-half_circle{width:{{circleSize}}; }'
					]
				]
			],
			'circleStrokeWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-circle-half,
						{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-circle .rtrb-pb-circle-inner{border-width:{{circleStrokeWidth}}; }'
					]
				]
			],

			'animationDuration'   => array(
				'type'    => 'number',
				'default' => 1500,
			),
			'wrapperAlignment' => array(
				'type'    => 'object',
				'default' => (object)[
					'lg' => 'center',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper{justify-content:{{wrapperAlignment}}; display:flex;}'
					]
				]
			),

			'labelDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),

			//style
			'fillGradientDisplay' => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'lineBGColor'   => array(
				'type'    => 'string',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper  .rtrb-pb-circle .rtrb-pb-circle-inner{background-color:{{lineBGColor}}; }'
					]
				]
			),

			'lineColor'   => array(
				'type'    => 'string',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-line-fill{background-color:{{lineColor}}; }'
					]
				]
			),

			'fillColor'   => array(
				'type'    => 'string',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-circle .rtrb-pb-circle-pie .rtrb-pb-circle-half{border-color:{{fillColor}}; }'
					]
				]
			),

			'strockColor'   => array(
				'type'    => 'string',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper  .rtrb-pb-circle .rtrb-pb-circle-inner{border-color:{{strockColor}}; }'
					]
				]
			),

			'fillGradientColor' => array(
				'type'    => 'string',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-line-fill{background-image: {{fillGradientColor}}; }'
					]
				]
			),

			'labelTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-label']
				],
			],

			'labelBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-label{background-color: {{labelBGColor}} !important; }'
					]
				]
			),

			'labelColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-label{color: {{labelColor}} !important; }'
					]
				]
			),

			"labelPadding" => array(
				"type"    => "object",
				"default" => array(
					'lg' => [
						"isLinked" => true,
						"unit"     => "px !important",
						"value"    => ''
					]
				),
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-label{{labelPadding}}'
					]
				]
			),

			"labelMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-label{{labelMargin}}'
					]
				]
			),

			'progressCountTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-count-wrap']
				],
			],

			'progressCountColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-count-wrap{color: {{progressCountColor}} !important; }'
					]
				]
			),

			'progressCountSpacing'   => array(
				'type'    => 'number',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-circle .rtrb-pb-circle-inner-content,
						{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-half_circle .rtrb-pb-circle-inner-content{top: {{progressCountSpacing}}%; }'
					],
					(object) [
						'depends' => [
							(object)['key' => 'layout', 'condition' => '==', 'value' => 'line'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-progressbar-wrapper .rtrb-pb-line .rtrb-pb-count-wrap{bottom: {{progressCountSpacing}}px;}'
					],
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area { 
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area::before'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area::before{
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block.rtrb-progressbar-area:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_progress_bar()
	{

		wp_register_script(
			'progress-bar-frontend',
			rtrb()->get_assets_uri('blocks/progress-bar.js'),
			array('react', 'wp-element'),
			RTRB_VERSION,
			true
		);

		register_block_type(
			RTRB_PATH_BLOCKS . 'progress-bar',
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
			wp_enqueue_script('progress-bar-frontend');
		}

		$data = [
			'template'              => 'blocks/progress-bar/layout-1',
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_progressbar_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
