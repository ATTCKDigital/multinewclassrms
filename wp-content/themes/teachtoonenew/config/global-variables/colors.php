<?php

/**
 * Set child theme colors
 */


$colors = array(
	array(
		'default'     => '#2E97CA',
		'description' => 'Set your site\'s primary brand color here.',
		'label'       => 'Brand Primary Color',
		'slug'        => 'color-brand-primary',
	),
	array(
		'default'     => '#A5D4F0',
		'description' => 'Set your site\'s secondary brand color here.',
		'label'       => 'Secondary Brand Color',
		'slug'        => 'color-brand-secondary',
	),

	array(
		'default'     => '#787878',
		'description' => 'Set your site\'s brand accent color here.',
		'label'       => 'Brand Accent Color',
		'slug'        => 'color-brand-accent',
	),

	array(
		'default'     => '#50525C',
		'description' => 'Set your site\'s body text color here.',
		'label'       => 'Body Text Color',
		'slug'        => 'color-text-body',
	),
	array(
		'default'     => '#50525C',
		'description' => 'Set your site\'s link color here.',
		'label'       => 'Link Color',
		'slug'        => 'color-text-link',
	),

	array(
		'default'     => '#FFFFFF',
		'description' => 'Default White',
		'label'       => 'Default White Color',
		'slug'        => 'color-default-white',
	),

	array(
		'default'     => '#000000',
		'description' => 'Default Black',
		'label'       => 'Default Black Color',
		'slug'        => 'color-default-black',
	),

    array(
        'default'     => '#F3D09E',
        'description' => 'Orange',
        'label'       => 'Orange Color',
        'slug'        => 'color-orange',
    ),

    array(
        'default'     => '#F0E27B',
        'description' => 'Primary Color 4 - Solid',
        'label'       => 'Primary Color 4 - Solid',
        'slug'        => 'primary-color-4--solid',
    ),

    array(
        'default'     => '#59869F',
        'description' => 'Dull Navy',
        'label'       => 'Dull Navy',
        'slug'        => 'color-dull-navy',
    )
);

define('FLEXLAYOUT_COLORS', $colors);
