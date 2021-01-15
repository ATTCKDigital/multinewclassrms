<?php
// 'prod', 'stage', etc. are the names of  WPEngine environments
// 'WPE_PROD' & 'WPE_STAGE' are key names of the WPENGINE_ACCOUNT' server variable
define('WPE_PROD', 'prod');
define('WPE_STAGE', 'stage');

define('CHILD_THEME_DIR', get_stylesheet_directory()); // use when there are files that should ONLY be from the child theme.
// Use locate_template() to include files.  This function first checks the child theme for the file and if there is none, uses the parent theme.
// Allows us to override main functions in the child theme without changing the parent.

/*** Global Variables ***/
// These define globally available variables, and must be included first
include_once(locate_template('config/global-variables/blocks.php'));
include_once(locate_template('config/global-variables/colors.php'));
include_once(locate_template('config/global-variables/nav-menus.php'));
include_once(locate_template('config/global-variables/blocks.php'));
include_once(locate_template('config/global-variables/wysiwyg-formats.php'));


// WP functions are split out into individual files for clarity. Disable/Enable files by commenting out here. 
// See README.md in parent theme for details on each config file

/*** ACF Configs ***/
// include_once(locate_template('config/acf-configs/acf-field-values.php'));
// include_once(locate_template('config/acf-configs/acf-wpml-options.php'));
include_once(locate_template('config/acf-configs/acf-options-page.php')); //REQUIRED
include_once(locate_template('config/acf-configs/acf-search.php')); //RECOMMENDED

/*** WP-Admin Configs ***/
// include_once(locate_template('config/admin-configs/change-post-labels.php'));
// include_once(locate_template('config/admin-configs/image-crops.php')); //RECOMMENDED
include_once(locate_template('config/admin-configs/remove-comments-column.php')); //RECOMMENDED
// include_once(locate_template('config/admin-configs/sidebars.php'));

/*** Theme Configs ***/
// include_once(locate_template('config/theme-configs/custom-post-types.php'));
// include_once(locate_template('config/theme-configs/customizer-colors.php')); //REQUIRED
// include_once(locate_template('config/theme-configs/disable-tax-archive.php'));
// include_once(locate_template('config/theme-configs/geotarget.php'));
include_once(locate_template('config/theme-configs/load-more.php')); //RECOMMENDED
include_once(locate_template('config/theme-configs/author-slug.php'));
// include_once(locate_template('config/theme-configs/password-protection.php'));
include_once(locate_template('config/theme-configs/wpml-language-switcher.php'));

