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

$block_wrap = 'rtrb-notice-wrapper';
if (isset($settings['noticeType']) && !empty($settings['noticeType'])) {
	$block_wrap .= ' rtrb-notice-' . $settings['noticeType'];
}

$notice_id = !empty($settings['blockId']) ? 'rtrb-notice-' . $settings['blockId'] : '';
$notice_appear_again = $settings['noticeAppearAgain'] ? 'true' : 'false';

?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="<?php echo esc_attr($block_wrap); ?>" data-notice-id="<?php echo esc_attr($notice_id); ?>" data-appear-again="<?php echo esc_attr($notice_appear_again); ?>">

		<div class="rtrb-notice-title">
			<?php echo Fns::rtrb_kses_basic($settings['noticeTitleText']); ?>
		</div>

		<?php if ($settings['noticeDismissible']) : ?>
			<span class="rtrb-notice-disclosure"></span>
		<?php endif; ?>

		<div class="rtrb-notice-desc">
			<?php echo Fns::rtrb_kses_basic($settings['noticeDescText']); ?>
		</div>

	</div>
</div>