<?php
/**
 * Block Name: Logo Animation
 *
 * This is the template that displays the logo animation block.
 */

$section = get_field('logo_animation');

// Create id attribute for specific styling
$id = 'logo-animation-' . $block['id'];

// Create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
?>
<div class="component <?php echo $align_class; ?>" id="<?php echo $id; ?>">
  <?php echo Utils::render_template('components/component_logo-animation/logo-animation.php'); ?>
</div>
