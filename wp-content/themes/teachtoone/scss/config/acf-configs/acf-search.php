<?php 
/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function acf_search_join( $join ) {
    global $wpdb;

    if ( is_admin() && wp_doing_ajax() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' cfmeta ON '. $wpdb->posts . '.ID = cfmeta.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'acf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function acf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_admin() && wp_doing_ajax() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (cfmeta.meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'acf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function acf_search_distinct( $where ) {
    global $wpdb;

    if ( is_admin() && wp_doing_ajax() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'acf_search_distinct' );
