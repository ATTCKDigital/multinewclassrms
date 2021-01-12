# Paid Plugins

The plugins in this folder are plugins that we have the license for.  They may require an update after installation.  License keys are available in Drive.

Please note that we are using the Beta version of Advanced Custom Fields. This Beta version is for compatability with Gutenberg and allows the developer to create Gutenberg blocks using ACF. We have also made a minor change to the core plugin code to allow for setting a parent block (neccessary for the way our layout experience works). The change:

in `acf-field-options.php` on line 231 we have added `'parent'          => 0,` to the `$field` arguments.