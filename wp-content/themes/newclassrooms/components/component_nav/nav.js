// Global Nav & Header behavior
function Nav($el) {
	// Cache the body
	const $body = $('body');

	function navToggle() {
		// Open nav on hamburger click
		$body.toggleClass('navOpen');
		$body.toggleClass('scroll-locked--mobile');
		$body.removeClass('searchOpen');
	}

	function searchToggle() {
		// Open search on click
		$body.toggleClass('searchOpen');
		$body.removeClass('navOpen');
	}

	function userScrolled() {
		// Check if user is scrolled on page load so that the nav is hidden when they refresh the page
		if ($(window).scrollTop() >= 10) {
			$('body').addClass('hideNav');
		}
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
			if (scroll >= 300) {
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

	function logoColor($el) {
		// Change the logo color as you scroll down the page. Can also be used to change the hamburger color. Make color changes using CSS.
		var row = $('.component-row');
		var footer = $('.component-footer').offset().top

		$(document.body).bind('FLEX.scroll', function (e, data) {
			var viewportHeight = data.viewportHeight;
			var scrollTop = data.currentScrollTop;

			$(row).each(function () {
				var rowTop = $(this).offset().top;
				var logoColor = $(this).data('logo-color');

				if (rowTop <= scrollTop + 20 ) {
					if (logoColor === 'logo-color-light') {
						$body.addClass('logoLight').removeClass('logoDark');
					}

					if (logoColor === 'logo-color-dark') {
						$body.addClass('logoDark').removeClass('logoLight');
					}
				}

				if (scrollTop === 0 ) {
					$body.removeClass('logoDark logoLight');
				}
			});

			if ( scrollTop >= footer ) {
					$body.addClass('logoLight').removeClass('logoDark');
			}
		});
	}

	function bindEvents() {
		$el.find('.hamburger-wrapper').on('click', navToggle);

		logoColor();
		scrolledNav();

		// Detect if the page was initialized with a different scroll position
		// and add the background class
		if ($(window).scrollTop() >= 10) {
			$body.addClass('backgroundNav')
		}
	}

	this.init = function ($el) {
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default Nav;
