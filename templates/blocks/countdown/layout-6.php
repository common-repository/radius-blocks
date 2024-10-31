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

$block_wrap_class = 'rtrb-countdown rtrbcd2';
if (isset($settings['layout'])) {
	$block_wrap_class .= ' rtrb-countdown--style-' . $settings['layout'];
}
$deadline = 0;
if (isset($settings['deadlineDateTime']) && !empty($settings['deadlineDateTime'])) {
	$deadline = $settings['deadlineDateTime'];
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>" data-deadline-date-time="<?php echo esc_attr($deadline); ?>">

		<?php if ($settings['daysDisplay']) : ?>
			<div class="rtrb-countdown__item rt-day">

				<?php if (isset($settings['daysText']) && !empty($settings['daysText'])) : ?>
					<span class="rtrb-countdown__count-text"><?php echo esc_html($settings['daysText']); ?></span>
				<?php endif; ?>

				<span class="rtrb-countdown__count">
					<span class="rtrb-countdown__single-digit rt-d1">0</span>
					<span class="rtrb-countdown__single-digit rt-d2">0</span>
					<span class="rtrb-countdown__single-digit rt-d3">0</span>
				</span>

			</div>
		<?php endif; ?>

		<?php if ($settings['hoursDisplay']) : ?>
			<div class="rtrb-countdown__item rt-hr">
				<?php if (isset($settings['hoursText']) && !empty($settings['hoursText'])) : ?>
					<span class="rtrb-countdown__count-text"><?php echo esc_html($settings['hoursText']); ?></span>
				<?php endif; ?>

				<span class="rtrb-countdown__count">
					<span class="rtrb-countdown__single-digit rt-h1">0</span>
					<span class="rtrb-countdown__single-digit rt-h2">0</span>
				</sp>
			</div>
		<?php endif; ?>

		<?php if ($settings['minutesDisplay']) : ?>
			<div class="rtrb-countdown__item rt-min">
				<?php if (isset($settings['minutesText']) && !empty($settings['minutesText'])) : ?>
					<span class="rtrb-countdown__count-text"><?php echo esc_html($settings['minutesText']); ?></span>
				<?php endif; ?>

				<span class="rtrb-countdown__count">
					<span class="rtrb-countdown__single-digit rt-m1">0</span>
					<span class="rtrb-countdown__single-digit rt-m2">0</span>
				</span>
			</div>
		<?php endif; ?>


		<?php if ($settings['secondsDisplay']) : ?>
			<div class="rtrb-countdown__item rt-sec">

				<?php if (isset($settings['secondsText']) && !empty($settings['secondsText'])) : ?>
					<span class="rtrb-countdown__count-text"><?php echo esc_html($settings['secondsText']); ?></span>
				<?php endif; ?>

				<span class="rtrb-countdown__count">
					<span class="rtrb-countdown__single-digit rt-s1">0</span>
					<span class="rtrb-countdown__single-digit rt-s2">0</span>
				</span>
			</div>
		<?php endif; ?>

	</div>
</div>