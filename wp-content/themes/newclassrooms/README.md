# CHILD THEME

## How to change global variables
There are several global variables that can be overridden from the child theme.  Some can be overridden through the WordPress admin, others can via the child theme code. 

### Blocks
To add or enable an ACF or FLEX block, you must edit the following file in the child theme: `config/global-variables/blocks.php`.  

#### Notes on Flex Layout System
This system has a block called "Row" and a block called "Column". These are parent blocks and the foundation of the Flex Layout System. When creating a new page, start with a "Row" block and then add "Column" blocks inside and select the widths of the columns.  Once the columns are set up, add your content blocks.

#### blocks.php
Gutenberg allows for the whitelisting of blocks.  The `blocks.php` file in `config/global-variables` contains the whitelist of blocks. 

Only blocks that are whitelisted will appear in the editor. A default set has been provided, add acf created blocks (`acf/block_name`) to this list to enable them in the editor. If a core block is not needed, it can be removed or commented out from the list to disable it.

You must also register the new block.  Add the new block function path to the `$registerBlocks` array.

(See the `blocks.php` file for details)

### Colors
The boilerplate theme comes with a set of default colors used for typography and backgrounds. Update the colors in the child theme in `config/global-variables/colors.php`. Existing naming conventions should be preserved.

Adding additional items to the array will add additional color options to the theme and the admin.

### Nav Menus
Some projects will require more than the default available admin editable menus. To add additional menus or change the names of existing, edit `config/global-variables/nav-menus.php`

## How to add/enable/disable functions
As mentioned in the config [README.md](https://github.com/ATTCKDigital/FLEX/tree/master/config) some functions can be enabled/disabled per project.  To do so go to `flexlayout-child/functions.php` and comment/uncomment those relevant to he project.  To override a parent theme function, copy the function php file from the parent into the same directory in the child and make edits.  The child theme version will override the parent version.

## How to create a new ACF block
See [README.md](https://github.com/ATTCKDigital/FLEX/tree/master/__GET_STARTED_HERE/FLEX-child/gutenberg/blocks) for details.

Updated 5/28/2019 by okadots for ATTCK