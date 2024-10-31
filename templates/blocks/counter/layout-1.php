<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = '';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
$wrap_class .= ' rtrb-block rtrb-block-frontend';

$block_wrap_class = 'rtrb-counter';
if (isset($settings['layout'])) {
	$block_wrap_class .= ' rtrb-counter--style-' . $settings['layout'];
}

?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<div class="rtrb-counter__inner">
			<?php if (($settings['mediaType'] !== 'none') && ($box_icon || ($settings['mediaType'] === 'image'))) : ?>
				<div class="rtrb-counter__media rtrb-counter__media--<?php echo esc_attr($settings['mediaType']); ?>">

					<?php if ($settings['mediaType'] == 'icon') : ?>
						<span class="rtrb-counter__icon"><?php echo Fns::rtrb_kses_intermediate($box_icon); ?></span>
					<?php endif ?>
					<?php if ($settings['mediaType'] == 'image') : ?>
						<img class="rtrb-counter__image" src="<?php echo esc_url($settings['imageUrl']); ?>" alt="image">
					<?php endif ?>

				</div>
			<?php endif ?>

			<div class="rtrb-counter__content">

				<?php if (!empty('numberValue')) : ?>
					<div class="rtrb-counter__number-wrap" style="--odo-duration: <?php echo esc_attr($settings['numberAnimationDuration']); ?>ms">
						<?php if ($settings['prefixDisplay'] && !empty('prefixValue')) : ?>
							<span class="rt-counter-prefix"><?php echo Fns::rtrb_kses_basic($settings['prefixValue']); ?></span>
						<?php endif ?>
						<div class="rtrb-count-number rtrb-counter__number" data-count="<?php echo esc_attr($settings['numberValue']); ?>" data-format="<?php echo esc_attr($settings['counterFormat']); ?>" data-duration="<?php echo esc_attr($settings['numberAnimationDuration']); ?>">
							<?php echo Fns::rtrb_kses_basic($settings['numberValue']); ?>
						</div>
						<?php if ($settings['suffixDisplay'] && !empty('suffixValue')) : ?>
							<span class="rt-counter-suffix"><?php echo Fns::rtrb_kses_basic($settings['suffixValue']); ?></span>
						<?php endif ?>
					</div>
				<?php endif ?>
				<?php if (!empty('titleText')) : ?>
					<?php echo '<' . esc_html($settings['titleTag']) . ' class="rtrb-counter__title">'; ?>
					<?php echo Fns::rtrb_kses_basic($settings['titleText']); ?>
					<?php echo '</' . esc_html($settings['titleTag']) . '>' ?>
				<?php endif ?>

			</div>

		</div>
	</div>

</div>