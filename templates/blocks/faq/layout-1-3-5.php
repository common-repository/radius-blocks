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

$list_wrap_class = 'rtrb-faq-list';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$list_wrap_class .= ' rtrb-faq-list--style-' . $settings['layout'];
}

$item_wrap_class = 'rtrb-faq';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$item_wrap_class .= ' rtrb-faq--style-' . $settings['layout'];
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($list_wrap_class); ?>">

		<?php
		$faqs = !empty($settings['accordions']) ? $settings['accordions'] : [];
		if (!empty($faqs)) {
			foreach ($faqs as $index => $faq) {
		?>
				<div class="rtrb-faq-list__item">
					<div class="<?php echo esc_attr($item_wrap_class); ?>">
						<div class="rtrb-faq__inner">
							<?php if ($settings['displayIcon']) : ?>
								<span class="rtrb-faq__count"><?php echo isset($faq['count']) ? esc_html($faq['count']) :  sprintf("%02d", $index + 1); ?></span>
							<?php endif; ?>

							<div class="rtrb-faq__content">
								<?php if (!empty($faq['title'])) : ?>
									<?php echo '<' . esc_html($settings['titleTagName']) . ' class="rtrb-faq__title rtrb-tag">'; ?>
									<?php echo Fns::rtrb_kses_basic($faq['title']); ?>
									<?php echo '</' . esc_html($settings['titleTagName']) . '>' ?>
								<?php endif; ?>

								<?php if (!empty($faq['content'])) : ?>
									<p class="rtrb-faq__desc">
										<?php echo Fns::rtrb_kses_basic($faq['content']); ?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
		<?php
			}
		}
		?>
	</div>
</div>