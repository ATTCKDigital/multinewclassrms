<?php
//Template for creating and registering an acf block.
//Additional details: https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
//Namespace function names "register_block_blockname" & "block_render_callback_blockname"

add_action('acf/init', 'register_block_testimonialcarousel');
function register_block_testimonialcarousel() {

	// check function exists
	if( function_exists('acf_register_block') ) {

		// register a testimonialcarousel block
		acf_register_block(array(
			'name'				=> 'testimonialcarousel',
			'title'				=> __('Testimonial Carousel'),
			'description'		=> __('A custom Testimonial Carousel block.'),
			'render_callback'	=> 'block_render_callback_testimonialcarousel',
			'category'			=> 'common',
			'icon'				=> 'update',
			'keywords'			=> array( 'testimonialcarousel' ),
			'mode'				=> 'edit'
		));
	}
}

function block_render_callback_testimonialcarousel( $block ) {

	// convert name ("acf/testimonialcarousel") into path friendly slug ("testimonialcarousel")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "template-parts/block" folder
	if( file_exists( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") ) ) {
		include( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") );
	}

}
