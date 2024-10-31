<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = '';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
$wrap_class .= ' rtrb-block rtrb-progressbar-area rtrb-block-frontend';

$block_wrap_class = 'rtrb-progressbar';
if (!empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-pb-' . $settings['layout'];
}
if ($settings['stripeDisplay']) {
	$block_wrap_class .= ' rtrb-pb-line-stripe';
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="rtrb-progressbar-wrapper rtrb-prgressbar-style-<?php echo esc_attr($settings['layout']); ?>">
		<div class="rtrb-progressbar-<?php echo esc_attr($settings['layout']); ?>-container">

			<?php if ($settings['layout'] === 'line' && $settings['labelDisplay'] && $settings['labelText']) : ?>
				<div class="rtrb-progressbar-label-wrap">
					<h4 class="rtrb-pb-label"><?php echo Fns::rtrb_kses_basic($settings['labelText']); ?></h4>
				</div>
			<?php endif; ?>

			<div class="<?php echo esc_attr($block_wrap_class); ?>" data-layout="<?php echo esc_attr($settings['layout']); ?>" data-count="<?php echo esc_attr($settings['progressCount']); ?>" data-duration="<?php echo esc_attr($settings['animationDuration']); ?>">

				<?php if ($settings['layout'] === 'line') : ?>
					<?php if ($settings['progressCountDisplay']) : ?>
						<span class="rtrb-pb-count-wrap">
							<span class="rtrb-pb-count"><?php echo esc_html($settings['progressCount']); ?></span>
							<span class="postfix">%</span>
						</span>
					<?php endif; ?>
					<span class="rtrb-pb-line-fill"></span>
				<?php endif; ?>


				<?php if ($settings['layout'] === 'circle') : ?>
					<div class="rtrb-pb-circle-pie">
						<div class="rtrb-pb-circle-left rtrb-pb-circle-half"></div>
						<div class="rtrb-pb-circle-right rtrb-pb-circle-half"></div>
					</div>

					<div class="rtrb-pb-circle-inner"></div>

					<div class="rtrb-pb-circle-inner-content">
						<?php if ($settings['progressCountDisplay']) : ?>
							<span class="rtrb-pb-count-wrap">
								<span class="rtrb-pb-count"><?php echo esc_html($settings['progressCount']); ?></span>
								<span class="postfix">%</span>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>


				<?php if ($settings['layout'] === 'half_circle') : ?>
					<div class="rtrb-pb-circle">
						<div class="rtrb-pb-circle-pie">
							<div class="rtrb-pb-circle-half" ref={circle_half}></div>
						</div>
						<div class="rtrb-pb-circle-inner"></div>
					</div>

					<div class="rtrb-pb-circle-inner-content">
						<?php if ($settings['progressCountDisplay']) : ?>
							<span class="rtrb-pb-count-wrap">
								<span class="rtrb-pb-count">><?php echo esc_html($settings['progressCount']); ?></span>
								<span class="postfix">%</span>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</div>

			<?php if ($settings['layout'] === 'circle' && $settings['labelDisplay'] && $settings['labelText']) : ?>
				<div class="rtrb-progressbar-label-wrap">
					<h4 class="rtrb-pb-label"><?php echo Fns::rtrb_kses_basic($settings['labelText']); ?></h4>
				</div>
			<?php endif; ?>

			<?php if ($settings['layout'] === 'half_circle' && $settings['labelDisplay'] && $settings['labelText']) : ?>
				<div class="rtrb-progressbar-label-wrap">
					<h4 class="rtrb-pb-label"><?php echo Fns::rtrb_kses_basic($settings['labelText']); ?></h4>
				</div>
			<?php endif; ?>
		</div>


	</div>
</div>