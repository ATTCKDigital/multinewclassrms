function DropdownSection($el) {

	var $dropdownButton;
	var $dropdownSection;
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

		$dropdownSection.attr('aria-hidden', isDropdownOpen);
	}

	function openSection() {
		console.log('DropdownSection.js › openSection()');

		if (closeText) {
			$('a', $dropdownButton).text(closeText);
		}

		$dropdownButton.addClass('active');

		$dropdownSection.animate({
			maxHeight: $dropdownSection[0].scrollHeight,
			opacity: 1
		}, 
		300, 
		function() { // Animation Complete
			$dropdownSection.removeClass('hidden-section');
			$dropdownSection.maxHeight = '';
			isDropdownOpen = true;
		})
	}

	function closeSection() {
		console.log('DropdownSection.js › closeSection()');
		$dropdownSection.removeClass('hidden-section');

		$dropdownSection.animate({
			maxHeight: 0,
			opacity: 0
		}, 
		300, 
		function() { // Animation Complete
			$dropdownSection.addClass('hidden-section');
			isDropdownOpen = false;

			if (openText) {
				$('a', $dropdownButton).text(openText);
			}

			$dropdownButton.removeClass('active');
		})
	}

	function render() {
		console.log('DropdownSection.js › render()');

		$dropdownButton = $('.dropdown-toggle', $el);
		$dropdownSection = $('.dropdown-section', $el);

		isDropdownOpen = true;
		$dropdownSection.attr('aria-hidden', isDropdownOpen);

		let options = $el.data('componentOptions');
		if (options) {
			options = options.replace(/'/g, '"')
			options = JSON.parse(options);
	
			openText = options['openText'] ?? 'Show More';
			closeText = options['closeText'] ?? 'Close';
		}
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