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

	if(current_language() == 'en') {
		$code = 'EN';
	} else if(current_language() == 'es') {
		$code = 'SP';
	}

	if(!empty($languages)){
		echo '<ul class="languages">';
		foreach($languages as $l){
			$code = $l['code'];

			if($code == 'en') {
				$code = 'EN';
			} else if($code == 'es') {
				$code = 'SP';
			}

			if($l['active']){
				echo '<li class="language activeLanguage"><a href="'.$l['url'].'">'.$code.'</a></li>';
			} else {
				echo '<li class="language"><a href="'.$l['url'].'">'.$code.'</a></li>';
			}
		}
		echo '</ul>';
	}
}

