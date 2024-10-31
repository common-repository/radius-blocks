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

$block_wrap_class = 'rtrb-social-wrapper';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-social-wrapper-style-' . $settings['layout'];
}

?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">

		<?php if (!empty($settings['socialIcons'])) : ?>
			<ul class="rtrb-social-list">
				<?php foreach ($settings['socialIcons'] as $socialicon) :
					$style = "";
					if (isset($socialicon['color']) && !empty($socialicon['color'])) {
						$style .= '--rt-social-color:' . $socialicon['color'] . ';';
					}
					if (isset($socialicon['hoverColor']) && !empty($socialicon['hoverColor'])) {
						$style .= '--rt-social-hover-color:' . $socialicon['hoverColor'] . ';';
					}
					if (isset($socialicon['background']) && !empty($socialicon['background'])) {
						$style .= '--rt-social-bg-color:' . $socialicon['background'] . ';';
					}
					if (isset($socialicon['hoverBackground']) && !empty($socialicon['hoverBackground'])) {
						$style .= '--rt-social-hover-bg-color:' . $socialicon['hoverBackground'] . ';';
					}
					//icon individual color
					if (isset($socialicon['iconColor']) && !empty($socialicon['iconColor'])) {
						$style .= '--rt-social-icon-color:' . $socialicon['iconColor'] . ';';
					}
					if (isset($socialicon['hoverIconColor']) && !empty($socialicon['hoverIconColor'])) {
						$style .= '--rt-social-hover-color:' . $socialicon['hoverIconColor'] . ';';
					}
					if (isset($socialicon['iconBackground']) && !empty($socialicon['iconBackground'])) {
						$style .= '--rt-social-bg-color:' . $socialicon['iconBackground'] . ';';
					}
					if (isset($socialicon['hoverIconBackground']) && !empty($socialicon['hoverIconBackground'])) {
						$style .= '--rt-social-hover-bg-color:' . $socialicon['hoverIconBackground'];
					}
				?>

					<?php if (!empty($socialicon['icon']) || !empty($socialicon['image']['url'])) : ?>
						<li class="rtrb-social-item">
							<a style="<?php echo esc_attr($style); ?>" target="<?php echo $socialicon['openWindow'] ? esc_attr("_blank") : ''; ?>" href="<?php echo esc_url($socialicon['url']); ?>" class="rtrb-social-link <?php echo strtolower('rt-' . $socialicon['title']); ?>">
								<?php if (!empty($socialicon['iconType']) && $socialicon['iconType'] == 'icon') : ?>
									<span class="rtrb-social-icon"><?php echo Fns::render_svg_html($socialicon['icon']); ?></span>
								<?php endif; ?>

								<?php if (!empty($socialicon['iconType']) && $socialicon['iconType'] == 'image') : ?>
									<span class="rtrb-social-icon">
										<img src="<?php echo esc_url($socialicon['image']['url']); ?>" alt="<?php echo esc_html($socialicon['title']); ?>">
									</span>
								<?php endif; ?>
								<span class="rtrb-social-label"><?php echo Fns::rtrb_kses_basic($socialicon['title']); ?></span>
							</a>
						</li>

					<?php endif; ?>

				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

	</div>
</div>