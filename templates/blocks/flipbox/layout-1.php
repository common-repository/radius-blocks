<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = '';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
$wrap_class .= ' rtrb-block rtrb-flipbox-wrapper rtrb-block-frontend';

$block_wrap_class = 'rtrb-fliper';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-fliper-style-' . $settings['layout'];
}
if (isset($settings['flipboxDirection']) && !empty($settings['flipboxDirection'])) {
	$block_wrap_class .= ' ' . $settings['flipboxDirection'];
}

//button
$button_class = 'rtrb-button rt-fill-btn';
if (isset($settings['buttonHoverEffect']) && !empty($settings['buttonHoverEffect'])) {
	$button_class .= ' ' . $settings['buttonHoverEffect'];
}

if (isset($settings['buttonIconHoverEffect']) && !empty($settings['buttonIconHoverEffect'])) {
	$button_class .= ' ' . $settings['buttonIconHoverEffect'];
}

// button attrs
$target = '_self';
if ($settings['buttonOpenWindow']) {
	$target = '_blank';
}
$nofollow = '';
if ($settings['buttonNofollow']) {
	$nofollow = 'nofollow';
}

// box attrs
$wrapper_target = '_self';
if ($settings['fbBackLinkOpenWindow']) {
	$wrapper_target = '_blank';
}
$wrapper_nofollow = '';
if ($settings['fbBackLinkNofollow']) {
	$wrapper_nofollow = 'nofollow';
}

?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>" data-flip-behavior="<?php echo esc_attr($settings['flipBehavior']); ?>">
		<div class="rtrb-fliper-wrapper">

			<div class="rtrb-flip-front">
				<div class="rtrb-flip-inner">
					<div class="rtrb-flipbox">
						<?php if ($settings['flipboxFrontMedia'] != 'none') { ?>
							<div class="rtrb-flipbox-media rtrb-flipbox-media-<?php echo esc_attr($settings['flipboxFrontMedia']) ?>">
								<?php if ($settings['flipboxFrontMedia'] == 'icon' && !empty($fbFrontIcon)) : ?>
									<span class="rtrb-flipbox-icon">
										<?php echo Fns::rtrb_kses_intermediate($fbFrontIcon); ?>
									</span>
								<?php endif;  ?>

								<?php if ($settings['flipboxFrontMedia'] == 'image' && !empty($settings['fbFrontImageUrl'])) : ?>
									<img src="<?php echo esc_url($settings['fbFrontImageUrl']); ?>" alt="flipbox image">
								<?php endif;  ?>
							</div>
						<?php } ?>

						<?php if ((($settings['fbFrontTitleDisplay'] && !empty('fbFrontTitleText')) || $settings['fbFrontDescDisplay'] && !empty('fbFrontDescText'))) : ?>
							<div class="rtrb-flipbox-content">
								<?php if ($settings['fbFrontTitleDisplay'] && !empty($settings['fbFrontTitleText'])) : ?>
									<h3 class="rtrb-flipbox-title rtrb-tag"><?php echo Fns::rtrb_kses_basic($settings['fbFrontTitleText']); ?></h3>
								<?php endif; ?>

								<?php if ($settings['fbFrontDescDisplay'] && !empty($settings['fbFrontDescText'])) : ?>
									<p class="rtrb-flipbox-short-desc"><?php echo Fns::rtrb_kses_basic($settings['fbFrontDescText']); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>

				</div>
			</div>

			<div class="rtrb-flip-back">
				<div class="rtrb-flip-inner">

					<?php if ($settings['fbBackLinkType'] == 'box' && !empty($settings['fbBackLink'])) : ?>
						<a target="<?php echo esc_attr($wrapper_target); ?>" rel="<?php echo esc_attr($wrapper_nofollow); ?>" href="<?php echo esc_url($settings['fbBackLink']); ?>" class="rtrb-custom-wrapper-link"></a>
					<?php endif; ?>

					<div class="rtrb-flipbox">
						<?php if ($settings['flipboxBackMedia'] != 'none') { ?>
							<div class="rtrb-flipbox-media rtrb-flipbox-media-<?php echo esc_attr($settings['flipboxBackMedia']) ?>">
								<?php if ($settings['flipboxBackMedia'] == 'icon' && !empty($fbBackIcon)) : ?>
									<span class="rtrb-flipbox-icon">
										<?php echo Fns::rtrb_kses_intermediate($fbBackIcon); ?>
									</span>
								<?php endif;  ?>

								<?php if ($settings['flipboxBackMedia'] == 'image' && !empty($settings['fbBackImageUrl'])) : ?>
									<img src="<?php echo esc_url($settings['fbBackImageUrl']); ?>" alt="flipbox image">
								<?php endif;  ?>
							</div>
						<?php } ?>

						<?php if ((($settings['fbBackTitleDisplay'] && !empty('fbBackTitleText')) || $settings['fbBackDescDisplay'] && !empty('fbBackDescText') || ($settings['fbBackLinkType'] == 'button'))) : ?>

							<div class="rtrb-flipbox-content">
								<?php if ($settings['fbBackTitleDisplay'] && !empty($settings['fbBackTitleText'])) : ?>
									<h3 class="rtrb-flipbox-title rtrb-tag"><?php echo Fns::rtrb_kses_basic($settings['fbBackTitleText']); ?></h3>
								<?php endif; ?>

								<?php if ($settings['fbBackDescDisplay'] && !empty($settings['fbBackDescText'])) : ?>
									<p class="rtrb-flipbox-short-desc"><?php echo Fns::rtrb_kses_basic($settings['fbBackDescText']); ?></p>
								<?php endif; ?>

								<?php if (isset($settings['fbBackLinkType']) && $settings['fbBackLinkType'] == 'button') : ?>
									<div class="rtrb-button-wrapper">
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
									</div>
								<?php endif; ?>
							</div>

						<?php endif; ?>

					</div>

				</div>
			</div>

		</div>
	</div>
</div>