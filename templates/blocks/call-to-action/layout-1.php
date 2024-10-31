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

$block_wrap_class = 'rtrb-cta';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-cta--style-' . $settings['layout'];
}
if (isset($settings['iconHoverEffect']) && !empty($settings['iconHoverEffect'])) {
	$block_wrap_class .= ' ' . $settings['iconHoverEffect'];
}

$button_class = 'rtrb-button rtrb-btn1 rt-fill-btn';

if (isset($settings['buttonHoverEffect']) && !empty($settings['buttonHoverEffect'])) {
	$button_class .= ' ' . $settings['buttonHoverEffect'];
}

if (isset($settings['buttonIconHoverEffect']) && !empty($settings['buttonIconHoverEffect'])) {
	$button_class .= ' ' . $settings['buttonIconHoverEffect'];
}

$button_class2 = 'rtrb-button rtrb-btn2 rt-fill-btn';

if (isset($settings['buttonTwoHoverEffect']) && !empty($settings['buttonTwoHoverEffect'])) {
	$button_class2 .= ' ' . $settings['buttonTwoHoverEffect'];
}

if (isset($settings['buttonTwoIconHoverEffect']) && !empty($settings['buttonTwoIconHoverEffect'])) {
	$button_class2 .= ' ' . $settings['buttonTwoIconHoverEffect'];
}

$target = '_self';
if ($settings['buttonOpenWindow']) {
	$target = '_blank';
}
$nofollow = '';
if ($settings['buttonNofollow']) {
	$nofollow = 'nofollow';
}

$targetTwo = '_self';
if ($settings['buttonTwoOpenWindow']) {
	$targetTwo = '_blank';
}
$nofollowTwo = '';
if ($settings['buttonTwoNofollow']) {
	$nofollowTwo = 'nofollow';
}
?>
<div class="<?php echo esc_attr($wrap_class); ?>">

	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<div class="rtrb-cta__inner">

			<div class="rtrb-cta__content">

				<?php if ($settings['titleDisplay'] && !empty('titleText')) : ?>
					<?php echo '<' . esc_html($settings['tagName']) . ' class="rtrb-cta__title rtrb-tag">'; ?>
					<?php echo Fns::rtrb_kses_basic($settings['titleText']); ?>
					<?php echo '</' . esc_html($settings['tagName']) . '>' ?>
				<?php endif ?>

				<?php if ($settings['descDisplay'] && !empty($settings['descText'])) : ?>
					<p class="rtrb-cta__desc"><?php echo Fns::rtrb_kses_basic($settings['descText']); ?></p>
				<?php endif; ?>

			</div>
			<?php if ($settings['buttonEnable'] || $settings['buttonTwoEnable']) : ?>

				<div class="rtrb-cta__action">
					<div class="rtrb-button-wrapper">
						<?php if ($settings['buttonEnable']) : ?>
							<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" href="<?php echo esc_url($settings['buttonURL']); ?>" class="<?php echo esc_attr($button_class); ?> ">

								<?php if (!empty($settings['buttonText'])) : ?>
									<span class="rt-btn-text"><?php echo Fns::rtrb_kses_basic($settings['buttonText']); ?></span>
								<?php endif;  ?>

								<?php if ($settings['iconEnable'] && !empty($button_icon)) : ?>
									<span class="rt-btn-icon">
										<?php echo Fns::rtrb_kses_intermediate($button_icon); ?>
									</span>
								<?php endif;  ?>

							</a>
						<?php endif; ?>
						<?php if ($settings['layout'] !== '3' && $settings['buttonTwoEnable']) : ?>
							<a target="<?php echo esc_attr($targetTwo); ?>" rel="<?php echo esc_attr($nofollowTwo); ?>" href="<?php echo esc_url($settings['buttonTwoURL']); ?>" class="<?php echo esc_attr($button_class2); ?> ">

								<?php if (!empty($settings['buttonTwoText'])) : ?>
									<span class="rt-btn-text"><?php echo Fns::rtrb_kses_basic($settings['buttonTwoText']); ?></span>
								<?php endif;  ?>

								<?php if ($settings['iconEnableTwo'] && !empty($button_icon2)) : ?>
									<span class="rt-btn-icon">
										<?php echo Fns::rtrb_kses_intermediate($button_icon2); ?>
									</span>
								<?php endif;  ?>

							</a>
						<?php endif; ?>

					</div>
				</div>

			<?php endif; ?>

		</div>
	</div>
</div>