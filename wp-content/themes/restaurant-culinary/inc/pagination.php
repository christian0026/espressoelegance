<?php
/**
 *
 * Pagination Functions
 *
 * @package Restaurant Culinary
 */

if( !function_exists('restaurant_culinary_archive_pagination_x') ):

	// Archive Page Navigation
	function restaurant_culinary_archive_pagination_x(){

		the_posts_pagination();
	}

endif;
add_action('restaurant_culinary_archive_pagination','restaurant_culinary_archive_pagination_x',20);