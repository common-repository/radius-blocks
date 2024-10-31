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
	<div class="rtrb-copyright rtrb-copyright-layout-<?php echo esc_attr($settings['layout']); ?>">
		<?php echo '<' . esc_html($settings['tagName']) . ' class="rtrb-copyright-text">'; ?>
		<?php echo Fns::rtrb_kses_basic($settings['replaceCopyrightText']); ?>
		<?php echo '</' . esc_html($settings['tagName']) . '>' ?>
	</div>
</div>