function CircleImage($el) {

	function bindEvents() {
		console.log('/newclassrooms/\tguttenberg /\tblocks/\t circle-image', 'bindEvents()');

		$(document.body).on('FLEX.scroll', () => activate())

	}

	function activate() {
		console.log('/newclassrooms/\tguttenberg /\tblocks/\t circle-image', 'activate()');
		const bounding = $el[0].getBoundingClientRect();

		if (bounding.top + $el[0].scrollHeight > window.innerHeight)
			return;

		$el.addClass('active');
	}

	this.init = function ($el) {
		console.log('/newclassrooms/\tguttenberg /\tblocks/\t circle-image', 'init()');
		bindEvents();
	
		return this;
	}

	return this.init($el);
}

export default CircleImage;
