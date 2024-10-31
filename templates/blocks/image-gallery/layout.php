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

$block_wrap_class = 'rtrb-img-gallery-wrapper';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-gallery-style-' . $settings['layout'];
}
if (isset($settings['gridPresetLayout'])) {
	$block_wrap_class .= ' ' . $settings['gridPresetLayout'];
}
if (isset($settings['captionPosition'])) {
	$block_wrap_class .= ' ' . $settings['captionPosition'];
}
if (isset($settings['overlayStyle'])) {
	$block_wrap_class .= ' ' . $settings['overlayStyle'];
}
if (isset($settings['imageHoverEffect'])) {
	$block_wrap_class .= ' ' . $settings['imageHoverEffect'];
}

$block_item_class = 'rtrb-img-gallery-item';
if (isset($settings['mainImageHoverEffect']) && !empty($settings['mainImageHoverEffect'])) {
	$block_item_class .= ' ' . $settings['mainImageHoverEffect'];
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="rtrb-img-gallery">
		<div class="<?php echo esc_attr($block_wrap_class); ?>">
			<?php
			if (!empty($settings['sources'])) {
				foreach ($settings['sources'] as $index => $source) {
					$dataCaption = '';
					if (!$settings['disableLightBoxCaption']) {
						$caption =  Fns::rtrb_kses_basic($source['caption']);
						$dataCaption = !empty($caption) ? "data-caption= $caption" : '';
					}
			?>
					<div class="rtrb-gallery-item">
						<a <?php echo esc_attr($dataCaption); ?> key="<?php echo esc_attr($index); ?>" <?php echo esc_attr(!$settings['disableLightBox'] ? "data-fancybox=rtrb-gallery" : ''); ?> href="<?php echo esc_attr(!$settings['disableLightBox'] ? $source['url'] : "javascript:void(0)"); ?>" class="<?php echo esc_attr($block_item_class); ?>">
							<span class="rtrb-img-gallery-wrap rtrb-img-wrap">
								<img class="rtrb-gallery-img" src="<?php echo esc_url($source['url']); ?>" image-index="<?php echo esc_attr($index); ?>" />
								<?php if ($settings['captionDisplay'] && !empty($source['caption'])) : ?>
									<span class="rtrb-img-caption-wrap">
										<span class="rtrb-caption">
											<?php echo Fns::rtrb_kses_basic($source['caption']); ?>
										</span>
									</span>
								<?php endif; ?>
							</span>
						</a>
					</div>

			<?php }
			}
			?>
		</div>
	</div>
</div>