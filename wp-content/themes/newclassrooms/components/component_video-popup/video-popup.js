import FLEX from '../../../FLEX/js/client-namespace';

function VideoPopup($el, params={}) {
	console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'VideoPopup()');

	var _$srcElementParent;
	var $closeButton;
	var $watchButton;
	var $popup;
	var $iframe;
	const $body = $('body');

	function bindEvents() {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'bindEvents()');

		$watchButton.on('click keypress', function (e) {
			// Detect key press for WCAG compliance
			var keyCode = e.keyCode || e.which;

			// Detect key press
			// 9 = tab
			// 13 = enter
			// 27 = esc
			if (e.type === 'keypress' && typeof keyCode !== 'undefined' && keyCode !== 13) {
				console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', '$watchButton keypress › exiting, pressed the  ' + e.key + ', keyCode: ' +  keyCode);
				return;
			} else {
				console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', '$watchButton keypress › pressed ' + e.key + ' key:type ' + e.type + ', keyCode: ' + keyCode);
			}
			
			e.preventDefault();

			displayPopup($(this));

			// Save reference so we can focus() correctly after popup is closed
			$('body').data('last-clicked-cta', $(this));
		});

		$closeButton.on('click keypress', function (e) {
			// Detect key press for WCAG compliance
			var keyCode = e.keyCode || e.which;

			// Detect key press
			// 9 = tab
			// 13 = enter
			// 27 = esc
			if (e.type === 'keypress' && typeof keyCode !== 'undefined' && keyCode !== 13) {
				console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', '$closeButton keypress › exiting, pressed the  ' + e.key + ', keyCode: ' + keyCode);
				return;
			} else {
				console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', '$closeButton keypress › pressed ' + e.key + ' key:type ' + e.type + ', keyCode: ' + keyCode);
			}

			e.preventDefault();

			hidePopup();

			// Focus back on the last clicked CTA
			$('body').data('last-clicked-cta').focus();
		});

		// Close any popups when esc key pressed
		// TODO: (DP) Going to have to implement the event layer here
		$(document).on('keydown', function (e) {
			// Detect key press for WCAG compliance
			var keyCode = e.keyCode || e.which;

			console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'document keypress › pressed ' + e.key + ' key:type ' + e.type + ', keyCode: ' + keyCode);

			// Detect key press
			// 9 = tab
			// 13 = enter
			// 27 = esc
			if (e.type === 'keypress' && typeof keyCode !== 'undefined' && keyCode === 27) {
				hidePopup();
			}
		});
	}

	function displayPopup(e) {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'displayPopup()');
		
		// let src = e[0].dataset.videoSrc;
		let $srcElement = $("#" + e[0].dataset.popupContentId);
		_$srcElementParent = $srcElement.parent();
		addVideoSrc($srcElement);

		// Activate popup
		$popup.addClass('active');

		// Focus on play button
		// $popup.find('.close-button').focus();
		$popup.find('.play').focus();

		// Display popup
		$body.addClass('popup-open');
	}

	function hidePopup() {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'hidePopup()');

		$popup.removeClass('active');
		$body.removeClass('popup-open');

		// $srcElement = $popup.find('.popup-content-container').html();
		var $srcElements = $popup.find('.popup-content-container').children();

		$srcElements.addClass('hide');

		_$srcElementParent.append($srcElements);
	}

	function addVideoSrc($srcElement) {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'addVideoSrc()');

		// Let's try moving the element into the popup.
		// We'll have to move it back on close
		
		// First, get rid of the .hide class which makes the template invisible
		$srcElement.removeClass('hide');

		// Then move the component markup into the popup contianer.
		$popup.find('.popup-content-container').append($srcElement);

		// Clone the element (without deep events becuse we're going 
		// to run it through the component loader individually)
		// var $srcElementClone = $srcElement.clone(false);

		// Get rid of the .hide class which makes the template invible
		// $srcElementClone.removeClass('hide')

		// Add the cloned popup element to the container
		// $popup.find('.popup-content-container').html($srcElementClone);

		// Run it through the component loader in case there are 
		// interactive elements (e.g., a video player)
		// console.log('Running FLEX loader on $srcElementClone: ', $srcElementClone);
		// FLEX.Loader.loadComponent($srcElementClone);

		
		// $iframe.attr("src", src);
	}

	function render() {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'render()');

		$closeButton = $('.close-button', $el);
		$watchButton = $('.video-button', $el);
		$iframe = $('iframe', $el);
		$popup = $('.component-video-popup');

		// Move popup outside the FLEX row
		$('body').append($popup);
	}

	this.init = function ($el) {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'e()');

		render();
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default VideoPopup;
