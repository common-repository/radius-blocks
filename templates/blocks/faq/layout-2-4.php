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

$block_wrap_class = 'rtrb-accordion';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-accordion--faq-' . $settings['layout'];
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<div class="rtrb-accordion__list" data-accordionType="<?php echo esc_attr($settings['accordionType']); ?>">
			<?php
			$accordions = !empty($settings['accordions']) ? $settings['accordions'] : [];

			if (!empty($accordions)) {
				foreach ($accordions as $index => $accordion) {
					$exp_tab = Fns::is_expanded_item($settings, $index) ? 'rt-expand-tab' : '';
			?>

					<div class="rtrb-accordion__item <?php echo esc_attr($exp_tab); ?>">

						<div class="rtrb-accordion__header">
							<div class="rtrb-accordion-title-wrap">
								<?php if (!empty($accordion['title'])) : ?>
									<?php echo '<' . esc_html($settings['titleTagName']) . ' class="rtrb-accordion-title rtrb-tag">'; ?>
									<?php echo Fns::rtrb_kses_basic($accordion['title']); ?>
									<?php echo '</' . esc_html($settings['titleTagName']) . '>' ?>
								<?php endif; ?>
							</div>

							<?php if ($settings['displayIcon'] && (!empty($faqIcon) || !empty($faqExpandedIcon))) : ?>
								<div class="rt-accordion-icon-wrap">

									<?php if (!empty($faqIcon)) : ?>
										<span class="rt-accordion-icon rt-expand-icon">
											<?php echo Fns::rtrb_kses_intermediate($faqIcon); ?>
										</span>
									<?php endif; ?>

									<?php if (!empty($faqExpandedIcon)) : ?>
										<span class="rt-accordion-icon rt-tab-icon">
											<?php echo Fns::rtrb_kses_intermediate($faqExpandedIcon); ?>
										</span>
									<?php endif; ?>

								</div>
							<?php endif; ?>

						</div>

						<?php if (!empty($accordion['content'])) : ?>
							<div class="rtrb-accordion__content">
								<div class="rt-widget">
									<p class="rtrb-content">
										<?php echo Fns::rtrb_kses_basic($accordion['content']); ?>
									</p>
								</div>
							</div>
						<?php endif; ?>

					</div>
			<?php }
			}
			?>
		</div>
		<!-- end rtrb-accordion__list -->
	</div>
	<!-- end rtrb-accordion -->

</div>