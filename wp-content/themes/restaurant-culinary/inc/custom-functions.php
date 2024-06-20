<?php
/**
 * Custom Functions.
 *
 * @package Restaurant Culinary
 */

if( !function_exists( 'restaurant_culinary_fonts_url' ) ) :

    //Google Fonts URL
    function restaurant_culinary_fonts_url(){

        $font_families = array(
            'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900',
        );

        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($fonts_url);
    }

endif;

if ( ! function_exists( 'restaurant_culinary_sub_menu_toggle_button' ) ) :

    function restaurant_culinary_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'restaurant-culinary-primary-menu' && isset( $args->show_toggles ) ) {
            
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';

            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'restaurant-culinary' ) . '</span>' . restaurant_culinary_get_theme_svg( 'chevron-down' ) . '</span></button>';

            }

            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        }elseif( $args->theme_location == 'restaurant-culinary-primary-menu' ) {

            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = restaurant_culinary_get_theme_svg( 'chevron-down' ) . '</div>';

            } else {

                $args->before = '';
                $args->after  = '';

            }

        }

        return $args;

    }

endif;

add_filter( 'nav_menu_item_args', 'restaurant_culinary_sub_menu_toggle_button', 10, 3 );

if ( ! function_exists( 'restaurant_culinary_the_theme_svg' ) ):
    
    function restaurant_culinary_the_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return restaurant_culinary_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in restaurant_culinary_get_theme_svg();.

        }else{

            echo restaurant_culinary_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in restaurant_culinary_get_theme_svg();.

        }
    }

endif;

