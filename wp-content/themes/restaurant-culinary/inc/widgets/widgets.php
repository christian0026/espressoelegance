<?php
/**
* Widget Functions.
*
* @package Restaurant Culinary
*/


function restaurant_culinary_widgets_init(){

	register_sidebar(array(
	    'name' => esc_html__('Main Sidebar', 'restaurant-culinary'),
	    'id' => 'sidebar-1',
	    'description' => esc_html__('Add widgets here.', 'restaurant-culinary'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>',
	));


    $restaurant_culinary_default = restaurant_culinary_get_default_theme_options();
    $restaurant_culinary_restaurant_culinary_footer_column_layout = absint( get_theme_mod( 'restaurant_culinary_footer_column_layout',$restaurant_culinary_default['restaurant_culinary_footer_column_layout'] ) );

    for( $i = 0; $i < $restaurant_culinary_restaurant_culinary_footer_column_layout; $i++ ){
    	
    	if( $i == 0 ){ $count = esc_html__('One','restaurant-culinary'); }
    	if( $i == 1 ){ $count = esc_html__('Two','restaurant-culinary'); }
    	if( $i == 2 ){ $count = esc_html__('Three','restaurant-culinary'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'restaurant-culinary').$count,
	        'id' => 'restaurant-culinary-footer-widget-'.$i,
	        'description' => esc_html__('Add widgets here.', 'restaurant-culinary'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'restaurant_culinary_widgets_init');