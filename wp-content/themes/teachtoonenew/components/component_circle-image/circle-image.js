function CircleImage($el) {
	console.log('/circle-image.js', 'CircleImage()');

	function bindEvents() {
		console.log('~/Childtheme/\tcomponents/\tcomponent-circle-image/\circle-image.js', 'bindEvents()');

		// Trigger line animation when tile enters viewport
		$el.addClass('prepare-in-view')
	}

	this.init = function ($el) {
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default CircleImage;
