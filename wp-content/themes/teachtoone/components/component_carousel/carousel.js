/**
 * Carousel component
 */
function Carousel ($el, params={}) {
	console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'Carousel()');

	const defaults = {
		'accessibility': true,
		'arrows': false,
		'dots': false,
		'prevArrow': '<button class="slick-prev"><svg class="icon icon-page-left">'
			+'<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-page-left"></use>'
			+'</svg><span class="sr-only">Previous slide</span></button>',
		'nextArrow': '<button class="slick-next"><svg class="icon icon-page-right">'
			+'<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-page-left"></use>'
			+'</svg><span class="sr-only">Next slide</span></button>'
	};

	var index = 0;
	var nextIndex = 0;
	var prevIndex = 0;
	var CSStransitionInProgress = false;
	var $dotsContainer;
	var $slidesContainer;
	var $slides;
	var slidesLength;

	// Merge any options set on the DOM element with
	// the component defaults set above
	var options = $.extend(true, {}, defaults, params);

	function bindEvents() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'bindEvents()');
		// Arrow click events
		$el.on('carousel.goPrev', goPrev);
		$el.on('carousel.goNext', goNext);

		// Dot click events
		$el.on('click', '.dots-component a', function (e) {
			e.preventDefault();

			// Find parent
			var $parent = $(this).closest('.dots-component');

			// Get index of this dot compared to siblings
			var index = $parent.find('a').index($(this));

			goTo(index);
		});

		// Keyboard commands (left & right arrow keys)
		$('body').on('keydown', function (e) {
			// Left arrow key
			if (e.keyCode === 37) {
				$('.nav.prev', $el).click();
			}

			// Right arrow key
			if (e.keyCode === 39) {
				$('.nav.next', $el).click();
			}
		});

		// Bind to prev/next arrows
		$el.on('click', '.nav', function (e) {
			e.preventDefault();

			var direction = 'carousel.goNext';

			if ($(this).hasClass('prev')) {
				direction = 'carousel.goPrev';
			}

			$el.trigger(direction);
		});

		detectSwipes();

		// Listen for CSS3 transition animation end
		$el.find('li').on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function () {
			CSStransitionInProgress = false;
		});

		// Auto-scroll every five seconds
		// setInterval(function () {
		// 	$('.nav.next', $el).click();
		// }, 5000);
	}

	function detectSwipes() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'detectSwipes()');
		let start = null;
		let carousel = $('.component-carousel', $el);

		carousel.on("touchstart", function(event) {
			if(event.touches.length === 1){
				//just one finger touched
				start = event.touches.item(0).clientX;
			}else{
				//a second finger hit the screen, abort the touch
				start = null;
			}
		});

		carousel.on("touchend", function(event) {
			var offset = 100;//at least 100px are a swipe

			if(start){
				//the only finger that hit the screen left it
				var end = event.changedTouches.item(0).clientX;

				if(end > start + offset) {
					goPrev();
				}

				if(end < start - offset) {
					goNext();
				}
			}
		});
	}

	function go() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'go()');
		// Indicate CSS transition is in progress
		CSStransitionInProgress = true;

		$slides.eq(index).removeClass('previous next').addClass('active');

		for (var x = 0; x < $slides.length; x++) {
			if(x < index) {
				if(x === 0 && index === ($slides.length - 1)) {
					$slides.eq(x).removeClass('previous next active').addClass('next');
				} else {
					$slides.eq(x).removeClass('previous next active').addClass('previous');
				}
			}
			if (x > index){
				if(x === ($slides.length - 1) && index === 0) {
					$slides.eq(x).removeClass('previous next active').addClass('previous');
				} else {
					$slides.eq(x).removeClass('previous next active').addClass('next');
				}
			}
		}

		updateDots(index);

		$(document.body).trigger('FLEX.slideUpdate', {
			id: $el.attr('id')
		});
	}

	function goNext() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'goNext()');
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
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'goPrev()');
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
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'ar()');
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

	function render() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'render()');
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

		setActiveItems();
	}

	/**
	 * Initializes all default active states
	 */
	function setActiveItems() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'setActiveItems()');
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
		updateDots(0);
	}

	/**
	 * Update the active dot.
	 * @param {Number} current - Zero-based current slide number.
	 */
	function updateDots(current) {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'curren()');
		$dotsContainer.each(function () {
			$(this).find('li.dot').removeClass('active');
			$(this).find('li.dot').eq(current).addClass('active');
		});
	}

	this.init = function ($el) {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_carousel/\t	carousel.js', 'e()');
		bindEvents();
		render();

		return this;
	}

	return this.init($el);
}

export default Carousel;
