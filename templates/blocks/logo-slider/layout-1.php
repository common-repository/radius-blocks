<?php

use RadiusTheme\RB\Helpers\Fns;

$block_wrap_class = 'rtrb-logo-slider';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-logo-slider-style-' . $settings['layout'];
}
$block_class = 'rtrb-logo';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_class .= ' rtrb-logo-style-' . $settings['layout'];
}
$logo_grid = !empty($settings['logoGrid']) ? $settings['logoGrid'] : [];
?>

<?php
$header_data = [
	'template'              => 'blocks/slider-header-footer/header',
	'settings'              => $settings,
	'block_wrap_class' => $block_wrap_class,
	'default_template_path' => null,
];
Fns::get_template($header_data['template'], $header_data, '', $header_data['default_template_path']);
?>

<?php
if (!empty($logo_grid)) {
	foreach ($logo_grid as $index => $logo) { ?>
		<div class="swiper-slide">
			<div class="rtrb-logo-slider__item">
				<div class="<?php echo esc_attr($block_class); ?>">
					<!-- link check -->
					<?php if (isset($logo['link']) && $logo['link']) { ?>
						<a class="rtrb-logo__img rtrb-img-wrap" href="<?php echo esc_url($logo['url']); ?>" target="<?php echo $logo['openWindow'] ? esc_attr("_blank") : ''; ?>">
						<?php } else {  ?>
							<div class="rtrb-logo__img rtrb-img-wrap">
							<?php }; ?>

							<img class="rtrb-logo__image" src="<?php echo esc_url($logo['imageUrl']) ?>" alt="brand" loading="lazy">
							<?php if ($settings['logoNameDisplay']) : ?>
								<h4 class="rtrb-logo-brand-name"><?php echo Fns::rtrb_kses_basic($logo['brandName']); ?></h4>
							<?php endif; ?>

							<!-- link check -->
							<?php if (isset($logo['link']) && $logo['link']) { ?>
						</a>
					<?php } else {  ?>
				</div>
			<?php } ?>
			<!-- link check end -->
			</div>
		</div>
		</div>
<?php }
} ?>

<?php
$footer_data = [
	'template'              => 'blocks/slider-header-footer/footer',
	'settings'              => $settings,
	'default_template_path' => null,
];
Fns::get_template($footer_data['template'], $footer_data, '', $footer_data['default_template_path']);
?>