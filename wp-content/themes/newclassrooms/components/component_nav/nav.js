import $ from 'jquery';

// Global Nav & Header behavior
function Nav($el) {
	// Cache the body
	var $body = $('body');

	function navToggle() {
		// Open nav on hamburger click
		$body.toggleClass('navOpen');
		$el.find('.openNav').removeClass('openSubNav');
		$el.find('.menu-back').removeClass('openSubNav');
		$body.removeClass('searchOpen');
	}

	function searchToggle() {
		// Open search on click
		$body.toggleClass('searchOpen');
		$body.removeClass('navOpen');
	}

	function toggleSubNav(e) {
		e.preventDefault();
		$(this).parent().toggleClass('openSubNav').siblings().removeClass('openSubNav');
		$body.toggleClass('openSubNav');
	}

	function openSubNav(e) {
		e.preventDefault();
		$(this).addClass('openSubNav').siblings().removeClass('openSubNav');
		$body.addClass('openSubNav');
	}

	function closeSubNav() {
		$el.find('.menu-item-has-children').removeClass('openSubNav');
		$body.removeClass('openSubNav');
	}

	function userScrolled() {
		// Check if user is scrolled on page load so that the nav is hidden when they refresh the page
		if ($(window).scrollTop() >= 10) {
			$('body').addClass('hideNav');
		}
	}

	function scrolledNav($el) {
		// Bind to scroll
		$(document.body).bind('FLEXLAYOUT.scroll', function (e, data) {
			// Show/hide nav bar background color
			var scroll = data.currentScrollTop;

			// Enable nav peek only on home page and HCP pages (en & fr) per ZH@SQNY 12/4/19
			if ($('body').hasClass('page-home') || $('body').hasClass('page-professionnels-de-la-sante') || $('body').hasClass('page-healthcare-providers')) {
				//add a class after short scroll to add background color etc
				if (scroll >= 10) {
					if (!$('body').hasClass('backgroundNav')) {
						$('body').addClass('backgroundNav');
					}
				}

				// Hide nav entirely once scrolled past a certain distance
				if (scroll >= 300) {
					if (!$('body').hasClass('hideNav')) {
						$('body').addClass('hideNav');
					}
				}

				// Show again as soon as they start scrolling back up
				if (data.scrollDirection === 'up') {
					$('body').removeClass('hideNav');
				}

				// Show again as soon as they start scrolling back up
				if (data.scrollDirection === 'up' && scroll <= 10) {
					$('body').removeClass('hideNav backgroundNav');
				}
			}
		});
	}

	function logoColor($el) {
		// Change the logo color as you scroll down the page. Can also be used to change the hamburger color. 
		// Make color changes using CSS.
		var row = $('.component-row');
		var footer = $('.global-footer').offset().top

		$(document.body).bind('FLEXLAYOUT.scroll', function (e, data) {
			var viewportHeight = data.viewportHeight;
			var scrollTop = data.currentScrollTop;

			$(row).each(function () {
				var rowTop = $(this).offset().top;
				var logoColor = $(this).data('logo-color');

				if (rowTop <= scrollTop + 20 ) {
					if (logoColor == 'logo-color-white') {
						$body.addClass('logoLight').removeClass('logoDark');
					}

					if (logoColor == 'logo-color-dark') {
						$body.addClass('logoDark').removeClass('logoLight');
					}
				}

				if (scrollTop == 0 ) {
					$body.removeClass('logoDark logoLight');
				}
			});

			if ( scrollTop >= footer ) {
					$body.addClass('logoLight').removeClass('logoDark');
			}
		});
	}

	function bindEvents() {
		$el = $el;
		$el.find('.hamburger-wrapper').on('click', navToggle);

		scrolledNav();

		// Use this if subnav is triggered on hover
		if ($(window).width() > 1024) {
			$el.find('.menu-items > .menu-item-has-children').on('mouseenter', openSubNav);

			// If we're hovering outside the nav, close the nav.
			$(document).on('mouseover',function (e) {
				let $target = $(e.target);

				if (!$target.is('.main-header') && !$target.closest('.main-header').length) {
					closeSubNav(e);
				}

				if (!$target.is('.menu-item-has-children') && !$target.closest('.menu-item-has-children').length) {
					closeSubNav(e);
				}
			});
		} else {
			$el.find('.menu-item-has-children > a').on('click', toggleSubNav);

		}
	}

	this.init = function ($el) {
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default Nav;
