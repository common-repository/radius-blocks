window.Project = (function (window, document, $) {
	'use strict';

	var app = {

		initialize: function () {
			app.tabs();
			$(document).on("click", "#rtrb-admin-settings-save-btn > button", app.saveSettings);
		},

		tabs: function () {
			$(".rtrb-tab-list li a").on("click", function (e) {
				e.preventDefault();
				$(".rtrb-tab-list li a").removeClass("active");
				$(this).addClass("active");
				var tab = $(this).attr("href");
				$(".rtrb-settings-tab-content").removeClass("active");
				$(".rtrb-settings-tabs-wrap").find(tab).addClass("active");
			});
		},

		saveSettings: function (e) {
			e.preventDefault();
			$.ajax({
				url: rtrbAdminSettings.ajax_url,
				type: "post",
				data: {
					action: "rtrb_save_block_settings",
					_wpnonce: rtrbAdminSettings.nonce,
					all_blocks: rtrbAdminSettings.all_blocks
				},
				success: function () {
					swal({
						text: "Successfully saved!",
						icon: "success",
						timer: 1000,
						button: false,
					});

				},
				error: function () {
					swal({
						title: "Error!",
						text: "You clicked the Ok!",
						icon: "error",
						timer: 1000,
						buttons: "Ok",
					});
				}

			});
			return false;
		}

	}

	$(document).ready(app.initialize);
	return app;
})(window, document, jQuery);
