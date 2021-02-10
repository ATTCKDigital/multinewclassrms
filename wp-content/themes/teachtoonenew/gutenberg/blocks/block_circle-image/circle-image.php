<?php
/**
 * Block Name: circle-image
 *
 * This is the template that displays the circle-image block.
 */

$section = get_field('circle_image');

// Create id attribute for specific styling
$id = 'circle-image-' . $block['id'];

// Create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
?>
<div class="component-circle-image component <?php echo $align_class; ?>" id="<?php echo $id; ?>" data-component-name="CircleImage">
	<svg class="circle" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
		<circle class="circle-stroke" stroke="<?= $section['border_color'] ?>" fill-opacity="0" />
	</svg>
	<img class="image" src="<?= $section['image']['url'] ?>" alt="<?= $section['image']['alt'] ?>">
</div>
