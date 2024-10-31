<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = 'rtrb-block rtrb-post-list-wrapper rtrb-block-frontend ';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}

$block_wrap_class = 'rtrb-listing-wrap rtrb-listing-list';
if (!empty($settings['layout']) && !empty($settings['layoutType'])) {
	$block_wrap_class .= ' rtrb-listing-' . $settings['layoutType'] . '-style-' . $settings['layout'];
}

$block_class = 'rtrb-post';
if (!empty($settings['layout']) && !empty($settings['layoutType'])) {
	$block_class .= ' rtrb-post-' . $settings['layoutType'];
	$block_class .= ' rtrb-post-' . $settings['layoutType'] . '-style-1';
}
if (!empty($settings['imageHoverEffect'])) {
	$block_class .= ' ' . $settings['imageHoverEffect'];
}

if (!empty($settings['overlayStyle'])) {
	$block_class .= ' ' . $settings['overlayStyle'];
}
if (!empty($settings['categoryPosition'])) {
	$block_class .= ' ' . $settings['categoryPosition'];
}

$metaList = array();
if (is_array($settings['metaList'])) {
	foreach ($settings['metaList'] as $item) {
		array_push($metaList, $item['value']);
	}
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<?php if (!empty($the_loops['posts'])) { ?>
			<?php foreach ($the_loops['posts'] as $the_loop) {
				$title = Fns::get_the_title($the_loop['ID'], $settings);
				$excerpt = Fns::get_the_excerpt($the_loop['ID'], $settings);

				$author = sprintf('<li class="rtrb-meta-item rtrb-author"><span class="rtrb-meta">By %1$s</span></li>', $the_loop['author_link']);
				$avatar = sprintf('<li class="rtrb-meta-item rtrb-avatar"><span class="rtrb-author-avatar">%1$s</span></li>', $the_loop['avatar']);

				//date
				$date_text = sprintf('<time>%1$s</time>', $the_loop['date']);
				$date_icon = $settings['metaIconDisplay'] ? sprintf('<span class="meta-icon">%1$s</span>', Fns::render_svg_html('calendar-alt')) : '';
				$date = sprintf(
					'<li class="rtrb-meta-item rtrb-date"><span class="rtrb-meta">%1$s %2$s</span></li>',
					$date_icon,
					$date_text
				);

				//category
				$categoryHtml = '';
				if (!empty($the_loop['category'])) {
					$categoryHtml .= '<ul class="rtrb-post-cat-meta-list">';
					foreach ($the_loop['category'] as $cat) {
						$categoryHtml .= '<li class="rtrb-cat-item">' . $cat . '</li>';
					}
					$categoryHtml .= '</ul>';
				}

				//tags
				$tag_text = !empty($the_loop['post_tag']) ? sprintf('<span class="rtrb-tag-items">%1$s</span>', $the_loop['post_tag']) : '';
				$tag_icon = sprintf('<span class="meta-icon">%1$s</span>', Fns::render_svg_html('tags'));
				if (!empty($tag_text) && !empty($tag_icon)) {
					$tags = sprintf(
						'<li class="rtrb-meta-item rtrb-meta"><span class="rtrb-meta">%1$s %2$s</span></li>',
						$tag_icon,
						$tag_text
					);
				} else {
					$tags = "";
				}

				//meta-category
				$cat_text = !empty($the_loop['meta_category']) ? sprintf('<span class="rtrb-tag-items">%1$s</span>', $the_loop['meta_category']) : '';
				$cat_icon = sprintf('<span class="meta-icon">%1$s</span>', Fns::render_svg_html('folder-open'));
				if (!empty($cat_text) && !empty($cat_icon)) {
					$metaCategory = sprintf(
						'<li class="rtrb-meta-item rtrb-meta"><span class="rtrb-meta">%1$s %2$s</span></li>',
						$cat_icon,
						$cat_text
					);
				} else {
					$metaCategory = "";
				}

				//Final meta HTML
				$metaListHtml = "";
				$metaListHtml .= sprintf('<ul class="rtrb-post-meta-list %1$s">', $settings['metaSep']);
				if (in_array("avatar", $metaList)) {
					$metaListHtml .= $avatar;
				}
				if (in_array("author", $metaList)) {
					$metaListHtml .= $author;
				}
				foreach ($metaList as $meta) {
					if ($meta != "avatar" && $meta != "author") {
						$metaListHtml .= ${$meta};
					}
				}
				$metaListHtml .= '</ul>';
			?>

				<div class="rtrb-listing-item">
					<article class="<?php echo esc_attr($block_class); ?>">

						<?php if ($settings['thumbnailDisplay']) : ?>
							<div class="rtrb-post-img rtrb-img-wrap">

								<?php if (!empty($the_loop['thumbnail'])) { ?>
									<a href="<?php echo esc_url($the_loop['post_link']); ?>"><?php echo Fns::rtrb_kses_intermediate($the_loop['thumbnail']); ?></a>
								<?php } else { ?>
									<a href="<?php echo esc_url($the_loop['post_link']); ?>">
										<img src="https://via.placeholder.com/600x420.png" alt="No Image Available" />
									</a>
								<?php } ?>

								<?php if ($settings['categoryDisplay'] && $settings['categoryPosition'] !== 'rt-above-title' && !empty($categoryHtml)) : ?>
									<?php echo Fns::rtrb_kses_intermediate($categoryHtml); ?>
								<?php endif; ?>

							</div>
						<?php endif; ?>

						<div class="rtrb-post-content">

							<?php if ($settings['categoryDisplay'] && $settings['categoryPosition'] === 'rt-above-title' && !empty($categoryHtml)) : ?>
								<?php echo Fns::rtrb_kses_intermediate($categoryHtml); ?>
							<?php endif; ?>

							<?php if ($settings['metaDisplay'] && $settings['metaPosition'] === 'above_title') : ?>
								<?php echo Fns::rtrb_kses_intermediate($metaListHtml); ?>
							<?php endif; ?>

							<?php if ($settings['titleDisplay'] && !empty($title)) { ?>
								<div class="rtrb-title-wrap">
									<?php echo '<' . esc_html($settings['titleTag']) . ' class="rtrb-post-title rtrb-tag">'; ?>
									<a href="<?php echo esc_url($the_loop['post_link']) ?>"><?php echo esc_html($title) ?></a>
									<?php echo '</' . esc_html($settings['titleTag']) . '>' ?>
								</div>
							<?php } ?>

							<?php if ($settings['metaDisplay'] && $settings['metaPosition'] === 'above_excerpt') : ?>
								<?php echo Fns::rtrb_kses_intermediate($metaListHtml); ?>
							<?php endif; ?>

							<?php if ($settings['excerptDisplay'] && !empty($excerpt)) : ?>
								<div class="rtrb-post-excerpt">
									<p><?php echo wp_kses_post($excerpt); ?></p>
								</div>
							<?php endif; ?>

							<?php if ($settings['metaDisplay'] && $settings['metaPosition'] === 'below_excerpt') : ?>
								<?php echo Fns::rtrb_kses_intermediate($metaListHtml); ?>
							<?php endif; ?>

							<?php if ($settings['readMoreDisplay']) : ?>
								<div class="rtrb-button-wrapper">
									<a href="<?php echo esc_url($the_loop['post_link']); ?>" class="rtrb-button rt-fill-btn rt-btn-no-effect rt-icon-effect-none">
										<span class="rt-btn-text">
											<?php echo Fns::rtrb_kses_basic($settings['readMoreBTNText']); ?>
										</span>

										<?php if ($settings['iconEnable'] && !empty($settings['buttonIcon'])) : ?>
											<span class='rt-btn-icon'><?php echo Fns::render_svg_html($settings['buttonIcon']); ?></span>
										<?php endif; ?>
									</a>
								</div>
							<?php endif; ?>

						</div>
					</article>
				</div>

			<?php } ?>
		<?php } ?>

	</div>

	<?php if ($settings['postShowPagination'] && !empty($the_loops['total_page'])) { ?>
		<div class="rtrb-pagination-wrap">
			<div class="rtrb-pagination-nav">
				<?php echo Fns::pagination($the_loops['total_page']); ?>
			</div>
		</div>
	<?php } ?>
</div>