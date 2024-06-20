<?php
/**
* Custom Addons.
*
* @package Restaurant Culinary
*/

$wp_customize->add_section( 'restaurant_culinary_theme_pagination_options',
    array(
    'title'      => esc_html__( 'Customizer Custom Settings', 'restaurant-culinary' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'restaurant_culinary_theme_addons_panel',
    )
);

$wp_customize->add_setting( 'restaurant_culinary_theme_pagination_options_alignment',
    array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'restaurant_culinary_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'restaurant_culinary_theme_pagination_options_alignment',
    array(
    'label'       => esc_html__( 'Pagination Alignment', 'restaurant-culinary' ),
    'section'     => 'restaurant_culinary_theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'restaurant-culinary' ),
        'Right' => esc_html__( 'Right', 'restaurant-culinary' ),
        'Left'  => esc_html__( 'Left', 'restaurant-culinary' ),
        ),
    )
);

$wp_customize->add_setting( 'restaurant_culinary_theme_breadcrumb_options_alignment',
    array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'restaurant_culinary_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'restaurant_culinary_theme_breadcrumb_options_alignment',
    array(
    'label'       => esc_html__( 'Breadcrumb Alignment', 'restaurant-culinary' ),
    'section'     => 'restaurant_culinary_theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'restaurant-culinary' ),
        'Right' => esc_html__( 'Right', 'restaurant-culinary' ),
        'Left'  => esc_html__( 'Left', 'restaurant-culinary' ),
        ),
    )
);