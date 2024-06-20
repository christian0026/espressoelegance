<?php
/**
* Body Classes.
* @package Restaurant Culinary
*/
 
 if (!function_exists('restaurant_culinary_body_classes')) :

    function restaurant_culinary_body_classes($classes) {

        $restaurant_culinary_default = restaurant_culinary_get_default_theme_options();
        global $post;
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }

        $restaurant_culinary_global_sidebar_layout = esc_html( get_theme_mod( 'restaurant_culinary_global_sidebar_layout',$restaurant_culinary_default['restaurant_culinary_global_sidebar_layout'] ) );

        if ( is_active_sidebar( 'sidebar-1' ) ) {
            if( is_single() || is_page() ){
                $restaurant_culinary_post_sidebar = esc_html( get_post_meta( $post->ID, 'restaurant_culinary_post_sidebar_option', true ) );
                if (empty($restaurant_culinary_post_sidebar) || ($restaurant_culinary_post_sidebar == 'global-sidebar')) {
                    $classes[] = esc_attr( $restaurant_culinary_global_sidebar_layout );
                } else{
                    $classes[] = esc_attr( $restaurant_culinary_post_sidebar );
                }
            }else{
                $classes[] = esc_attr( $restaurant_culinary_global_sidebar_layout );
            }
            
        }
        
        return $classes;
    }

endif;

add_filter('body_class', 'restaurant_culinary_body_classes');