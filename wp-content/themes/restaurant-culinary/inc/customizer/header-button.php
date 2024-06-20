<?php
/**
* Header Options.
*
* @package Restaurant Culinary
*/

$restaurant_culinary_default = restaurant_culinary_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'restaurant_culinary_button_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'restaurant-culinary' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'restaurant_culinary_theme_option_panel',
	)
);

$wp_customize->add_setting('restaurant_culinary_header_search',
    array(
        'default' => $restaurant_culinary_default['restaurant_culinary_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'restaurant_culinary_sanitize_checkbox',
    )
);
$wp_customize->add_control('restaurant_culinary_header_search',
    array(
        'label' => esc_html__('Enable Search', 'restaurant-culinary'),
        'section' => 'restaurant_culinary_button_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'restaurant_culinary_header_layout_button',
    array(
    'default'           => $restaurant_culinary_default['restaurant_culinary_header_layout_button'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'restaurant_culinary_header_layout_button',
    array(
    'label'    => esc_html__( 'Header Button Text', 'restaurant-culinary' ),
    'section'  => 'restaurant_culinary_button_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'restaurant_culinary_header_layout_button_url',
    array(
    'default'           => $restaurant_culinary_default['restaurant_culinary_header_layout_button_url'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'restaurant_culinary_header_layout_button_url',
    array(
    'label'    => esc_html__( 'Header Button Url', 'restaurant-culinary' ),
    'section'  => 'restaurant_culinary_button_header_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting('restaurant_culinary_theme_loader',
    array(
        'default' => $restaurant_culinary_default['restaurant_culinary_theme_loader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'restaurant_culinary_sanitize_checkbox',
    )
);
$wp_customize->add_control('restaurant_culinary_theme_loader',
    array(
        'label' => esc_html__('Enable Preloader', 'restaurant-culinary'),
        'section' => 'restaurant_culinary_button_header_setting',
        'type' => 'checkbox',
    )
);
