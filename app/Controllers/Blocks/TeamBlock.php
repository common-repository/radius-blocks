<?php

namespace RadiusTheme\RB\Controllers\Blocks;

use RadiusTheme\RB\Helpers\Fns;

class TeamBlock
{
	protected $attributes = [];

	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'rtrb_blcoks_css_enqueue']);
		add_action('init', [$this, 'register_team']);
	}

	public function rtrb_blcoks_css_enqueue()
	{
		if (Fns::rtrb_has_block('rtrb/team') && !is_admin()) {
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

			//image
			'imageId'   => array(
				'type'    => 'string',
				'default' => '',
			),

			'imageUrl'   => array(
				'type'    => 'string',
				'default' => RTRB_URL . '/assets/img/blocks/team/default-team.jpg',
			),
			'imageWidth' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img {width:{{imageWidth}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img {height:{{imageHeight}};}'
					]
				]
			],

			'imageAlignment'   => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img {align-self: {{imageAlignment}};}'
					]
				]
			),
			'imageHoverEffect'  => array(
				'type'    => 'string',
				'default' => 'rtrb-img-effect-none',
			),

			//content
			'nameDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'nameText'   => array(
				'type'    => 'string',
				'default' => 'Leslie Alexander',
			),
			'designationDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'designationText'   => array(
				'type'    => 'string',
				'default' => 'Senior Artist',
			),
			'bioDisplay'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'bioText'   => array(
				'type'    => 'string',
				'default' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy',
			),

			'contentAlignment' => array(
				'type' => 'object',
				'default' => [],
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content {text-align: {{contentAlignment}}; }'
					]
				]
			),
			'nameTagName'   => array(
				'type'    => 'string',
				'default' => 'h3',
			),

			//social icons
			'socialIconDisplay'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'socialIcons' => [
				'type' => "array",
				'default' => [
					[
						"title" => "Facebook",
						"color" => "",
						"background" => "",
						"url" => "https://www.facebook.com/radiustheme/",
						"icon" => "facebook-f"
					],
					[
						"title" => "Twitter",
						"color" => "",
						"background" => "",
						"url" => "https://twitter.com/radiustheme/",
						"icon" => "twitter"
					],
					[
						"title" => "Instagram",
						"color" => "",
						"background" => "",
						"url" => "https://www.instagram.com/radiustheme/",
						"icon" => "instagram"
					],
					[
						"title" => "Linkedin",
						"color" => "",
						"background" => "",
						"url" => "https://www.linkedin.com/company/radiustheme/",
						"icon" => "linkedin-in"
					],
					[
						"title" => "Youtube",
						"color" => "",
						"background" => "",
						"url" => "https://www.youtube.com/c/RadiusTheme",
						"icon" => "youtube"
					],
				],
			],
			'socialOpenWindow'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'socialNofollow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

			//spacing
			'spacingImageContent' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__inner {gap:{{spacingImageContent}}; }'
					]
				]
			],

			//wrapper link
			'wrapperLink'   => array(
				'type'    => 'string',
				'default' => '',
			),
			'wrapperNofollow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'wrapperOpenWindow'   => array(
				'type'    => 'boolean',
				'default' => false,
			),

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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img{{imageMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img{{imagePadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img{border-style:{{imageBorderStyle}};}'
					]
				]
			),

			'imageHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img:hover{border-style:{{imageHoverBorderStyle}};}'
					]
				]
			),

			'imageBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img{border-color:{{imageBorderColor}};}'
					]
				]
			),
			'imageHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img:hover{border-color:{{imageHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img{{imageBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img:hover{{imageHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img{{imageRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__img:hover{{imageHoverRadius}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team .rtrb-team__img::after,{{RTRB}}.rtrb-block .rtrb-team .rtrb-team__img::before{background: {{imageOverlayBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team .rtrb-team__img::after,{{RTRB}}.rtrb-block .rtrb-team .rtrb-team__img::before{background: {{imageOverlayGradientColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team .rtrb-team__img::before{background: {{imageOverlayHoverBGColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team .rtrb-team__img::before{background: {{imageOverlayHoverGradientColor}}; }'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-team__member-name']
				],
			],
			'nameColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__member-name{color: {{nameColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__member-name{{namePadding}}'
					]
				]
			),

			'seperatorColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-name-seperator{background-color: {{seperatorColor}}; }'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-team__member-designation']
				],
			],
			'designationColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__member-designation {color: {{designationColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__member-designation{{designationPadding}}'
					]
				]
			),

			//bio style
			'bioTypo' => [
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-team__content p']
				],
			],
			'bioColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content p {color: {{bioColor}}; }'
					]
				]
			),
			"bioPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content p{{bioPadding}}'
					]
				]
			),

			//content style
			'contentBackground'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content {background-color: {{contentBackground}}; }'
					]
				]
			),

			"contentPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content{{contentPadding}}'
					]
				]
			),

			'contentBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content{border-style:{{contentBorderStyle}};}'
					]
				]
			),

			'contentBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content{border-color:{{contentBorderColor}};}'
					]
				]
			),

			"contentBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content{{contentBorderWidth}}'
					]
				]
			),

			"contentRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__content{{contentRadius}}'
					]
				]
			),

			//social icons style
			'socialIconColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a {color: {{socialIconColor}}; }'
					]
				]
			),
			'socialIconHoverColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a:hover {color: {{socialIconHoverColor}} !important; }'
					]
				]
			),
			'socialIconBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a {background-color: {{socialIconBGColor}}; }'
					]
				]
			),
			'socialIconHoverBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a:hover {background-color: {{socialIconHoverBGColor}} !important; }'
					]
				]
			),
			'socialIconSize' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a {font-size:{{socialIconSize}}; }'
					]
				]
			],
			'socialIconGap' => [
				'type' => 'object',
				'default' => (object)[
					'lg' => '',
					'unit' => 'px'
				],
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area .rtrb-social, {{RTRB}}.rtrb-block .rtrb-team__social-area ul > li > ul {gap:{{socialIconGap}}; }'
					]
				]
			],

			"socialIconPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a {{socialIconPadding}}'
					]
				]
			),

			'socialIconBorderType'  => array(
				'type'    => 'string',
				'default' => 'normal',
			),
			'socialIconBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a{border-style:{{socialIconBorderStyle}};}'
					]
				]
			),

			'socialIconHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a:hover{border-style:{{socialIconHoverBorderStyle}};}'
					]
				]
			),

			'socialIconBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a{border-color:{{socialIconBorderColor}};}'
					]
				]
			),
			'socialIconHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a:hover{border-color:{{socialIconHoverBorderColor}};}'
					]
				]
			),

			"socialIconBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a{{socialIconBorderWidth}}'
					]
				]
			),

			"socialIconHoverBorderWidth" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a:hover{{socialIconHoverBorderWidth}}'
					]
				]
			),

			"socialIconRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a{{socialIconRadius}}'
					]
				]
			),

			"socialIconHoverRadius" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area li a:hover{{socialIconHoverRadius}}'
					]
				]
			),

			'socialContainerBGType'   => array(
				'type'    => 'string',
				'default' => 'classic',
			),
			'socialContainerBGColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'socialContainerBGType', 'condition' => '==', 'value' => 'classic'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area{background: {{socialContainerBGColor}}; }'
					]
				]
			),
			'socialContainerGradientColor'  => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'depends' => [
							(object)['key' => 'socialContainerBGType', 'condition' => '==', 'value' => 'gradient'],
						],
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area{background: {{socialContainerGradientColor}}; }'
					]
				]
			),

			"socialContainerMargin" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area{{socialContainerMargin}}'
					]
				]
			),
			"socialContainerPadding" => array(
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team__social-area{{socialContainerPadding}}'
					]
				]
			),
			'socialShareBarColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style' => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team--style-3 .rtrb-social:after{background: {{socialShareBarColor}}; }'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team{{mainWrapMargin}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team{{mainWrapPadding}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team:hover'
					],
				]
			),

			'mainWrapHoverBGTransition'   => array(
				'type'    => 'number',
				'default' => 0.5,
				'style' => [
					(object)[
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team{ 
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team::before'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team::before{
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team{border-style:{{mainWrapBorderStyle}};}'
					]
				]
			),

			'mainWrapBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team{border-color:{{mainWrapBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team{{mainWrapBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team{{mainWrapRadius}}'
					]
				]
			),

			'mainWrapHoverBorderStyle'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team:hover{border-style:{{mainWrapHoverBorderStyle}};}'
					]
				]
			),

			'mainWrapHoverBorderColor'   => array(
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team:hover{border-color:{{mainWrapHoverBorderColor}};}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team:hover{{mainWrapHoverBorderWidth}}'
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
						'selector' => '{{RTRB}}.rtrb-block .rtrb-team:hover{{mainWrapHoverRadius}}'
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
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-team']
				],
			],

			'mainWrapHoverShadow' => [
				'type' => 'object',
				'default' => (object)['openShadow' => 1, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1], 'color' => '', 'inset' => false, 'transition' => 0.5],
				'style' => [
					(object)['selector' => '{{RTRB}}.rtrb-block .rtrb-team:hover']
				],
			],

		);
		return apply_filters('rtrb_block_attributes', $attributes);
	}

	public function register_team()
	{
		register_block_type(
			RTRB_PATH_BLOCKS . 'team',
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
		$layoutArray = ['1', '4', '6'];
		$layout = isset($settings['layout']) ? $settings['layout'] : '1';
		if (in_array($layout, $layoutArray, true)) {
			$layout = '1-4-6';
		}

		$data = [
			'template'              => 'blocks/team/layout-' . $layout,
			'settings'              => $settings,
			'default_template_path' => null,
		];

		$data = apply_filters('rtrb_team_block_data', $data);
		return Fns::get_template_html($data['template'], $data, '', $data['default_template_path']);
	}
}
