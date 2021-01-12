<?php
// Allows creation of predefined select/radio button options if specific field 
// names are being used
function acf_load_cta_color_field_choices( $field ) {
	// reset choices
	$field['choices'] = array(
		'black' => 'Black',
		'white' => 'White',
	);

	return $field;
}

function acf_load_component_choices( $field ) {
	$dir	= THEME_DIR . '/inc/components/custom/';
	$allFiles = scandir($dir);
	$files = array_diff($allFiles, array('.', '..', '.DS_Store'));
	$field['choices'] = $files;

	return $field;
}

function acf_load_cta_choices( $field ) {
	// Reset choices
	$field['choices'] = array(
		'none' => 'No CTA',
		'internal' => 'Internal Link CTA',
		'external' => 'External Link CTA'
	);


	return $field;
}

function acf_load_theme_choices( $field ) {
	// Reset choices
	$field['choices'] = array(
		'default' => 'Default',
		'white' => 'White',
		'black' => 'Black',
		'gray'  => 'Gray',
		'blue-gradient'  => 'Blue Gradient',
		'orange-gradient'  => 'Orange Gradient',
		'diagonal'  => 'Diagonal Pattern',
		'background' => 'Background'
	);

	return $field;
}

function acf_load_rowpadding_choices( $field ) {
	// Reset choices
	$field['choices'] = array(
		'top-20-40' 	=> 'Top (20px/40px)',
		'top-20-60' 	=> 'Top (20px/60px)',
		'top-20-80' 	=> 'Top (20px/80px)',
		'top-40-80' 	=> 'Top (40px/80px)',
		'top-40' 		=> 'Top (40px/40px)',
		'top-80-120' 	=> 'Top (80px/120px)',
		'bottom-20-40' 	=> 'Bottom (20px/40px)',
		'bottom-20-60' 	=> 'Bottom (20px/60px)',
		'bottom-20-80' 	=> 'Bottom (20px/80px)',
		'bottom-40-80' 	=> 'Bottom (40px/80px)',
		'bottom-40' 	=> 'Bottom (40px/40px)',
		'bottom-80-120' => 'Bottom (80px/120px)',
	);

	return $field;
}


function acf_load_columnpadding_choices( $field ) {
	// Reset choices
	$field['choices'] = array(
		'top-20-0' 		=> 'Top (20px/0px)',
		'top-20-40' 	=> 'Top (20px/40px)',
		'top-20-60' 	=> 'Top (20px/60px)',
		'top-20-80' 	=> 'Top (20px/80px)',
		'top-40-80'		=> 'Top (40px/80px)',
		'top-40' 		=> 'Top (40px/40px)',
		'bottom-20-0'	=> 'Bottom (20px/0px)',
		'bottom-20-40'	=> 'Bottom (20px/40px)',
		'bottom-20-60'	=> 'Bottom (20px/60px)',
		'bottom-20-80' 	=> 'Bottom (20px/80px)',
		'bottom-40-80' 	=> 'Bottom (40px/80px)',
		'bottom-40' 	=> 'Bottom (40px/40px)',
	);

	return $field;
}

// Preload shared select box & radio button values. 'name' is the field name 
// that will be assigned to each choice set
add_filter('acf/load_field/name=cta_color', 'acf_load_cta_color_field_choices');
add_filter('acf/load_field/name=show_cta', 'acf_load_cta_choices');
add_filter('acf/load_field/name=theme', 'acf_load_theme_choices');
add_filter('acf/load_field/name=component_type', 'acf_load_component_choices');
add_filter('acf/load_field/name=row_padding', 'acf_load_rowpadding_choices');
add_filter('acf/load_field/name=column_padding', 'acf_load_columnpadding_choices');
?>