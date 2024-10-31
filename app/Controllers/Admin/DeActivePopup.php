<?php

namespace RadiusTheme\RB\Controllers\Admin;

use RadiusTheme\RB\Traits\SingletonTrait;

class DeActivePopup
{
	use SingletonTrait;
	public string $textdomain = 'radius-blocks';
	public function __construct()
	{
		add_action('admin_footer', [$this, 'deactivation_popup'], 99);
	}

	/***
	 * @param $mimes
	 *
	 * @return mixed
	 */
	public function deactivation_popup()
	{
		global $pagenow;
		if ('plugins.php' !== $pagenow) {
			return;
		}

		$this->dialog_box_style();
		$this->deactivation_scripts();
?>
		<div id="deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>" title="Quick Feedback">
			<!-- Modal content -->
			<div class="modal-content">
				<div id="feedback-form-body-<?php echo esc_attr($this->textdomain); ?>">

					<div class="feedback-input-wrapper">
						<input id="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-bug_issue_detected" class="feedback-input" type="radio" name="reason_key" value="bug_issue_detected">
						<label for="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-bug_issue_detected" class="feedback-label"><?php echo esc_html('Bug or issue detected', 'radius-blocks'); ?></label>
					</div>

					<div class="feedback-input-wrapper">
						<input id="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-no_longer_needed" class="feedback-input" type="radio" name="reason_key" value="no_longer_needed">
						<label for="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-no_longer_needed" class="feedback-label"><?php echo esc_html('I no longer need the plugin', 'radius-blocks'); ?></label>
					</div>
					<div class="feedback-input-wrapper found-plugin">
						<input id="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-found_a_better_plugin" class="feedback-input" type="radio" name="reason_key" value="found_a_better_plugin">
						<label for="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-found_a_better_plugin" class="feedback-label"><?php echo esc_html('I found a better plugin', 'radius-blocks'); ?></label>
						<input class="feedback-feedback-text" type="text" name="reason_found_a_better_plugin" placeholder="Please share the plugin name">
					</div>
					<div class="feedback-input-wrapper">
						<input id="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-couldnt_get_the_plugin_to_work" class="feedback-input" type="radio" name="reason_key" value="couldnt_get_the_plugin_to_work">
						<label for="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-couldnt_get_the_plugin_to_work" class="feedback-label"><?php echo esc_html("I couldn't get the plugin to work", 'radius-blocks'); ?></label>
					</div>

					<div class="feedback-input-wrapper">
						<input id="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-temporary_deactivation" class="feedback-input" type="radio" name="reason_key" value="temporary_deactivation">
						<label for="feedback-deactivate-<?php echo esc_attr($this->textdomain); ?>-temporary_deactivation" class="feedback-label"><?php echo esc_html("It's a temporary deactivation", 'radius-blocks'); ?></label>
					</div>
					<p class="error-display" style="color:red;font-size: 16px;"></p>
				</div>
				<p style="margin: 0 0 15px 0;">
					<?php echo esc_html("Please let us know about any issues you are facing with the plugin.
					How can we improve the plugin?", "radius-blocks"); ?>
				</p>
				<div class="feedback-text-wrapper-<?php echo esc_attr($this->textdomain); ?>">
					<textarea id="deactivation-feedback-<?php echo esc_attr($this->textdomain); ?>" rows="4" cols="40" placeholder=" Write something here. How can we improve the plugin?"></textarea>
					<p class="error-display" style="color:red;font-size: 16px;"></p>
				</div>
				<p style="margin: 0;">
					<?php echo esc_html("Your satisfaction is our utmost inspiration. Thank you for your feedback.", "radius-blocks"); ?>
				</p>
			</div>
		</div>
	<?php
	}

	/***
	 * @param $mimes
	 *
	 * @return mixed
	 */
	public function dialog_box_style()
	{
	?>
		<style>
			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?> {
				display: none;
			}

			.ui-dialog-titlebar-close {
				display: none;
			}

			/* The Modal (background) */
			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>.modal {
				display: none;
				/* Hidden by default */
				position: fixed;
				/* Stay in place */
				z-index: 1;
				/* Sit on top */
				padding-top: 100px;
				/* Location of the box */
				left: 0;
				top: 0;
				width: 100%;
				/* Full width */
				height: 100%;
				/* Full height */
				overflow: auto;
				/* Enable scroll if needed */
			}

			/* Modal Content */
			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>.modal-content {
				position: relative;
				margin: auto;
				padding: 0;
			}

			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>.feedback-label {
				font-size: 15px;
			}

			div#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>p {
				font-size: 16px;
			}

			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>.modal-content>* {
				width: 100%;
				padding: 5px 2px;
				overflow: hidden;
			}

			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>.modal-content textarea {
				border: 1px solid rgba(0, 0, 0, 0.3);
				padding: 15px;
				width: 100%;
			}

			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>.modal-content input.feedback-feedback-text {
				border: 1px solid rgba(0, 0, 0, 0.3);
				min-width: 250px;
			}

			/* The Close Button */
			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>input[type="radio"] {
				margin: 0;
			}

			.ui-dialog-title {
				font-size: 18px;
				font-weight: 600;
			}

			#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>.modal-body {
				padding: 2px 16px;
			}

