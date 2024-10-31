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
?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="rtrb-drop-cap-wrapper rtrb-drop-cap-wrapper-style-<?php echo esc_attr($settings['layout']); ?>">
		<div class='rtrb-drop-cap-desc-wrap'>
			<p><?php echo Fns::rtrb_kses_basic($settings['contents']); ?></p>
		</div>
	</div>
</div>