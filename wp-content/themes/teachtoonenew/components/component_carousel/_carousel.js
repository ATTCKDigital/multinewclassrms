// Global carousel
function _carousel($el) {
	// Cache the body
    function bindEvents() {
        console.log('carousel.js › Carousel.bindEvents()');

        // Only render on mobile devices
        if (!$('.breakpoint.tablet-portrait').is(':visible')) {
            render();
        }

        // Render on window resize
        $(document.body).on('FLEX.resize', render);
    }

    function render() {
        console.log('carousel.js › Carousel.render()');
        // Collect all slides relating to this group
        var carouselID = '.' + $el.attr('data-carousel-id');
        var slides = $('.slide').find(carouselID);
        console.log('carousel.js › Carousel.render(), carouselID: ', carouselID, 'slides: ', slides);

        // Default to mobile only (add a desktop flag later if necessary)
    }

	this.init = function ($el) {
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default _carousel;
