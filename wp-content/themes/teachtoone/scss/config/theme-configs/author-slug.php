<?php
//change author slug
//https://www.isitwp.com/change-the-author-slug-url-base/
add_action('init', 'cng_author_base');
function cng_author_base() {
    global $wp_rewrite;
    $author_slug = 'staff'; // change slug name
    $wp_rewrite->author_base = $author_slug;
}
