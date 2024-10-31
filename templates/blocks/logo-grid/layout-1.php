<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = 'rtrb-block rtrb-block-frontend ';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}

$block_wrap_class = 'rtrb-logo-grid';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-logo-grid--style-' . $settings['layout'];
}
$block_class = 'rtrb-logo';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_class .= ' rtrb-logo--style-' . $settings['layout'];
}
$logo_grid = !empty($settings['logoGrid']) ? $settings['logoGrid'] : [];
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">
		<?php
		if (!empty($logo_grid)) {
			foreach ($logo_grid as $index => $logo) { ?>
				<div class="rtrb-logo-grid__item">
					<div class="<?php echo esc_attr($block_class); ?>">
						<div class="rtrb-logo__img rtrb-img-wrap">
							<img class="rtrb-logo__image" src="<?php echo esc_url($logo['imageUrl']) ?>" alt="brand" loading="lazy">
						</div>
						<?php if ($settings['logoNameDisplay']) : ?>
							<h4 class="rtrb-logo-brand-name"><?php echo Fns::rtrb_kses_basic($logo['brandName']); ?></h4>
						<?php endif; ?>
					</div>
				</div>
		<?php }
		} ?>
	</div>
</div>