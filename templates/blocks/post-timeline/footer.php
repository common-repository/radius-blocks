<?php

use RadiusTheme\RB\Helpers\Fns;

?>
</div> <!-- /.swiper-wrapper   -->

<div class="rtrb-swiper-navigation post-timeline-nav">
	<?php if ($settings['sliderOptions']['arrowNavigation']) : ?>
		<span class="rtrb-slider-btn-prev rtrb-slider-btn">
			<?php echo !empty($settings['arrowLeftIcon']) ? Fns::render_svg_html($settings['arrowLeftIcon']) : Fns::render_svg_html('angle-left'); ?>
		</span>
		<span class="rtrb-slider-btn-next rtrb-slider-btn">
			<?php echo !empty($settings['arrowRightIcon']) ? Fns::render_svg_html($settings['arrowRightIcon']) : Fns::render_svg_html('angle-right'); ?>
		</span>
	<?php endif; ?>
</div>

</div>
</div>
</div>