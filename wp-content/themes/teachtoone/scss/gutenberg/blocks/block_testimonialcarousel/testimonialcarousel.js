// TestimonialCarousel Component
function TestimonialCarousel($el) {
	// Cache the body
	function bindEvents() {
		console.log('/newclassrooms/\tcomponents/\tcomponent_testimonialcarousel/\ttestimonialcarousel.js', 'bindEvents()');

		// Render on window resize
		$(document.body).on('FLEX.resize', render);
	}

	function render() {
		console.log('/newclassrooms/\tcomponents/\tcomponent_testimonialcarousel/\ttestimonialcarousel.js', 'render()');
	}

	this.init = function ($el) {
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default TestimonialCarousel;
