<?php
/**
 * AJAX Load More Posts
 *
 */


$result = array();

// Script for getting posts
function ajax_filter_get_posts( $post ) {

	// Verify nonce
	if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) )
		die('Permission denied');

	$category = $_POST['category'];
	$tag = $_POST['tag'];
	$postType = $_POST['postType'];
	
	$postTypeArray = explode(',',$postType);
	
	$categoryArray = explode(',',$category);
	$search = $_POST['search'];
	$author = $_POST['author'];
	//excluded posts
	$exclude = $_POST['ids'];
	//what type of filter?
	$filterType = $_POST['filterType'];
	//what is the selection?
	$selection = $_POST['selection'];
	$selectionArray = explode(',',$selection);
	//are we filtering or loading more?
	$loadMore = $_POST['loadMore'];
	//what type of page are we on?
	$pageType = $_POST['pageType'];
	//if we are on a category or tag page, what is the term?
	$pageCategory = $_POST['pageCategory'];

	//separate the year and month
	$year = $selectionArray[0];
	$month = $selectionArray[1];
	
	if($month) {
		$month = $month;
	} else {
		$month = '';
	}


	if($loadMore == 'true') {
		//if we are loading more

		if($filterType == 'author') {
				//if load more on author archive
				$args = array(
					'posts_per_page' 	=> 10,
					'orderby'			=> 'date',
					'order' 			=> 'DESC',
					'post_status' 		=> 'publish',
					'post__not_in'		=> $exclude,
					'author_name'		=> $selection
				); 
		} else if($filterType == 'year' && $pageType == 'category') {
			//if filtering by year on a category page and loading more
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
				'cat'				=> $pageCategory,
				'date_query' => array(
						array(
							'year'  => $year,
							'month' => $month
						),
				),
			); 
		} else if($filterType == 'year' && $pageType == 'tag') {
			//if filtering by year on a tag page and loading more
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
				'tag_id'			=> $pageCategory,
				'date_query' => array(
						array(
							'year'  => $year,
							'month' => $month
						),
				),
			); 
		} else if($filterType == 'year' && $pageType == 'press') {
			//if filtering by year on press page and loading more
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'press',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
				'date_query' => array(
						array(
							'year'  => $year,
							'month' => $month
						),
				),
			); 
		} else if($filterType == 'press_tag') {
			//if filtering by press_tag on press page and loading more
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'press',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
				'tax_query' 		=> array(
						array(
							'taxonomy' => 'press_tag',
							'field'    => 'term_id',
							'terms'    => $selection,
						),
					),
			); 
		} else if($filterType == 'category' && $pageType == 'blog') {
			//if loading more on a category page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
				'category__in'		=> $selectionArray 
			); 
		} else if($pageType == 'blog') {
			//if loading more on blog landing page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
			); 
		} else if($filterType == 'category') {
			//if loading more on a category page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
				'category__in'		=> $selectionArray 
			); 
		} else if($pageType == 'press') {
			//if loading more on a press page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'press',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
			); 
		} else if($filterType == 'tag') {
			//if loading more on a tag page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'post__not_in'		=> $exclude,
				'tag__in'			=> $selectionArray 
			); 
		} else if($filterType == 'type') {
			//if filtering by post type
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> $selectionArray,
				'post_status' 		=> 'publish',
				's'					=> $search,
				'post__not_in'		=> $exclude,
			); 
		}	
	} else {
		//if we are filtering

		if($filterType == 'year' && $pageType == 'category') {
			//if filtering by year on a category page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'cat'				=> $pageCategory,
				'date_query' 		=> array(
						array(
							'year'  => $year,
							'month' => $month
						),
				),
			); 
		} else if($filterType == 'year' && $pageType == 'tag') {
			//if filtering by year on a tag page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'tag_id'			=> $pageCategory,
				'date_query' 		=> array(
						array(
							'year'  => $year,
							'month' => $month
						),
				),
			); 
		} else if($filterType == 'year' && $pageType == 'press') {
			//if filtering by year on a press page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'press',
				'post_status' 		=> 'publish',
				'date_query' 		=> array(
						array(
							'year'  => $year,
							'month' => $month
						),
				),
			); 
		} else if($filterType == 'press_tag' && $pageType == 'press') {
			//if filtering by press tag on a press page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'press',
				'post_status' 		=> 'publish',
				'tax_query' 		=> array(
						array(
							'taxonomy' => 'press_tag',
							'field'    => 'term_id',
							'terms'    => $selection,
						),
					),
			); 
		} else if($filterType == 'category' && $pageType == 'blog') {
			//if filtering by category on blog landing page
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> 'post',
				'post_status' 		=> 'publish',
				'cat'				=> $selection,
			); 
		} else if($filterType == 'type') {
			//if filtering by post type
			$args = array(
				'posts_per_page' 	=> 10,
				'orderby'			=> 'date',
				'order' 			=> 'DESC',
				'post_type' 		=> $selectionArray,
				'post_status' 		=> 'publish',
				's'					=> $search,
				'post__not_in'		=> $exclude,
			); 
		}
 

	}

	$query = new WP_Query( $args );
	$count = $query->post_count;

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				
			if($search) {
				$search = 'true';
			} else {
				$search = 'false';
			}

			$postID = get_the_ID();
			$maxPages = $query->max_num_pages;
			$link = get_the_permalink($postID);
			$postType = get_post_type($postID);
			$category = get_the_category($postID);
			$thumbnail = get_the_post_thumbnail_url($postID, 'full');

			if($thumbnail) {
				 $thumbnail = '<div class="image-wrapper"><img width="800" height="800" src="'.$thumbnail.'" class="attachment-square size-square wp-post-image" alt=""></div>';
				 $thumbnailClass = ' feed-item-image';
			} else {
				$thumbnail = '';
				$thumbnailClass = '';
			}



			$results = '';

			if(($postType == 'post') || ($search == 'true') || ($postType == 'press')) {
				$results = '<li class="new-elements load-item feed-item background-white'.$thumbnailClass.'" data-post-id="'.$postID.'" data-max-pages="'.$maxPages.'" data-results-count="'.$count.'">'.$thumbnail.'<a href="'.$link.'" class="full-link"></a><div class="feed-item-inner padding-mobile-20"><time class="caption margin-mobile-bottom-20"><a href="/category/'.$category[0]->slug.'">'.$category[0]->name.'</a></time><h2 class="headline3 margin-mobile-bottom-10"><a href="'.$link.'">'.get_the_title($postID).'</a></h2><p>'.excerpt(15).'</p><a href="'.$link.'" class="cta-link cta-link-small cta-link-absolute">Posted '.get_the_time('F j, Y').' &mdash; Read more</a></div></li>';
				
			} else if($postType == 'challenges') {
				$results = '<li class="new-elements load-item feed-item news-item no-indent background-white" data-post-id="'.$postID.'" data-max-pages="'.$maxPages.'" data-results-count="'.$count.'"> <a class="full-link" href="'.$link.'"></a><h5 class="eyebrow margin-mobile-bottom-10">'.get_field('challenges_header', $postID).'</h5><h3 class="headline2-alt">'.get_the_title($postID).'</h3></li>';
			} else if($postType == 'campaigns') {
				$results = '<div class="new-elements load-item small-content-item feed-item column pure-u-lg-12-12 pure-u-md-12-12 pure-u-sm-12-12" data-post-id="'.$postID.'" data-max-pages="'.$maxPages.'" data-results-count="'.$count.'"><a href="'.$link.'" class="full-link"></a><div class="small-content-inner"><div class="small-image"><img alt="'.get_the_title($postID).'" src="'.get_the_post_thumbnail_url($postID, 'full').'" title="'.get_the_title($postID).'"></div><div class="small-content"><h2 class="headline2-alt"><a href="'.$link.'">'.get_the_title($postID).'</a></h2><p class="margin-mobile-bottom-10 margin-tablet-landscape-bottom-20 margin-mobile-top-10 margin-tablet-landscape-top-20">'.excerpt(30).'</p><a class="cta-link cta-link-small" href="'.$link.'" title="Read more">Read more</a></div></div></div>';
			} else {
				$results = '<li class="new-elements load-item feed-item background-white'.$thumbnailClass.'" data-post-id="'.$postID.'" data-max-pages="'.$maxPages.'" data-results-count="'.$count.'">'.$thumbnail.'<a href="'.$link.'" class="full-link"></a><div class="feed-item-inner padding-mobile-20"><time class="caption margin-mobile-bottom-20">'.get_the_time('F j, Y').'</time><h2 class="headline3 margin-mobile-bottom-10"><a href="'.$link.'">'.get_the_title($postID).'</a></h2><p>'.excerpt(15).'</p><a href="'.$link.'" class="cta-link cta-link-small cta-link-absolute">Read more</a></div></li>';
			}
							

			$result['response'][] = $results;
			$result['status']   = 'done';
	
	endwhile; else:
		$result['response'] = '<li class="feed-item load-item padding-mobile-20 padding-tablet-landscape-40 padding-tablet-landscape-left-85 component-theme-white padding-tablet-landscape-right-85" data-max-pages="0" data-results-count="0"><h3 class="headline3">There is no content that matches your filter</h3></li>';
		$result['status']   = '404';
	endif;
 
	$result = json_encode($result);
	echo $result;
	

	die();
}


add_action('wp_ajax_filter_posts', 'ajax_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_get_posts');
