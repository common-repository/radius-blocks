<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = '';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
$wrap_class .= ' rtrb-block rtrb-advanced-video-main-area rtrb-block-frontend';

$block_wrap_class = 'rtrb-advanced-video';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-video-style-' . $settings['layout'];
}

$video_play_class = 'rtrb-video-play-wrap ';
if ($settings['enableOverlay'] && !$settings['videoPopupShowHide']) {
	$video_play_class .= ' rtrb-video-play-show';
} elseif ($settings['enableOverlay'] && $settings['videoPopupShowHide']) {
	$video_play_class .= ' ';
} else {
	$video_play_class .= ' rtrb-video-play-hide';
}

$video_url = $settings['videoSource'] == "external" ?  $settings['videoURL'] : $settings['videoObj']['url'];
$dataFancybox = $settings['videoPopupShowHide'] ?  'data-fancybox' : '';

?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<div class="rtrb-advanced-video-area">

			<div class="rtrb-advanced-video-wrapper " data-url="<?php echo esc_url($video_url); ?>" data-autoplay="<?php echo esc_attr($settings['autoPlayOnOff'] ? 'on' : 'off'); ?>" data-muted="<?php echo esc_attr($settings['muteOnOff'] ? 'on' : 'off'); ?>" data-loop="<?php echo esc_attr($settings['loopOnOff'] ? 'on' : 'off'); ?>" data-control="<?php echo esc_attr($settings['showControlOnOff'] ? 'on' : 'off'); ?>"></div>

			<div class="<?php echo esc_attr($video_play_class); ?>" style="--rt-video-overlay-img:<?php echo $settings['enableOverlay'] && !empty($settings['overlayImgObj']['url']) ? 'url(' . esc_url($settings['overlayImgObj']['url']) . ')' : ''; ?>">
				<div class="rtrb-video-overlay"></div>

				<?php if ($settings['videoPlayIconType'] != 'none') : ?>
					<a href="<?php echo $settings['videoPopupShowHide'] ? esc_url($video_url) : "javascript:void(0)"; ?>" class="rtrb-play-icon" <?php echo esc_attr($dataFancybox); ?>>
						<?php if ($settings['videoPlayIconType'] == 'icon' && !empty($settings['videoPlayIcon'])) :
							echo Fns::rtrb_kses_intermediate(Fns::render_svg_html($settings['videoPlayIcon']));
						endif; ?>

						<?php if ($settings['videoPlayIconType'] == 'image' && !empty($settings['videoPlayImgObj']['url'])) : ?>
							<img src="<?php echo esc_url($settings['videoPlayImgObj']['url']); ?>" alt="<?php echo esc_attr($settings['videoPlayImgObj']['alt']); ?>" />
						<?php endif; ?>
					</a>
				<?php endif; ?>

			</div>

		</div>
	</div>
</div>