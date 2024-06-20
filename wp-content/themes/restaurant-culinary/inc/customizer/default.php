<?php
/**
 * Default Values.
 *
 * @package Restaurant Culinary
 */

if ( ! function_exists( 'restaurant_culinary_get_default_theme_options' ) ) :
	function restaurant_culinary_get_default_theme_options() {

		$restaurant_culinary_defaults = array();

        // Header
        $restaurant_culinary_defaults['restaurant_culinary_header_layout_button']          =  esc_html__( 'Buy Now', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_header_layout_button_url']      =  esc_url( '#', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_header_search']                 = 0;
        $restaurant_culinary_defaults['restaurant_culinary_theme_loader']                  = 0;
        $restaurant_culinary_defaults['restaurant_culinary_footer_column_layout']          = 3;

        //Slider 

        $restaurant_culinary_defaults['restaurant_culinary_slider_section_small_title']    =  esc_html__( 'Taste Redefined', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_sub_title']      =  esc_html__( 'Where Every Flavor Tells A Story', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_content']        =  esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, industry\'s standard dummy text ever since the 1500s,', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_button_url']     =  esc_url( '#', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_button']         =  esc_html__( 'Learn More', 'restaurant-culinary' );

	// Options.
        $restaurant_culinary_defaults['restaurant_culinary_logo_width_range']                 = 300;
        
        $restaurant_culinary_defaults['restaurant_culinary_global_sidebar_layout']	        = 'right-sidebar';
        
        $restaurant_culinary_defaults['restaurant_culinary_pagination_layout']                = 'numeric';
	$restaurant_culinary_defaults['restaurant_culinary_footer_column_layout'] 	        = 2;
	$restaurant_culinary_defaults['restaurant_culinary_footer_copyright_text'] 	        = esc_html__( 'All rights reserved.', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_twp_navigation_type']              = 'theme-normal-navigation';
        $restaurant_culinary_defaults['restaurant_culinary_post_author']                      = 1;
        $restaurant_culinary_defaults['restaurant_culinary_post_date']                        = 1;
        $restaurant_culinary_defaults['restaurant_culinary_post_category']                	= 1;
        $restaurant_culinary_defaults['restaurant_culinary_post_tags']                        = 1;
        $restaurant_culinary_defaults['restaurant_culinary_floating_next_previous_nav']       = 1;
        $restaurant_culinary_defaults['restaurant_culinary_header_slider']                    = 0;
        $restaurant_culinary_defaults['restaurant_culinary_category_section']                 = 0;
        $restaurant_culinary_defaults['restaurant_culinary_courses_category_section']         = 0;
        $restaurant_culinary_defaults['restaurant_culinary_background_color']                 = '#fff';

        //About Us
        
        $restaurant_culinary_defaults['restaurant_culinary_header_about_us']                   = 0;
        $restaurant_culinary_defaults['restaurant_culinary_about_us_section_title']            = esc_html__( 'Highlight', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_about_us_section_sub_title']        = esc_html__( 'The magic of the kitchen', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_about_us_section_content']          = esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, industry\'s standard dummy text ever since the.', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_about_section_button']              = esc_html__( 'Learn More', 'restaurant-culinary' );
        $restaurant_culinary_defaults['restaurant_culinary_about_section_button_url']          = esc_url( '#', 'restaurant-culinary' );



	// Pass through filter.
	$restaurant_culinary_defaults = apply_filters( 'restaurant_culinary_filter_default_theme_options', $restaurant_culinary_defaults );

		return $restaurant_culinary_defaults;
	}
endif;
