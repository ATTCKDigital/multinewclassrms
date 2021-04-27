function HeroSlider($el) {
	// const AUTO_SCROLL_TIME = 10000;
	var scrollTimePassed = 0;

	var index = 0;
	var nextIndex = 0;
	var prevIndex = 0;
	var CSStransitionInProgress = false;
	var $dotsContainer;
	var $slidesContainer;
	var $slides;
	var slidesLength;
	var transitionedOnce = false;

	// Used by throttle for better animation management
	// TODO: (DP) Add this to FLEX as a core utility.
	var _timerInterval = 8000; // Animate every N sec
	var _timePassed = 0; // Stores how much time has passed
	var _timerId; // Stores an Id so we can cancel it

	function bindEvents() {
		console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'bindEvents()');

		// Dot click events
		$el.on('click', '.dots-component a', function (e) {
			e.preventDefault();

			// Find parent
			var $parent = $(this).closest('.dots-component');

			// Get index of this dot compared to siblings
			var index = $parent.find('a').index($(this));

			// Delay the carousel's normal transition when the user is interacting
			// We're adding an addition 30 second delay from the last click
			_timePassed = -30000;

			goTo(index);
		});

		// Keyboard commands (left & right arrow keys)
		$('body').on('keydown', function (e) {
			// Left arrow key
			if (e.keyCode === 37) {
				_timePassed = -3000;

				goPrev();
			}

			// Right arrow key
			if (e.keyCode === 39) {
				_timePassed = -3000;

				goNext();
			}
		});

		// Tablet and phone swipe events
		detectSwipes();

		// Listen for CSS3 transition animation end
		$el.find('li').on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function () {
			CSStransitionInProgress = false;
			$el.removeClass('CSStransitionInProgress');

			// Place focus on primary CTA within slide after animation is complete
			// TODO: (DP) This actually kills tabbing on the whole site since the 
			// hero animation keeps placing focus back on the active slide's primary CTA.
			// $el.find('button').focus();
		});

		// Auto-scroll every X seconds
		throttle(goNext, _timerInterval);
		// setInterval(function () {

		// 	goNext();
		// }, AUTO_SCROLL_TIME);
	}

	function throttle(func, delay) {
		//console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'throttle()');

		function check() {
			if (_timePassed < delay) {
				if (_timePassed % 500 === 0) {
					// console.log('check, _timePassed: ', _timePassed);
				}

				// Increment the timer
				_timePassed += 10;

				// Execute again
				checkAgain(func, delay); 

			} else {
				// Execute the function
				func();

				// Reset timer
				_timePassed = 0;

				// Loop again
				checkAgain(func, delay);
			}
		}

		function checkAgain(a, b, c) {
			_timerId = requestAnimationFrame(function RAFCALLBACK(data, b, c) {
				throttle(func, delay);
			});
		};

		check();
	}

	function detectSwipes() {
		// console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'detectSwipes()');

		let start = null;
		let carousel = $('.component-carousel', $el);

		carousel.on("touchstart", function (event) {
			if (event.touches.length === 1) {
				// Just one finger touched
				start = event.touches.item(0).clientX;
			} else {
				// A second finger hit the screen, abort the touch
				start = null;
			}
		});

		carousel.on("touchend", function(event) {
			// At least 100px are a swipe
			var offset = 100;

			if (start) {
				// The only finger that hit the screen left it
				var end = event.changedTouches.item(0).clientX;

				if (end > start + offset) {
					_timePassed = -3000;
					goPrev();
				}

				if (end < start - offset) {
					_timePassed = -3000;
					goNext();
				}
			}
		});
	}

	function goNext() {
		console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'goNext()');

		// Proceed only if no CSS transition is in progress
		if (CSStransitionInProgress) return;

		// If current active slide isn't at the end
		// bump up index
		if (index < slidesLength) {
			index = index + 1;
			prevIndex = index - 1;

			// If current active slide still isn't at the end
			// bump up nextIndex
			if (index < slidesLength) {
				nextIndex = index + 1;
			} else {
				// Otherwise reset it to the beginning
				nextIndex = 0;
			}
		} else {
			index = 0;
			nextIndex = index + 1;
			prevIndex = slidesLength;
		}

		go();
	}

	function goPrev() {
		// console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'goPrev()');

		// Proceed only if no CSS transition is in progress
		if (CSStransitionInProgress) return;

		// If current active slide isn't at the beginning
		if (index > 0) {
			// drop down index
			index = index - 1;

			// [ ] [p] [i] [n] [ ]
			nextIndex = index + 1;

			// If current active slide still isn't at the end,
			if (index > 0) {
				// drop down prevIndex.
				// [p] [i] [n] [ ] [ ]
				prevIndex = index - 1;
			} else {
				// Otherwise, set it to the last slide
				// [i] [n] [ ] [ ] [p]
				prevIndex = $slides.length;
			}
		} else {
			// [n] [ ] [ ] [p] [i]
			index = slidesLength;
			nextIndex = 0;
			prevIndex = index - 1;
		}

		go();
	}

	function goTo(arg) {
		console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'goTo(arg:)', arg);

		// Proceed only if no CSS transition is in progress
		if (CSStransitionInProgress) return;

		// If current active slide isn't at the beginning
		if (index !== arg) {
			// go to index
			index = arg;

			// If current active slide isn't at the end
			if (index < slidesLength) {
				nextIndex = index + 1;

				// If current active slide isnt at the beginning,
				if (index > 0) {
					// drop down prevIndex.
					// [p] [i] [n] [ ] [ ]
					prevIndex = index - 1;
				} else {
					prevIndex = slidesLength;
				}
			} else {
				nextIndex = 0;
				prevIndex = index - 1;
			}
		}

		go();
	}

	function go() {
		console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'go()');

		// Replace background image of slides with active background
		// to prevent white flash when switching classes.
		var activeSlideBgImg = $slides.eq(index).find('.image-wrapper img').attr('src');

		$slidesContainer.css({
			'background': 'url(' + activeSlideBgImg + ') center center no-repeat',
			'background-size': 'cover'
		});

		// Indicate CSS transition is in progress
		CSStransitionInProgress = true;
		$el.addClass('CSStransitionInProgress');

		$slides
			.eq(index)
			.removeClass('previous next active z1 z2 z3 animationDelayMarker')
			.addClass('active z2')
				.find('a, button')
				.attr('tabindex', '0');

		for (var x = 0; x < $slides.length; x++) {
			console.log('x:(' + x + '), index:(' + index + '), x < index?', x < index);

			// Enforce lower bounds
			if (x < index) {
				if (x === 0 && index === ($slides.length - 1)) {
					$slides.eq(x).removeClass('previous active z1 z2 z3 animationDelayMarker');//.addClass('next');

					setTimeout((function ($slides, x) {
						return function () {
							$slides.eq(x).removeClass('next');
							$slides.eq(x).addClass('next z1');
						}
					})($slides, x), 2000);
				} else {
					$slides
						.eq(x)
						.removeClass('previous next active z1 z2 z3 animationDelayMarker')
						.addClass('previous z3')
							.find('a, button')
							.attr('tabindex', '-1');

					setTimeout((function ($slides, x) {
						return function () {
							// console.log('adding animationDelayMarker to $sides: x: ', $slides, x);

							$slides.eq(x).addClass('animationDelayMarker');
						}
					})($slides, x), 2000);
				}
			}

			// Enforce upper bounds
			if (x > index){
				if (x === ($slides.length - 1) && index === 0) {
					$slides
						.eq(x)
						.removeClass('previous next active z1 z2 z3 animationDelayMarker')
						.addClass('previous z3')
							.find('a, button')
							.attr('tabindex', '-1');

					setTimeout((function ($slides, x) {
						return function () {
							// console.log('adding animationDelayMarker to $sides: x: ', $slides, x);

							$slides.eq(x).addClass('animationDelayMarker');
						}
					})($slides, x), 2000);
				} else {
					$slides.eq(x).removeClass('previous active z1 z2 z3 animationDelayMarker');//.addClass('next');

					setTimeout((function ($slides, x) {
						return function () {
							$slides.eq(x).removeClass('next');
							$slides.eq(x).addClass('next z1');
						}
					})($slides, x), 2000);
				}
			}
		}

		// Remove firstLoad class from slide element after the first slide cycle
		if (transitionedOnce === false) {
			$slides.removeClass('firstLoad');
			$('body').addClass('sliderTransitionedOnce');

			// Prevent this from needing to hit the DOM again.
			transitionedOnce = true;
		}

		$(document.body).trigger('FLEX.slideUpdate', {
			'id': $el.attr('id')
		});
	}

	/**
	 * Initializes all default active states
	 */
	function setActiveItems() {
		console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'setActiveItems()');
		// - first LI of first UL
		$('.slides.active li', $el).eq(0).addClass('active');

		// Set active elements (because they aren't set via PHP):
		for (var x = 0; x < $slides.length; x++) {
			// Set next/prev of each slide
			switch (true) {
				// - first LI
				case x === 0:
					// $slidesContainer.eq(0).addClass('active');
					$slides.eq(x).addClass('active');
					break;

				// - last LI
				case x === ($slides.length - 1):
					$slides.eq(x).addClass('previous');
					break;

				// - middle LIs
				default:
					$slides.eq(x).addClass('next');
					break;
			}
		}

		// Set active dot
		// updateDots(0);
	}

	function render() {
		console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', 'render()');

		$dotsContainer = $('.dots-component', $el);
		$slidesContainer = $('.slides', $el);
		$slides = $('.slides > li', $el);

		console.log('/— $slides: ', {}, $slides.length, $slides);

		slidesLength = $slides.length - 1;

		// Hide dots if only one slide
		if ($slides.length > 1) {
			$('.dots-component', $el).css({
				'visibility': 'visible'
			});
		}

		// Duplicate header elements for outline effect
		$slides.each(function () {
			if ($('.headline1', this).length > 0) {
				$('.headline1', this)
					.clone()
					.addClass('dup')
					.insertAfter($('.headline1', this));
			}
		});

		setActiveItems();
	}

	this.init = function ($el) {
		console.log('/newclassrooms/\tgutenberg/\tblocks/\thero-slider', '$el: ', $el);

		render();
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default HeroSlider;
