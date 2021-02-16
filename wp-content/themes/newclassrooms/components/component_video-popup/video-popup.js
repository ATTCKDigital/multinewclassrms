import FLEX from '../../../FLEX/js/clientNamespace';

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

		$watchButton.on('click', function (e) {
			displayPopup($(this));
		});

		$closeButton.on('click', function (e) {
			e.preventDefault();

			hidePopup();
		});
	}

	function displayPopup(e) {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'displayPopup(e:)', e);
		
		// let src = e[0].dataset.videoSrc;
		let $srcElement = $("#" + e[0].dataset.popupContentId);
		_$srcElementParent = $srcElement.parent();
		addVideoSrc($srcElement);

		$popup.addClass('active');
		$body.addClass('popup-open');
	}

	function hidePopup() {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'hidePopup()');

		$popup.removeClass('active');
		$body.removeClass('popup-open');

		// $srcElement = $popup.find('.popup-content-container').html();
		var $srcElements = $popup.find('.popup-content-container').children();

		_$srcElementParent.append($srcElements);
	}

	function addVideoSrc($srcElement) {
		console.log('/newclassrooms/\tcomponents/\tcomponent_video-popup/\tvideo-popup.js', 'addVideoSrc()');

		// Let's try moving the element into the popup.
		// We'll have to move it back on close
		
		// First, get rid of the .hide class which makes the template invible
		$srcElement.removeClass('hide')

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
