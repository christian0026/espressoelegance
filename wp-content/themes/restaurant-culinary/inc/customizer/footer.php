<?php
/**
* Footer Settings.
*
* @package Restaurant Culinary
*/

$restaurant_culinary_default = restaurant_culinary_get_default_theme_options();

$wp_customize->add_section( 'restaurant_culinary_footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Settings', 'restaurant-culinary' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'restaurant_culinary_theme_option_panel',
	)
);

$wp_customize->add_setting( 'restaurant_culinary_footer_column_layout',
	array(
	'default'           => $restaurant_culinary_default['restaurant_culinary_footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'restaurant_culinary_sanitize_select',
	)
);
$wp_customize->add_control( 'restaurant_culinary_footer_column_layout',
	array(
	'label'       => esc_html__( 'Footer Column Layout', 'restaurant-culinary' ),
	'section'     => 'restaurant_culinary_footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'restaurant-culinary' ),
		'2' => esc_html__( 'Two Column', 'restaurant-culinary' ),
		'3' => esc_html__( 'Three Column', 'restaurant-culinary' ),
	    ),
	)
);

$wp_customize->add_setting( 'restaurant_culinary_footer_copyright_text',
	array(
	'default'           => $restaurant_culinary_default['restaurant_culinary_footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'restaurant_culinary_footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'restaurant-culinary' ),
	'section'  => 'restaurant_culinary_footer_widget_area',
	'type'     => 'text',
	)
);

$wp_customize->add_setting( 'footer_widget_background_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
));
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_background_color', array(
    'label'     => __('Footer Widget Background Color', 'restaurant-culinary'),
    'description' => __('It will change the complete footer widget background color.', 'restaurant-culinary'),
    'section' => 'restaurant_culinary_footer_widget_area',
    'settings' => 'footer_widget_background_color',
)));

$wp_customize->add_setting('footer_widget_background_image',array(
    'default'   => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'footer_widget_background_image',array(
    'label' => __('Footer Widget Background Image','restaurant-culinary'),
    'section' => 'restaurant_culinary_footer_widget_area'
)));