if ( ! function_exists( 'restaurant_culinary_get_theme_svg' ) ):

    function restaurant_culinary_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Restaurant_Culinary_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
                'polyline' => array(
                    'fill'      => true,
                    'points'    => true,
                ),
                'line' => array(
                    'fill'      => true,
                    'x1'      => true,
                    'x2' => true,
                    'y1'    => true,
                    'y2' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;

if( !function_exists( 'restaurant_culinary_post_category_list' ) ) :

    // Post Category List.
    function restaurant_culinary_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','restaurant-culinary' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('restaurant_culinary_single_post_navigation') ):

    function restaurant_culinary_single_post_navigation(){

        $restaurant_culinary_footer_column_layout = restaurant_culinary_get_default_theme_options();
        $restaurant_culinary_twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'restaurant_culinary_twp_disable_ajax_load_next_post', true ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $restaurant_culinary_twp_navigation_type == '' || $restaurant_culinary_twp_navigation_type == 'global-layout' ){
            $restaurant_culinary_twp_navigation_type = get_theme_mod('restaurant_culinary_twp_navigation_type', $restaurant_culinary_footer_column_layout['restaurant_culinary_twp_navigation_type']);
        }

        if( $restaurant_culinary_twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $restaurant_culinary_twp_navigation_type == 'theme-normal-navigation' ){ ?>

                <div class="navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . restaurant_culinary_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Previous post:', 'restaurant-culinary') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . restaurant_culinary_the_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Next post:', 'restaurant-culinary') . '</span><span class="post-title">%title</span>',
                    )); ?>
                </div>
                <?php

            }else{

                $next_post = get_next_post();
                if( isset( $next_post->ID ) ){

                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'restaurant_culinary_navigation_action','restaurant_culinary_single_post_navigation',30 );

if( !function_exists('restaurant_culinary_content_offcanvas') ):

    // Offcanvas Contents
    function restaurant_culinary_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html('Close', 'restaurant-culinary'); ?>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'restaurant-culinary'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('restaurant-culinary-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'restaurant-culinary-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Restaurant_Culinary_Walker_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'restaurant_culinary_before_footer_content_action','restaurant_culinary_content_offcanvas',30 );

if( !function_exists('restaurant_culinary_footer_content_widget') ):

    function restaurant_culinary_footer_content_widget(){

        $restaurant_culinary_default = restaurant_culinary_get_default_theme_options();
        
            $restaurant_culinary_restaurant_culinary_footer_column_layout = absint(get_theme_mod('restaurant_culinary_footer_column_layout', $restaurant_culinary_default['restaurant_culinary_footer_column_layout']));
            $restaurant_culinary_footer_sidebar_class = 12;
            if($restaurant_culinary_restaurant_culinary_footer_column_layout == 2) {
                $restaurant_culinary_footer_sidebar_class = 6;
            }
            if($restaurant_culinary_restaurant_culinary_footer_column_layout == 3) {
                $restaurant_culinary_footer_sidebar_class = 4;
            }
            ?>
           
            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">

                        <?php for ($i=0; $i < $restaurant_culinary_restaurant_culinary_footer_column_layout; $i++) {
                            ?>
                            <div class="column <?php echo 'column-' . absint($restaurant_culinary_footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('restaurant-culinary-footer-widget-' . $i); ?>
                            </div>
                       <?php } ?>

                    </div>
                </div>
            </div>

        <?php

    }

endif;

add_action( 'restaurant_culinary_footer_content_action','restaurant_culinary_footer_content_widget',10 );

if( !function_exists('restaurant_culinary_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function restaurant_culinary_footer_content_info(){

        $restaurant_culinary_footer_column_layout = restaurant_culinary_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-9">
                        <div class="footer-credits">
                            <div class="footer-copyright">
                                <?php
                                $restaurant_culinary_footer_copyright_text = wp_kses_post( get_theme_mod( 'restaurant_culinary_footer_copyright_text', $restaurant_culinary_footer_column_layout['restaurant_culinary_footer_copyright_text'] ) );
                                    echo esc_html( $restaurant_culinary_footer_copyright_text );
                                    echo '<br>';
                                    echo esc_html__('Theme: ', 'restaurant-culinary') . '<a href="' . esc_url('https://www.omegathemes.com/wordpress/free-restaurant-wordpress-theme/') . '" title="' . esc_attr__('Restaurant Culinary ', 'restaurant-culinary') . '" target="_blank"><span>' . esc_html__('Restaurant Culinary ', 'restaurant-culinary') . '</span></a>' . esc_html__('By ', 'restaurant-culinary') . '  <span>' . esc_html__('OMEGA ', 'restaurant-culinary') . '</span>';
                                 ?>
                            </div>
                        </div>
                    </div>
                    <div class="column column-3 align-text-right">
                        <a class="to-the-top" href="#site-header">
                            <span class="to-the-top-long">
                                <?php
                                printf( esc_html__( 'To the Top %s', 'restaurant-culinary' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
                                ?>
                            </span>
                            <span class="to-the-top-short">
                                <?php
                                printf( esc_html__( 'Up %s', 'restaurant-culinary' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
                                ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

endif;

add_action( 'restaurant_culinary_footer_content_action','restaurant_culinary_footer_content_info',20 );


if( !function_exists( 'restaurant_culinary_main_slider' ) ) :

    function restaurant_culinary_main_slider(){

        $restaurant_culinary_defaults = restaurant_culinary_get_default_theme_options();
        $restaurant_culinary_header_slider = get_theme_mod( 'restaurant_culinary_header_slider', $restaurant_culinary_defaults['restaurant_culinary_header_slider'] );

        $restaurant_culinary_banner_right_image_1 = get_theme_mod( 'restaurant_culinary_banner_right_image_1' );

        $restaurant_culinary_banner_right_image_2 = get_theme_mod( 'restaurant_culinary_banner_right_image_2' );

        $restaurant_culinary_banner_right_image_3 = get_theme_mod( 'restaurant_culinary_banner_right_image_3' );

        $restaurant_culinary_slider_section_small_title = esc_html( get_theme_mod( 'restaurant_culinary_slider_section_small_title',
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_small_title'] ) );

        $restaurant_culinary_slider_section_sub_title = esc_html( get_theme_mod( 'restaurant_culinary_slider_section_sub_title',
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_sub_title'] ) );

        $restaurant_culinary_slider_section_content = esc_html( get_theme_mod( 'restaurant_culinary_slider_section_content',
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_content'] ) );

        $restaurant_culinary_slider_section_button_url = esc_attr( get_theme_mod( 'restaurant_culinary_slider_section_button_url',
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_button_url'] ) );

        $restaurant_culinary_slider_section_button = esc_html( get_theme_mod( 'restaurant_culinary_slider_section_button',
        $restaurant_culinary_defaults['restaurant_culinary_slider_section_button'] ) );

        if( $restaurant_culinary_header_slider ){ ?>
                <div class="slider-box">
                    <div class="wrapper">
                        <div class="slider-main">
                            <div class="left-box">
                                <div class="slide-heading-main">
                                    <h4 class="slide-title">
                                        <?php if( $restaurant_culinary_slider_section_small_title ){ ?>
                                            <?php echo esc_html($restaurant_culinary_slider_section_small_title) ?>
                                        <?php } ?>
                                    </h4>
                                    <h3 class="slide-sub-title">
                                        <?php if( $restaurant_culinary_slider_section_sub_title ){ ?>
                                            <?php echo esc_html($restaurant_culinary_slider_section_sub_title) ?>
                                        <?php } ?>
                                    </h3>
                                    <p class="slide-content">
                                        <?php if( $restaurant_culinary_slider_section_content ){ ?>
                                            <?php echo esc_html($restaurant_culinary_slider_section_content) ?>
                                        <?php } ?>
                                    </p>
                                    <?php if( $restaurant_culinary_slider_section_button_url || $restaurant_culinary_slider_section_button ){ ?>
                                        <span class="slide-button">
                                            <a href="<?php echo $restaurant_culinary_slider_section_button_url  ?>"><?php echo esc_html($restaurant_culinary_slider_section_button) ?></a>
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="right-box">
                                <div class="image-main-box">
                                    <div class="imagebox1">
                                        <div class="entry-thumbnail">
                                            <?php if( $restaurant_culinary_banner_right_image_1 ){ ?>
                                                <img src="<?php echo esc_url( $restaurant_culinary_banner_right_image_1 ); ?>" alt="Banner Right Image">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="imagebox2">
                                        <div class="entry-thumbnail1">
                                            <?php if( $restaurant_culinary_banner_right_image_2 ){ ?>
                                                <img src="<?php echo esc_url( $restaurant_culinary_banner_right_image_2 ); ?>" alt="Banner Right Image">
                                            <?php } ?>
                                        </div>
                                        <div class="entry-thumbnail">
                                            <?php if( $restaurant_culinary_banner_right_image_3 ){ ?>
                                                <img src="<?php echo esc_url( $restaurant_culinary_banner_right_image_3 ); ?>" alt="Banner Right Image">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
    }

endif;

if( !function_exists( 'restaurant_culinary_about_us_section' ) ) :

    function restaurant_culinary_about_us_section(){ 

        $restaurant_culinary_footer_column_layout = restaurant_culinary_get_default_theme_options();

        $restaurant_culinary_header_about_us = get_theme_mod( 'restaurant_culinary_header_about_us', 
        $restaurant_culinary_footer_column_layout['restaurant_culinary_header_about_us'] );

        $restaurant_culinary_about_us_section_title = esc_html( get_theme_mod( 'restaurant_culinary_about_us_section_title',
        $restaurant_culinary_footer_column_layout['restaurant_culinary_about_us_section_title'] ) );

        $restaurant_culinary_about_us_section_sub_title = esc_html( get_theme_mod( 'restaurant_culinary_about_us_section_sub_title',
        $restaurant_culinary_footer_column_layout['restaurant_culinary_about_us_section_sub_title'] ) );

        $restaurant_culinary_about_us_section_content = esc_html( get_theme_mod( 'restaurant_culinary_about_us_section_content',
        $restaurant_culinary_footer_column_layout['restaurant_culinary_about_us_section_content'] ) );

        $restaurant_culinary_about_us_right_image_1 = get_theme_mod( 'restaurant_culinary_about_us_right_image_1' );

        $restaurant_culinary_about_us_right_image_2 = get_theme_mod( 'restaurant_culinary_about_us_right_image_2' );

        $restaurant_culinary_about_us_right_image_3 = get_theme_mod( 'restaurant_culinary_about_us_right_image_3' );

        $restaurant_culinary_about_section_button_url = esc_attr( get_theme_mod( 'restaurant_culinary_about_section_button_url',
        $restaurant_culinary_footer_column_layout['restaurant_culinary_about_section_button_url'] ) );

        $restaurant_culinary_about_section_button = esc_html( get_theme_mod( 'restaurant_culinary_about_section_button',
        $restaurant_culinary_footer_column_layout['restaurant_culinary_about_section_button'] ) );
        
        if( $restaurant_culinary_header_about_us ){ ?>
            <div class="most-read">
                <div class="wrapper">
                    <div class="most-read-div">
                        <div class="blog-main-box">
                            <div class="list-heading-main">
                                <h4 class="list-title">
                                    <?php if( $restaurant_culinary_about_us_section_title ){ ?>
                                        <?php echo esc_html($restaurant_culinary_about_us_section_title) ?>
                                    <?php } ?>
                                </h4>
                                <h3 class="list-sub-title">
                                    <?php if( $restaurant_culinary_about_us_section_sub_title ){ ?>
                                        <?php echo esc_html($restaurant_culinary_about_us_section_sub_title) ?>
                                    <?php } ?>
                                </h3>
                                <p class="list-content">
                                    <?php if( $restaurant_culinary_about_us_section_content ){ ?>
                                        <?php echo esc_html($restaurant_culinary_about_us_section_content) ?>
                                    <?php } ?>
                                </p>
                                <?php if( $restaurant_culinary_about_section_button_url || $restaurant_culinary_about_section_button ){ ?>
                                    <span class="about-button">
                                        <a href="<?php echo $restaurant_culinary_about_section_button_url ?>"><?php echo esc_html($restaurant_culinary_about_section_button) ?></a>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="most-sidebar-box">
                            <div class="about-img">
                                <?php if( $restaurant_culinary_about_us_right_image_1 ){ ?>
                                    <img src="<?php echo esc_url( $restaurant_culinary_about_us_right_image_1 ); ?>" alt="About Us Right Image">
                                <?php } ?>
                            </div>
                            <div class="about-img_1">
                                <?php if( $restaurant_culinary_about_us_right_image_2 ){ ?>
                                    <img class="img-1" src="<?php echo esc_url( $restaurant_culinary_about_us_right_image_2 ); ?>" alt="About Us Right Image">
                                <?php } ?>
                                <?php if( $restaurant_culinary_about_us_right_image_3 ){ ?>
                                    <img src="<?php echo esc_url( $restaurant_culinary_about_us_right_image_3 ); ?>" alt="About Us Right Image">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }

endif;

if (!function_exists('restaurant_culinary_post_format_icon')):

    // Post Format Icon.
    function restaurant_culinary_post_format_icon() {

        $restaurant_culinary_format = get_post_format(get_the_ID()) ?: 'standard';
        $restaurant_culinary_icon = '';
        $restaurant_culinary_title = '';
        if( $restaurant_culinary_format == 'video' ){
            $restaurant_culinary_icon = restaurant_culinary_get_theme_svg( 'video' );
            $restaurant_culinary_title = esc_html__('Video','restaurant-culinary');
        }elseif( $restaurant_culinary_format == 'audio' ){
            $restaurant_culinary_icon = restaurant_culinary_get_theme_svg( 'audio' );
            $restaurant_culinary_title = esc_html__('Audio','restaurant-culinary');
        }elseif( $restaurant_culinary_format == 'gallery' ){
            $restaurant_culinary_icon = restaurant_culinary_get_theme_svg( 'gallery' );
            $restaurant_culinary_title = esc_html__('Gallery','restaurant-culinary');
        }elseif( $restaurant_culinary_format == 'quote' ){
            $restaurant_culinary_icon = restaurant_culinary_get_theme_svg( 'quote' );
            $restaurant_culinary_title = esc_html__('Quote','restaurant-culinary');
        }elseif( $restaurant_culinary_format == 'image' ){
            $restaurant_culinary_icon = restaurant_culinary_get_theme_svg( 'image' );
            $restaurant_culinary_title = esc_html__('Image','restaurant-culinary');
        }
        
        if (!empty($restaurant_culinary_icon)) { ?>
            <div class="theme-post-format">
                <span class="post-format-icom"><?php echo restaurant_culinary_svg_escape($restaurant_culinary_icon); ?></span>
                <?php if( $restaurant_culinary_title ){ echo '<span class="post-format-label">'.esc_html( $restaurant_culinary_title ).'</span>'; } ?>
            </div>
        <?php }
    }

endif;

if ( ! function_exists( 'restaurant_culinary_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function restaurant_culinary_svg_escape( $input ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $svg ) {
            return false;
        }

        return $svg;

    }

endif;

if( !function_exists( 'restaurant_culinary_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function restaurant_culinary_sanitize_sidebar_option_meta( $input ){

        $restaurant_culinary_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$restaurant_culinary_metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'restaurant_culinary_sanitize_pagination_meta' ) ) :

    // Sidebar Option Sanitize.
    function restaurant_culinary_sanitize_pagination_meta( $input ){

        $restaurant_culinary_metabox_options = array( 'Center','Right','Left');
        if( in_array( $input,$restaurant_culinary_metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