			.ui-dialog-buttonset {
				background-color: #fefefe;
				padding: 0 30px 30px;
				display: flex;
				justify-content: space-between;
				gap: 10px;
			}

			.ui-dialog-buttonset button {
				min-width: 110px;
				text-align: center;
				border: 1px solid rgba(0, 0, 0, 0.1);
				padding: 0 15px;
				border-radius: 5px;
				height: 40px;
				font-size: 15px;
				font-weight: 600;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				cursor: pointer;
				transition: 0.3s all;
				background: rgba(0, 0, 0, 0.02);
				margin: 0;
			}

			.ui-dialog-buttonset button.rtrb-loading::before {
				display: inline-block;
				content: "\f463";
				font: 18px dashicons;
				animation: rtrb-loading-rotation 2s linear infinite;
			}

			.ui-dialog-buttonset button.rtrb-loading {
				background: #2271b1;
				color: #fff;
			}

			.ui-dialog-buttonset button:nth-child(2) {
				background: transparent;
			}

			.ui-dialog-buttonset button:hover {
				background: #2271b1;
				color: #fff;
			}

			.ui-dialog[aria-describedby="deactivation-dialog-radius-blocks"] {
				background-color: #fefefe;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
				z-index: 99;
			}

			div#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?> {
				padding: 30px;
			}

			.ui-draggable .ui-dialog-titlebar {
				padding: 18px 15px;
			}

			div#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>,
			.ui-draggable .ui-dialog-titlebar {
				box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
				text-align: left;
			}

			.modal-content .feedback-input-wrapper {
				margin-bottom: 8px;
				display: flex;
				align-items: center;
				gap: 8px;
				line-height: 2;
				padding: 0 2px;
			}

			.ui-widget-overlay.ui-front {
				position: fixed;
				height: 100%;
				width: 100%;
				bottom: 0;
				left: 0;
				background-color: rgba(0, 0, 0, .8);
				z-index: 9999;
				-webkit-user-select: none;
				-moz-user-select: none;
				user-select: none;
			}

			.modal-content .feedback-input-wrapper .feedback-feedback-text {
				display: none;
			}

			.modal-content .feedback-input-wrapper input[type="radio"][value="found_a_better_plugin"]:checked+label+.feedback-feedback-text {
				display: block;
			}

			.modal-content .feedback-input-wrapper input[type=radio] {
				box-shadow: none !important;
			}

			@keyframes rtrb-loading-rotation {
				0% {
					transform: rotate(0deg)
				}

				to {
					transform: rotate(359deg)
				}
			}
		</style>

	<?php
	}

	/***
	 * @param $mimes
	 *
	 * @return mixed
	 */
	public function deactivation_scripts()
	{
		wp_enqueue_script('jquery-ui-dialog');
	?>
		<script>
			jQuery(document).ready(function($) {
				var deactivationDialog;
				// Open the deactivation dialog when the 'Deactivate' link is clicked
				$('.deactivate #deactivate-radius-blocks').on('click', function(e) {
					e.preventDefault();
					var href = $('.deactivate #deactivate-radius-blocks').attr('href');
					var given = localRetrieveData("feedback-given");

					// If set for limited time.
					if ('given' === given) {
						// window.location.href = href;
						// return;
					}

					deactivationDialog = $('#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>');

					deactivationDialog.dialog({
						modal: true,
						width: 500,
						show: {
							effect: "fadeIn",
							duration: 400
						},
						hide: {
							effect: "fadeOut",
							duration: 100
						},

						buttons: {
							Submit: function() {
								submitFeedback();
							},
							Cancel: function() {
								$(this).dialog('close');
								window.location.href = href;
							}
						}
					});
					// Customize the button text
					$('.ui-dialog-buttonpane button:contains("Submit")').text('Send & Deactivate');
					$('.ui-dialog-buttonpane button:contains("Cancel")').text('Skip & Deactivate');
				});

				// Submit the feedback
				function submitFeedback() {
					var href = $('.deactivate #deactivate-radius-blocks').attr('href');
					var reasons = $('#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?> input[type="radio"]:checked').val();
					var feedback = $('#deactivation-feedback-<?php echo esc_attr($this->textdomain); ?>').val();
					var better_plugin = $('#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?> .modal-content input[name="reason_found_a_better_plugin"]').val();
					// Perform AJAX request to submit feedback
					if (!reasons && !feedback && !better_plugin) {
						// Define flag variables
						$('#feedback-form-body-<?php echo esc_attr($this->textdomain); ?> .error-display').text('Choose The Reason');
						$('.feedback-text-wrapper-<?php echo esc_attr($this->textdomain); ?> .error-display').text('Please provide me with some advice.');
						return;
					}

					$('.ui-dialog-buttonpane .ui-dialog-buttonset button:first-child').addClass('rtrb-loading');
					$('.ui-dialog-buttonpane .ui-dialog-buttonset button:first-child').text('');

					if ('temporary_deactivation' == reasons && !feedback) {
						window.location.href = href;
					}

					$.ajax({
						url: 'https://radiusblocks.com/wp-json/RadiusTheme/pluginSurvey/v1/Survey/appendToSheet',
						method: 'GET',
						dataType: 'json',
						data: {
							website: '<?php echo esc_url(home_url()) ?>',
							reasons: reasons ? reasons : '',
							better_plugin: better_plugin,
							feedback: feedback,
							wpplugin: 'RadiusBlocks',
						},
						success: function(response) {
							if (response.success) {
								console.log('Success');
								localStoreData("feedback-given", 'given');
							}
						},
						error: function(xhr, status, error) {
							// Handle the error response
							console.error('Error', error);
						},
						complete: function(xhr, status) {
							$('#deactivation-dialog-<?php echo esc_attr($this->textdomain); ?>').dialog('close');
							window.location.href = href;

						}

					});
				}

				// Store data in local storage with an expiration time of 1 hour
				function localStoreData(key, value) {
					// Calculate the expiration time in milliseconds (1 hour = 60 minutes * 60 seconds * 1000 milliseconds)
					var expirationTime = Date.now() + (60 * 60 * 1000);

					// Create an object to store the data and expiration time
					var dataObject = {
						value: value,
						expirationTime: expirationTime
					};

					// Store the object in local storage
					localStorage.setItem(key, JSON.stringify(dataObject));
				}

				// Retrieve data from local storage
				function localRetrieveData(key) {
					// Get the stored data from local storage
					var data = localStorage.getItem(key);
					if (data) {
						// Parse the stored JSON data
						var dataObject = JSON.parse(data);
						// Check if the data has expired
						if (Date.now() <= dataObject.expirationTime) {
							// Return the stored value
							return dataObject.value;
						} else {
							// Data has expired, remove it from local storage
							localStorage.removeItem(key);
						}
					}
					// Return null if data doesn't exist or has expired
					return null;
				}

				// Handle overlay click event to close the dialog
				$(document).on('click', '.ui-widget-overlay', function(event) {
					// Check if the click event target is not within the dialog
					if (deactivationDialog && !deactivationDialog.is(event.target) && deactivationDialog.has(event.target).length === 0) {
						deactivationDialog.dialog('close');
					}
				});

			});
		</script>

<?php
	}
}
