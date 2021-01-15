<?php
// Register our sidebars and widgetized areas.
// Example provided below, change as needed.
function flexlayout_widgets_init() {

	register_sidebar( 
		array(
			'name'          => 'News post sidebar',
			'id'            => 'news_sidebar',
			'before_widget' => '<div class="component component-sidebar">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="headline6 align-center">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'flexlayout_widgets_init' );