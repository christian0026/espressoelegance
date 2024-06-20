<?php
/**
 * Restaurant Cafeteria Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Restaurant Cafeteria
 */

if ( ! defined( 'RESTAURANT_CAFETERIA_URL' ) ) {
    define( 'RESTAURANT_CAFETERIA_URL', esc_url( 'https://www.themagnifico.net/products/cafeteria-wordpress-theme/', 'restaurant-cafeteria') );
}
if ( ! defined( 'RESTAURANT_CAFETERIA_TEXT' ) ) {
    define( 'RESTAURANT_CAFETERIA_TEXT', __( 'Restaurant Cafeteria Pro','restaurant-cafeteria' ));
}
if ( ! defined( 'RESTAURANT_CAFETERIA_BUY_TEXT' ) ) {
    define( 'RESTAURANT_CAFETERIA_BUY_TEXT', __( 'Buy Restaurant Cafeteria Pro','restaurant-cafeteria' ));
}

use WPTRT\Customize\Section\Restaurant_Cafeteria_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Restaurant_Cafeteria_Button::class );

    $manager->add_section(
        new Restaurant_Cafeteria_Button( $manager, 'restaurant_cafeteria_pro', [
            'title'       => esc_html( RESTAURANT_CAFETERIA_TEXT,'restaurant-cafeteria' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'restaurant-cafeteria' ),
            'button_url'  => esc_url( RESTAURANT_CAFETERIA_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'restaurant-cafeteria-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'restaurant-cafeteria-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function restaurant_cafeteria_customize_register($wp_customize){

    // Pro Version
    class Restaurant_Cafeteria_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>' . esc_html('For More','restaurant-cafeteria') . ' <strong>' . esc_html($this->label) . '</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( RESTAURANT_CAFETERIA_BUY_TEXT) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Restaurant_Cafeteria_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('restaurant_cafeteria_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'restaurant_cafeteria_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'restaurant_cafeteria_logo_title_text',array(
        'label'          => __( 'Enable Disable Title', 'restaurant-cafeteria' ),
        'section'        => 'title_tagline',
        'settings'       => 'restaurant_cafeteria_logo_title_text',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('restaurant_cafeteria_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'restaurant_cafeteria_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'restaurant_cafeteria_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'restaurant-cafeteria' ),
        'section'        => 'title_tagline',
        'settings'       => 'restaurant_cafeteria_theme_description',
        'type'           => 'checkbox',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_logo', array(
        'sanitize_callback' => 'Restaurant_Cafeteria_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Restaurant_Cafeteria_Customize_Pro_Version ( $wp_customize,'pro_version_logo', array(
        'section'     => 'title_tagline',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'restaurant-cafeteria' ),
        'description' => esc_url( RESTAURANT_CAFETERIA_URL ),
        'priority'    => 100
    )));

    // General Settings
     $wp_customize->add_section('restaurant_cafeteria_general_settings',array(
        'title' => esc_html__('General Settings','restaurant-cafeteria'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('restaurant_cafeteria_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'restaurant_cafeteria_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'restaurant_cafeteria_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'restaurant-cafeteria' ),
        'section'        => 'restaurant_cafeteria_general_settings',
        'settings'       => 'restaurant_cafeteria_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'restaurant_cafeteria_preloader_bg_color', array(
        'default' => '#f26c4f',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'restaurant_cafeteria_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_general_settings',
        'settings' => 'restaurant_cafeteria_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'restaurant_cafeteria_preloader_dot_1_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'restaurant_cafeteria_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_general_settings',
        'settings' => 'restaurant_cafeteria_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'restaurant_cafeteria_preloader_dot_2_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'restaurant_cafeteria_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_general_settings',
        'settings' => 'restaurant_cafeteria_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('restaurant_cafeteria_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'restaurant_cafeteria_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'restaurant_cafeteria_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'restaurant-cafeteria' ),
        'section'        => 'restaurant_cafeteria_general_settings',
        'settings'       => 'restaurant_cafeteria_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('restaurant_cafeteria_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'restaurant_cafeteria_sanitize_choices'
    ));
    $wp_customize->add_control('restaurant_cafeteria_scroll_top_position',array(
        'type' => 'radio',
        'section' => 'restaurant_cafeteria_general_settings',
        'choices' => array(
            'Right' => __('Right','restaurant-cafeteria'),
            'Left' => __('Left','restaurant-cafeteria'),
            'Center' => __('Center','restaurant-cafeteria')
        ),
    ) );

    // Product Columns
    $wp_customize->add_setting( 'restaurant_cafeteria_products_per_row' , array(
       'default'           => '3',
       'transport'         => 'refresh',
       'sanitize_callback' => 'restaurant_cafeteria_sanitize_select',
    ) );

    $wp_customize->add_control('restaurant_cafeteria_products_per_row', array(
       'label' => __( 'Product per row', 'restaurant-cafeteria' ),
       'section'  => 'restaurant_cafeteria_general_settings',
       'type'     => 'select',
       'choices'  => array(
           '2' => '2',
           '3' => '3',
           '4' => '4',
       ),
    ) );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Restaurant_Cafeteria_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Restaurant_Cafeteria_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'restaurant_cafeteria_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'restaurant-cafeteria' ),
        'description' => esc_url( RESTAURANT_CAFETERIA_URL ),
        'priority'    => 100
    )));

    // Header
    $wp_customize->add_section('restaurant_cafeteria_header_settings',array(
        'title' => esc_html__('Header Settings','restaurant-cafeteria'),
    ));

    $wp_customize->add_setting('restaurant_cafeteria_header_button_text_1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_header_button_text_1',array(
        'label' => __('Header Button 1','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_header_settings',
        'setting' => 'restaurant_cafeteria_header_button_text_1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_header_button_url_1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_header_button_url_1',array(
        'label' => __('Header Button Url 1','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_header_settings',
        'setting' => 'restaurant_cafeteria_header_button_url_1',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_header_button_text_2',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_header_button_text_2',array(
        'label' => __('Header Button 2','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_header_settings',
        'setting' => 'restaurant_cafeteria_header_button_text_2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_header_button_url_2',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_header_button_url_2',array(
        'label' => __('Header Button Url 2','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_header_settings',
        'setting' => 'restaurant_cafeteria_header_button_url_2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_header_button_text_3',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_header_button_text_3',array(
        'label' => __('Header Button 3','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_header_settings',
        'setting' => 'restaurant_cafeteria_header_button_text_3',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_header_button_url_3',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_header_button_url_3',array(
        'label' => __('Header Button Url 3','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_header_settings',
        'setting' => 'restaurant_cafeteria_header_button_url_3',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_topbar_phone_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_topbar_phone_text',array(
        'label' => __('Phone Number','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_header_settings',
        'setting' => 'restaurant_cafeteria_topbar_phone_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_header_search_setting', array(
        'default' => false,
        'sanitize_callback' => 'restaurant_cafeteria_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'restaurant_cafeteria_header_search_setting',array(
        'label'          => __( 'Enable Header Search', 'restaurant-cafeteria' ),
        'section'        => 'restaurant_cafeteria_header_settings',
        'settings'       => 'restaurant_cafeteria_header_search_setting',
        'type'           => 'checkbox',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_header_setting', array(
        'sanitize_callback' => 'Restaurant_Cafeteria_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Restaurant_Cafeteria_Customize_Pro_Version ( $wp_customize,'pro_version_header_setting', array(
        'section'     => 'restaurant_cafeteria_header_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'restaurant-cafeteria' ),
        'description' => esc_url( RESTAURANT_CAFETERIA_URL ),
        'priority'    => 100
    )));

    //Slider
    $wp_customize->add_section('restaurant_cafeteria_top_slider',array(
        'title' => esc_html__('Slider Settings','restaurant-cafeteria'),
    ));

    $wp_customize->add_setting('restaurant_cafeteria_slider_short_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_slider_short_heading',array(
        'label' => esc_html__('Slider Short Heading','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_top_slider',
        'setting' => 'restaurant_cafeteria_slider_short_heading',
        'type'  => 'text'
    ));

    for ( $restaurant_cafeteria_count = 1; $restaurant_cafeteria_count <= 3; $restaurant_cafeteria_count++ ) {

        $wp_customize->add_setting( 'restaurant_cafeteria_top_slider_page' . $restaurant_cafeteria_count, array(
            'default'           => '',
            'sanitize_callback' => 'restaurant_cafeteria_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'restaurant_cafeteria_top_slider_page' . $restaurant_cafeteria_count, array(
            'label'    => __( 'Select Slide Page', 'restaurant-cafeteria' ),
            'description' => __('Slider image size (1400 x 600)','restaurant-cafeteria'),
            'section'  => 'restaurant_cafeteria_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Restaurant_Cafeteria_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Restaurant_Cafeteria_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'restaurant_cafeteria_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'restaurant-cafeteria' ),
        'description' => esc_url( RESTAURANT_CAFETERIA_URL ),
        'priority'    => 100
    )));

    // About Us
    $wp_customize->add_section('restaurant_cafeteria_about_us_section',array(
        'title' => esc_html__('About Us Option','restaurant-cafeteria'),
    ));

    $wp_customize->add_setting('restaurant_cafeteria_about_us_left_image',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( 
    $wp_customize,'restaurant_cafeteria_about_us_left_image',array(
        'label' => __('About Us Left Image ','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_about_us_section',
        'settings' => 'restaurant_cafeteria_about_us_left_image',
    )));

    $wp_customize->add_setting('restaurant_cafeteria_about_us_image_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_about_us_image_heading',array(
        'label' => esc_html__('Main Heading','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_about_us_section',
        'setting' => 'restaurant_cafeteria_about_us_image_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_about_us_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_about_us_heading',array(
        'label' => esc_html__('Main Text','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_about_us_section',
        'setting' => 'restaurant_cafeteria_about_us_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_about_us_content',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_about_us_content',array(
        'label' => esc_html__('Main Content','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_about_us_section',
        'setting' => 'restaurant_cafeteria_about_us_content',
        'type'  => 'text'
    ));

    for ($i=1; $i <= 4; $i++) {

        $wp_customize->add_setting('restaurant_cafeteria_about_us_list_icon'.$i,array(
            'default' => 'fas fa-mobile-alt',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('restaurant_cafeteria_about_us_list_icon'.$i,array(
            'label' => esc_html__('Featured Icon' ,'restaurant-cafeteria').$i,
            'section' => 'restaurant_cafeteria_about_us_section',
            'setting' => 'restaurant_cafeteria_about_us_list_icon'.$i,
            'type'  => 'text'
        ));

        $wp_customize->add_setting('restaurant_cafeteria_about_us_list_heading'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('restaurant_cafeteria_about_us_list_heading'.$i,array(
            'label' => esc_html__('Featured Heading' ,'restaurant-cafeteria').$i,
            'section' => 'restaurant_cafeteria_about_us_section',
            'setting' => 'restaurant_cafeteria_about_us_list_heading'.$i,
            'type'  => 'text'
        ));
    }

    $wp_customize->add_setting('restaurant_cafeteria_about_us_button_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_about_us_button_text',array(
        'label' => esc_html__('Button Text','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_about_us_section',
        'setting' => 'restaurant_cafeteria_about_us_button_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_about_us_button_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('restaurant_cafeteria_about_us_button_url',array(
        'label' => esc_html__('Button Url','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_about_us_section',
        'setting' => 'restaurant_cafeteria_about_us_button_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('restaurant_cafeteria_about_us_image1',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( 
    $wp_customize,'restaurant_cafeteria_about_us_image1',array(
        'label' => __('About Us Image 1 ','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_about_us_section',
        'settings' => 'restaurant_cafeteria_about_us_image1',
    )));

    $wp_customize->add_setting('restaurant_cafeteria_about_us_image2',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( 
    $wp_customize,'restaurant_cafeteria_about_us_image2',array(
        'label' => __('About Us Image 2 ','restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_about_us_section',
        'settings' => 'restaurant_cafeteria_about_us_image2',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_about_setting', array(
        'sanitize_callback' => 'Restaurant_Cafeteria_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Restaurant_Cafeteria_Customize_Pro_Version ( $wp_customize,'pro_version_about_setting', array(
        'section'     => 'restaurant_cafeteria_about_us_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'restaurant-cafeteria' ),
        'description' => esc_url( RESTAURANT_CAFETERIA_URL ),
        'priority'    => 100
    )));
    
    // Footer
    $wp_customize->add_section('restaurant_cafeteria_site_footer_section', array(
        'title' => esc_html__('Footer', 'restaurant-cafeteria'),
    ));

    $wp_customize->add_setting('restaurant_cafeteria_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('restaurant_cafeteria_footer_text_setting', array(
        'label' => __('Replace the footer text', 'restaurant-cafeteria'),
        'section' => 'restaurant_cafeteria_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Restaurant_Cafeteria_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Restaurant_Cafeteria_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'restaurant_cafeteria_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'restaurant-cafeteria' ),
        'description' => esc_url( RESTAURANT_CAFETERIA_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'restaurant_cafeteria_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function restaurant_cafeteria_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function restaurant_cafeteria_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function restaurant_cafeteria_customize_preview_js(){
    wp_enqueue_script('restaurant-cafeteria-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'restaurant_cafeteria_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function restaurant_cafeteria_panels_js() {
    wp_enqueue_style( 'restaurant-cafeteria-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'restaurant-cafeteria-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'restaurant_cafeteria_panels_js' );