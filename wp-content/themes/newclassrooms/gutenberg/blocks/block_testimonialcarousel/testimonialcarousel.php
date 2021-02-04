<?php
/**
 * Block Name: Testimonial Carousel
 *
 * This is the template that displays the recipe carousel block.
 */

// create id attribute for specific styling
$id = 'testimonialcarousel-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

$slides = get_field('testimonials');

?>
<div class="component-testimonialcarousel component" id="<?php echo $id; ?>" data-component-name="TestimonialCarousel Carousel">
    <div class="component-carousel">
        <ul class="slides">
            <nav class="nav-buttons">
                <a href="#prev" class="nav prev"></a>
                <a href="#next" class="nav next"></a>
            </nav>
            <?php foreach ($slides as $index => $slide): ?>
                <li class="slide" data-slide-index="<?= $index; ?>">
                    <div class="component-row-wide flex-grid quote-container">
                        <section class="quote-image">
                        </section>
                        <section class="flex-12-12">
                            <blockquote>
                                <p><?= $slide['quote']; ?></p>
                            </blockquote>
                        </section>
                    </div>
                    <div class="component-row-wide flex-grid author-dots-row">
                        <section class="flex-12-12 flex-tablet-landscape-9-12 author-container">
                            <div class="author-image" style="background-image: url(<?= $slide['author_image']; ?>)"></div>
                            <div class="author-data">
                                <p class="author-name is-style-body2"><?= $slide['author_name']; ?></p>
                                <p class="author-title is-style-body3"><?= $slide['author_title']; ?></p>
                            </div>
                        </section>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>