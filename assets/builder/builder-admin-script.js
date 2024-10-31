
/* global wp */
(function ($) {
	"use strict";

	var GModal = null;

	var rtrbModal = function rtrbModal() {
		this.$modal = $('#rtrb-builder-modal');

		this.show = function () {
			var modal = this;
			$(document).trigger('rtrb.Modal.show', this.$modal);
			$('body').addClass('rtrb-modal-open');
			this.$modal.find('.rtrb-modal-backdrop, .rtrb-modal-close').on('click', function () {
				modal.close();
			});
			document.addEventListener('keydown', function (event) {
				if (event.key === "Escape") {
					modal.close();
				}
			});
			GModal = modal;
		};

		this.addLoading = function () {
			$(document).trigger('rtrb.Modal.addLoading', this.$modal);
			this.$modal.addClass('loading');
			return this;
		};

		this.removeLoading = function () {
			$(document).trigger('rtrb.Modal.removeLoading', this.$modal);
			this.$modal.removeClass('loading');
			return this;
		};

		this.close = function () {
			$(document).trigger('rtrb.Modal.close', this.$modal);
			this.$modal.removeClass('loading in');
			$('body').removeClass('rtrb-modal-open');
			this.$modal.find('.rtrb-modal-backdrop, .rtrb-modal-close').off('click');
			return this;
		};
	};

	function initModalData(data) {
		$("#rtrb-builder-modal-title").val(data.title);
		$("#rtrb-builder-modal-condition_a").val(data.condition_a);
		$("#rtrb-builder-modal-condition_singular").val(data.condition_singular);
		$("#rtrb-builder-model-condition_singular_ids").val(data.condition_singular_ids);
		$("#rtrb-builder-modal-condition_archive").val(data.condition_archive);
		$("#rtrb-builder-modal-type").val(data.type);
		var $activation = $("#rtrb-builder-modal-activation");

		if (data.activation) {
			$activation.attr("checked", !0);
		} else {
			$activation.removeAttr("checked");
		}

		$("#rtrb-builder-modal-activation, #rtrb-builder-modal-type, #rtrb-builder-modal-condition_a, #rtrb-builder-modal-condition_singular, #rtrb-builder-modal-condition_archive").trigger("change");

		var $ids = $("#rtrb-builder-modal-condition_singular_ids");
		var modal = GModal ? GModal : new rtrbModal();
		$.ajax({
			url: rtrb_builder.ajaxurl,
			type: "POST",
			headers: {
				"X-WP-Nonce": rtrb_builder.nonce
			},
			dataType: "json",
			data: {
				ids: data.condition_singular_ids || [],
				action: 'rtrb_builder_ajax_singular_list'
			},
			beforeSend: function beforeSend() {
				modal.addLoading().show();
			},
			success: function success(res) {
				modal.removeLoading();

				if (res.results.length) {
					$ids.html('');
					$.each(res.results, function (t, e) {
						var a = new Option(e.text, e.id, !0, !0);
						$ids.append(a).trigger("change");
					});
				}

				$ids.trigger({
					type: "select2:select",
					params: {
						data: res
					}
				});
			}
		});
	}

	$(function () {
		$(".row-actions .edit a, .page-title-action, .row-title").on("click", function (e) {
			e.preventDefault();
			var title_col = $(this).parents(".column-title");
			var modal = GModal ? GModal : new rtrbModal();
			var pId = 0;



			if (title_col.length) {

				pId = title_col.find(".hidden").attr("id").split("_")[1];
				$.ajax({
					url: rtrb_builder.ajaxurl,
					type: "POST",
					headers: {
						"X-WP-Nonce": rtrb_builder.nonce
					},
					dataType: "json",
					data: {
						id: pId,
						action: 'rtrb_builder_ajax_builder_get'
					},
					beforeSend: function beforeSend() {
						modal.addLoading().show();
					},
					success: function success(res) {
						modal.removeLoading();

						if (res.success) {
							initModalData(res.data);
						} else {
							alert('Error while loading builder modal');
						}
					}
				});
			} else {

				initModalData({
					title: "",
					type: "header",
					condition_a: "entire_site",
					condition_singular: "all",
					activation: false
				});
			}

			if (pId) {
				$("#rtrb-modal-edit-btn").attr('href', rtrb_builder.editUrl.replace("%d%", pId));
			} else {
				$("#rtrb-modal-edit-btn").attr('href', '#');
			}

			modal.$modal.find('form').attr('data-id', pId);
		});
		$('#rtrb-builder-modal-type').on('change', function () {
			var value = $(this).val();
			var options_wrap = $("#rtrb-builder-options-container");

			if ("section" === value) {
				options_wrap.hide();
			} else {
				options_wrap.show();
			}
		});
		$('#rtrb-builder-modal-condition_a').on('change', function () {
			var value = $(this).val();
			var singular_wrap = $("#rtrb-builder-modal-condition_singular-container");
			var archive_wrap = $("#rtrb-builder-modal-condition_archive-container");

			if ("singular" === value) {
				singular_wrap.show();
				archive_wrap.hide();
			} else if ("archive" === value) {
				singular_wrap.hide();
				archive_wrap.show();
			} else {
				singular_wrap.hide();
				archive_wrap.hide();
			}
		});
		$('#rtrb-builder-modal-condition_singular').on('change', function () {
			var value = $(this).val();
			var options_wrap = $("#rtrb-builder-modal-condition_singular_ids-container");

			if ("selective" === value) {
				options_wrap.show();
			} else {
				options_wrap.hide();
			}
		});
		$("#rtrb-builder-modal-condition_singular_ids").select2({
			ajax: {
				url: rtrb_builder.ajaxurl,
				dataType: "json",
				data: function data(t) {
					return {
						s: t.term,
						action: 'rtrb_builder_ajax_singular_list'
					};
				}
			},
			cache: !0,
			placeholder: "--",
			dropdownParent: $("#rtrb-modal-body")
		});
		$("#rtrb-builder-modal-form").on('submit', function (e) {
			e.preventDefault();
			var modal = GModal ? GModal : new rtrbModal();
			var data = new FormData(this);
			data.append('action', 'rtrb_builder_ajax_builder_update');
			data.append('id', modal.$modal.find('form').attr("data-id"));
			$.ajax({
				url: rtrb_builder.ajaxurl,
				dataType: "json",
				data: data,
				type: "POST",
				cache: false,
				processData: false,
				contentType: false,
				headers: {
					"X-WP-Nonce": rtrb_builder.nonce
				},
				beforeSend: function beforeSend() {
					modal.addLoading();
				},
				success: function success(res) {
					modal.removeLoading();

					if (res.success) {
						var $exist = $("#post-" + res.data.id);

						if ($exist.length) {
							$exist.find(".column-type").html(res.data.type_html);
							$exist.find(".column-condition").html(res.data.cond_text);
							$exist.find(".row-title").html(res.data.title).attr("aria-label", res.data.title);
						} else {
							window.location.href = rtrb_builder.adminUrl;
						}
					}
				}
			});
		});
	});
})(jQuery);

