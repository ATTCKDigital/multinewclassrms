/**
 * Carousel component
 */
function VideoPopup ($el, params={}) {
	console.log('/newclassrooms/\tcomponents	/\tcomponent_video-popup/\t	video-popup.js', 'VideoPopup()');

	var $closeButton;
	var $watchButton;
	var $popup;
	var $iframe;
	const $body = $('body');

	function bindEvents() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_video-popup/\t	video-popup.js', 'bindEvents()');

		$watchButton.on('click', function (e) {
			displayPopup($(this));
		});

		$closeButton.on('click', function (e) {
			e.preventDefault();

			hidePopup();
		});
	}

	function displayPopup(e) {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_video-popup/\t	video-popup.js', 'displayPopup()');
		let src = e[0].dataset.videoSrc;
		addVideoSrc(src);

		$popup.addClass('active');
		$body.addClass('popup-open');
	}

	function hidePopup() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_video-popup/\t	video-popup.js', 'hidePopup()');

		$popup.removeClass('active');
		$body.removeClass('popup-open');
	}

	function addVideoSrc(src) {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_video-popup/\t	video-popup.js', 'addVideoSrc()');

		// $iframe.attr("src", src);
	}

	function render() {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_video-popup/\t	video-popup.js', 'render()');

		$closeButton = $('.close-button', $el);
		$watchButton = $('.video-button', $el);
		$iframe = $('iframe', $el);
		$popup = $('.component-video-popup');
	}

	this.init = function ($el) {
		console.log('/newclassrooms/\tcomponents	/\tcomponent_video-popup/\t	video-popup.js', 'e()');
		render();
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default VideoPopup;
