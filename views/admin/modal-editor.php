<?php

use RadiusTheme\RB\Helpers\Fns;

defined('ABSPATH') || exit;
?>
<div id="rtrb-builder-modal" class="rtrb-modal" tabindex="-1" role="dialog">
	<div class="rtrb-modal-wrap">
		<form action="" method="post" id="rtrb-builder-modal-form">
			<div class="rtrb-modal-content">
				<div class="rtrb-modal-header">
					<button type="button" class="rtrb-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
					</button>
					<h4 class="rtrb-modal-title" id="rtrb-modal-title"><?php esc_html_e('Template Settings', 'radius-blocks'); ?></h4>
				</div>
				<div class="rtrb-modal-body" id="rtrb-modal-body">
					<div class="rtrb-input-group">
						<label class="rtrb-input-label"><?php esc_html_e('Title:', 'radius-blocks'); ?></label>
						<input required type="text" id="rtrb-builder-modal-title" name="title" class="rtrb-builder-modal-title rtrb-form-control">
					</div>
					<div class="rtrb-input-group">
						<label class="rtrb-input-label"><?php esc_html_e('Type:', 'radius-blocks'); ?></label>
						<select name="type" id="rtrb-builder-modal-type" class="rtrb-builder-modal-type rtrb-form-control">
							<option value="header"><?php esc_html_e('Header', 'radius-blocks'); ?></option>
							<option value="footer"><?php esc_html_e('Footer', 'radius-blocks'); ?></option>
						</select>
					</div>
					<div id="rtrb-builder-options-container" class="rtrb-builder-options-container">
						<div class="rtrb-input-group">
							<label class="rtrb-input-label"><?php esc_html_e('Conditions:', 'radius-blocks'); ?></label>
							<select name="condition_a" id="rtrb-builder-modal-condition_a" class="rtrb-form-control">
								<option value="entire_site"><?php esc_html_e('Entire Site', 'radius-blocks'); ?></option>
								<option value="singular"><?php esc_html_e('Singular', 'radius-blocks'); ?></option>
								<option value="archive"><?php esc_html_e('Archive', 'radius-blocks'); ?></option>
							</select>
						</div>
						<div style="display: none" id="rtrb-builder-modal-condition_singular-container" class="rtrb-builder-condition_singular-container rtrb-builder-options-container">
							<div class="rtrb-input-group">
								<label class="rtrb-input-label"></label>
								<select id="rtrb-builder-modal-condition_singular" name="condition_singular" class="rtrb-builder-condition_singular rtrb-form-control">
									<option value="all"><?php esc_html_e('All Singulars', 'radius-blocks'); ?></option>
									<option value="front_page"><?php esc_html_e('Front Page', 'radius-blocks'); ?></option>
									<option value="all_posts"><?php esc_html_e('All Posts', 'radius-blocks'); ?></option>
									<option value="all_pages"><?php esc_html_e('All Pages', 'radius-blocks'); ?></option>
									<option value="selective"><?php esc_html_e('Selective Singular', 'radius-blocks'); ?>
									</option>
									<option value="404page"><?php esc_html_e('404 Page', 'radius-blocks'); ?></option>
								</select>
							</div>
							<div style="display: none" id="rtrb-builder-modal-condition_singular_ids-container" class="rtrb-builder-condition_singular_ids-container rtrb-builder-options-container">
								<div class="rtrb-input-group">
									<label class="rtrb-input-label"></label>
									<select multiple name="condition_singular_ids[]" id="rtrb-builder-modal-condition_singular_ids" class="rtrb-builder-condition_singular_ids"></select>
								</div>
								<br />
							</div>
						</div>
						<div style="display: none" id="rtrb-builder-modal-condition_archive-container" class="rtrb-option-container">
							<div class="rtrb-input-group">
								<label class="rtrb-input-label"></label>
								<select name="condition_archive" id="rtrb-builder-modal-condition_archive" class="rtrb-form-control">
									<?php
									$groups = Fns::builder_archive_conditions_list();
									if (!empty($groups)) {
										foreach ($groups as $key => $group) { ?>
											<optgroup label="<?php echo esc_attr($group['label']) ?>">
												<?php
												foreach ($group['options'] as $optionKey => $option) {
												?>
													<option value="<?php echo esc_attr($optionKey); ?>"><?php echo esc_html($option) ?></option>
												<?php
												}
												?>
											</optgroup>
									<?php
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="rtrb-input-group">
						<label class="rtrb-input-label"></label>
						<div class="rtrb-input-checkbox-wrap">
							<input type="hidden" value="0" class="rtrb-form-control" name="activation">
							<label class="rtrb-input-checkbox-control-label">
								<input type="checkbox" value="1" class="rtrb-form-control-checkbox" name="activation" id="rtrb-builder-modal-activation">
								<?php esc_html_e('Activate', 'radius-blocks'); ?>
							</label>
						</div>
					</div>
				</div>
				<div class="rtrb-modal-footer">
					<a href="#" class="rtrb-btn rtrb-btn-primary" id="rtrb-modal-edit-btn"><?php esc_html_e('Edit content', 'radius-blocks'); ?></a>
					<button type="submit" class="rtrb-btn rtrb-btn-primary" id="rtrb-modal-save-btn"><?php esc_html_e('Save changes', 'radius-blocks'); ?></button>
				</div>
				<span class="rtrb-spinner"></span>
			</div>
		</form>
	</div>
	<div class="rtrb-modal-backdrop"></div>
</div>