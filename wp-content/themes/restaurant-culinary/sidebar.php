<?php
/**
 * The sidebar containing the main widget area
 * @package Restaurant Culinary
 */

$restaurant_culinary_default = restaurant_culinary_get_default_theme_options();

$post_id = get_the_ID(); // Get the post ID

$restaurant_culinary_post_sidebar = esc_html(get_post_meta($post_id, 'restaurant_culinary_post_sidebar_option', true));
$restaurant_culinary_sidebar_column_class = 'column-order-2';

if (empty($restaurant_culinary_post_sidebar)) {
    $restaurant_culinary_global_sidebar_layout = esc_html(get_theme_mod('restaurant_culinary_global_sidebar_layout', $restaurant_culinary_default['restaurant_culinary_global_sidebar_layout']));
} else {
    $restaurant_culinary_global_sidebar_layout = $restaurant_culinary_post_sidebar;
}
if (!is_active_sidebar('sidebar-1') || $restaurant_culinary_global_sidebar_layout == 'no-sidebar') {
    return;
}

if ($restaurant_culinary_global_sidebar_layout == 'left-sidebar') {
    $restaurant_culinary_sidebar_column_class = 'column-order-1';
}
?>

<aside id="secondary" class="widget-area <?php echo esc_attr($restaurant_culinary_sidebar_column_class); ?>">
    <div class="widget-area-wrapper">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside>
