# GUTENBERG ACF BLOCKS

## Blocks
Gutenberg is Wordpress' new dynamic layout editor.  It is a part of Wordpress 5.0+. As noted in previous readme docs, we have extended Gutenberg to work with a row/column paradigm to allow users to have control while keeping within design guidelines.

A default set of blocks comes with the Flexlayout theme, but for many projects custom blocks are required. Custom blocks are created via ACF.

## Create a Block
In `flexlayout-child/gutenberg/blocks` a sample block is available (`block_testimonial`). To add a custom block, duplicate and rename this folder into the `blocks` directory.

1. Delete the copied `group_123.json` file. As you go through the steps a new ACF json file will be created.
2. Rename all of the copied files with your new block name.  If the block name is more than one word use a hyphen in between words. (The js file is optional depending on your block. Delete if unneeded)
3. In `register_block-name.php`, change the following items:
- line 6 & 7: change the function name to match your block. The block name should use underscores when it is a function name. ie `register_block_block_name`.
- line 14: change the `name` to your block name
- line 15: change the `title` to a human readable name of the block
- line 16: change the `description` to a human readable description of the block
- line 17 & 27: change the `render_callback` to reflect the name of your block
- line 19: select a [Dashicon](https://developer.wordpress.org/resource/dashicons/#editor-rtl). If no appropriate one is available, see Oka about how to add a new one.
- line 20: change the `keywords` to reflect your block.
4. In `block-name.scss` delete existing styles.  Add your own styles.  Allow the styles to be included in the build by adding to `flexlayout-child/scss/style.scss` and to `admin.scss` if these styles need to be reflected in the editor.
5. In `flexlayout-child/config/global-variables/blocks.php` register your blocks in `$blocks` and `$registeBlocks`, instructions are in the config file.
6. From the WP admin, go to Custom Fields. From the toolbar under *Local JSON*, select the block you have created.  Now click *Add New* and add your fields. In the *Location* section of the Custom Fields, select "Block is equal to Block Name" and save. You will see that a json file has been created in the block folder.
7. In `block-name.php` change the following and add your own markup and ACF fields.
- line 3: Update the block name and description
- line 12: Update the block id name to reflect your block
- line 14: If the block will have the WP align attribute, leave as is; if not, remove this line
- line 18: Change the component class to reflect your block.  It should always be `component-block-name`. If necessary, add `data-component-name="JSFunction"`.
8. From here you should be able to add your block on any page you need it!

# CHILD THEME BLOCK OVERRIDES

If the markup of a parent Gutenberg block needs to change, add it here in a folder with the same name. For example, to override the Feed block (a common use case), create a new folder in `gutenberg/blocks` called `block_feed`. Copy the existing `feed.php` markup into a new file in the new folder called `feed.php`.  Make changes as needed in this file. If css or js changes are required, add the corresponding files to this new block folder and register the css and js as normal.

Created 5/28/2019 by okadots for ATTCK
