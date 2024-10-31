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
	<div class="rtrb-advanced-heading rtrb-advanced-heading--layout-<?php echo esc_attr($settings['layout']); ?>">

		<?php if ($settings['separatorPosition'] == 'top' && $settings['displaySeparator']) : ?>
			<div class="rtrb-ah-separator-line"></div>
		<?php endif; ?>

		<?php if ($settings['subHeadingPosition'] == 'top' && $settings['displaySubheading'] && !empty($settings['subheadingText'])) : ?>
			<div class="rtrb-advanced-heading__sub-title-wrap">
				<div class="rtrb-advanced-heading__sub-title">
					<?php if ($settings['subTitleBarLeft']) : ?>
						<span class="rt-sub-title-bar rt-sub-title-bar--left"></span>
					<?php endif; ?>
					<?php echo '<' . esc_html($settings['subHeadingTagName']) . ' class="rt-sub-title-text rtrb-tag">'; ?>
					<?php echo Fns::rtrb_kses_basic($settings['subheadingText']); ?>
					<?php echo '</' . esc_html($settings['subHeadingTagName']) . '>' ?>
					<?php if ($settings['subTitleBarRight']) : ?>
						<span class="rt-sub-title-bar rt-sub-title-bar--right"></span>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="rtrb-advanced-heading__title-wrap">
			<?php echo '<' . esc_html($settings['tagName']) . ' class="rtrb-advanced-heading__title">'; ?>
			<?php echo Fns::rtrb_kses_basic($settings['headingText']); ?>
			<?php echo '</' . esc_html($settings['tagName']) . '>' ?>
		</div>

		<?php if ($settings['subHeadingPosition'] == 'bottom' && $settings['displaySubheading'] && !empty($settings['subheadingText'])) : ?>
			<div class="rtrb-advanced-heading__sub-title-wrap">
				<div class="rtrb-advanced-heading__sub-title">
					<?php if ($settings['subTitleBarLeft']) : ?>
						<span class="rt-sub-title-bar rt-sub-title-bar--left"></span>
					<?php endif; ?>
					<?php echo '<' . esc_html($settings['subHeadingTagName']) . ' class="rt-sub-title-text rtrb-tag">'; ?>
					<?php echo Fns::rtrb_kses_basic($settings['subheadingText']); ?>
					<?php echo '</' . esc_html($settings['subHeadingTagName']) . '>' ?>
					<?php if ($settings['subTitleBarRight']) : ?>
						<span class="rt-sub-title-bar rt-sub-title-bar--right"></span>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($settings['separatorPosition'] == 'bottom' && $settings['displaySeparator']) : ?>
			<div class="rtrb-ah-separator-line"></div>
		<?php endif; ?>

		<?php if ($settings['displayDescription'] && !empty($settings['descriptionText'])) : ?>
			<div class="rtrb-advanced-heading__desc-wrap">
				<p class="rtrb-advanced-heading__desc"><?php echo Fns::rtrb_kses_basic($settings['descriptionText']); ?></p>
			</div>
		<?php endif; ?>

	</div>
</div>