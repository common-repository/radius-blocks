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

$block_wrap_class = 'rtrb-advanced-image';
if (isset($settings['imageStyle']) && !empty($settings['imageStyle'])) {
	$block_wrap_class .= ' rtrb-image-style-' . $settings['imageStyle'];
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

$block_item_class = 'rtrb-img-area';
if (isset($settings['mainImageHoverEffect']) && !empty($settings['mainImageHoverEffect'])) {
	$block_item_class .= ' ' . $settings['mainImageHoverEffect'];
}

$target = '_self';
if ($settings['imageOpenWindow']) {
	$target = '_blank';
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<?php
		if (!empty($settings['image'])) {
			$image = $settings['image'];
		?>

			<?php if ($settings['enableLink']) { ?>
				<a target="<?php echo esc_attr($target); ?>" href="<?php echo $settings['imageLink'] ? esc_url($settings['imageLink']) : "javascript:void(0)"; ?>" class="<?php echo esc_attr($block_item_class); ?>">
				<?php } else { ?>
					<div class="<?php echo esc_attr($block_item_class); ?>">
					<?php }; ?>

					<figure class="rtrb-img-inner rtrb-img-wrap">
						<img class="rtrb-img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						<?php if ($settings['captionDisplay'] && !empty($image['caption'])) : ?>
							<figcaption class="rtrb-img-caption-wrap">
								<span class="rtrb-caption">
									<?php echo Fns::rtrb_kses_basic($image['caption']); ?>
								</span>
							</figcaption>
						<?php endif; ?>
					</figure>

					<?php if ($settings['enableLink']) {
						echo "</a>";
					} else {
						echo "</div>";
					} ?>

				<?php } ?>
					</div>
	</div>