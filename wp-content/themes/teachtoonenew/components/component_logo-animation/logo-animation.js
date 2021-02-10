

function LogoAnimation($el) {
  const DELAY_BEFORE_NEXT_ANIMATION = 1000;

  var $lastCircleLine;
  var $svg;

	function bindEvents() {
    console.log('/newclassrooms/components/logo-image', 'bindEvents()');

    $lastCircleLine.on("animationend", function(){
      setTimeout(() => restartAnimation(), DELAY_BEFORE_NEXT_ANIMATION);
    });
	}

  function restartAnimation() {
    console.log('/newclassrooms/components/logo-image', 'restartAnimation()');

    $svg.removeClass('animate');
    $svg.width();
    $svg.addClass('animate');
  }

	this.init = function ($el) {
		console.log('/newclassrooms/components/logo-image', 'init()');

    $lastCircleLine = $('.circle4-line', $el);
    $svg = $('.circle-svg', $el);

    bindEvents();

		return this;
	}

	return this.init($el);
}

export default LogoAnimation;
