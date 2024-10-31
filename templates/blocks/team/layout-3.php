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

$block_wrap_class = 'rtrb-team';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-team--style-' . $settings['layout'];
}

if (isset($settings['imageHoverEffect'])) {
	$block_wrap_class .= ' ' . $settings['imageHoverEffect'];
}

$wrapper_target = '_self';
if ($settings['wrapperOpenWindow']) {
	$wrapper_target = '_blank';
}
$wrapper_nofollow = '';
if ($settings['wrapperNofollow']) {
	$wrapper_nofollow = 'nofollow';
}

$social_target = '_self';
if ($settings['socialOpenWindow']) {
	$social_target = '_blank';
}
$social_nofollow = '';
if ($settings['socialNofollow']) {
	$social_nofollow = 'nofollow';
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<?php if (!empty($settings['wrapperLink'])) : ?>
			<a target="<?php echo esc_attr($wrapper_target); ?>" rel="<?php echo esc_attr($wrapper_nofollow); ?>" href="<?php echo esc_url($settings['wrapperLink']); ?>" class="rtrb-custom-wrapper-link"></a>
		<?php endif; ?>

		<div class="rtrb-team__inner">

			<?php if (!empty($settings['imageUrl'])) : ?>
				<div class="rtrb-team__img rtrb-img-wrap">

					<?php if (!empty($settings['wrapperLink'])) : ?>
						<a target="<?php echo esc_attr($wrapper_target); ?>" rel="<?php echo esc_attr($wrapper_nofollow); ?>" href="<?php echo esc_url($settings['wrapperLink']); ?>" class="rtrb-custom-wrapper-link"></a>
					<?php endif; ?>

					<img class="rtrb-team__image" src="<?php echo esc_url($settings['imageUrl']); ?>" alt="team" loading="lazy" />

					<?php if ($settings['socialIconDisplay'] && !empty($settings['socialIcons'])) : ?>
						<div class="rtrb-team__social-area">
							<ul class="rtrb-social">
								<?php foreach ($settings['socialIcons'] as $socialicon) : ?>
									<?php if (!empty($socialicon['icon'])) : ?>
										<li class="rtrb-social__item">
											<a target="<?php echo esc_attr($social_target); ?>" rel="<?php echo esc_attr($social_nofollow); ?>" href="<?php echo esc_url($socialicon['url']); ?>" class="rtrb-social__link fb">
												<?php $icon =  Fns::render_svg_html($socialicon['icon']); ?>
												<?php echo Fns::rtrb_kses_intermediate($icon); ?>
											</a>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="rtrb-team__content">
				<?php if ($settings['nameDisplay'] && !empty($settings['nameText'])) : ?>
					<?php echo '<' . esc_html($settings['nameTagName']) . ' class="rtrb-team__member-name rtrb-tag">'; ?>
					<?php echo Fns::rtrb_kses_basic($settings['nameText']); ?>
					<?php echo '</' . esc_html($settings['nameTagName']) . '>' ?>
				<?php endif; ?>

				<?php if ($settings['designationDisplay'] && !empty($settings['designationText'])) : ?>
					<span class="rtrb-team__member-designation">
						<?php echo Fns::rtrb_kses_basic($settings['designationText']); ?>
					</span>
				<?php endif; ?>

				<?php if ($settings['bioDisplay'] && !empty($settings['bioText'])) : ?>
					<p class="rtrb-content">
						<?php echo Fns::rtrb_kses_basic($settings['bioText']); ?>
					</p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>