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
<div class="component-hero-slider component <?php echo $align_class; ?>" id="<?php echo $id; ?>" data-component-name="HeroSlider VideoPopup">
	<ul class="slides">
		<?php foreach ($slides as $key => $slide): ?>
			<li
				class="slide <?= $key == 0 ? 'active' : '' ?>"
			>
				<div class="side-column" style="background-color: <?= $slide['accent_color'] ?>;"></div>
				<div class="image-wrapper">
					<img class="image" src="<?= $slide['background_image']['url'] ?>" alt="<?= $slide['background_image']['alt'] ?>">
				</div>
				<div class="content">
					<div class="side-row" style="background-color: <?= $slide['accent_color'] ?>;"></div>
					<h1 class="headline6 is-style-headline6 align-left"><?= $slide['subtitle']; ?></h1>
					<h2 class="headline1 is-style-headline1 align-left">
						<?= $slide['title'] ?>
					</h2>
					<?php if (!empty($slide['video_url'])): ?>
						<div class="component-button component align-left margin-phone-top-4x ">
							<button class="cta video-button prepare-in-view" data-video-src="<?= $slide['video_url'] ?>">
								<?php _e('Watch Video', '_flex') ?>
							</a>
						</div>
					<?php endif; ?>
					<nav class="slider-navigation">
						<ul class="dots-component">
							<?php foreach ($slides as $i => $slide): ?>
								<li class="dot <?= $i == $key ? 'active' : '' ?>">
									<a href="#<?= $i ?>"></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</nav>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
		echo Utils::render_template('components/component_video-popup/video-popup.php');
	?>
</div>