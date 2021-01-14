<?php
//Template for creating and registering an acf block.
//Additional details: https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
//Namespace function names "register_block_blockname" & "block_render_callback_blockname"

add_action('acf/init', 'register_block_divider');
function register_block_divider() {

	// check function exists
	if( function_exists('acf_register_block') ) {

		// register a divider block
		acf_register_block(array(
			'name'				=> 'divider',
			'title'				=> __('Divider'),
			'description'		=> __('A custom divider block.'),
			'render_callback'	=> 'block_render_callback_divider',
			'category'			=> 'common',
			'icon'				=> 'editor-insertmore',
			'keywords'			=> array( 'divider' ),
			'parent'			=> ['flexlayout/column'],
			'mode'				=> 'edit'
		));
	}
}

function block_render_callback_divider( $block ) {

	// convert name ("acf/divider") into path friendly slug ("divider")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "template-parts/block" folder
	if( file_exists( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") ) ) {
		include( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") );
	}

}