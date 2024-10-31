<?php
$block_unique_class = '.rtrb-block-' . $settings['blockId'];

$auto_height    = $settings['sliderOptions']['autoHeight'] ? $settings['sliderOptions']['autoHeight'] : '0';
$loop           = $settings['sliderOptions']['loop'] ? $settings['sliderOptions']['loop'] : '0';
$autoplay       = $settings['sliderOptions']['autoPlay'] ? $settings['sliderOptions']['autoPlay'] : '0';
$stop_on_hover  = $settings['sliderOptions']['stopOnHover'] ? $settings['sliderOptions']['stopOnHover'] : '0';
$delay          = $settings['sliderOptions']['autoPlayDelay'] ? $settings['sliderOptions']['autoPlayDelay'] : '5000';
$autoplay_speed = $settings['sliderOptions']['autoPlaySlideSpeed'] ? $settings['sliderOptions']['autoPlaySlideSpeed'] : '200';

$dots = $settings['sliderOptions']['dotNavigation'] ? $settings['sliderOptions']['dotNavigation'] : '0';
$nav  = $settings['sliderOptions']['arrowNavigation'] ? $settings['sliderOptions']['arrowNavigation'] : '0';
$space_between = isset($settings['sliderOptions']['spaceBetween']) ? $settings['sliderOptions']['spaceBetween'] : '20';

$autoplay   = boolval($autoplay) ? array(
	'delay' => absint($delay),
	'pauseOnMouseEnter' => boolval($stop_on_hover),
	'disableOnInteraction' => false,
) : boolval($autoplay);

$pagination = boolval($dots) ? array(
	'el'        => "$block_unique_class .rtrb-slider-pagination",
	'clickable' => true,
	'type'      => 'bullets',
) : boolval($dots);

$navigation = boolval($nav) ? array(
	'nextEl' => "$block_unique_class .rtrb-slider-btn-next",
	'prevEl' => "$block_unique_class .rtrb-slider-btn-prev",
) : boolval($nav);

$break_0    = array(
	'slidesPerView'  => absint($settings['slidesItem']['sm']),
	'slidesPerGroup' => absint($settings['slidesItem']['sm']),
);
$break_576  = array(
	'slidesPerView'  => absint($settings['slidesItem']['sm']),
	'slidesPerGroup' => absint($settings['slidesItem']['sm']),
);
$break_768  = array(
	'slidesPerView'  => absint($settings['slidesItem']['md']),
	'slidesPerGroup' => absint($settings['slidesItem']['md']),
);
$break_1200 = array(
	'slidesPerView'  => absint($settings['slidesItem']['lg']),
	'slidesPerGroup' => absint($settings['slidesItem']['lg']),
);

$swiper_data = array(
	// Optional parameters
	'slidesPerView'  => absint($settings['slidesItem']['lg']),
	'slidesPerGroup' => absint($settings['slidesItem']['lg']),
	'spaceBetween'   => absint($space_between),
	'loop'           => boolval($loop),
	// If we need pagination
	//'slideClass'     => 'swiper-slide-customize',
	'autoplay'       => $autoplay,
	// If we need pagination
	'pagination'     => $pagination,
	'speed'          => absint($autoplay_speed),
	// allowTouchMove: true,
	// Navigation arrows
	'navigation'     => $navigation,
	'autoHeight'     => boolval($auto_height),
	'breakpoints'    => array(
		0    => $break_0,
		576  => $break_576,
		768  => $break_768,
		1200 => $break_1200,
	),
);
$swiper_data = wp_json_encode($swiper_data);

//class generate
$wrap_class = 'rtrb-block rtrb-post-timeline-wrapper rtrb-block-frontend rtrb-swiper-main-wrapper ';
if (isset($settings['blockId'])) {
	$wrap_class .= 'rtrb-block-' . $settings['blockId'];
}
if (isset($settings['className']) && !empty($settings['className'])) {
	$wrap_class .= ' ' . $settings['className'];
}
if (!empty($settings['layout'])) {
	$wrap_class .= ' rtrb-post-timeline-wrapper-style-' . $settings['layout'];
}



$block_wrapper_class = 'rtrb-swiper-container ';
if (isset($block_wrap_class) && !empty($block_wrap_class)) {
	$block_wrapper_class .= $block_wrap_class;
}

$slider_arow_dot_style = '';
if ($settings['sliderOptions']['dotNavigation'] && !empty($settings['sliderOptions']['dotStyle'])) {
	$slider_arow_dot_style = "rtrb-slider-pagination-style-" . $settings['sliderOptions']['dotStyle'];
}

if ($settings['sliderOptions']['arrowNavigation'] && !empty($settings['sliderOptions']['arrowStyle'])) {
	$slider_arow_dot_style .= " rtrb-slider-btn-style-" . $settings['sliderOptions']['arrowStyle'];
}

if ($settings['sliderOptions']['arrowNavigation'] && !empty($settings['sliderOptions']['arrowPosition'])) {
	$slider_arow_dot_style .= " rtrb-slider-btn-position-" . $settings['sliderOptions']['arrowPosition'];
}


$swiper_wrapper_class = 'rtrb-swiper-slider swiper rtrb-post-timeline-list';
if (!empty($slider_arow_dot_style)) {
	$swiper_wrapper_class .= ' ' . $slider_arow_dot_style;
}
if ($settings['sliderOptions']['autoHeight'] != 'true') {
	$swiper_wrapper_class .= ' ' . 'rtrb-swiper-equal-height';
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">

	<?php if (isset($settings['sliderOptions']['sliderLoader']) && $settings['sliderOptions']['sliderLoader']) :  ?>
		<div class="rtrb-swiper-lazy-preloader">
			<svg class="spinner" viewBox="0 0 50 50">
				<circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
			</svg>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_attr($block_wrapper_class); ?>" style="opacity:0">
		<div class="<?php echo esc_attr($swiper_wrapper_class); ?>" data-options="<?php echo esc_attr($swiper_data); ?>">


			<div class="swiper-wrapper">