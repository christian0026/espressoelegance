<?php

$restaurant_culinary_custom_css = "";

$restaurant_culinary_theme_pagination_options_alignment = get_theme_mod('restaurant_culinary_theme_pagination_options_alignment', 'Center');
	if ($restaurant_culinary_theme_pagination_options_alignment == 'Center') {
	    $restaurant_culinary_custom_css .= '.pagination{';
	    $restaurant_culinary_custom_css .= 'text-align: center;';
	    $restaurant_culinary_custom_css .= '}';
	} else if ($restaurant_culinary_theme_pagination_options_alignment == 'Right') {
	    $restaurant_culinary_custom_css .= '.pagination{';
	    $restaurant_culinary_custom_css .= 'text-align: Right;';
	    $restaurant_culinary_custom_css .= '}';
	} else if ($restaurant_culinary_theme_pagination_options_alignment == 'Left') {
	    $restaurant_culinary_custom_css .= '.pagination{';
	    $restaurant_culinary_custom_css .= 'text-align: Left;';
	    $restaurant_culinary_custom_css .= '}';
	}

	 $restaurant_culinary_theme_breadcrumb_options_alignment = get_theme_mod('restaurant_culinary_theme_breadcrumb_options_alignment', 'Center');
	if ($restaurant_culinary_theme_breadcrumb_options_alignment == 'Center') {
	    $restaurant_culinary_custom_css .= '.breadcrumbs ul{';
	    $restaurant_culinary_custom_css .= 'text-align: center !important;';
	    $restaurant_culinary_custom_css .= '}';
	} else if ($restaurant_culinary_theme_breadcrumb_options_alignment == 'Right') {
	    $restaurant_culinary_custom_css .= '.breadcrumbs ul{';
	    $restaurant_culinary_custom_css .= 'text-align: Right !important;';
	    $restaurant_culinary_custom_css .= '}';
	} else if ($restaurant_culinary_theme_breadcrumb_options_alignment == 'Left') {
	    $restaurant_culinary_custom_css .= '.breadcrumbs ul{';
	    $restaurant_culinary_custom_css .= 'text-align: Left !important;';
	    $restaurant_culinary_custom_css .= '}';
	}