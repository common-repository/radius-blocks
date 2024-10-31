<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class ImageComparison
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_image_comparison']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/image-comparison') && !is_admin()) {
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

			//media settings
			'beforeImageUrl'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'beforeImageId'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'afterImageUrl'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'afterImageId'   => array(
				'type'    => 'string',
				'default' => '',
			),

			//settings
			'fullWidth'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'customWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'depends' => [
							(object)['key' => 'fullWidth', 'condition' => '!=', 'value' => true],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison {max-width:{{customWidth}}; }'
					]
				]
			],

			'alignment' => array(
				'type' => 'object',
				'default' => [],
			),

			'displayLabels'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'beforeLabel'   => array(
				'type'    => 'string',
				'default' => 'Before',
			),

			'afterLabel'   => array(
				'type'    => 'string',
				'default' => 'After',
			),
			'labelsPositionV'   => array(
				'type'    => 'string',
				'default' => 'center',
			),
			'labelsPositionH'   => array(
				'type'    => 'string',
				'default' => 'center',
			),

			'lpVTop'   => array(
				'type'    => 'string',
				'default' => 'top',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'labelsPositionV', 'condition' => '==', 'value' => 'top'],
						],
						'selector' => '{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(3) > div,
						{{RTRB}}.rtrb-block .rtrb-image-comparison-wrapper > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block .rtrb-image-comparison-wrapper > div > div:nth-of-type(3) > div {top: 20px !important; transform: none !important; }'
					]
				]

			),
			'lpVBottom'   => array(
				'type'    => 'string',
				'default' => 'bottom',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'labelsPositionV', 'condition' => '==', 'value' => 'bottom'],
						],
						'selector' => '{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(3) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(3) > div {top: unset !important;bottom: 20px !important;transform: none !important; }'
					]
				]

			),

			'lpHLeft'   => array(
				'type'    => 'string',
				'default' => 'left',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'labelsPositionH', 'condition' => '==', 'value' => 'left'],
						],
						'selector' => '{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(3) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(3) > div {	left: 5% !important;
							transform: none !important; }'
					]
				]

			),
			'lpHRight'   => array(
				'type'    => 'string',
				'default' => 'right',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'labelsPositionH', 'condition' => '==', 'value' => 'right'],
						],
						'selector' => '{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(3) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(3) > div {left: unset !important;	right: 5% !important;
							transform: none !important; }'
					]
				]

			),


			'mouseHover'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'swapImage'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'varticalMode'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'noHandle'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			'handlerLineWidth'   => array(
				'type'    => 'number',
				'default' => 4,
			),
			'handlerLinePosition'   => array(
				'type'    => 'number',
				'default' => 50,
			),

			//style
			'lineColor'   => array(
				'type'    => 'string',
				'default' => '#fff',
			),

			'labelsTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(2) > div,
					{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(3) > div,
					{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(2) > div,
					{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(3) > div']
				],
			],

			'labelsBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(3) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(3) > div {background-color: {{labelsBGColor}} !important; }'
					]
				]
			),

			'labelsColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(3) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(3) > div{color: {{labelsColor}} !important; }'
					]
				]
			),

			"labelsPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block.rtrb-block-editor .rtrb-image-comparison-wrapper > div > div > div:nth-of-type(3) > div,
						{{RTRB}}.rtrb-block.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(2) > div,
						{{RTRB}}.rtrb-block.rtrb-block-frontend .rtrb-image-comparison-wrapper > div > div:nth-of-type(3) > div {{labelsPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison { 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-image-comparison:hover']
				],
			],

		);

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_image_comparison()
	{

		wp_register_script(
			'image-comparison-frontend',
			rtrb()->get_assets_uri('blocks/image-comparison.js'),
			array('react', 'wp-element'),
			RTRB_VERSION,
			true
		);

		register_block_type(
			RTRB_PATH_BLOCKS . 'image-comparison',
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
			wp_enqueue_script('image-comparison-frontend');
		}

		$data = [
			'template'              => 'blocks/image-comparison/layout',
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_image_comparison_block_data', $data);
		ob_start();
		Fns::get_template($data['template'], $data, '', $data['default_template_path']);
		return ob_get_clean();
	}
}
