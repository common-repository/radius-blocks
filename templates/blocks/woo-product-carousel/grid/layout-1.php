<?php

use RadiusTheme\RB\Helpers\Fns;


$block_wrap_class = 'rtrb-listing-wrap rtrb-listing-post-carousel';
if (!empty($settings['layout']) && !empty($settings['layoutType'])) {
	$block_wrap_class .= ' rtrb-listing-' . $settings['layoutType'] . '-style-' . $settings['layout'];
}

$block_class = 'rtrb-product';
if (!empty($settings['layout']) && !empty($settings['layoutType'])) {
	$block_class .= ' rtrb-product-' . $settings['layoutType'];
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

?>

<?php
$header_data = [
	'template'              => 'blocks/slider-header-footer/header',
	'settings'              => $settings,
	'block_wrap_class' => $block_wrap_class,
	'default_template_path' => null,
];
Fns::get_template($header_data['template'], $header_data, '', $header_data['default_template_path']);
?>

<?php if (!empty($the_loops['products'])) { ?>
	<?php foreach ($the_loops['products'] as $the_loop) {
		$title = Fns::get_the_title($the_loop['id'], $settings);

		//category
		$categoryHtml = '';
		if (!empty($the_loop['category'])) {
			$categoryHtml .= '<ul class="rtrb-product-cat-list">';
			foreach ($the_loop['category'] as $cat) {
				$categoryHtml .= '<li class="rtrb-cat-item"> <a href="' . esc_url($cat['url']) . '">' . $cat['name'] . '</a></li>';
			}
			$categoryHtml .= '</ul>';
		}

		//add to cart button class
		$add_to_cart = 'rtrb-button';
		if (!empty($the_loop['type'])) {
			$add_to_cart .= ' product_type_' . $the_loop['type'];
		}
		if (!empty($the_loop['type']) && $the_loop['type'] == 'simple') {
			$add_to_cart .=  ' add_to_cart_btn ajax_add_to_cart';
		}
	?>
		<div class="swiper-slide">
			<div class="rtrb-listing-item">
				<div class="<?php echo esc_attr($block_class); ?>">

					<div class="rtrb-product-img-content">
						<div class="rtrb-img-wrap <?php echo esc_attr($settings['thumbnailFixedHeight'] ? 'fixed-height' : ''); ?>">
							<?php if (!empty($the_loop['image'])) { ?>
								<a href="<?php echo esc_url($the_loop['permalink']); ?>">
									<?php echo Fns::rtrb_kses_intermediate($the_loop['thumbnail']); ?>
								</a>
							<?php } else { ?>
								<a href="<?php echo esc_url($the_loop['permalink']); ?>">
									<img src="https://via.placeholder.com/600x420.png" alt="No Image Available" />
								</a>
							<?php } ?>
						</div>

						<div class="rtrb-hover-content">
							<ul class="rtrb-action-btn">
								<li>
									<a href="<?php echo esc_url($the_loop['add_to_cart_url']); ?>" data-quantity="1" data-product-id="<?php echo esc_attr($the_loop['id']); ?>" class="<?php echo esc_attr($add_to_cart); ?>" rel="nofollow">
										<?php if ($settings['iconEnable']) {
											if (!empty($settings['buttonIcon'])) {
												echo Fns::render_svg_html($settings['buttonIcon']);
											} else { ?>
												<svg width="1.1em" height="1.4em" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M19.7031 6.04049C19.439 5.68661 19.0428 5.4836 18.616 5.4836H14.7643L12.6756 0.375545C12.5461 0.0588394 12.2007 -0.0858914 11.9042 0.0524978C11.6076 0.190804 11.4722 0.559744 11.6017 0.876492L13.4855 5.48364H6.51449L8.39828 0.876492C8.52777 0.559744 8.39238 0.190845 8.09582 0.0524978C7.7993 -0.0858914 7.45387 0.058756 7.32438 0.375545L5.23574 5.48364H1.38403C0.957229 5.48364 0.561018 5.68661 0.296916 6.04053C0.0376587 6.38799 -0.0580053 6.83466 0.0344556 7.26614L2.09137 16.862C2.235 17.5321 2.78996 18 3.44094 18H16.5591C17.21 18 17.765 17.5321 17.9086 16.862L19.9655 7.26609C20.058 6.83461 19.9623 6.38795 19.7031 6.04049ZM16.5591 16.7483H3.44094C3.34145 16.7483 3.2543 16.6786 3.23371 16.5826L1.1768 6.98681C1.16067 6.91151 1.18774 6.85485 1.21336 6.8206C1.23711 6.78872 1.2909 6.73528 1.38403 6.73528H4.72399L4.57051 7.11064C4.44102 7.42739 4.57641 7.79629 4.87297 7.93464C4.9493 7.97026 5.02883 7.98712 5.10715 7.98712C5.33301 7.98712 5.54824 7.84681 5.64441 7.61163L6.00274 6.73536H13.9973L14.3557 7.61163C14.4518 7.84685 14.6671 7.98712 14.8929 7.98712C14.9712 7.98712 15.0508 7.97026 15.1271 7.93464C15.4237 7.79633 15.5591 7.42739 15.4296 7.11064L15.2761 6.73528H18.6161C18.7092 6.73528 18.763 6.78872 18.7867 6.8206C18.8123 6.85489 18.8394 6.91155 18.8233 6.98677L16.7664 16.5826C16.7457 16.6786 16.6586 16.7483 16.5591 16.7483Z" fill="currentColor"></path>
													<path d="M6.48438 9.44711C6.16078 9.44711 5.89844 9.72731 5.89844 10.0729V14.6623C5.89844 15.0079 6.16078 15.2881 6.48438 15.2881C6.80797 15.2881 7.07031 15.0079 7.07031 14.6623V10.0729C7.07031 9.72731 6.80801 9.44711 6.48438 9.44711Z" fill="currentColor"></path>
													<path d="M10 9.44711C9.67641 9.44711 9.41406 9.72731 9.41406 10.0729V14.6623C9.41406 15.0079 9.67641 15.2881 10 15.2881C10.3236 15.2881 10.5859 15.0079 10.5859 14.6623V10.0729C10.5859 9.72731 10.3236 9.44711 10 9.44711Z" fill="currentColor"></path>
													<path d="M13.5156 9.44711C13.192 9.44711 12.9297 9.72731 12.9297 10.0729V14.6623C12.9297 15.0079 13.192 15.2881 13.5156 15.2881C13.8392 15.2881 14.1016 15.0079 14.1016 14.6623V10.0729C14.1015 9.72731 13.8392 9.44711 13.5156 9.44711Z" fill="currentColor"></path>
												</svg>
											<?php } ?>
										<?php } ?>
										<?php if ($settings['cartCustomBtnTextEnable']) {
											echo Fns::rtrb_change_cart_text($the_loop['type'], $settings);
										} else { ?>
											<span class="btn-text"><?php echo esc_html($the_loop['add_to_cart_text']); ?></span>
										<?php }; ?>
									</a>
								</li>
							</ul>
						</div>

					</div>


					<?php if ($settings['categoryDisplay']  && !empty($categoryHtml)) : ?>
						<?php echo Fns::rtrb_kses_intermediate($categoryHtml); ?>
					<?php endif; ?>


					<?php if ($settings['saleBadgeDisplay']  && $the_loop['sale']) : ?>
						<div class="rtrb-product-sale-badge"><?php echo esc_html($settings['saleText']); ?></div>
					<?php endif; ?>


					<div class="rtrb-product-content">
						<ul class="ratings-list">
							<?php
							for ($i = 1; $i <= 5; $i++) { ?>
								<li class="<?php echo esc_attr(($i <= $the_loop['rating_average']) ? 'star selected' : 'star'); ?>">
									<svg width="0.98em" height="0.88em" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.83743 0.199456L9.86714 4.21656C9.89376 4.26921 9.93297 4.31484 9.98146 4.34961C10.0299 4.38437 10.0863 4.40725 10.1457 4.41631L14.6941 5.05993C14.7609 5.07218 14.8229 5.10188 14.8738 5.14587C14.9246 5.18986 14.9622 5.24648 14.9826 5.3097C15.0031 5.37292 15.0055 5.44037 14.9897 5.50484C14.974 5.56932 14.9406 5.62841 14.8931 5.67581L11.6069 8.79961C11.5637 8.8408 11.5313 8.89157 11.5125 8.9476C11.4937 9.00363 11.489 9.06326 11.4989 9.12142L12.2721 13.5602C12.2869 13.6306 12.2801 13.7037 12.2527 13.7704C12.2252 13.8371 12.1782 13.8944 12.1176 13.9352C12.057 13.976 11.9854 13.9985 11.9118 13.9999C11.8382 14.0013 11.7657 13.9815 11.7035 13.9431L7.64412 11.8568C7.59058 11.8296 7.53109 11.8154 7.47071 11.8154C7.41034 11.8154 7.35085 11.8296 7.29731 11.8568L3.26631 13.9264C3.20412 13.9649 3.1317 13.9847 3.05807 13.9833C2.98444 13.9819 2.91286 13.9594 2.85225 13.9186C2.79163 13.8778 2.74466 13.8204 2.71719 13.7537C2.68973 13.6871 2.68297 13.614 2.69777 13.5436L3.47099 9.10478C3.48086 9.04661 3.47619 8.98698 3.45739 8.93095C3.43858 8.87492 3.40619 8.82416 3.36297 8.78296L0.110882 5.67581C0.0617455 5.62821 0.027062 5.56827 0.0106694 5.50262C-0.00572323 5.43698 -0.0031858 5.36819 0.0180009 5.30386C0.0391875 5.23953 0.0781973 5.18218 0.130713 5.13815C0.18323 5.09412 0.247204 5.06513 0.315558 5.05438L4.86393 4.41076C4.92337 4.4017 4.97971 4.37882 5.0282 4.34406C5.07668 4.30929 5.11589 4.26366 5.14252 4.21101L7.17223 0.193908C7.20449 0.134866 7.2527 0.0855774 7.31164 0.0513947C7.37058 0.0172119 7.43799 -0.000558481 7.50655 1.33791e-05C7.57511 0.000585239 7.6422 0.0194774 7.70053 0.0546383C7.75886 0.0897993 7.80621 0.139885 7.83743 0.199456Z" fill="currentColor"></path>
									</svg>
								</li>
							<?php } ?>
						</ul>

						<?php if ($settings['titleDisplay'] && !empty($title)) { ?>
							<div class="rtrb-product-title-wrap">
								<?php echo '<' . esc_html($settings['titleTag']) . ' class="rtrb-product-title">'; ?>
								<a href="<?php echo esc_url($the_loop['permalink']) ?>"><?php echo esc_html($title) ?></a>
								<?php echo '</' . esc_html($settings['titleTag']) . '>' ?>
							</div>
						<?php } ?>

						<div class="rtrb-product-price">
							<?php echo wp_kses_post($the_loop['price_html']); ?>
						</div>

					</div>



				</div>
			</div>
		</div>

	<?php } ?>
<?php } ?>

<?php
$footer_data = [
	'template'              => 'blocks/slider-header-footer/footer',
	'settings'              => $settings,
	'default_template_path' => null,
];
Fns::get_template($footer_data['template'], $footer_data, '', $footer_data['default_template_path']);
?>