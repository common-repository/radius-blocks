<?php
defined('ABSPATH') || exit;
?>

<div class="rtrb-settings-page-wrapper">
	<div class="rtrb-header-area">
		<div class="rtrb-header-logo-wrap">
			<img src="<?php echo rtrb()->get_assets_uri('img/admin/logo/radius-blocks-32-32.png') ?>" loading="lazy" />
		</div>
		<div class="rtrb-header-title-wrap">
			<h2 class="rtrb-title">Radius Blocks Settings</h2>
		</div>
	</div>

	<div class="rtrb-settings-tabs-wrap">
		<div class="rtrb-tabs-nav-wrap">
			<ul class="rtrb-tab-list">
				<li><a href="#general" class="rtrb-button active"><span>Get Help</span></a></li>
				<li><a href="#blocks" class="rtrb-button"><span>Blocks</span></a></li>
			</ul>
		</div>

		<div class="rtrb-tabs-content-wrap">
			<!-- general tab-content -->
			<div id="general" class="rtrb-settings-tab-content active">
				<div class="rtrb-settings-cta">
					<div class="rtrb-settings-cta-inner">
						<div class="rtrb-settings-cta-content">
							<h3 class="rtrb-settings-cta-title">Need Design Ideas?</h3>
							<p class="rtrb-settings-cta-desc">
								Explore beautiful section to get inspiration built with RadiusBlocks.
							</p>
						</div>
						<div class="rtrb-button-wrapper">
							<a href="https://radiusblocks.com/" target="_blank" class="rtrb-button">
								Explore Demo
							</a>
						</div>
					</div>
				</div>
				<div class="rtrb-general-settings">
					<div class="rtrb-general-wrap">

						<div class="rtrb-general-item">
							<div class="rtrb-general-item-box">
								<div class="rtrb-box-icon">
									<span class="rt-box-icon dashicons dashicons-media-document"></span>
								</div>
								<div class="rtrb-content">
									<h3 class="rtrb-title">Documentation</h3>
									<p class="rtrb-description">Get started by spending some time with the documentation we included step by step process with screenshots </p>
								</div>
								<div class="rtrb-button-wrapper">
									<a href="https://www.radiustheme.com/docs/radius-blocks/" class="rtrb-button">Explore Docs</a>
								</div>
							</div>
						</div>

						<div class="rtrb-general-item">
							<div class="rtrb-general-item-box">
								<div class="rtrb-box-icon">
									<span class="rt-box-icon dashicons dashicons-sos">
									</span>
								</div>
								<div class="rtrb-content">
									<h3 class="rtrb-title">Need Help?</h3>
									<p class="rtrb-description">Stuck with something? Please create a
										<a href="https://www.radiustheme.com/contact/">ticket here</a> or post on <a href="https://www.facebook.com/groups/234799147426640/">facebook group</a>. For emergency case join our <a href="https://www.radiustheme.com/">live chat</a>.
									</p>
								</div>
								<div class="rtrb-button-wrapper">
									<a href="https://www.radiustheme.com/contact/" class="rtrb-button">Get Support</a>
								</div>
							</div>
						</div>
						<div class="rtrb-general-item">
							<div class="rtrb-general-item-box">
								<div class="rtrb-box-icon">
									<span class="rt-box-icon dashicons dashicons-smiley">
									</span>
								</div>
								<div class="rtrb-content">
									<h3 class="rtrb-title">Profile</h3>
									<p class="rtrb-description">Our main goal to develop quality WordPress plugins & themes for our customers & provide best customer support.</p>
								</div>
								<div class="rtrb-button-wrapper">
									<a href="https://profiles.wordpress.org/techlabpro1/" class="rtrb-button">Profile</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<!-- blocks tab-content -->
			<div id="blocks" class="rtrb-settings-tab-content">
				<div class="rtrb-block-settings">
					<div id="blocks-settings-root"></div>
				</div>
			</div>
		</div>

	</div>
</div>