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

$block_wrap_class = 'rtrb-pricing-table';
if (!empty($settings['layout'])) {
	$block_wrap_class .= ' rtrb-pricing-table-style-' . $settings['layout'];
}
if ($settings['badgeDisplay']) {
	$block_wrap_class .= ' rtrb-ribbon rtrb-ribbon-style-' . $settings['badgeStyle'];
	$block_wrap_class .= ' ' . $settings['badgePosition'];
}
$feature_list_class = 'rtrb-feature-list';
if ($settings['featureListStyle']) {
	$feature_list_class .= ' ' . $settings['featureListStyle'];
}

$target = '_self';
if ($settings['buttonOpenWindow']) {
	$target = '_blank';
}
$nofollow = '';
if ($settings['buttonNofollow']) {
	$nofollow = 'nofollow';
}
?>

<div class="<?php echo esc_attr($wrap_class); ?>">
	<div class="<?php echo esc_attr($block_wrap_class); ?>">
		<div class="rtrb-pricing-table-inner">

			<?php if ($settings['badgeDisplay']) : ?>
				<span class="rtrb-ribbon-span">
					<?php echo esc_html($settings['badgeText']); ?>
					<span class="triangle-bar bar-one"> </span>
					<span class="triangle-bar bar-two"></span>
				</span>
			<?php endif; ?>

			<?php if ($settings['headerMediaType'] === 'icon' || $settings['headerMediaType'] === 'image') : ?>
				<div class="rtrb-pricing-media">

					<?php if ($settings['headerMediaType'] === 'icon' && !empty($settings['headerIcon'])) : ?>
						<div class="rtrb-pricing-icon">
							<span class="rtrb-price-icon">
								<?php echo Fns::render_svg_html($settings['headerIcon']); ?>
							</span>
						</div>
					<?php endif; ?>

					<?php if ($settings['headerMediaType'] === 'image' && !empty($settings['headerImageUrl'])) : ?>
						<div class="rtrb-pricing-image">
							<img src="<?php echo esc_url($settings['headerImageUrl']); ?>" alt="icon-image">
						</div>
					<?php endif; ?>

				</div>
			<?php endif; ?>

			<div class="rtrb-pricing-header">
				<h3 class="rtrb-pricing-title"><?php echo esc_html($settings['titleText']); ?></h3>
				<?php if ($settings['subTitleDisplay']) : ?>
					<p class="rtrb-pricing-sub-title"><?php echo Fns::rtrb_kses_basic($settings['subTitleText']); ?></p>
				<?php endif; ?>
			</div>


			<?php if (!empty($settings['features'])) : ?>
				<div class="rtrb-pricing-body">
					<ul class="<?php echo esc_attr($feature_list_class); ?> ">
						<?php foreach ($settings['features'] as $feature) : ?>
							<li class="rtrb-feature-list-item">
								<?php if ($settings['featureListStyle'] === 'rt-list-with-icon') : ?>
									<span class="list-icon">
										<?php echo Fns::render_svg_html($feature['icon']); ?>
									</span>
								<?php endif; ?>
								<span class="list-text">
									<?php echo Fns::rtrb_kses_basic($feature['text']); ?>
								</span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<div class="rtrb-pricing-wrap">
				<div class="rtrb-price-wrap-inner">
					<span class="rtrb-price-wrap">
						<span class="rtrb-orginal-price <?php echo esc_attr($settings['salePriceDisplay'] ? 'line-through' : ''); ?>">
							<?php if ($settings['currencyPosition'] === 'left') : ?>
								<span class="rtrb-currency"><?php echo Fns::rtrb_kses_basic($settings['currency']); ?></span>
							<?php endif; ?>
							<span class="rtrb-price"><?php echo esc_html($settings['price']); ?></span>
							<?php if ($settings['currencyPosition'] === 'right') : ?>
								<span class="rtrb-currency"><?php echo Fns::rtrb_kses_basic($settings['currency']); ?></span>
							<?php endif; ?>
						</span>
						<?php if ($settings['salePriceDisplay']) : ?>
							<span class="rtrb-sale-price">
								<?php if ($settings['currencyPosition'] === 'left') : ?>
									<span class="rtrb-currency"><?php echo Fns::rtrb_kses_basic($settings['currency']); ?></span>
								<?php endif; ?>
								<span class="rtrb-price"><?php echo esc_html($settings['price']); ?></span>
								<?php if ($settings['currencyPosition'] === 'right') : ?>
									<span class="rtrb-currency"><?php echo Fns::rtrb_kses_basic($settings['currency']); ?></span>
								<?php endif; ?>
							</span>
						<?php endif; ?>
					</span>
					<?php if ($settings['unit']) : ?>
						<span class="rtrb-price-period">
							<?php if ($settings['unitSep']) : ?><span class="period-seperator"><?php echo esc_html($settings['unitSep']); ?></span><?php endif; ?>
							<span class="period-text"><?php echo esc_html($settings['unit']); ?></span>
						</span>
					<?php endif; ?>
				</div>

				<?php if ($settings['saveMessageDisplay']) : ?>
					<div class="save-msg-wrap">
						<span class="save-amount"><?php echo Fns::rtrb_kses_basic($settings['saveMessageText']); ?></span>
					</div>
				<?php endif; ?>

			</div>

			<?php if ($settings['buttonDisplay']) : ?>
				<div class="rtrb-pricing-button-wrap">
					<div class="rtrb-button-wrapper">
						<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" href="<?php echo esc_url($settings['buttonURL']); ?>" class="rtrb-button rt-fill-btn rt-btn-no-effect rt-icon-effect-none">
							<span class="rt-btn-text">
								<?php echo Fns::rtrb_kses_basic($settings['buttonText']); ?>
							</span>

							<?php if ($settings['iconEnable'] && !empty($settings['buttonIcon'])) : ?>
								<span class='rt-btn-icon'><?php echo Fns::render_svg_html($settings['buttonIcon']); ?></span>
							<?php endif; ?>
						</a>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>