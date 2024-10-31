<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action('rtrb/builder/before_header'); ?>
	<header class="rtrb-builder-content rtrb-builder-content-header rtrb-builder-theme-support">
		<?php \RadiusTheme\RB\Helpers\Fns::render_builder_content('header'); ?>
	</header>
	<?php do_action('rtrb/builder/after_header'); ?>