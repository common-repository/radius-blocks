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

$block_wrap_class = 'rtrb-swiper-container rtrb-testimonial-slider';
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

<?php if (!empty($settings['testimonials'])) { ?>
	<?php foreach ($settings['testimonials'] as $testimonial_item) { ?>
		<div class="swiper-slide">
			<div class="rtrb-testimonial <?php echo esc_attr('rtrb-testimonial--style-' . $settings['layout']); ?>">
				<div class="rtrb-testimonial__content">
					<?php if ($settings['messageDisplay'] && !empty($testimonial_item['message'])) : ?>
						<div class="rtrb-testimonial__description">
							<p>
								<?php echo Fns::rtrb_kses_basic($testimonial_item['message']); ?>
							</p>
						</div>
					<?php endif; ?>
				</div>

				<div class="rtrb-testimonial__author">
					<?php if ($settings['imageDisplay']) : ?>
						<div class="rtrb-testimonial__author-img">
							<img src="<?php echo esc_url($testimonial_item['imageUrl']); ?>" alt="testimonial" loading="lazy">
						</div>
					<?php endif; ?>

					<?php if ($settings['nameDisplay'] && !empty($testimonial_item['name'])) : ?>
						<?php echo '<' . esc_html($settings['nameTagName']) . ' class="rtrb-testimonial__author-name rtrb-tag">'; ?>
						<?php echo Fns::rtrb_kses_basic($testimonial_item['name']); ?>
						<?php echo '</' . esc_html($settings['nameTagName']) . '>' ?>
					<?php endif; ?>

					<?php if ($settings['designationDisplay'] && !empty($testimonial_item['designation'])) : ?>
						<span class="rtrb-testimonial__author-designation"><?php echo esc_html($testimonial_item['designation']); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php } ?>
<?php } ?>

<?php
$footer_data = [
	'template'              => 'blocks/slider-header-footer/footer',
	'settings'              => $settings,
	'default_template_path' => null,
];
Fns::get_template($footer_data['template'], $footer_data, '', $footer_data['default_template_path']);
?>