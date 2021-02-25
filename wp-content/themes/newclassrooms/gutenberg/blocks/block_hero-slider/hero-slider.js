function HeroSlider($el) {
	const AUTO_SCROLL_TIME = 15000;

	var index = 0;
	var nextIndex = 0;
	var prevIndex = 0;
	var CSStransitionInProgress = false;
	var $dotsContainer;
	var $slidesContainer;
	var $slides;
	var slidesLength;

	function bindEvents() {
		console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'bindEvents()');

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
				goPrev();
			}

			// Right arrow key
			if (e.keyCode === 39) {
				goNext();
			}
		});

		detectSwipes();

		// Listen for CSS3 transition animation end
		$el.find('li').on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function () {
			CSStransitionInProgress = false;
		});

		// Auto-scroll every X seconds
		setInterval(function () {
			goNext();
		}, AUTO_SCROLL_TIME);
	}

	function detectSwipes() {
		console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'detectSwipes()');
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
			// At least 100px are a swipe
			var offset = 100;

			if(start){
				// The only finger that hit the screen left it
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

	function goNext() {
		// console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'goNext()');
		
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
		// console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'goPrev()');

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
		console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'goTo(arg:)', arg);

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
		console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'go()');
		
		// Indicate CSS transition is in progress
		// CSStransitionInProgress = true;

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

		// updateDots(index);

		$(document.body).trigger('FLEX.slideUpdate', {
			id: $el.attr('id')
		});
	}

	/**
	 * Initializes all default active states
	 */
	function setActiveItems() {
		console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'setActiveItems()');
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
		console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'render()');
		
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
		console.log('/newclassrooms/\tguttenberg/\tblocks/\thero-slider', 'e()');
		bindEvents();
		render();
	
		return this;
	}

	return this.init($el);
}

export default HeroSlider;
