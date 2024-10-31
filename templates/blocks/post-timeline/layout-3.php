<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = 'rtrb-block rtrb-post-timeline-wrapper rtrb-block-frontend ';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
if (!empty($settings['layout'])) {
	$wrap_class .= ' rtrb-post-timeline-wrapper-style-' . $settings['layout'];
}

// $block_wrap_class = 'rtrb-listing-wrap rtrb-listing-grid';
// if (!empty($settings['layout']) && !empty($settings['layoutType'])) {
// 	$block_wrap_class .= ' rtrb-listing-' . $settings['layoutType'] . '-style-' . $settings['layout'];
// }

$block_class = 'rtrb-post';
if (!empty($settings['layout']) && !empty($settings['layoutType'])) {
	$block_class .= ' rtrb-post-' . $settings['layoutType'];
	$block_class .= ' rtrb-post-' . $settings['layoutType'] . '-style-1';
}
if (!empty($settings['imageHoverEffect'])) {
	$block_class .= ' ' . $settings['imageHoverEffect'];
}




$metaList = array();
if (is_array($settings['metaList'])) {
	foreach ($settings['metaList'] as $item) {
		array_push($metaList, $item['value']);
	}
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="rtrb-post-timeline-inner">

		<div class="rtrb-post-timeline-list">

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
					<div class="rtrb-post-timeline-item">
						<div class="rtrb-timeline-card">

							<div class="rtrb-timeline-card-date-wrap">
								<span class="rtrb-calender-icon">
									<?php echo Fns::render_svg_html('calendar-alt'); ?>
								</span>
								<span class="rtrb-date-text">
									<?php echo Fns::rtrb_kses_basic($date_text); ?>
								</span>
							</div>

							<div class="rtrb-timeline-card-main">
								<div class="rtrb-timeline-card-main-inner">
									<div class="rtrb-card-img-wrap">
										<?php if ($settings['thumbnailDisplay']) : ?>
											<div class="rtrb-post-img rtrb-img-wrap <?php echo esc_attr($settings['thumbnailFixedHeight'] ? 'fixed-height' : ''); ?>">
												<?php if (!empty($the_loop['thumbnail'])) { ?>
													<a href="<?php echo esc_url($the_loop['post_link']); ?>"><?php echo Fns::rtrb_kses_intermediate($the_loop['thumbnail']); ?></a>
												<?php } else { ?>
													<a href="<?php echo esc_url($the_loop['post_link']); ?>">
														<img src="https://via.placeholder.com/600x420.png" alt="No Image Available" />
													</a>
												<?php } ?>
											</div>
										<?php endif; ?>

										<div class="rtrb-card-content-wrap">

											<?php if ($settings['titleDisplay'] && !empty($title)) { ?>
												<div class="rtrb-card-title-wrap">
													<?php echo '<' . esc_html($settings['titleTag']) . ' class="rtrb-card-title">'; ?>
													<a href="<?php echo esc_url($the_loop['post_link']) ?>"><?php echo esc_html($title) ?></a>
													<?php echo '</' . esc_html($settings['titleTag']) . '>' ?>
												</div>
											<?php } ?>

											<?php if ($settings['metaDisplay']) : ?>
												<?php echo Fns::rtrb_kses_intermediate($metaListHtml); ?>
											<?php endif; ?>

										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				<?php } ?>
			<?php } ?>

		</div>
	</div>

</div>