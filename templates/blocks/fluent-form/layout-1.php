<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = '';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
$wrap_class .= ' rtrb-block rtrb-fluent-form rtrb-block-frontend';

$block_wrap_class = 'rtrb-fluent-form-wrapper';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-fluent-form-style-' . $settings['layout'] . " ";
}

if (isset($settings['formAlignmentHelper']) && !empty($settings['formAlignmentHelper'])) {
	$block_wrap_class .= 'rtrb-fm-alignment-' . $settings['formAlignmentHelper'] . " ";
}

if (isset($settings['labelEnable']) && !$settings['labelEnable']) {
	$block_wrap_class .= 'rtrb-fm-hide-label ';
}

if (isset($settings['placeholderEnable']) && !$settings['placeholderEnable']) {
	$block_wrap_class .= 'rtrb-fm-hide-placeholder ';
}

if (isset($settings['errorMessageEnable']) && !$settings['errorMessageEnable']) {
	$block_wrap_class .= 'rtrb-fm-hide-error-message ';
}
if (isset($settings['formName']) && !empty($settings['formName'])) {
	$block_wrap_class .= $settings['formName'];
}
?>

<?php if (isset($settings['formId']) && !empty($settings['formId'])) { ?>

	<div class="<?php echo esc_attr($wrap_class); ?>">
		<div class="<?php echo esc_attr($block_wrap_class); ?>">
			<?php
			$shortcode = sprintf('[fluentform id="' . $settings['formId'] . '"]');
			echo do_shortcode(shortcode_unautop($shortcode));
			?>
		</div>
	</div>

<?php } ?>