<?php
/**
* Posts Settings.
*
* @package Restaurant Culinary
*/

$restaurant_culinary_default = restaurant_culinary_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'restaurant_culinary_posts_settings',
	array(
	'title'      => esc_html__( 'Meta Information Settings', 'restaurant-culinary' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'restaurant_culinary_theme_option_panel',
	)
);

$wp_customize->add_setting('restaurant_culinary_post_author',
    array(
        'default' => $restaurant_culinary_default['restaurant_culinary_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'restaurant_culinary_sanitize_checkbox',
    )
);
$wp_customize->add_control('restaurant_culinary_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'restaurant-culinary'),
        'section' => 'restaurant_culinary_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('restaurant_culinary_post_date',
    array(
        'default' => $restaurant_culinary_default['restaurant_culinary_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'restaurant_culinary_sanitize_checkbox',
    )
);
$wp_customize->add_control('restaurant_culinary_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'restaurant-culinary'),
        'section' => 'restaurant_culinary_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('restaurant_culinary_post_category',
    array(
        'default' => $restaurant_culinary_default['restaurant_culinary_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'restaurant_culinary_sanitize_checkbox',
    )
);
$wp_customize->add_control('restaurant_culinary_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'restaurant-culinary'),
        'section' => 'restaurant_culinary_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('restaurant_culinary_post_tags',
    array(
        'default' => $restaurant_culinary_default['restaurant_culinary_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'restaurant_culinary_sanitize_checkbox',
    )
);
$wp_customize->add_control('restaurant_culinary_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'restaurant-culinary'),
        'section' => 'restaurant_culinary_posts_settings',
        'type' => 'checkbox',
    )
);