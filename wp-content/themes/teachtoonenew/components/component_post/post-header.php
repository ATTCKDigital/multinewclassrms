<?php // Single Post Header 
	$category = get_the_category(); 
	$category_slug = $category[0]->slug;
?>
<section class="component-post-header component-row flex-grid padding-tablet-landscape-bottom-8x padding-bottom-4x padding-tablet-landscape-top-4x margin-top-2x" data-logo-color="logo-color-dark">
	<div class="component-row component-background-center-center padding-tablet-landscape-top-8x margin-top-8x margin-tablet-landscape-top-2x" data-section-id="937">
		<div class="flex-grid component-row-wide component-alignment-top"></div>
	</div>
	<div class="column flex-12-12 text-align-center">
		<header class="single-header flex-tablet-landscape-8-12 flex-12-12">
			<div class="color-text-primary display-block margin-bottom-2x margin-tablet-landscape-bottom-3x text-align-center category category-<?= $category_slug; ?>"></div>
			<h1 class="headline2 title color-text-primary flex-tablet-landscape-8-12 flex-12-12 text-align-center margin-bottom-2x margin-tablet-landscape-bottom-3x"><?php the_title();?></h1>
			<span class="eyebrow uppercase display-block text-align-center date"><?= get_the_time('F j, Y');?></span>
		</header>
	</div>
	<?php if(has_post_thumbnail()){ ?>
		<div class="flex-grid component-row-full component-alignment-center padding-tablet-landscape-top-8x padding-top-4x">
			<div class="column component-row-wide text-align-center">
				<div class="component-post-header">
					<div class="featured-image">
						<?php the_post_thumbnail('full');?>
					</div>
				</div>
			</div>
		</div>	
	<?php } ?>
</section>