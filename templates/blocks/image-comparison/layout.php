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

$labelPostionClass = !$settings['varticalMode'] ? 'rtrb-label-vertical-' . $settings['labelsPositionV']
	: 'rtrb-label-horizontal-' . $settings['labelsPositionH'];

$varticalMode = !empty($settings['varticalMode']) ? 'true' : 'false';
$displayLabels = !empty($settings['displayLabels']) ? 'true' : 'false';
$mouseHover = !empty($settings['mouseHover']) ? 'true' : 'false';
$noHandle = !empty($settings['noHandle']) ? 'true' : 'false';
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="rtrb-image-comparison rtrb-image-comparison-style-<?php echo esc_attr($settings['layout']); ?>">
		<div class="rtrb-image-comparison-wrapper <?php echo esc_attr($labelPostionClass); ?>" data-left-image="<?php echo esc_attr($settings['beforeImageUrl']); ?>" data-right-image="<?php echo esc_attr($settings['afterImageUrl']); ?>" data-vertical-mode="<?php echo esc_attr($varticalMode); ?>" data-hover="<?php echo esc_attr($mouseHover); ?>" data-show-label="<?php echo esc_attr($displayLabels); ?>" data-left-label="<?php echo esc_attr($settings['beforeLabel']); ?>" data-right-label="<?php echo esc_attr($settings['afterLabel']); ?>" data-slider-position="<?php echo esc_attr($settings['handlerLinePosition']); ?>" data-line-width="<?php echo esc_attr($settings['handlerLineWidth']); ?>" data-line-color="<?php echo esc_attr($settings['lineColor']); ?>" data-handle="<?php echo esc_attr($noHandle); ?>">
			<?php
			if (!empty($settings['beforeImageUrl']) && !empty($settings['afterImageUrl'])) { ?>
				<div data-testid="container">
					<img alt="Left Image" src="<?php echo esc_url($settings['beforeImageUrl']); ?>" data-testid="left-image" />
					<img alt="Right Image" src="<?php echo esc_url($settings['afterImageUrl']); ?>" data-testid="right-image" />
				</div>
			<?php }
			?>
		</div>
	</div>
</div>