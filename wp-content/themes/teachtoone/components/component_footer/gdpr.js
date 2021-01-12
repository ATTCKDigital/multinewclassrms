import $ from 'jquery';

//GDPR
function GDPR($el) {
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (30*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = "allowCookies=yes;"+expires;
		$el.addClass('hideGDPR');
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
		}
		return "";
	}

	function checkCookie() {
		var allowCookies = getCookie("allowCookies");
		if (allowCookies == "yes") {
			setCookie("allowCookies", "yes", 90);
			$el.addClass('hideGDPR');
		} else {
			$el.removeClass('hideGDPR')
		}
	}

	function bindEvents() {
		$el = $el;
		$el.find('.gdprAgree').on('click', setCookie);
		checkCookie();

		
	}

	this.init = function ($el) {
		bindEvents();

		return this;
	}

	return this.init($el);
}

export default GDPR;
