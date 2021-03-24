console.log('loaded', '~/Childtheme/\t/js\t/components\t/component_colortile\t/colortile.js');

function ColorTile($el) {
	console.log('~/Childtheme/\tcomponents/\tcomponent-colortile/\tcolortile.js', 'ColorTile()');

	function bindEvents() {
		console.log('~/Childtheme/\tcomponents/\tcomponent-colortile/\tcolortile.js', 'bindEvents()');

		// Trigger line animation when tile enters viewport
		$el.addClass('prepare-in-view')
	}

	this.init = function ($el) {
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default ColorTile;
