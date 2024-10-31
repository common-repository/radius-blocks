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

$block_wrap_class = 'rtrb-icon-box';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-icon-box--style-' . $settings['layout'];
}
if (isset($settings['iconHoverEffect']) && !empty($settings['iconHoverEffect'])) {
	$block_wrap_class .= ' ' . $settings['iconHoverEffect'];
}
if (isset($settings['bgHoverEffect']) && !empty($settings['bgHoverEffect'])) {
	$block_wrap_class .= ' ' . $settings['bgHoverEffect'];
}

?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="<?php echo esc_attr($block_wrap_class); ?>">
		<div class="rt-icon-box-bg"></div>
		<div class="rtrb-icon-box__inner">

			<?php if (($settings['mediaType'] !== 'none') && (!empty($box_icon) || $settings['mediaType'] === 'image')) : ?>
				<div class="rtrb-icon-box__media rtrb-icon-box__media--<?php echo esc_attr($settings['mediaType']); ?>">
					<?php if ($settings['mediaType'] == 'icon' && !empty($box_icon)) : ?>
						<span class="rtrb-icon-box__icon"><?php echo Fns::rtrb_kses_intermediate($box_icon); ?></span>
					<?php endif ?>
					<?php if ($settings['mediaType'] == 'image' && !empty($settings['imageUrl'])) : ?>
						<img class="rtrb-icon-box__image" src="<?php echo esc_url($settings['imageUrl']); ?>" alt="image">
					<?php endif ?>
				</div>
			<?php endif ?>

			<div class="rtrb-icon-box__content">
				<?php if ($settings['titleDisplay'] && !empty('titleText')) : ?>
					<?php echo '<' . esc_html($settings['titleTag']) . ' class="rtrb-icon-box__title rtrb-tag">'; ?>
					<?php echo Fns::rtrb_kses_basic($settings['titleText']); ?>
					<?php echo '</' . esc_html($settings['titleTag']) . '>' ?>
				<?php endif ?>
			</div>

		</div>
	</div>

</div>