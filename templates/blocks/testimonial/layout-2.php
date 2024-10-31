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

$block_wrap_class = 'rtrb-testimonial';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-testimonial--style-' . $settings['layout'];
}

?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<div class="rtrb-testimonial__author">

			<?php if ($settings['imageDisplay'] && !empty($settings['imageUrl'])) : ?>
				<div class="rtrb-testimonial__author-img">
					<img src="<?php echo esc_url($settings['imageUrl']); ?>" alt="testimonial" loading="lazy">
				</div>
			<?php endif; ?>

			<?php if ($settings['nameDisplay'] && !empty($settings['nameText'])) : ?>
				<?php echo '<' . esc_html($settings['nameTagName']) . ' class="rtrb-testimonial__author-name rtrb-tag">'; ?>
				<?php echo Fns::rtrb_kses_basic($settings['nameText']); ?>
				<?php echo '</' . esc_html($settings['nameTagName']) . '>' ?>
			<?php endif; ?>

			<?php if ($settings['designationDisplay'] && !empty($settings['designationText'])) : ?>
				<span class="rtrb-testimonial__author-designation"><?php echo esc_html($settings['designationText']); ?></span>
			<?php endif; ?>

		</div>

		<?php if ($settings['messageDisplay'] && !empty($settings['messageText'])) : ?>
			<div class="rtrb-testimonial__content">

				<?php if ($settings['ratingDisplay']) : ?>
					<div class="rtrb-rating">
						<div class="rtrb-rating__inner">
							<div class="rtrb-star-rating">
								<span style="--rtrb-rating:<?php echo esc_html($settings['ratings'] * 20); ?>%"></span>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="rtrb-testimonial__description">
					<?php if ($settings['quoteDisplay'] && !empty($quote_icon)) : ?>
						<span class="rt-quote-icon">
							<?php echo Fns::rtrb_kses_intermediate($quote_icon); ?>
						</span>
					<?php endif; ?>
					<p>
						<?php echo Fns::rtrb_kses_basic($settings['messageText']); ?>
					</p>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>