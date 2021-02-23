<?php
	/**
	 * Block Name: Content Feed
	 *
	 * This is the template that displays the content-feed block.
	 */
	$categories = get_field('archive_categories');
	$number_of_items = get_field('number_to_display');
	$archive_select = get_field('archive_select');
	$posts = [];

	if (empty($archive_select)) {
		$recent_posts = wp_get_recent_posts( [
			'numberposts' => $number_of_items,
			'post_status' => 'publish',
			'cat' 				=> $categories,
		] );
			
		foreach ($recent_posts as $index => $post) {
			$postID  = $post['ID'];

			$link = get_the_permalink($postID);
			$categories = get_the_category($postID);
			$title = get_the_title($postID);

			$posts[$index] = [
				'link' 			=> $link,
				'category' 	=> !empty($categories) ? $categories[0] : '',
				'title'		 	=> $title
			];
		}
	} else {
		foreach ($archive_select as $index => $post) {
			$postID  = $post->ID;

			$link = get_the_permalink($postID);
			$categories = get_the_category($postID);
			$title = get_the_title($postID);

			$posts[$index] = [
				'link' 			=> $link,
				'category' 	=> !empty($categories) ? $categories[0] : '',
				'title'		 	=> $title
			];
		}
	}

	// Create id attribute for specific styling
	$id = 'content-feed-' . $block['id'];

	// Create align class ("alignwide") from block setting ("wide")
	$align_class = $block['align'] ? 'align' . $block['align'] : '';

	// create id attribute for specific styling
	$id = 'content-feed-' . $block['id'];

	// Create align class ("alignwide") from block setting ("wide")
	$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<div 
	class="component-content-feed component <?php echo $align_class; ?>" id="<?php echo $id; ?>"
	>
	<ul class="feed-items flex-grid">
		<?php foreach ($posts as $post) : ?>
			<li class="feed-item flex-12-12 flex-tablet-portrait-6-12">
				<a class="feed-item-link" href="<?= $post['link'] ?>">
					<small class="post-cat post-cat-<?= $post['category']->slug ?> is-style-headline6"><?= $post['category']->name ?></small>
					<h3 class="post-title is-style-headline4"><?= $post['title'] ?></h3>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
