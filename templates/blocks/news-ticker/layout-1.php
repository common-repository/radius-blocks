<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = 'rtrb-block rtrb-block-frontend rtrb-preloader-wrapper ';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}

$block_wrap_class = 'rtrb-ticker-wrapper rtrb-preloader-content';
if (!empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-ticker-wrapper-style-' . $settings['layout'];
}

?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<?php if (isset($settings['tickerOptions']['preLoader']) && $settings['tickerOptions']['preLoader']) :  ?>
		<div class="rtrb-lazy-preloader">
			<svg class="spinner" viewBox="0 0 50 50">
				<circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
			</svg>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_attr($block_wrap_class); ?>" data-ticker-type="<?php echo esc_attr($settings['tickerOptions']['tickerType']); ?>" data-ticker-direction="<?php echo esc_attr($settings['tickerOptions']['direction']); ?>" data-ticker-speed="<?php echo esc_attr($settings['tickerOptions']['speed']); ?>" data-ticker-stop-hover="<?php echo esc_attr($settings['tickerOptions']['stopOnHover'] ? 'true' : 'false'); ?>">

		<div class="rtrb-news-ticker">
			<div class="rtrb-news-ticker-label">

				<?php if (!empty($settings['tickerLabelIconEnable'])) : ?>
					<span class="rtrb-news-ticker-label-icon">
						<?php echo Fns::render_svg_html($settings['tickerLabelIcon']); ?>
					</span>
				<?php endif; ?>

				<?php if (!empty($settings['tickerLabel'])) : ?>
					<span class="rtrb-news-ticker-label-text">
						<?php echo Fns::rtrb_kses_basic($settings['tickerLabel']); ?>
					</span>
				<?php endif; ?>

			</div>

			<div class="rtrb-news-ticker-box">
				<div class="rtrb-news-ticker-wrap">
					<ul class="rtrb-news-ticker-data">
						<?php if (!empty($the_loops['posts'])) { ?>
							<?php foreach ($the_loops['posts'] as $the_loop) {
								$title = Fns::get_the_title($the_loop['ID'], $settings);
							?>
								<li>
									<a target="<?php echo $settings['tickerOptions']['openNewTab'] ? esc_attr("_blank") : ''; ?>" href="<?php echo esc_url($the_loop['post_link']); ?>" class="rtrb-single-news"> <?php echo esc_html($title); ?></a>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</div>

			<?php if (!empty($settings['tickerOptions']['tickerControl'])) : ?>
				<div class="rtrb-news-ticker-controls">
					<button class="rtrb-news-ticker-arrow rtrb-news-ticker-prev">
						<?php if (!empty($settings['navLeftIcon'])) {
							echo Fns::render_svg_html($settings['navLeftIcon']);
						} else { ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 384 512">
								<path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
							</svg>
						<?php } ?>

					</button>
					<button class="rtrb-news-ticker-arrow rtrb-news-ticker-next">
						<?php if (!empty($settings['navRightIcon'])) {
							echo Fns::render_svg_html($settings['navRightIcon']);
						} else { ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 384 512">
								<path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
							</svg>
						<?php } ?>
					</button>
				</div>
			<?php endif; ?>

		</div>

	</div>
</div>