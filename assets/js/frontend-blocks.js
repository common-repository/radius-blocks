window.Project = (function (window, document, $) {
	'use strict';

	//add search template
	const searchIconBtn2 = $('a[href = "#rtrb-search-template"]');
	const blockUnickClass = searchIconBtn2.attr('data-blockid');
	const pText = searchIconBtn2.attr('data-ptext');
	const submitIcon = searchIconBtn2.attr('data-sbtn');
	if (searchIconBtn2 && blockUnickClass) {
		document.body.innerHTML += `
		<div id="rtrb-search-template" class="${blockUnickClass} rtrb-search-box-overlay">
			<button type="button" class="rtrb-search-close-btn rtrb-close-btn2">×</button>
			<form class="rtrb-search-form" role="search" action="/" method="get">
				<input type="search" placeholder="${pText}" name="s" title="Search" class="rtrb-search-input" />
				${submitIcon ? '<button class="rtrb-search-btn" type="submit"><svg width="1em" height="1em" viewBox="0 0 25 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M24.3569 23.6399L18.0081 17.2885C19.6706 15.452 20.6921 13.0234 20.6921 10.3509C20.6913 4.63387 16.0596 0 10.3457 0C4.63172 0 0 4.63387 0 10.3509C0 16.0678 4.63172 20.7017 10.3457 20.7017C12.8145 20.7017 15.0788 19.8336 16.8575 18.3902L23.2309 24.7667C23.5414 25.0778 24.0456 25.0778 24.3561 24.7667C24.6674 24.4557 24.6674 23.9509 24.3569 23.6399ZM10.3457 19.1092C5.51104 19.1092 1.59183 15.188 1.59183 10.3509C1.59183 5.51376 5.51104 1.59254 10.3457 1.59254C15.1803 1.59254 19.0995 5.51376 19.0995 10.3509C19.0995 15.188 15.1803 19.1092 10.3457 19.1092Z"></path></svg></button>' : ''}
			</form>
		</div>`;
	}

	var app = {
		initialize: function () {
			app.buttonBock();
			app.accordionBlock();
			app.countDownBlock();
			app.countDownBlockLayout6();
			app.counterBlock();
			app.advancedTab();
			app.advancedVideo();
			app.searchBlock();
			app.noticeDisclosure();
			app.instagramFeed();
			app.socialShare();
			app.imageAccordion();
			app.addToCartButton();
			app.flipBox();
		},
		flipBox: function () {
			let flipbox = document.querySelectorAll(".rtrb-fliper");
			for (let i = 0; i < flipbox.length; i++) {
				let flipBehavior = flipbox[i].getAttribute("data-flip-behavior");
				if (flipBehavior === 'hover') {
					$(flipbox[i]).mouseenter(function () {
						$(flipbox[i]).addClass('flip-back-selected');
					}).mouseleave(function () {
						$(flipbox[i]).removeClass('flip-back-selected');
					});
				} else if (flipBehavior === 'click') {
					$(flipbox[i]).click(function () {
						$(flipbox[i]).addClass('flip-back-selected');
					}).mouseleave(function () {
						$(flipbox[i]).removeClass('flip-back-selected');
					});
				}
			}
		},
		instagramFeed: function () {
			const instagrams = document.getElementsByClassName(`rtrb-instagram-gallery`);

			setTimeout(() => {
				for (let instagram of instagrams) {
					var iso;

					imagesLoaded(instagram, function () {
						iso = new Isotope(instagram, {
							itemSelector: ".rtrb-instagram-gallery-col",
							percentPosition: true,
							masonry: {
								columnWidth: ".rtrb-instagram-gallery-col",
							},
						});
					});
				}
			}, 1000);
		},

		noticeDisclosure: function () {

			let notices = document.querySelectorAll(".rtrb-notice-wrapper");

			for (let i = 0; i < notices.length; i++) {
				let dismissButton = notices[i].querySelector(".rtrb-notice-disclosure");

				//if dismissbutton is not found then return
				if (!dismissButton) {
					return;
				}

				let noticeId = notices[i].getAttribute("data-notice-id");
				let noticeAgain = notices[i].getAttribute("data-appear-again");
				let alreadyNoticeHiddenPermanently = localStorage.getItem(`rtrb-notice-hidden-permanently-${noticeId}`);

				noticeAgain === 'true' && noticeAppearAgain(noticeId);
				noticeAgain === 'false' && alreadyNoticeHiddenPermanently === '1' && removeNotice(notices[i]);

				//dismissbutton click then fire
				dismissButton.addEventListener('click', function () {
					onDisclosureButtonClick(notices[i]);
				})
			}

			function noticeDeletePermanently(noticeId) {
				localStorage.setItem(`rtrb-notice-hidden-permanently-${noticeId}`, '1')
			}

			function noticeAppearAgain(noticeId) {
				localStorage.hasOwnProperty(`rtrb-notice-hidden-permanently-${noticeId}`) && localStorage.removeItem(`rtrb-notice-hidden-permanently-${noticeId}`)
			}

			function removeNotice(notice) {
				notice.remove()
			}

			function onDisclosureButtonClick(notice) {
				let noticeId = notice.getAttribute('data-notice-id');
				let noticeAgain = notice.getAttribute('data-appear-again');
				noticeAgain === 'true' && noticeAppearAgain(noticeId);
				noticeAgain === 'false' && noticeDeletePermanently(noticeId);
				removeNotice(notice);
			}
		},

		addToCartButton: function () {

			$('.rtrb-button.add_to_cart_btn').on('click', function (event) {
				event.preventDefault();
				var $thisproduct = $(this);
				var product_id = $(this).data('product-id');
				var quantity = 1;
				$.ajax({
					url: rtrbParams.ajaxurl,
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'rtrb_add_to_cart',
						product_id: product_id,
						quantity: quantity
					},
					success: function (data) {
						if (data.success) {
							$thisproduct.addClass('added');
							let viewcartHtml = `<a href="${data.cart_url}">
							<svg width="15" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M19.7031 6.04049C19.439 5.68661 19.0428 5.4836 18.616 5.4836H14.7643L12.6756 0.375545C12.5461 0.0588394 12.2007 -0.0858914 11.9042 0.0524978C11.6076 0.190804 11.4722 0.559744 11.6017 0.876492L13.4855 5.48364H6.51449L8.39828 0.876492C8.52777 0.559744 8.39238 0.190845 8.09582 0.0524978C7.7993 -0.0858914 7.45387 0.058756 7.32438 0.375545L5.23574 5.48364H1.38403C0.957229 5.48364 0.561018 5.68661 0.296916 6.04053C0.0376587 6.38799 -0.0580053 6.83466 0.0344556 7.26614L2.09137 16.862C2.235 17.5321 2.78996 18 3.44094 18H16.5591C17.21 18 17.765 17.5321 17.9086 16.862L19.9655 7.26609C20.058 6.83461 19.9623 6.38795 19.7031 6.04049ZM16.5591 16.7483H3.44094C3.34145 16.7483 3.2543 16.6786 3.23371 16.5826L1.1768 6.98681C1.16067 6.91151 1.18774 6.85485 1.21336 6.8206C1.23711 6.78872 1.2909 6.73528 1.38403 6.73528H4.72399L4.57051 7.11064C4.44102 7.42739 4.57641 7.79629 4.87297 7.93464C4.9493 7.97026 5.02883 7.98712 5.10715 7.98712C5.33301 7.98712 5.54824 7.84681 5.64441 7.61163L6.00274 6.73536H13.9973L14.3557 7.61163C14.4518 7.84685 14.6671 7.98712 14.8929 7.98712C14.9712 7.98712 15.0508 7.97026 15.1271 7.93464C15.4237 7.79633 15.5591 7.42739 15.4296 7.11064L15.2761 6.73528H18.6161C18.7092 6.73528 18.763 6.78872 18.7867 6.8206C18.8123 6.85489 18.8394 6.91155 18.8233 6.98677L16.7664 16.5826C16.7457 16.6786 16.6586 16.7483 16.5591 16.7483Z" fill="currentColor"></path>
								<path d="M6.48438 9.44711C6.16078 9.44711 5.89844 9.72731 5.89844 10.0729V14.6623C5.89844 15.0079 6.16078 15.2881 6.48438 15.2881C6.80797 15.2881 7.07031 15.0079 7.07031 14.6623V10.0729C7.07031 9.72731 6.80801 9.44711 6.48438 9.44711Z" fill="currentColor"></path>
								<path d="M10 9.44711C9.67641 9.44711 9.41406 9.72731 9.41406 10.0729V14.6623C9.41406 15.0079 9.67641 15.2881 10 15.2881C10.3236 15.2881 10.5859 15.0079 10.5859 14.6623V10.0729C10.5859 9.72731 10.3236 9.44711 10 9.44711Z" fill="currentColor"></path>
								<path d="M13.5156 9.44711C13.192 9.44711 12.9297 9.72731 12.9297 10.0729V14.6623C12.9297 15.0079 13.192 15.2881 13.5156 15.2881C13.8392 15.2881 14.1016 15.0079 14.1016 14.6623V10.0729C14.1015 9.72731 13.8392 9.44711 13.5156 9.44711Z" fill="currentColor"></path>
							</svg>
							<span>View cart</span>
							</a>`;
							$(viewcartHtml).insertAfter($thisproduct);
						}
					}
				});
			});
		},

		imageAccordion: function () {
			if ($('.rtrb-image-accordion-wrapper')) {
				$('.rtrb-image-accordion-wrapper').each(function () {

					var imageAccordions = $(this);
					let activeType = imageAccordions.find('.item').data('active-type')

					if (activeType == 'click') {

						imageAccordions.find('.item').click(function () {
							$(this).parent().find('.item').removeClass('item-active');
							$(this).parent().find('.item').removeClass('checkedItem');
							$(this).addClass('item-active');
						})
					}

					if (activeType == 'hover') {
						imageAccordions.find('.item').mouseover(function () {
							$(this).parent().find('.item').removeClass('checkedItem');
						})
					}

				})
			}
		},

		socialShare: function () {
			$(document).on(
				'click',
				'.rtrb-share-btn[target="_blank"]',
				function (event) {
					event.preventDefault();

					let windowSize = '';
					const url = this.href,
						domain = url.split('/')[2];

					switch (domain) {
						case 'www.facebook.com':
							windowSize = 'width=585,height=368';
							break;
						case 'twitter.com':
							windowSize = 'width=585,height=261';
							break;
						case 'pinterest.com':
							windowSize = 'width=750,height=550';
							break;
						default:
							windowSize = 'width=585,height=515';
					}
					window.open(
						url,
						'',
						'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,' +
						windowSize
					);
				}
			);
		},

		newsTicker: function () {
			if ($('.rtrb-ticker-wrapper')) {
				$(".rtrb-ticker-wrapper").each(function (i) {

					// local variable 
					const rtrbTicker = $(this);
					const _tickerType = $(this).data("ticker-type");
					const _tickerDirection = rtrbTicker.data("ticker-direction");
					const _tickerSpeed = rtrbTicker.data("ticker-speed");
					const _stopOnHover = Boolean(rtrbTicker.data("ticker-stop-hover"));
					const _ticker = $(this).find('.rtrb-news-ticker-data');
					const _tickerPrev = $(this).find(".rtrb-news-ticker-prev");
					const _tickerNext = $(this).find(".rtrb-news-ticker-next");

					setTimeout(function () {
						rtrbTicker.animate({ opacity: "1" });
						rtrbTicker.parents('.rtrb-preloader-wrapper').addClass('rtrb-preloader-init');
					}, 100)

					// AcmeTicker init
					_ticker.AcmeTicker({
						type: _tickerType || 'horizontal',
						direction: _tickerDirection || 'right',
						speed: _tickerSpeed || 1500,
						pauseOnHover: _stopOnHover,
						controls: {
							prev: _tickerPrev,
							next: _tickerNext
						}
					});

				})
			}
		},

		searchBlock: function () {
			const searchIconBtn2 = $('a[href = "#rtrb-search-template"]');
			const searchCloseBtn2 = $(".rtrb-search-close-btn.rtrb-close-btn2");
			const searchOverlay2 = $("#rtrb-search-template");
			if (searchIconBtn2) {
				searchIconBtn2.on('click', function () {
					searchOverlay2.css({ "bottom": "0", "opacity": "1" });
					searchCloseBtn2.css({ 'visibility': 'visible' })
				})
			}
			if (searchCloseBtn2) {
				searchCloseBtn2.on('click', function () {
					searchOverlay2.css({ "bottom": "100%", "opacity": "0" });
					searchCloseBtn2.css({ 'visibility': 'hidden' })
				})
			}

			$('#rtrb-search-icon3').on('click', function (event) {
				event.preventDefault();

				var target = $("#rtrb-search-template3");
				target.removeClass("close-change");
				target.addClass("header-search-open");

				var self_class = $('#rtrb-search-icon3');
				self_class.addClass("close-change");
				self_class.removeClass("open-change");

				var self_close = $('#rtrb-search-close-icon3');
				self_close.addClass("open-change");
				self_close.removeClass("close-change");

				setTimeout(function () {
					target.find('input').focus();
				}, 600);
				return false;
			});

			$('#rtrb-search-close-icon3').on('click', function (event) {
				event.preventDefault();

				var target = $("#rtrb-search-template3");
				target.addClass("close-change");
				target.removeClass("header-search-open");

				var self_class = $('#rtrb-search-icon3');
				self_class.removeClass("close-change");
				self_class.addClass("open-change");

				var self_close = $('#rtrb-search-close-icon3');
				self_close.removeClass("open-change");
				self_close.addClass("close-change");

				setTimeout(function () {
					target.find('input').focus();
				}, 600);
				return false;
			});
		},

		advancedVideo: function () {
			const videoContainer = $(".rtrb-advanced-video-area");
			if (videoContainer.length) {
				for (let i = 0; i < videoContainer.length; i++) {

					const tagElementVideo = videoContainer[i].querySelector('.rtrb-advanced-video-wrapper');
					const tagElementPlay = videoContainer[i].querySelector('.rtrb-video-play-show');
					const tagElementPlayIcon = videoContainer[i].querySelector('.rtrb-play-icon');

					let url = $(tagElementVideo).attr('data-url');
					let videoAutoplay = $(tagElementVideo).attr('data-autoplay') == 'on' ? true : false;
					let videoMuted = $(tagElementVideo).attr('data-muted') == 'on' ? true : false;
					let videoControl = $(tagElementVideo).attr('data-control') == 'on' ? true : false;
					let videoLoop = $(tagElementVideo).attr('data-loop') == 'on' ? true : false;

					if (tagElementPlay) {
						$(tagElementPlayIcon).on("click", function (event) {
							event.preventDefault();
							$(tagElementPlay).hide();
							$(tagElementVideo).show();
						});
					}

					renderReactPlayer(tagElementVideo, {
						url,
						width: '100%',
						height: '100%',
						className: 'rtrb-video-player',
						controls: videoControl,
						playing: videoAutoplay,
						muted: videoMuted,
						loop: videoLoop
					});
				}
			}
		},

		advancedTab: function () {
			const rtrbTabWrappers = document.querySelectorAll('.rtrb-tabs-wrapper');
			if (rtrbTabWrappers.length) {
				// for scoped
				rtrbTabWrappers.forEach((rtrbTabWrapper) => {
					const rtrbTabLabels = rtrbTabWrapper.querySelectorAll(".rtrb-tab-nav .rtrb-tab-nav-item");
					const rtrbTabPanes = rtrbTabWrapper.querySelectorAll(".rtrb-tab-pane-wrapper .rtrb-tab-pane");
					if (rtrbTabLabels.length) {
						rtrbTabLabels.forEach(item => {
							item.addEventListener('click', function () {

								// menu item 
								rtrbTabLabels.forEach(lableItem => {
									lableItem.classList.remove('active');
								})

								// tab pane item 
								rtrbTabPanes.forEach(paneItem => {
									paneItem.classList.remove('active');
								})
								// matching by data-rt-tab-id and pass active class
								const valueMatchingTab = this.getAttribute('data-rt-tab-id');
								const getMatchingTab = rtrbTabWrapper.querySelectorAll(`[data-rt-tab-id="${valueMatchingTab}"]`)
								getMatchingTab.forEach(ele => ele.classList.add('active'))
							})
						})
					}
				})
			}
		},

		buttonBock: function () {
			if ($('.rt-position-aware-btn')) {
				$('.rt-position-aware-btn')
					.on('mouseenter', function (e) {
						const parentOffset = $(this).offset(),
							relX = e.pageX - parentOffset.left,
							relY = e.pageY - parentOffset.top;
						$(this).find('span').css({ top: relY, left: relX })
					})
					.on('mouseout', function (e) {
						const parentOffset = $(this).offset(),
							relX = e.pageX - parentOffset.left,
							relY = e.pageY - parentOffset.top;
						$(this).find('span').css({ top: relY, left: relX })
					});
			}
		},

		accordionBlock: function () {
			if ($('.rtrb-accordion__list')) {
				$('.rtrb-accordion__list').each(function () {
					var list = $(this)
					var accordionType = $(this).attr('data-accordionType');
					list.find('.rtrb-accordion__item:not(.rt-expand-tab) > .rtrb-accordion__content').hide();

					if (accordionType == 'accordion') {
						list.find('.rtrb-accordion__item > .rtrb-accordion__header').click(function () {
							var item = $(this).parents('.rtrb-accordion__item');
							if (item.hasClass('rt-expand-tab')) {
								item.removeClass("rt-expand-tab").find(".rtrb-accordion__content").slideUp();
							} else {
								list.find('.rtrb-accordion__item.rt-expand-tab .rtrb-accordion__content').slideUp()
								list.find('.rtrb-accordion__item.rt-expand-tab').removeClass('rt-expand-tab')
								item.addClass("rt-expand-tab").find(".rtrb-accordion__content").slideDown();
							}
						})
					}

					if (accordionType == 'toggle') {
						list.find('.rtrb-accordion__item > .rtrb-accordion__header').click(function () {
							var item = $(this).parents('.rtrb-accordion__item');
							if (item.hasClass("rt-expand-tab")) {
								item.removeClass("rt-expand-tab").find(".rtrb-accordion__content").slideToggle();
							} else {
								item.addClass("rt-expand-tab").find(".rtrb-accordion__content").slideToggle();
							}
							return false;
						})
					}
				})
			}
		},

		countDownBlock: function () {
			const countdowns = $(".rtrbcd1");

			// Return no countdown block
			if (!countdowns) return;

			for (let i = 0; i < countdowns.length; i++) {
				const tagElement = countdowns[i];
				const deadlineDateTime = parseInt(tagElement.getAttribute("data-deadline-date-time"));

				const fakeElement = { textContent: "00" };
				const fakeElement2 = {
					textContent: "00",
					r: {
						baseVal: {
							value: 95
						}
					}
				};

				const daySpanTag = tagElement.querySelector(".rtrb-countdown__item.rt-day .rtrb-countdown__count") || fakeElement;
				const hourSpanTag = tagElement.querySelector(".rtrb-countdown__item.rt-hr .rtrb-countdown__count") || fakeElement;
				const minuteSpanTag = tagElement.querySelector(".rtrb-countdown__item.rt-min .rtrb-countdown__count") || fakeElement;
				const secondSpanTag = tagElement.querySelector(".rtrb-countdown__item.rt-sec .rtrb-countdown__count") || fakeElement;

				const dayCircleRef = tagElement.querySelector(".rtrb-countdown__item.rt-day .rtCircleTrackUp") || fakeElement2;
				const hoursCircleRef = tagElement.querySelector(".rtrb-countdown__item.rt-hr .rtCircleTrackUp") || fakeElement2;
				const minuteCirclesRef = tagElement.querySelector(".rtrb-countdown__item.rt-min .rtCircleTrackUp") || fakeElement2;
				const secondsCircleRef = tagElement.querySelector(".rtrb-countdown__item.rt-sec .rtCircleTrackUp") || fakeElement2;

				const dateTimeLeft = (deadlineDateTime, intervalId = null) => {
					const now = Date.now();
					const secondsLeft = Math.round((deadlineDateTime - now) / 1000);
					const seconds = secondsLeft % 60;
					const minutes = Math.floor(secondsLeft / 60) % 60;
					const hours = Math.floor(secondsLeft / 3600) % 24;
					const days = Math.floor(secondsLeft / 86400);

					if (secondsLeft < 0) {
						clearInterval(intervalId);
						daySpanTag.textContent = "00";
						hourSpanTag.textContent = "00";
						minuteSpanTag.textContent = "00";
						secondSpanTag.textContent = "00";
						return;
					}

					daySpanTag.textContent = days < 10 ? `0${days}` : `${days}`;
					hourSpanTag.textContent = hours < 10 ? `0${hours}` : `${hours}`;
					minuteSpanTag.textContent = minutes < 10 ? `0${minutes}` : `${minutes}`;
					secondSpanTag.textContent = seconds < 10 ? `0${seconds}` : `${seconds}`;

					if (tagElement.classList.contains('rtrb-countdown--style-5')) {
						// circular progress 

						// get deadline value (days, hours, minutes, seconds)
						const dayRefValue = Number(daySpanTag.textContent)
						const hrRefValue = Number(hourSpanTag.textContent)
						const minRefValue = Number(minuteSpanTag.textContent)
						const secRefValue = Number(secondSpanTag.textContent)

						// get base value of svg circle tags (days, hours, minutes, seconds)
						const radiusDay = dayCircleRef?.r?.baseVal?.value;
						const radiusHr = hoursCircleRef?.r?.baseVal?.value;
						const radiusMin = minuteCirclesRef?.r?.baseVal?.value;
						const radiusSec = secondsCircleRef?.r?.baseVal?.value;

						// get circumference (poridhi) value of svg circle (days, hours, minutes, seconds)
						const circumferenceDay = radiusDay * 2 * Math.PI;
						const circumferenceHr = radiusHr * 2 * Math.PI;
						const circumferenceMin = radiusMin * 2 * Math.PI;
						const circumferenceSec = radiusSec * 2 * Math.PI;

						// get track value for current circle status
						const dayDashOffVal = circumferenceDay - ((dayRefValue / 365) * circumferenceDay);
						const hrDashOffVal = circumferenceHr - ((hrRefValue / 24) * circumferenceHr);
						const minDashOffVal = circumferenceMin - ((minRefValue / 60) * circumferenceMin);
						const secDashOffVal = circumferenceSec - ((secRefValue / 60) * circumferenceSec);

						// css implement for circle tag strokeDasharray & strokeDashoffset
						dayCircleRef.style.strokeDasharray = circumferenceDay
						dayCircleRef.style.strokeDashoffset = dayDashOffVal

						hoursCircleRef.style.strokeDasharray = circumferenceHr
						hoursCircleRef.style.strokeDashoffset = hrDashOffVal

						minuteCirclesRef.style.strokeDasharray = circumferenceMin
						minuteCirclesRef.style.strokeDashoffset = minDashOffVal

						secondsCircleRef.style.strokeDasharray = circumferenceSec
						secondsCircleRef.style.strokeDashoffset = secDashOffVal

					}
				};

				dateTimeLeft(deadlineDateTime || 0);

				const intervalId = setInterval(() => {
					dateTimeLeft(deadlineDateTime || 0, intervalId);
				}, 1000);

			}
		},

		countDownBlockLayout6: function () {
			const countdowns = $(".rtrbcd2");

			// Return no countdown block
			if (!countdowns) return;

			for (let i = 0; i < countdowns.length; i++) {
				const tagElement = countdowns[i];
				const deadlineDateTime = parseInt(tagElement.getAttribute("data-deadline-date-time"));
				const fakeElement = { textContent: "0" };
				const daySpanTag1 = tagElement.querySelector(".rtrb-countdown__item.rt-day .rt-d1") || fakeElement;
				const daySpanTag2 = tagElement.querySelector(".rtrb-countdown__item.rt-day .rt-d2") || fakeElement;
				const daySpanTag3 = tagElement.querySelector(".rtrb-countdown__item.rt-day .rt-d3") || fakeElement;
				const hourSpanTag1 = tagElement.querySelector(".rtrb-countdown__item.rt-hr .rt-h1") || fakeElement;
				const hourSpanTag2 = tagElement.querySelector(".rtrb-countdown__item.rt-hr .rt-h2") || fakeElement;
				const minuteSpanTag1 = tagElement.querySelector(".rtrb-countdown__item.rt-min .rt-m1") || fakeElement;
				const minuteSpanTag2 = tagElement.querySelector(".rtrb-countdown__item.rt-min .rt-m2") || fakeElement;
				const secondSpanTag1 = tagElement.querySelector(".rtrb-countdown__item.rt-sec .rt-s1") || fakeElement;
				const secondSpanTag2 = tagElement.querySelector(".rtrb-countdown__item.rt-sec .rt-s2") || fakeElement;

				const dateTimeLeft = (deadlineDateTime, intervalId = null) => {
					const now = Date.now();
					const secondsLeft = Math.round((deadlineDateTime - now) / 1000);
					const seconds = (secondsLeft % 60).toString().split("");
					const minutes = (Math.floor(secondsLeft / 60) % 60).toString().split("");
					const hours = (Math.floor(secondsLeft / 3600) % 24).toString().split("");
					const days = (Math.floor(secondsLeft / 86400)).toString().split("");

					if (secondsLeft < 0) {
						clearInterval(intervalId);
						daySpanTag1.textContent = "0";
						daySpanTag2.textContent = "0";
						daySpanTag3.textContent = "0";
						hourSpanTag1.textContent = "0";
						hourSpanTag2.textContent = "0";
						minuteSpanTag1.textContent = "0";
						minuteSpanTag2.textContent = "0";
						secondSpanTag1.textContent = "0";
						secondSpanTag2.textContent = "0";
						return;
					}

					if (days.length == 2) {
						days.unshift(0);
					}
					if (days.length == 1) {
						days.unshift(0, 0);
					}
					if (hours.length == 1) {
						hours.unshift(0);
					}
					if (minutes.length == 1) {
						minutes.unshift(0);
					}
					if (seconds.length == 1) {
						seconds.unshift(0);
					}

					daySpanTag1.textContent = `${days[0]}`;
					daySpanTag2.textContent = `${days[1]}`;
					daySpanTag3.textContent = `${days[2]}`;
					hourSpanTag1.textContent = `${hours[0]}`;
					hourSpanTag2.textContent = `${hours[1]}`;
					minuteSpanTag1.textContent = `${minutes[0]}`;
					minuteSpanTag2.textContent = `${minutes[1]}`;
					secondSpanTag1.textContent = `${seconds[0]}`;
					secondSpanTag2.textContent = `${seconds[1]}`;
				};

				dateTimeLeft(deadlineDateTime || 0);
				const intervalId = setInterval(() => {
					dateTimeLeft(deadlineDateTime || 0, intervalId);
				}, 1000);

			}
		},

		counterBlock: function () {
			// odometer counter
			const rtrbCountNumber = $('.rtrb-count-number');
			if (rtrbCountNumber.length) {
				rtrbCountNumber.each(function () {
					rtrbCountNumber.appear(function (e) {
						const el = this;
						const updateData = $(el).attr("data-count");
						const od = new Odometer({
							el: el,
							format: $(el).attr("data-format"),
							duration: $(el).attr("data-duration"),
						});
						od.update(updateData);
					});
				});
			}
		},
	}

	//swiper slider intialize
	window.initRtrbSlider = function () {

		const swiperMainWrapper = $(".rtrb-block-frontend.rtrb-swiper-main-wrapper");
		if (swiperMainWrapper.length) {
			$(".rtrb-swiper-slider").each(function (i) {
				let $thisSlider = $(this);
				setTimeout(function () {
					$thisSlider.parents('.rtrb-swiper-container').animate({ opacity: "1" });
					$thisSlider.parents('.rtrb-swiper-container').parents('.rtrb-swiper-main-wrapper').addClass('rtrb-swiper-init');
				}, 100)

				this.defaultOptions = {
					breakpointsInverse: true,
					observer: true,
					navigation: {
						nextEl: $thisSlider.find(".rtrb-slider-btn-next").get(i),
						prevEl: $thisSlider.find(".rtrb-slider-btn-prev").get(i)
					}
				};
				this.options = Object.assign({}, this.defaultOptions, $thisSlider.data("options") || {});
				new Swiper(this, this.options);
			});
		}
		//news ticker init
		app.newsTicker();
	};
	setTimeout(initRtrbSlider, 500);

	//app initialize
	$(document).ready(app.initialize);
	return app;
})(window, document, jQuery);


