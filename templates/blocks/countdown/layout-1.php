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

$block_wrap_class = 'rtrb-countdown rtrbcd1';
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
				<span class="rtrb-countdown__count">00</span>
				<?php if (isset($settings['daysText']) && !empty($settings['daysText'])) : ?>
					<span class="rtrb-countdown__count-text"><?php echo esc_html($settings['daysText']); ?></span>
				<?php endif; ?>

				<?php if (($settings['layout'] == '4')) : ?>
					<span class="rt-ex-shape rt-ex-shape--one">
						<span></span>
					</span>
					<span class="rt-ex-shape rt-ex-shape--two">
						<span></span>
					</span>
				<?php endif; ?>

				<?php if (($settings['layout'] == '5')) : ?>
					<div class="rtrb-circle-canvas">
						<svg width="<?php echo esc_attr($settings['countBoxCircleSize']);  ?>" height="<?php echo esc_attr($settings['countBoxCircleSize']);  ?>">
							<circle r="<?php echo ((($settings['countBoxCircleSize']) / 2) - (($settings['circleStrokeWidth']) / 2))  ?>" cx="<?php echo ((($settings['countBoxCircleSize']) / 2)); ?>" cy="<?php echo ((($settings['countBoxCircleSize']) / 2)); ?>" class="rtCircleTrack rtCircleTrackDown rtDay">
							</circle>
							<circle r="<?php echo ((($settings['countBoxCircleSize']) / 2) - (($settings['circleStrokeWidth']) / 2))  ?>" cx="<?php echo ((($settings['countBoxCircleSize']) / 2)); ?>" cy="<?php echo ((($settings['countBoxCircleSize']) / 2)); ?>" class="rtCircleTrack rtCircleTrackUp rtDay">
							</circle>
						</svg>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ($settings['hoursDisplay']) : ?>
			<div class="rtrb-countdown__item rt-hr">
				<span class="rtrb-countdown__count">00</span>
				<?php if (isset($settings['hoursText']) && !empty($settings['hoursText'])) : ?>
					<span class="rtrb-countdown__count-text"><?php echo esc_html($settings['hoursText']); ?></span>
				<?php endif; ?>

				<?php if (($settings['layout'] == '4')) : ?>
					<span class="rt-ex-shape rt-ex-shape--one">
						<span></span>
					</span>
					<span class="rt-ex-shape rt-ex-shape--two">
						<span></span>
					</span>
				<?php endif; ?>

				<?php if (($settings['layout'] == '5')) : ?>
					<div class="rtrb-circle-canvas">
						<svg width="<?php echo esc_attr($settings['countBoxCircleSize']);  ?>" height="<?php echo esc_attr($settings['countBoxCircleSize']);  ?>">
							<circle r="<?php echo ((($settings['countBoxCircleSize']) / 2) - (($settings['circleStrokeWidth']) / 2))  ?>" cx="<?php echo ((($settings['countBoxCircleSize']) / 2)); ?>" cy="<?php echo ((($settings['countBoxCircleSize']) / 2)); ?>" class="rtCircleTrack rtCircleTrackDown rtHr">
							</circle>
							<circle r="<?php echo ((($settings['countBoxCircleSize']) / 2) - (($settings['circleStrokeWidth']) / 2))  ?>" cx="<?php echo ((($settings['countBoxCircleSize']) / 2)); ?>" cy="<?php echo ((($settings['countBoxCircleSize']) / 2)); ?>" class="rtCircleTrack rtCircleTrackUp rtHr">
							</circle>
						</svg>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ($settings['minutesDisplay']) : ?>
			<div class="rtrb-countdown__item rt-min">
				<span class="rtrb-countdown__count">00</span>
				<?php if (isset($settings['minutesText']) && !empty($settings['minutesText'])) : ?>
					<span class="rtrb-countdown__count-text"><?php echo esc_html($settings['minutesText']); ?></span>
				<?php endif; ?>

				<?php if (($settings['layout'] == '4')) : ?>
					<span class="rt-ex-shape rt-ex-shape--one">
						<span></span>
					</span>
					<span class="rt-ex-shape rt-ex-shape--two">
						<span></span>
					</span>
				<?php endif; ?>

				<?php if (($settings['layout'] == '5')) : ?>
					<div class="rtrb-circle-canvas">

						<svg width="<?php echo esc_attr($settings['countBoxCircleSize']);  ?>" height="<?php echo esc_attr($settings['countBoxCircleSize']);  ?>">

							<circle r="<?php echo ((($settings['countBoxCircleSize']) / 2) - (($settings['circleStrokeWidth']) / 2))  ?>" cx="<?php echo ((($settings['countBoxCircleSize']) / 2))  ?>" cy="<?php echo ((($settings['countBoxCircleSize']) / 2))  ?>" class="rtCircleTrack rtCircleTrackDown rtMin">
							</circle>
							<circle r="<?php echo ((($settings['countBoxCircleSize']) / 2) - (($settings['circleStrokeWidth']) / 2))  ?>" cx="<?php echo ((($settings['countBoxCircleSize']) / 2))  ?>" cy="<?php echo ((($settings['countBoxCircleSize']) / 2))  ?>" class="rtCircleTrack rtCircleTrackUp rtMin">
							</circle>

						</svg>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ($settings['secondsDisplay']) : ?>
			<div class="rtrb-countdown__item rt-sec">
				<span class="rtrb-countdown__count">00</span>
				<?php if (isset($settings['secondsText']) && !empty($settings['secondsText'])) : ?>
					<span class="rtrb-countdown__count-text"><?php echo esc_html($settings['secondsText']); ?></span>
				<?php endif; ?>

				<?php if (($settings['layout'] == '4')) : ?>
					<span class="rt-ex-shape rt-ex-shape--one">
						<span></span>
					</span>
					<span class="rt-ex-shape rt-ex-shape--two">
						<span></span>
					</span>
				<?php endif; ?>

				<?php if (($settings['layout'] == '5')) : ?>
					<div class="rtrb-circle-canvas">
						<svg width="<?php echo esc_attr($settings['countBoxCircleSize']);  ?>" height="<?php echo esc_attr($settings['countBoxCircleSize']);  ?>">

							<circle r="<?php echo ((($settings['countBoxCircleSize']) / 2) - (($settings['circleStrokeWidth']) / 2))  ?>" cx="<?php echo ((($settings['countBoxCircleSize']) / 2))  ?>" cy="<?php echo ((($settings['countBoxCircleSize']) / 2))  ?>" class="rtCircleTrack rtCircleTrackDown rtSec">
							</circle>
							<circle r="<?php echo ((($settings['countBoxCircleSize']) / 2) - (($settings['circleStrokeWidth']) / 2))  ?>" cx="<?php echo ((($settings['countBoxCircleSize']) / 2))  ?>" cy="<?php echo ((($settings['countBoxCircleSize']) / 2))  ?>" class="rtCircleTrack rtCircleTrackUp rtSec">
							</circle>

						</svg>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</div>