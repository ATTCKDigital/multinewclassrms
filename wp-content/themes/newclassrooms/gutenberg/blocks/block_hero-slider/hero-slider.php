<?php
/**
 * Block Name: hero-slider
 *
 * This is the template that displays the hero-slider block.
 */

$slides = get_field('hero_slider');

// create id attribute for specific styling
$id = 'hero-slider-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<div class="component-hero-slider component <?php echo $align_class; ?>" id="<?php echo $id; ?>">
	<ul class="slider">
		<?php foreach ($slides as $key => $slide): ?>
			<li
				class="slide <?= $key == 0 ? 'slide--active' : '' ?>"
			>
				<div class="side-column flex-4-12" style="background-color: <?= $slide['accent_color'] ?>;"></div>
				<div class="image-wrapper">
					<img class="image" src="<?= $slide['background_image']['url'] ?>" alt="<?= $slide['background_image']['alt'] ?>">
				</div>
				<div class="content">
					<h1 class="headline6 is-style-headline6 align-left"><?= $slide['subtitle']; ?></h1>
					<h2 class="headline1 is-style-headline1 align-left">
						<?= $slide['title'] ?>
					</h2>
					<?php if (!empty($slide['video_url'])): ?>
						<div class="component-button component  align-left margin-phone-top-4x ">
							<a href="#" class="cta cta--video prepare-in-view">
								<?php _e('Watch Video', '_flex') ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
	<nav class="slider-navigation">
		<ul class="points">
			<?php foreach ($slides as $key => $slide): ?>
				<li class="point"></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	
</div>