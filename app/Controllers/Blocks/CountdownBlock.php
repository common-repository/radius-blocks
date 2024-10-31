<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class CountdownBlock
{

	protected $attributes = [];

	public function __construct()
	{
		add_action('init', [$this, 'register_countdown']);
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/countdown') && !is_admin()) {
			wp_enqueue_style('rtrb-blocks-frontend-style');
			wp_enqueue_script('rtrb-frontend-blocks-js');
		}
	}

	public function get_attributes()
	{
		$attributes = [
			'blockId'       => [
				'type'    => 'string',
				'default' => '',
			],
			'preview'       => [
				'type'    => 'boolean',
				'default' => false,
			],
			'layout'        => [
				'type'    => 'string',
				'default' => '1',
			],
			'deadlineDateTime'  => [
				'type' => 'number',
			],
			'daysDisplay'   => [
				'type'    => 'boolean',
				'default' => true,
			],
			'daysText'      => [
				'type'    => 'string',
				'default' => 'Days',
			],
			'hoursDisplay'  => [
				'type'    => 'boolean',
				'default' => true,
			],
			'hoursText'     => [
				'type'    => 'string',
				'default' => 'Hours',
			],
			'minutesDisplay'             => [
				'type'    => 'boolean',
				'default' => true,
			],
			'minutesText'   => [
				'type'    => 'string',
				'default' => 'Minutes',
			],
			'secondsDisplay'             => [
				'type'    => 'boolean',
				'default' => true,
			],
			'secondsText'   => [
				'type'    => 'string',
				'default' => 'Seconds',
			],
			'countBoxContainerWidth'     => [
				'type'    => 'object',
				'default' => [
					'lg' => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{width:{{countBoxContainerWidth}}; }',
					],
				],
			],
			'countBoxContainerHeight'     => [
				'type'    => 'object',
				'default' => [
					'lg' => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{height:{{countBoxContainerHeight}}; }',
					],
				],
			],

			'boxBarOneBgType'                 => [
				'type'    => 'string',
				'default' => 'gradient',
			],
			'boxBarOneBgColor'                => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'boxBarOneBgType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rt-ex-shape--one > span{ border-image-source: {{boxBarOneBgColor}}; }',
					],
				],
			],
			'boxBarOneGradientBgColor'          => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'boxBarOneBgType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rt-ex-shape--one > span{border-image-source: {{boxBarOneGradientBgColor}}; }',
					],
				],
			],
			'boxBarTwoBgType'                 => [
				'type'    => 'string',
				'default' => 'gradient',
			],
			'boxBarTwoBgColor'                => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'boxBarTwoBgType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rt-ex-shape--two > span{ border-image-source: {{boxBarTwoBgColor}}; }',
					],
				],
			],
			'boxBarTwoGradientBgColor'          => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'boxBarTwoBgType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rt-ex-shape--two > span{border-image-source: {{boxBarTwoGradientBgColor}}; }',
					],
				],
			],

			// single digit for layout 6
			'singleDigitWidth'     => [
				'type'    => 'object',
				'default' => [
					'lg' => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit {width:{{singleDigitWidth}}; }',
					],
				],
			],
			'singleDigitHeight'     => [
				'type'    => 'object',
				'default' => [
					'lg' => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit {height:{{singleDigitHeight}}; }',
					],
				],
			],
			'singleDigitBgType'                 => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'singleDigitBgColor'                => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'singleDigitBgType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit{ background: {{singleDigitBgColor}}; }',
					],
				],
			],
			'singleDigitGradientBgColor'          => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'singleDigitBgType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit{background: {{singleDigitGradientBgColor}}; }',
					],
				],
			],

			'singleDigitBorderType'         => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'singleDigitBorderStyle'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit{border-style:{{singleDigitBorderStyle}};}',
					],
				],
			],
			'singleDigitBorderColor'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit{border-color:{{singleDigitBorderColor}};}',
					],
				],
			],
			'singleDigitBorderWidth'        => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit{{singleDigitBorderWidth}}',
					],
				],
			],
			'singleDigitRadius'             => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit{{singleDigitRadius}}',
					],
				],
			],
			'singleDigitHoverBorderStyle'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit:hover{border-style:{{singleDigitHoverBorderStyle}};}',
					],
				],
			],
			'singleDigitHoverBorderColor'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit:hover{border-color:{{singleDigitHoverBorderColor}};}',
					],
				],
			],
			'singleDigitHoverBorderWidth'   => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit:hover{{singleDigitHoverBorderWidth}}',
					],
				],
			],
			'singleDigitHoverRadius'        => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit:hover{{singleDigitHoverRadius}}',
					],
				],
			],
			'singleDigitShadowType'         => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'singleDigitShadow'             => [
				'type'    => 'object',
				'default' => [
					'openShadow' => 1,
					'width'      => [
						'top'    => 1,
						'right'  => 1,
						'bottom' => 1,
						'left'   => 1,
					],
					'color'      => '',
					'inset'      => false,
					'transition' => 0.5,
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit',
					],
				],
			],
			'singleDigitHoverShadow'        => [
				'type'    => 'object',
				'default' => [
					'openShadow' => 1,
					'width'      => [
						'top'    => 1,
						'right'  => 1,
						'bottom' => 1,
						'left'   => 1,
					],
					'color'      => '',
					'inset'      => false,
					'transition' => 0.5,
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtrb-countdown__single-digit:hover',
					],
				],
			],

			// seperator
			'seperatorDisplay'             => [
				'type'    => 'boolean',
				'default' => true,

			],
			'countItemSepColor'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown--style-2 .rtrb-countdown__item:before { color:{{countItemSepColor}}; }',
					],
				],
			],
			'countItemSepSize'     => [
				'type'    => 'object',
				'default' => [
					'lg' => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown--style-2 .rtrb-countdown__item:before { font-size:{{countItemSepSize}}; }',
					],
				],
			],
			'countItemSepTop'     => [
				'type'    => 'object',
				'default' => [
					'lg' => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown--style-2 .rtrb-countdown__item:before { top:{{countItemSepTop}}; }',
					],
				],
			],
			'countItemSepLeft'     => [
				'type'    => 'object',
				'default' => [
					'lg' => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown--style-2 .rtrb-countdown__item:before { left:{{countItemSepLeft}}; }',
					],
				],
			],

			// circle progress
			'countBoxCircleSize'     => [
				'type'    => 'number',
				'default' => '200',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown--style-5 .rtrb-countdown__item{width:{{countBoxCircleSize}}px; height:{{countBoxCircleSize}}px; }',
					],
				],
			],
			'circleStrokeWidth'     => [
				'type'    => 'number',
				'default' => '10',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtCircleTrack{ stroke-width:{{circleStrokeWidth}}; }',
					],
				],
			],
			'circleDownStrokeWidth'     => [
				'type'    => 'number',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtCircleTrack{ stroke-width:{{circleDownStrokeWidth}}; }',
					],
				],
			],
			'circleDownStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtCircleTrackDown { stroke:{{circleDownStroke}}; }',
					],
				],
			],
			'circleUpStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item .rtCircleTrackUp { stroke:{{circleUpStroke}}; }',
					],
				],
			],

			// indivusal circle colors
			'circleDayDownStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-day .rtCircleTrackDown { stroke:{{circleDayDownStroke}}; }',
					],
				],
			],
			'circleDayUpStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-day .rtCircleTrackUp { stroke:{{circleDayUpStroke}}; }',
					],
				],
			],

			'circleHrDownStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-hr .rtCircleTrackDown { stroke:{{circleHrDownStroke}}; }',
					],
				],
			],
			'circleHrUpStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-hr .rtCircleTrackUp { stroke:{{circleHrUpStroke}}; }',
					],
				],
			],

			'circleMinDownStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-min .rtCircleTrackDown { stroke:{{circleMinDownStroke}}; }',
					],
				],
			],
			'circleMinUpStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-min .rtCircleTrackUp { stroke:{{circleMinUpStroke}}; }',
					],
				],
			],
			'circleSecDownStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-sec .rtCircleTrackDown { stroke:{{circleSecDownStroke}}; }',
					],
				],
			],
			'circleSecUpStroke'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-sec .rtCircleTrackUp { stroke:{{circleSecUpStroke}}; }',
					],
				],
			],



			'countBoxGap'           => [
				'type'    => 'object',
				'default' => [
					'lg' => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown{gap:{{countBoxGap}}; }',
					],
				],
			],
			'countBoxAlign'              => [
				'type'    => 'object',
				'default' => [],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block  .rtrb-countdown{justify-content:{{countBoxAlign}};}',
					],
				],
			],
			'countBoxPadding'            => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{{countBoxPadding}}',
					],
				],
			],
			'countBoxConnectorBGColor'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown--style-2 .rtrb-countdown__item::after, 
						{{RTRB}}.rtrb-block .rtrb-countdown--style-2 .rtrb-countdown__item::before{background:{{countBoxConnectorBGColor}};}',
					],
				],
			],

			'countBoxBGNormalHover'      => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'countBoxBGType'             => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'countBoxHoverBGType'        => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'countBoxBGColor'            => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'countBoxBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{ background: {{countBoxBGColor}} !important; }',
					],
				],
			],
			'countBoxHoverBGColor'       => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'countBoxHoverBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item:hover{background: {{countBoxHoverBGColor}} !important; }',
					],
				],
			],
			'countBoxGradientColor'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'countBoxBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{background: {{countBoxGradientColor}} !important; }',
					],
				],
			],
			'countBoxHoverGradientColor' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'countBoxHoverBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item:hover{background: {{countBoxHoverGradientColor}} !important; }',
					],
				],
			],
			'countBoxBorderType'         => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'countBoxBorderStyle'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{border-style:{{countBoxBorderStyle}};}',
					],
				],
			],
			'countBoxHoverBorderStyle'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item:hover{border-style:{{countBoxHoverBorderStyle}};}',
					],
				],
			],
			'countBoxBorderColor'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{border-color:{{countBoxBorderColor}};}',
					],
				],
			],
			'countBoxHoverBorderColor'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item:hover{border-color:{{countBoxHoverBorderColor}};}',
					],
				],
			],
			'countBoxBorderWidth'        => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{{countBoxBorderWidth}}',
					],
				],
			],
			'countBoxHoverBorderWidth'   => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item:hover{{countBoxHoverBorderWidth}}',
					],
				],
			],
			'countBoxRadius'             => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item{{countBoxRadius}}',
					],
				],
			],
			'countBoxHoverRadius'        => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item:hover{{countBoxHoverRadius}}',
					],
				],
			],
			'countBoxShadowType'         => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'countBoxShadow'             => [
				'type'    => 'object',
				'default' => [
					'openShadow' => 1,
					'width'      => [
						'top'    => 1,
						'right'  => 1,
						'bottom' => 1,
						'left'   => 1,
					],
					'color'      => '',
					'inset'      => false,
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item',
					],
				],
			],
			'digitsTypo'                 => [
				'type'    => 'object',
				'default' => [
					'openTypography' => 1,
					'size'           => [
						'lg'   => '',
						'unit' => 'px',
					],
					'spacing'        => [
						'lg'   => '',
						'unit' => 'px',
					],
					'height'         => [
						'lg'   => '',
						'unit' => 'px',
					],
					'transform'      => '',
					'weight'         => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__count',
					],
				],
			],
			'digitsColor'                => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__count{color: {{digitsColor}}; }',
					],
				],
			],
			'digitsPadding'              => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__count{{digitsPadding}}',
					],
				],
			],
			'labelsTypo'                 => [
				'type'    => 'object',
				'default' => [
					'openTypography' => 1,
					'size'           => [
						'lg'   => '',
						'unit' => 'px',
					],
					'spacing'        => [
						'lg'   => '',
						'unit' => 'px',
					],
					'height'         => [
						'lg'   => '',
						'unit' => 'px',
					],
					'transform'      => '',
					'weight'         => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__count-text',
					],
				],
			],
			'labelsColor'                => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__count-text {color: {{labelsColor}}; }',
					],
				],
			],
			'labelsBgColor'                => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__count-text {background: {{labelsBgColor}}; }',
					],
				],
			],
			'labelsPadding'              => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__count-text{{labelsPadding}}',
					],
				],
			],
			'dayDigitColor'              => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rt-day .rtrb-countdown__count{color: {{dayDigitColor}}; }',
					],
				],
			],
			'dayLabelColor'              => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rt-day .rtrb-countdown__count-text {color: {{dayLabelColor}}; }',
					],
				],
			],
			'dayBGNormalHover'           => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'dayBGType'                  => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'dayHoverBGType'             => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'dayBGColor'                 => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'dayBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-day{ background: {{dayBGColor}} !important; }',
					],
				],
			],
			'dayHoverBGColor'            => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'dayHoverBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-day:hover{background: {{dayHoverBGColor}} !important; }',
					],
				],
			],
			'dayGradientColor'           => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'dayBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-day{background: {{dayGradientColor}} !important; }',
					],
				],
			],
			'dayHoverGradientColor'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'dayHoverBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-day:hover{background: {{dayHoverGradientColor}} !important; }',
					],
				],
			],
			'hourDigitColor'             => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rt-hr .rtrb-countdown__count {color: {{hourDigitColor}}; }',
					],
				],
			],
			'hourLabelColor'             => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rt-hr .rtrb-countdown__count-text {color: {{hourLabelColor}}; }',
					],
				],
			],
			'hourBGNormalHover'          => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'hourBGType'                 => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'hourHoverBGType'            => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'hourBGColor'                => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'hourBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-hr{ background: {{hourBGColor}} !important; }',
					],
				],
			],
			'hourHoverBGColor'           => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'hourHoverBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-hr:hover{background: {{hourHoverBGColor}} !important; }',
					],
				],
			],
			'hourGradientColor'          => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'hourBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-hr{background: {{hourGradientColor}} !important; }',
					],
				],
			],
			'hourHoverGradientColor'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'hourHoverBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-hr:hover{background: {{hourHoverGradientColor}} !important; }',
					],
				],
			],
			'minuteDigitColor'           => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rt-min .rtrb-countdown__count{color: {{minuteDigitColor}}; }',
					],
				],
			],
			'minuteLabelColor'           => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rt-min .rtrb-countdown__count-text {color: {{minuteLabelColor}}; }',
					],
				],
			],
			'minuteBGNormalHover'        => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'minuteBGType'               => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'minuteHoverBGType'          => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'minuteBGColor'              => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'minuteBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-min{ background: {{minuteBGColor}} !important; }',
					],
				],
			],
			'minuteHoverBGColor'         => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'minuteHoverBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-min:hover{background: {{minuteHoverBGColor}} !important; }',
					],
				],
			],
			'minuteGradientColor'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'minuteBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-min{background: {{minuteGradientColor}} !important; }',
					],
				],
			],
			'minuteHoverGradientColor'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'minuteHoverBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-min:hover{background: {{minuteHoverGradientColor}} !important; }',
					],
				],
			],
			'secondDigitColor'           => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rt-sec .rtrb-countdown__count {color: {{secondDigitColor}}; }',
					],
				],
			],
			'secondLabelColor'           => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rt-sec .rtrb-countdown__count-text {color: {{secondLabelColor}}; }',
					],
				],
			],
			'secondBGNormalHover'        => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'secondBGType'               => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'secondHoverBGType'          => [
				'type'    => 'string',
				'default' => 'classic',
			],
			'secondBGColor'              => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'secondBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-sec{ background: {{secondBGColor}} !important; }',
					],
				],
			],
			'secondHoverBGColor'         => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'secondHoverBGType',
								'condition' => '==',
								'value'     => 'classic',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-sec:hover{background: {{secondHoverBGColor}} !important; }',
					],
				],
			],
			'secondGradientColor'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'secondBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-sec{background: {{secondGradientColor}} !important; }',
					],
				],
			],
			'secondHoverGradientColor'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'secondHoverBGType',
								'condition' => '==',
								'value'     => 'gradient',
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown__item.rt-sec:hover{background: {{secondHoverGradientColor}} !important; }',
					],
				],
			],
			'mainWrapMargin'             => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown{{mainWrapMargin}}',
					],
				],
			],
			'mainWrapPadding'            => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown{{mainWrapPadding}}',
					],
				],
			],
			'mainWrapBG'                 => [
				'type'    => 'object',
				'default' => [
					'openBGColor' => 0,
					'type'        => 'classic',
					'classic'     => [
						'color'       => '',
						'img'         => [
							'imgURL' => '',
							'imgID'  => '',
						],
						'imgProperty' => [
							'imgPosition'   => [
								'lg' => '',
							],
							'imgAttachment' => [
								'lg' => '',
							],
							'imgRepeat'     => [
								'lg' => '',
							],
							'imgSize'       => [
								'lg' => '',
							],
						],
					],
					'gradient'    => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown',
					],
				],
			],
			'mainWrapHoverBG'            => [
				'type'    => 'object',
				'default' => [
					'openBGColor' => 0,
					'type'        => 'classic',
					'classic'     => [
						'color'       => '',
						'img'         => [
							'imgURL' => '',
							'imgID'  => '',
						],
						'imgProperty' => [
							'imgPosition'   => [
								'lg' => '',
							],
							'imgAttachment' => [
								'lg' => '',
							],
							'imgRepeat'     => [
								'lg' => '',
							],
							'imgSize'       => [
								'lg' => '',
							],
						],
					],
					'gradient'    => '',
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown:hover',
					],
				],
			],
			'mainWrapHoverBGTransition'  => [
				'type'    => 'number',
				'default' => 0.5,
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown{transition: background {{mainWrapHoverBGTransition}}s;}',
					],
				],
			],
			'mainWrapBGOverlay'          => [
				'type'    => 'object',
				'default' => [
					'openBGColor' => 0,
					'type'        => 'classic',
					'classic'     => [
						'color'       => '',
						'img'         => [
							'imgURL' => '',
							'imgID'  => '',
						],
						'imgProperty' => [
							'imgPosition'   => [
								'lg' => '',
							],
							'imgAttachment' => [
								'lg' => '',
							],
							'imgRepeat'     => [
								'lg' => '',
							],
							'imgSize'       => [
								'lg' => '',
							],
						],
					],
					'gradient'    => '',
				],
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'mainWrapBGOverlayEnable',
								'condition' => '==',
								'value'     => true,
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown::before',
					],
				],
			],
			'mainWrapBGOverlayOpacity'   => [
				'type'    => 'number',
				'default' => 0.5,
				'style'   => [
					[
						'depends'  => [
							[
								'key'       => 'mainWrapBGOverlayEnable',
								'condition' => '==',
								'value'     => true,
							],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown::before{opacity:{{mainWrapBGOverlayOpacity}}}',
					],
				],
			],
			'mainWrapBGOverlayEnable'    => [
				'type'    => 'boolean',
				'default' => false,
			],
			'mainWrapBGType'             => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'mainWrapBorderType'         => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'mainWrapBorderStyle'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown{border-style:{{mainWrapBorderStyle}};}',
					],
				],
			],
			'mainWrapBorderColor'        => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown{border-color:{{mainWrapBorderColor}};}',
					],
				],
			],
			'mainWrapBorderWidth'        => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown{{mainWrapBorderWidth}}',
					],
				],
			],
			'mainWrapRadius'             => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown{{mainWrapRadius}}',
					],
				],
			],
			'mainWrapHoverBorderStyle'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown:hover{border-style:{{mainWrapHoverBorderStyle}};}',
					],
				],
			],
			'mainWrapHoverBorderColor'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown:hover{border-color:{{mainWrapHoverBorderColor}};}',
					],
				],
			],
			'mainWrapHoverBorderWidth'   => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown:hover{{mainWrapHoverBorderWidth}}',
					],
				],
			],
			'mainWrapHoverRadius'        => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown:hover{{mainWrapHoverRadius}}',
					],
				],
			],
			'mainWrapShadowType'         => [
				'type'    => 'string',
				'default' => 'normal',
			],
			'mainWrapShadow'             => [
				'type'    => 'object',
				'default' => [
					'openShadow' => 1,
					'width'      => [
						'top'    => 1,
						'right'  => 1,
						'bottom' => 1,
						'left'   => 1,
					],
					'color'      => '',
					'inset'      => false,
					'transition' => 0.5,
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown',
					],
				],
			],
			'mainWrapHoverShadow'        => [
				'type'    => 'object',
				'default' => [
					'openShadow' => 1,
					'width'      => [
						'top'    => 1,
						'right'  => 1,
						'bottom' => 1,
						'left'   => 1,
					],
					'color'      => '',
					'inset'      => false,
					'transition' => 0.5,
				],
				'style'   => [
					[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-countdown:hover',
					],
				],
			],
		];

		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_countdown()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'countdown',
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
		$layoutArray = ['1', '2', '3', '4', '5'];
		$layout = isset($settings['layout']) ? $settings['layout'] : '1';
		if (in_array($layout, $layoutArray, true)) {
			$layout = '1';
		}
		$data   = [
			'template'              => 'blocks/countdown/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_countdown_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
