<?php

use RadiusTheme\RB\Helpers\Fns;

$wrap_class = '';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
$wrap_class .= ' rtrb-block rtrb-image-accordion rtrb-block-frontend';

$block_wrap_class = 'rtrb-image-accordion-wrapper';
if (isset($settings['layout']) && !empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-image-accordion-style-' . $settings['layout'];
}
if (isset($settings['activeType']) && !empty($settings['activeType'])) {
	$block_wrap_class .= ' rtrb-image-accordion-' . $settings['activeType'];
}
if (isset($settings['styleType']['lg']) && !empty($settings['styleType']['lg'])) {
	$block_wrap_class .= ' rtrb-image-accordion-' . $settings['styleType']['lg'];
}
if (isset($settings['styleType']['md']) && !empty($settings['styleType']['md'])) {
	$block_wrap_class .= ' rtrb-image-accordion-tab-' . $settings['styleType']['md'];
}
if (isset($settings['styleType']['sm']) && !empty($settings['styleType']['sm'])) {
	$block_wrap_class .= ' rtrb-image-accordion-mob-' . $settings['styleType']['sm'];
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">
		<?php
		$accordions = !empty($settings['accordions']) ? $settings['accordions'] : [];
		if (!empty($accordions)) {
			foreach ($accordions as $index => $accordion) {
				$default_actuve_item = Fns::is_active_item($settings, $index) ? 'checkedItem' : '';
		?>
				<div class="item <?php echo esc_attr($default_actuve_item); ?>" data-active-type="<?php echo esc_attr($settings['activeType']); ?>" style="background-image:<?php echo   !empty($accordion['image']['url']) ? 'url(' . esc_url($accordion['image']['url']) . ')' : ''; ?>">
					<div class="content">
						<div class="inner">
							<?php if (!empty($accordion['title'])) : ?>
								<h3 class="title"><?php echo Fns::rtrb_kses_basic($accordion['title']); ?></h3>
							<?php endif; ?>

							<?php if (!empty($accordion['content'])) : ?>
								<p class="desc"><?php echo Fns::rtrb_kses_basic($accordion['content']); ?></p>
							<?php endif; ?>

							<?php if ($accordion['enableProject'] || $accordion['enablePopup']) : ?>
								<ul class="link-list">
									<?php if ($accordion['enablePopup']) : ?>
										<li>
											<a href="<?php echo esc_url($accordion['image']['url']); ?>" class="link" data-fancybox>
												<?php
												if (!empty($accordion['popupIcon'])) {
													echo Fns::render_svg_html($accordion['popupIcon']);
												} else { ?>
													<svg width="15" height="15" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M15.7857 9.71429H9.71429V15.7857C9.71429 16.1078 9.58635 16.4166 9.35863 16.6443C9.13091 16.8721 8.82205 17 8.5 17C8.17795 17 7.86909 16.8721 7.64137 16.6443C7.41365 16.4166 7.28571 16.1078 7.28571 15.7857V9.71429H1.21429C0.892237 9.71429 0.583379 9.58635 0.355656 9.35863C0.127934 9.13091 0 8.82205 0 8.5C0 8.17795 0.127934 7.86909 0.355656 7.64137C0.583379 7.41365 0.892237 7.28572 1.21429 7.28572H7.28571V1.21429C7.28571 0.892237 7.41365 0.583378 7.64137 0.355656C7.86909 0.127933 8.17795 0 8.5 0C8.82205 0 9.13091 0.127933 9.35863 0.355656C9.58635 0.583378 9.71429 0.892237 9.71429 1.21429V7.28572H15.7857C16.1078 7.28572 16.4166 7.41365 16.6443 7.64137C16.8721 7.86909 17 8.17795 17 8.5C17 8.82205 16.8721 9.13091 16.6443 9.35863C16.4166 9.58635 16.1078 9.71429 15.7857 9.71429Z" fill="currentColor" />
													</svg>
												<?php } ?>
											</a>
										</li>
									<?php endif; ?>
									<?php if ($accordion['enableProject']) : ?>
										<li>
											<a href="<?php echo esc_url($accordion['projectLink']); ?>" class="link">
												<?php
												if (!empty($accordion['projectIcon'])) {
													echo Fns::render_svg_html($accordion['projectIcon']);
												} else { ?>
													<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M6.35585 8.64415C6.68855 8.96061 6.68855 9.47994 6.35585 9.79641C6.03939 10.1129 5.52006 10.1129 5.20359 9.79641C4.44357 9.03524 4.01669 8.00357 4.01669 6.92793C4.01669 5.85228 4.44357 4.82061 5.20359 4.05944L8.07613 1.1869C8.8373 0.426881 9.86897 0 10.9446 0C12.0203 0 13.0519 0.426881 13.8131 1.1869C14.5731 1.94807 15 2.97974 15 4.05539C15 5.13103 14.5731 6.16271 13.8131 6.92387L12.604 8.13293C12.6121 7.46754 12.5067 6.80215 12.2795 6.16922L12.6608 5.77972C12.8883 5.5547 13.0689 5.28679 13.1922 4.9915C13.3154 4.69622 13.3789 4.37942 13.3789 4.05944C13.3789 3.73947 13.3154 3.42267 13.1922 3.12739C13.0689 2.8321 12.8883 2.56419 12.6608 2.33917C12.4358 2.11168 12.1679 1.93109 11.8726 1.80784C11.5773 1.68459 11.2605 1.62113 10.9406 1.62113C10.6206 1.62113 10.3038 1.68459 10.0085 1.80784C9.71321 1.93109 9.4453 2.11168 9.22028 2.33917L6.35585 5.20359C6.12837 5.42862 5.94778 5.69653 5.82453 5.99181C5.70128 6.2871 5.63782 6.60389 5.63782 6.92387C5.63782 7.24384 5.70128 7.56064 5.82453 7.85593C5.94778 8.15121 6.12837 8.41912 6.35585 8.64415ZM8.64415 5.20359C8.96061 4.88713 9.47994 4.88713 9.79641 5.20359C10.5564 5.96476 10.9833 6.99643 10.9833 8.07207C10.9833 9.14772 10.5564 10.1794 9.79641 10.9406L6.92387 13.8131C6.16271 14.5731 5.13103 15 4.05539 15C2.97974 15 1.94807 14.5731 1.1869 13.8131C0.426881 13.0519 0 12.0203 0 10.9446C0 9.86897 0.426881 8.8373 1.1869 8.07613L2.39597 6.86707C2.38785 7.53246 2.49334 8.19785 2.72055 8.83889L2.33917 9.22028C2.11168 9.4453 1.93109 9.71321 1.80784 10.0085C1.68459 10.3038 1.62113 10.6206 1.62113 10.9406C1.62113 11.2605 1.68459 11.5773 1.80784 11.8726C1.93109 12.1679 2.11168 12.4358 2.33917 12.6608C2.56419 12.8883 2.8321 13.0689 3.12739 13.1922C3.42267 13.3154 3.73947 13.3789 4.05944 13.3789C4.37942 13.3789 4.69622 13.3154 4.9915 13.1922C5.28679 13.0689 5.5547 12.8883 5.77972 12.6608L8.64415 9.79641C8.87163 9.57138 9.05222 9.30348 9.17547 9.00819C9.29872 8.7129 9.36218 8.39611 9.36218 8.07613C9.36218 7.75616 9.29872 7.43936 9.17547 7.14407C9.05222 6.84879 8.87163 6.58088 8.64415 6.35585C8.56534 6.282 8.50252 6.19277 8.45957 6.09368C8.41663 5.99458 8.39447 5.88772 8.39447 5.77972C8.39447 5.67172 8.41663 5.56487 8.45957 5.46577C8.50252 5.36667 8.56534 5.27744 8.64415 5.20359Z" fill="currentColor" />
													</svg>
												<?php } ?>
											</a>
										</li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>

						</div>
					</div>

				</div>
		<?php }
		}
		?>
	</div>
</div>