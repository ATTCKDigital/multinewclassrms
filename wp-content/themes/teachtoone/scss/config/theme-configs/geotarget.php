<?php
// Redirect user based on country location. Requires WP Engine GeoTarget and WPML	
function flexlayout_geo_target() {
	//get the country we are in
	// global $wp_query;
	$country = getenv('HTTP_GEOIP_COUNTRY_CODE');
	//what url are we on?
	$currentURL = $_SERVER['REQUEST_URI'];
	//get the path from the url
	$currentURLPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	//split the path into segments
	$currentPath = explode('/', $currentURLPath);
	//get the country segment
	$urlCountry = $currentPath[1];
	//this cookie will determine the user's origin region, prior to switching their language manually
	$originCookie = false;

	//get the active languages and find the url
	$languages =  apply_filters('wpml_active_languages', null, array('skip_missing' => 0 ));

	if($urlCountry == 'uk' || $urlCountry == 'ca') {
		//if user goes to an explicit regionalized link 
		//they should always be able to view that link
		return;

	} else if ( $country == "GB" ) {
		//if i am in the UK (England, Scotland, Wales, Northern Ireland)

		if (isset($_COOKIE) && isset($_COOKIE['originCookie'])){
			//if there IS a cookie set do nothing because the user has already visited the site and been redirected to their language in the else case below. having a cookie set allows the user to switch regions via the nav switcher

		} else {		
			//if there is no cookie, set the cookie to the uk.	
			setcookie( 'originCookie', 'uk', strtotime( '+30 days' ));
			$location = $languages['uk']['url'];
			if (!is_admin()) {
				wp_redirect($location);
				exit;
			} 
		}

	} else if ( $country == "CA" ) {
		//if i am in Canada
		//redirect me to the CA site
		if (isset($_COOKIE) && isset($_COOKIE['originCookie'])){
			//if there IS a cookie set do nothing because the user has already visited the site and been redirected to their language in the else case below. having a cookie set allows the user to switch regions via the nav switcher

		} else {		
			//if there is no cookie, set the cookie to the uk.	
			setcookie( 'originCookie', 'ca', strtotime( '+30 days' ));
			$location = $languages['ca']['url'];
			if (!is_admin()) {
				wp_redirect($location);
				exit;
			} 
		}
	} else {
		//if i am anywhere else in the world
		//do nothing
		return;
	}
}
add_action( 'template_redirect', 'flexlayout_geo_target');




