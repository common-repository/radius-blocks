<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = '';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
$wrap_class .= ' rtrb-block rtrb-block-frontend rtrb-search';

$block_wrap_class = 'rtrb-search-box rtrb-search-box-wrapper ';
if (isset($settings['mainWrapBGOverlayEnable']) && !empty($settings['mainWrapBGOverlayEnable'])) {
	$block_wrap_class .= ' rtrb-overlay';
}
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-search-box-style-' . $settings['layout'];
}
$show_submit_btn = $settings['searchIconDisplay'] ? 'yes' : '';

?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<a href="#rtrb-search-template" class="rtrb-search-icon-btn" data-sbtn="<?php echo esc_attr($show_submit_btn); ?>" data-ptext="<?php echo esc_attr($settings['placeholderText']); ?>" data-blockid="rtrb-block-<?php echo esc_attr($settings['blockId']); ?>" type="button">
			<span class="rtrb-search-icon">
				<svg width="1.5em" height="1.5em" viewBox="0 0 25 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M24.3569 23.6399L18.0081 17.2885C19.6706 15.452 20.6921 13.0234 20.6921 10.3509C20.6913 4.63387 16.0596 0 10.3457 0C4.63172 0 0 4.63387 0 10.3509C0 16.0678 4.63172 20.7017 10.3457 20.7017C12.8145 20.7017 15.0788 19.8336 16.8575 18.3902L23.2309 24.7667C23.5414 25.0778 24.0456 25.0778 24.3561 24.7667C24.6674 24.4557 24.6674 23.9509 24.3569 23.6399ZM10.3457 19.1092C5.51104 19.1092 1.59183 15.188 1.59183 10.3509C1.59183 5.51376 5.51104 1.59254 10.3457 1.59254C15.1803 1.59254 19.0995 5.51376 19.0995 10.3509C19.0995 15.188 15.1803 19.1092 10.3457 19.1092Z"></path>
				</svg>
			</span>
		</a>

	</div>
</div>