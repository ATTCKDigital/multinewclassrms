<?php
// Get current language 
// Usage: current_language();
function current_language() {
	if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		$current_language = ICL_LANGUAGE_CODE;
		return $current_language;
	}
}



// Custom language switcher nav
// Usage: languages_list_nav();
function flexlayout_language_switcher(){
	//show all languages
	$languages =  apply_filters('wpml_active_languages', null, array('skip_missing' => 0 ));

	if(current_language() == 'us') {
		$code = 'U.S.';
	} else if(current_language() == 'uk') {
		$code = 'U.K.';
	} else if(current_language() == 'ca') {
		$code = 'Canada (En)';
	} else if(current_language() == 'ca-fr') {
		$code = 'Canada (Fr)';
	}

	if(!empty($languages)){
		echo '<ul class="menu-items languages">';
		echo '<li class="menu-item menu-item-has-children"><a href="#">';
		echo Utils::render_template("inc/templates/svg.php", array(
			"id" => "globe",
			"classes" => "globe",
			"data" => ""
		));
		echo $code.'</a><ul class="sub-menu">';
		foreach($languages as $l){
			$code = $l['code'];

			if($code == 'us') {
				$code = 'U.S.';
			} else if($code == 'uk') {
				$code = 'U.K.';
			} else if($code == 'ca') {
				$code = 'Canada (En)';
			} else if($code == 'ca-fr') {
				$code = 'Canada (Fr)';
			}

			if($l['active']){
				echo '<li class="menu-item language activeLanguage"><a href="'.$l['url'].'">'.$code.'</a></li>';
			} else {
				echo '<li class="menu-item language"><a href="'.$l['url'].'">'.$code.'</a></li>';
			}
		}
		echo '</ul></li></ul>';
	}
}

