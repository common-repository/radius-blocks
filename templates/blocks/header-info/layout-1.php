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

$block_wrap_class = 'rtrb-header-info';
if (isset($settings['mainWrapBGOverlayEnable']) && !empty($settings['mainWrapBGOverlayEnable'])) {
	$block_wrap_class .= ' rtrb-overlay';
}
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-header-info-style-' . $settings['layout'];
}

?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<?php if (!empty($settings['infoLists'])) { ?>
			<div class="rtrb-header-info-layout <?php echo esc_attr($settings['layoutType']); ?>">

				<?php foreach ($settings['infoLists'] as $iconList) { ?>
					<!-- link check -->
					<?php if (isset($iconList['link']) && $iconList['link']) { ?>
						<a target="<?php echo $iconList['openWindow'] ? esc_attr("_blank") : ''; ?>" href="<?php echo esc_url($iconList['url']); ?>" class="rtrb-header-info-item">
						<?php } else {  ?>
							<div class="rtrb-header-info-item">
							<?php }; ?>
							<!-- link check end -->
							<?php
							$icon = !empty($iconList['icon']) ? Fns::render_svg_html($iconList['icon']) : '';
							$globalIcon = !empty($settings['listIcon']) ? Fns::render_svg_html($settings['listIcon']) : '';
							?>

							<?php if ($settings['iconPosition'] == 'before' && !$iconList['overrideMedia'] && $settings['mediaType'] == 'icon' && !empty($globalIcon)) : ?>
								<span class="rtrb-media rtrb-icon"><?php echo Fns::rtrb_kses_intermediate($globalIcon); ?></span>
							<?php endif; ?>

							<?php if ($settings['iconPosition'] == 'before' && $iconList['overrideMedia'] && $iconList['mediaType'] == 'icon' && !empty($icon)) : ?>
								<span class="rtrb-media rtrb-icon"><?php echo Fns::rtrb_kses_intermediate($icon); ?></span>
							<?php endif; ?>

							<?php if ($settings['iconPosition'] == 'before' && $iconList['overrideMedia'] && $iconList['mediaType'] == 'image' && !empty($iconList['image']['url'])) : ?>
								<span class="rtrb-media rtrb-image">
									<img src="<?php echo esc_url($iconList['image']['url']);  ?>" alt="<?php echo esc_attr($iconList['label']); ?>">
								</span>
							<?php endif; ?>

							<?php if ($settings['iconPosition'] == 'before' && !$iconList['overrideMedia'] && $settings['mediaType'] == 'image' && !empty($settings['imageUrl'])) : ?>
								<span class="rtrb-media rtrb-image">
									<img src="<?php echo esc_url($settings['imageUrl']);  ?>" alt="<?php echo esc_attr($iconList['label']); ?>">
								</span>
							<?php endif; ?>

							<?php if ($settings['displayLabel']) : ?>
								<span class="rtrb-label"><?php echo Fns::rtrb_kses_basic($iconList['label']); ?></span>
							<?php endif; ?>

							<?php if ($settings['iconPosition'] == 'after' && !$iconList['overrideMedia'] && $settings['mediaType'] == 'icon' && !empty($globalIcon)) : ?>
								<span class="rtrb-media rtrb-icon"><?php echo Fns::rtrb_kses_intermediate($globalIcon); ?></span>
							<?php endif; ?>

							<?php if ($settings['iconPosition'] == 'after' && $iconList['overrideMedia'] && $iconList['mediaType'] == 'icon' && !empty($icon)) : ?>
								<span class="rtrb-media rtrb-icon"><?php echo Fns::rtrb_kses_intermediate($icon); ?></span>
							<?php endif; ?>

							<?php if ($settings['iconPosition'] == 'after' && $iconList['overrideMedia'] && $iconList['mediaType'] == 'image' && !empty($iconList['image']['url'])) : ?>
								<span class="rtrb-media rtrb-image">
									<img src="<?php echo esc_url($iconList['image']['url']);  ?>" alt="<?php echo esc_attr($iconList['label']); ?>">
								</span>
							<?php endif; ?>

							<?php if ($settings['iconPosition'] == 'after' && !$iconList['overrideMedia'] && $settings['mediaType'] == 'image' && !empty($settings['imageUrl'])) : ?>
								<span class="rtrb-media rtrb-image">
									<img src="<?php echo esc_url($settings['imageUrl']);  ?>" alt="<?php echo esc_attr($iconList['label']); ?>">
								</span>
							<?php endif; ?>

							<!-- link check -->
							<?php if (isset($iconList['link']) && $iconList['link']) { ?>
						</a>
					<?php } else {  ?>
			</div>
			<!-- link check end -->
		<?php } ?>

	<?php } ?>
	</div>
<?php } ?>

</div>
</div>