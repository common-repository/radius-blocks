<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = '';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
$wrap_class .= ' rtrb-block rtrb-block-frontend';

$button_class = 'rtrb-button';
if (isset($settings['buttonType']) && !empty($settings['buttonType'])) {
	$button_class .= ' ' . $settings['buttonType'];
}
if (isset($settings['buttonSize']) && !empty($settings['buttonSize'])) {
	$button_class .= ' ' . $settings['buttonSize'];
}
if (isset($settings['buttonHoverEffect']) && !empty($settings['buttonHoverEffect'])) {
	$button_class .= ' ' . $settings['buttonHoverEffect'];
}

if (isset($settings['buttonIconHoverEffect']) && !empty($settings['buttonIconHoverEffect'])) {
	$button_class .= ' ' . $settings['buttonIconHoverEffect'];
}

$target = '_self';
if ($settings['buttonOpenWindow']) {
	$target = '_blank';
}
$nofollow = '';
if ($settings['buttonNofollow']) {
	$nofollow = 'nofollow';
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="rtrb-button-wrapper">

		<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" href="<?php echo esc_url($settings['buttonURL']); ?>" class="<?php echo esc_attr($button_class); ?> ">

			<?php if (!empty($settings['buttonText'])) : ?>
				<span class="rt-btn-text"><?php echo Fns::rtrb_kses_basic($settings['buttonText']); ?></span>
			<?php endif;  ?>

			<?php if ($settings['buttonType'] === 'rt-position-aware-btn') : ?>
				<span class='rt-aware'></span>
			<?php endif;  ?>

			<?php if ($settings['iconEnable'] && !empty($button_icon) && $settings['buttonIconType'] == 'icon') : ?>
				<span class="rt-btn-icon">
					<?php echo Fns::rtrb_kses_intermediate($button_icon); ?>
				</span>
			<?php endif;  ?>

			<?php if ($settings['iconEnable'] && !empty($settings['imageUrl']) && $settings['buttonIconType'] == 'image') : ?>
				<span class="rt-btn-icon">
					<img src="<?php echo esc_url($settings['imageUrl']); ?>" alt="<?php echo Fns::rtrb_kses_basic($settings['buttonText']); ?>">
				</span>
			<?php endif;  ?>

		</a>
	</div>

</div>