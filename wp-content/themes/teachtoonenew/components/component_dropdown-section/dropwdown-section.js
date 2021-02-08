function DropdownSection($el) {

	var $dropdownButton;
	var $el;
	var openText;
	var closeText;
	var isDropdownOpen;

	function bindEvents() {
		console.log('DropdownSection.js › bindEvents()');

		$dropdownButton.on('click', function(e) {
			e.preventDefault();

			toggleSection();
		})
	}

	function toggleSection() {
		console.log('DropdownSection.js › toggleSection()');

		if (!isDropdownOpen) {
			openSection()
		} else {
			closeSection();
		}

		$el.attr('aria-hidden', isDropdownOpen);
	}

	function openSection() {
		console.log('DropdownSection.js › openSection()');

		$el.animate({
			maxHeight: $el[0].scrollHeight,
			opacity: 1
		}, 
		300, 
		function() { // Animation Complete
			$el.addClass('visible');
			$el.maxHeight = ''
			isDropdownOpen = true;
			$('a', $dropdownButton).text(closeText);
			$('a', $dropdownButton).addClass('active');
		})
	}

	function closeSection() {
		console.log('DropdownSection.js › closeSection()');

		$el.animate({
			maxHeight: 0,
			opacity: 0
		}, 
		300, 
		function() { // Animation Complete
			$el.removeClass('visible');
			isDropdownOpen = false;
			$('a', $dropdownButton).text(openText);
			$('a', $dropdownButton).removeClass('active');
		})
	}

	function render() {
		console.log('DropdownSection.js › render()');

		$dropdownButton = $el.siblings('.dropdown-button');
		isDropdownOpen = true;
		$el.attr('aria-hidden', isDropdownOpen);
		let options = $el.data('componentOptions');
		options = options.replace(/'/g, '"')
		options = JSON.parse(options);

		openText = options['openText'] ?? 'Show More';
		closeText = options['closeText'] ?? 'Close';
	}

	this.init = function ($el) {
		render();
		toggleSection();

		bindEvents();

		return this;
	}

	return this.init($el);
}

export default DropdownSection;