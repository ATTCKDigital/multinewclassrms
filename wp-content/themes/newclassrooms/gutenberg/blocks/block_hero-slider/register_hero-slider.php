<?php
//Template for creating and registering an acf block.
//Additional details: https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
//Namespace function names "register_block_blockname" & "block_render_callback_hero-slider"

add_action('acf/init', 'register_block_hero_slider');
function register_block_hero_slider() {

	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a hero-slider block
		acf_register_block(array(
			'name'				=> 'hero-slider',
			'title'				=> __('Hero Slider'),
			'description'		=> __('A custom hero slider block.'),
			'render_callback'	=> 'block_render_callback_hero_slider',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'hero-slider', 'slider' ),
			'mode'				=> 'edit'
		));
	}
}

function block_render_callback_hero_slider( $block ) {
	// Convert name ("acf/hero-slider") into path friendly slug ("hero-slider")
	$slug = str_replace('acf/', '', $block['name']);
	
	// Include a template part from within the "template-parts/block" folder
	if( file_exists( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") ) ) {
		include( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") );
	}

}