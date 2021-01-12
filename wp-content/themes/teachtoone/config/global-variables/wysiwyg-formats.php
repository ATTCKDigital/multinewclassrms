<?php

/**
 * WYSIWYG Formats dropdown styles 
 *
**/

$style_formats = array(
	array(  
			'title' => 'Body 2',  
			'block' => 'p',  
			'classes' => 'body2',
			'wrapper' => false,
		),  

		array(  
			'title' => 'Body 3',  
			'block' => 'p',  
			'classes' => 'body3',
			'wrapper' => false,
		),  

		array(  
			'title' => 'Button',  
			'inline' => 'span',  
			'classes' => 'cta',
			'wrapper' => false,
		),


		array(  
			'title' => 'Button Negative',  
			'inline' => 'span',  
			'classes' => 'cta cta-negative',
			'wrapper' => false,
		),

		array(  
			'title' => 'Button Accent',  
			'inline' => 'span',  
			'classes' => 'cta cta-accent',
			'wrapper' => false,
		),

		
		array(  
			'title' => 'Button Solid',  
			'inline' => 'span',  
			'classes' => 'cta cta-solid',
			'wrapper' => false,
		),
		
		array(  
			'title' => 'Underline',  
			'inline' => 'span',  
			'classes' => 'underline',
			'wrapper' => false,
		),

		array(  
			'title' => 'Strikethrough',  
			'inline' => 'span',  
			'classes' => 'strikethrough',
			'wrapper' => false,
		),

);

if(!defined('FLEXLAYOUT_WYSIWYG')) {
	define('FLEXLAYOUT_WYSIWYG', $style_formats);
}
