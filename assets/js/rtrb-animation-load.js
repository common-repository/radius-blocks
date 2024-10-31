
//for window dom loaded
window.addEventListener('DOMContentLoaded', (event) => {
	var keySelector = '.rt___animated';

	waitForWrapperSection(keySelector).then((elm) => {
		var findAnimationClass = document.querySelectorAll(keySelector);
		animateClassReplace(findAnimationClass);

		window.addEventListener('scroll', function (event) {
			animateClassReplace(findAnimationClass);
		}, true);
	});

	//For block inspector sidebar panel
	window.addEventListener('DOMNodeInserted', (event) => {
		var adminSidebarChangeSelector = document.getElementById('rtrb-animation-selector');

		if (adminSidebarChangeSelector) {
			adminSidebarChangeSelector.addEventListener('change', function (event) {
				setTimeout(function () {
					animateClassReplace(document.querySelectorAll(keySelector));
				}, 500);
			}, true);
		}
	});
});

var isInWrapperViewport = function (elem) {
	var distance = elem.getBoundingClientRect();
	return (
		distance.top >= 0 && distance.top <= (window.innerHeight || document.documentElement.clientHeight)
		&& distance.bottom >= 0 && distance.bottom <= (window.innerWidth || document.documentElement.clientWidth)
	);
};

//replace rt___animated className
var animateClassReplace = function (selector) {
	selector.forEach(element => {
		if (isInWrapperViewport(element)) {
			let toRemoveClasses = [];
			let toAddClasses = [];
			element.classList.forEach((classname) => {
				if (classname.includes('rt___')) {
					toRemoveClasses.push(classname);
					toAddClasses.push(classname.replace('rt___', 'rt__'));
				}
			})
			element.classList.add(...toAddClasses);
			element.classList.remove(...toRemoveClasses);
		}

	});
}

var waitForWrapperSection = function (selector) {
	return new Promise(resolve => {
		if (document.querySelector(selector)) {
			return resolve(document.querySelector(selector));
		}

		const observer = new MutationObserver(mutations => {
			if (document.querySelector(selector)) {
				resolve(document.querySelector(selector));
				observer.disconnect();
			}
		});

		observer.observe(document.body, {
			childList: true,
			subtree: true
		});
	});
}