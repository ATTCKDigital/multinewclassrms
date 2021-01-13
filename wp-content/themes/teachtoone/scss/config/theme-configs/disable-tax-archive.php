<?php
// Disable the taxonomy archive pages
// https://jboullion.com/disable-taxonomy-archive/

add_action('pre_get_posts', 'flexlayout_disable_tax_archive');
function flexlayout_disable_tax_archive($qry) {

    if (is_admin()) return;

    if (is_tax('press_tag')){
    	$location = home_url();
        wp_safe_redirect( $location );
		exit;
    }
}