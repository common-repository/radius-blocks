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

$block_wrap_class = 'rtrb-button-wrapper rtrb-dual-button';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-dual-button--style-' . $settings['layout'];
}

$button_class = 'rt-dual-btn rtrb-button rt-fill-btn';

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
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" href="<?php echo esc_url($settings['buttonOneURL']); ?>" class="rt-dual-btn--one <?php echo esc_attr($button_class); ?> ">
			<?php if (!empty($settings['buttonOneText'])) : ?>
				<span class="rt-btn-text"><?php echo Fns::rtrb_kses_basic($settings['buttonOneText']); ?></span>
			<?php endif;  ?>

			<?php if ($settings['buttonOneIconEnable'] && !empty($button_one_icon)) : ?>
				<span class="rt-btn-icon">
					<?php echo Fns::rtrb_kses_intermediate($button_one_icon); ?>
				</span>
			<?php endif;  ?>
		</a>

		<?php if ($settings['connectorDisplay']) : ?>
			<span class="rt-dual-btn-connector">
				<span class="rt-dual-btn-connector__inner">
					<?php if (!empty($settings['connectorType']) && $settings['connectorType'] === 'text') : ?>
						<?php echo esc_html($settings['connectorText']); ?>
					<?php endif; ?>
					<?php if (!empty($settings['connectorType']) && $settings['connectorType'] === 'icon') : ?>
						<?php $connectorIcon = Fns::render_svg_html($settings['connectorIcon']); ?>
						<?php echo Fns::rtrb_kses_intermediate($connectorIcon);  ?>
					<?php endif; ?>
				</span>
			</span>
		<?php endif;  ?>

		<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" href="<?php echo esc_url($settings['buttonTwoURL']); ?>" class="rt-dual-btn--two <?php echo esc_attr($button_class); ?> ">
			<?php if (!empty($settings['buttonTwoText'])) : ?>
				<span class="rt-btn-text"><?php echo Fns::rtrb_kses_basic($settings['buttonTwoText']); ?></span>
			<?php endif;  ?>

			<?php if ($settings['buttonTwoIconEnable'] && !empty($button_two_icon)) : ?>
				<span class="rt-btn-icon">
					<?php echo Fns::rtrb_kses_intermediate($button_two_icon); ?>
				</span>
			<?php endif;  ?>
		</a>

	</div>

</div>