console.log('loaded', '~/Childtheme/\t/js\t/components\t/component_features-card\t/features-card.js');

function FeaturesCard($el, params={}) {
	console.log('~/Childtheme/\tcomponents/\tcomponent_features-card/\tfeatures-card.js', 'FeaturesCard()');

	function bindEvents() {
		console.log('~/Childtheme/\tcomponents/\tcomponent_features-card/\tfeatures-card.js', 'bindEvents()');

		// Clicking left or right tab adds class to parent container
		$('.features-card-tab', $el).on('click', switchTabs);
	}

	function switchTabs(e) {
		console.log('~/Childtheme/\tcomponents/\tcomponent_features-card/\tfeatures-card.js', 'switchTabs()');
		
		// In case the tabs are anchor links or buttons
		e.preventDefault();

		if ($(this).hasClass('features-card-tab-right')) {
			$el.addClass('alt-tab-selected');
		} else {
			$el.removeClass('alt-tab-selected');
		}
	}

	this.init = function ($el) {
		console.log('~/Childtheme/\tcomponents/\tcomponent_features-card/\tfeatures-card.js', 'init()');

		bindEvents();

		return this;
	}

	return this.init($el);
}

export default FeaturesCard;
