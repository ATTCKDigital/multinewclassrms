<?php 
/**** Enable Blocks ****/
// Select blocks that should be available for the project.
// Available Blocks
// Enable your acf created blocks by using acf/block_name
// Enable FLEX created blocks by using FLEX/block_name

$blocks = array(
	'flexlayout/row', //REQUIRED
	'flexlayout/column', //REQUIRED
	'flexlayout/button',
	'flexlayout/feed',
	'flexlayout/heading',
	'flexlayout/image',
	'flexlayout/quote',
	'flexlayout/shortcode',
	'flexlayout/source',
	'flexlayout/socialmedia',
	'flexlayout/text',
	// 'flexlayout/users',
	'flexlayout/video',
	'acf/divider',
	'acf/testimonialcarousel'
);


define('FLEXLAYOUT_BLOCKS', $blocks);

//Add all of the acf blocks that should be registered. Only put the block name. The components must be named as described in the read me.
$registerBlocks = array(
	'divider',
	'testimonialcarousel'
);


define('FLEXLAYOUT_REGISTER_BLOCKS', $registerBlocks);
