<?php
// Set default Featured Image size
set_post_thumbnail_size( 250,99999, false );

// Create custom crop sizes for uploaded images, uncomment out and change attributes below
function flexlayout_image_crop() {
  add_image_size('square',800,800, true); 
  // add_image_size('archive-thumbnail',662,662, true);

}
add_action( 'after_setup_theme', 'flexlayout_image_crop' );
