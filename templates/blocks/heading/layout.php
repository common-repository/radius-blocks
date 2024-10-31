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
	<div class="rtrb-gradient-heading rtrb-gradient-heading--layout-<?php echo esc_attr($settings['layout']); ?>">

		<?php if ($settings['displaySubheading'] &&  $settings['subHeadingPosition'] === 'top' && !empty($settings['subheadingText'])) : ?>
			<div class="rtrb-gradient-heading__desc-wrap">
				<?php echo '<' . esc_html($settings['subHeadingTagName']) . ' class="rtrb-gradient-heading__desc rtrb-tag">'; ?>
				<?php echo Fns::rtrb_kses_basic($settings['subheadingText']); ?>
				<?php echo '</' . esc_html($settings['subHeadingTagName']) . '>' ?>
			</div>
		<?php endif; ?>

		<div class="rtrb-gradient-heading__title-wrap">
			<?php echo '<' . esc_html($settings['tagName']) . ' class="rtrb-gradient-heading__title rtrb-tag">'; ?>
			<?php echo Fns::rtrb_kses_basic($settings['headingText']); ?>
			<?php echo '</' . esc_html($settings['tagName']) . '>' ?>
		</div>
		
		<?php if ($settings['displaySubheading'] &&  $settings['subHeadingPosition'] === 'bottom' && !empty($settings['subheadingText'])) : ?>
			<div class="rtrb-gradient-heading__desc-wrap">
				<?php echo '<' . esc_html($settings['subHeadingTagName']) . ' class="rtrb-gradient-heading__desc rtrb-tag">'; ?>
				<?php echo Fns::rtrb_kses_basic($settings['subheadingText']); ?>
				<?php echo '</' . esc_html($settings['subHeadingTagName']) . '>' ?>
			</div>
		<?php endif; ?>

	</div>
</div>