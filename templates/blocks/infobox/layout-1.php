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

$block_wrap_class = 'rtrb-info-box';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-info-box--style-' . $settings['layout'];
}
if (isset($settings['iconHoverEffect']) && !empty($settings['iconHoverEffect'])) {
	$block_wrap_class .= ' ' . $settings['iconHoverEffect'];
}

$target = '_self';
if ($settings['buttonOpenWindow']) {
	$target = '_blank';
}
$nofollow = '';
if ($settings['buttonNofollow']) {
	$nofollow = 'nofollow';
}

$title_target = '_self';
if ($settings['buttonOpenWindow']) {
	$title_target = '_blank';
}
$title_nofollow = '';
if ($settings['buttonNofollow']) {
	$title_nofollow = 'nofollow';
}

?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<div class="rtrb-info-box__inner">

			<?php if (($settings['mediaType'] !== 'none') && (!empty($box_icon) || $settings['mediaType'] === 'image')) : ?>
				<div class="rtrb-info-box__media rtrb-info-box__media--<?php echo esc_attr($settings['mediaType']); ?>">

					<?php if ($settings['mediaType'] == 'icon' && !empty($box_icon)) : ?>
						<span class="rtrb-info-box__icon"><?php echo Fns::rtrb_kses_intermediate($box_icon); ?></span>
					<?php endif ?>

					<?php if ($settings['mediaType'] == 'image' && !empty($settings['imageUrl'])) : ?>
						<img class="rtrb-info-box__image" src="<?php echo esc_url($settings['imageUrl']); ?>" alt="image">
					<?php endif ?>

				</div>
			<?php endif; ?>

			<div class="rtrb-info-box__content">

				<?php if ($settings['titleDisplay'] && !empty('titleText')) : ?>
					<?php if ($settings['titleLinkEnable']) : ?>
						<a target="<?php echo esc_attr($title_target); ?>" rel="<?php echo esc_attr($title_nofollow); ?>" href="<?php echo esc_url($settings['titleURL']); ?>" class="rtrb-info-box-title-link">
						<?php endif ?>
						<?php echo '<' . esc_html($settings['titleTag']) . ' class="rtrb-info-box__title rtrb-tag">'; ?>
						<?php echo Fns::rtrb_kses_basic($settings['titleText']); ?>
						<?php echo '</' . esc_html($settings['titleTag']) . '>' ?>
						<?php if ($settings['titleLinkEnable']) : ?>
						</a>
					<?php endif ?>
				<?php endif ?>

				<?php if ($settings['descDisplay'] && !empty($settings['descText'])) : ?>
					<p class="rtrb-info-box__excerpt"><?php echo Fns::rtrb_kses_basic($settings['descText']); ?></p>
				<?php endif; ?>

				<?php if ($settings['buttonEnable']) : ?>

					<?php if ($settings['buttonType'] === 'rt-read-more-icon-btn' && ($settings['buttonIconEnable'] && !empty($button_icon))) { ?>
						<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" href="<?php echo esc_url($settings['buttonURL']); ?>" class="rtrb-button <?php echo esc_attr($settings['buttonType']); ?>">
							<span class="rt-btn-icon"> <?php echo Fns::rtrb_kses_intermediate($button_icon); ?></span>
						</a>
					<?php } else { ?>
						<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" href="<?php echo esc_url($settings['buttonURL']); ?>" class="rtrb-button <?php echo esc_attr($settings['buttonType']); ?> <?php echo esc_attr(($settings['buttonType'] == 'rt-outline-btn' || $settings['buttonType'] == 'rt-fill-btn') ? $settings['buttonHoverEffect'] : ''); ?>">
							<span class="rt-btn-text"><?php echo Fns::rtrb_kses_basic($settings['buttonText']); ?></span>

							<?php if ($settings['buttonIconEnable'] && !empty($button_icon)) : ?>
								<span class="rt-btn-icon">
									<?php echo Fns::rtrb_kses_intermediate($button_icon); ?>
								</span>
							<?php endif; ?>

						</a>
					<?php } ?>

				<?php endif; ?>
			</div>

		</div>
	</div>

</div>