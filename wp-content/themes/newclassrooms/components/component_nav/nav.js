console.log('loaded', '/newclassrooms\t/js\t/components\t/component_nav\t/nav.js');

// Global Nav & Header behavior
function Nav($el) {
	// Cache the body
	const $body = $('body');

	function bindEvents() {
		$el.find('.hamburger-wrapper').on('click keyup', navToggle);

		initLogoColor();
		logoColor();
		scrolledNav();

		// Detect if the page was initialized with a different scroll position
		// and add the background class
		if ($(window).scrollTop() >= 10) {
			$body.addClass('backgroundNav')
		}
	}

	function initLogoColor() {
		var $row = $('.component-row').first();
		var logoColor = $row.data('logo-color');

		setLogoClass(logoColor);
	}

	function logoColor($el) {
		// Change the logo color as you scroll down the page. Can also be used to change the hamburger color. Make color changes using CSS.
		var row = $('.component-row');
		var footer = $('.component-footer').offset().top

		$(document.body).bind('FLEX.scroll', function (e, data) {
			var viewportHeight = data.viewportHeight;
			var scrollTop = data.currentScrollTop;
			
			if (scrollTop === 0 ) {
				var logoColor = $(row).data('logo-color');
				setLogoClass(logoColor);		

				return;
			}

			$(row).each(function () {
				var rowTop = $(this).offset().top;
				var logoColor = $(this).data('logo-color');

				if (rowTop <= scrollTop + 20 ) {
					setLogoClass(logoColor);
				}
			});

			if ( scrollTop >= footer ) {
					$body.addClass('logoLight').removeClass('logoDark');
			}
		});
	}

	function navToggle(e) {
		console.log('/newclassrooms/\tcomponents/\tcomponent-nav/\tnav.js', 'navToggle()');

		// Open nav on hamburger click or enter press when tab focused
		var keyCode = e.keyCode || e.which;

		// Detect enter key press
		// 9 = tab
		// 13 = enter
		if (e.type === 'keyup' && typeof keyCode !== 'undefined' && keyCode !== 13) {
			console.log('exiting, pressed the  ' + e.key + ' key ', keyCode);
			return;
		} else {
			console.log('/newclassrooms/\tcomponents/\tcomponent-nav/\tnav.js', 'navToggle(), keyCode: ', keyCode, 'key: ', e.key, 'event: ', e);
		}

		$body.toggleClass('navOpen');
		$body.toggleClass('scroll-locked--mobile');
		$body.removeClass('searchOpen');

		// If nav is open and hamburger is visible, 
		// add tabindex attributes to nav links
		if ($('.hamburger-wrapper').is(':visible') && $('body').hasClass('navOpen')) {
			$('nav.main-nav .menu-item a').prop('tabindex', '0');
		} else {
			// Otherwise, remove them (i.e., make them not tabbable).
			$('nav.main-nav .menu-item a').prop('tabindex', '-1');
		}
	}

	function searchToggle() {
		console.log('/FLEX/\tcomponents/\tcomponent-nav/\tnav.js', 'searchToggle()');

		// Open search on click
		$body.toggleClass('searchOpen');
		$body.removeClass('navOpen');
	}

	function scrolledNav($el) {
		let scroll

		// Bind to scroll
		$(document.body).on('FLEX.scroll', function (e, data) {
			// Show/hide nav bar background color
			scroll = data.currentScrollTop;

				//add a class after short scroll to add background color etc
			if (scroll >= 10) {
				$body.addClass('backgroundNav');
			}

			// Hide nav entirely once scrolled past a certain distance
			if (scroll >= 50) {
				$body.addClass('hideNav');
			}

			// Show again as soon as they start scrolling back up
			if (data.scrollDirection === 'up') {
				$body.removeClass('hideNav');
			}

			// Show again as soon as they start scrolling back up
			if (data.scrollDirection === 'up' && scroll <= 10) {
				$body.removeClass('hideNav backgroundNav');
			}
		})
	}

	function setLogoClass(logoColor) {
		if (logoColor === 'logo-color-light') {
			$body.addClass('logoLight').removeClass('logoDark');
		}

		if (logoColor === 'logo-color-dark') {
			$body.addClass('logoDark').removeClass('logoLight');
		}
	}

	function userScrolled() {
		// Check if user is scrolled on page load so that the nav is hidden when they refresh the page
		if ($(window).scrollTop() >= 10) {
			$('body').addClass('hideNav');
		}
	}

	this.init = function ($el) {
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default Nav;
