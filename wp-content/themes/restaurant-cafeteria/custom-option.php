<?php

    $restaurant_cafeteria_theme_css= "";

    /*--------------------------- Scroll to top positions -------------------*/

    $restaurant_cafeteria_scroll_position = get_theme_mod( 'restaurant_cafeteria_scroll_top_position','Right');
    if($restaurant_cafeteria_scroll_position == 'Right'){
        $restaurant_cafeteria_theme_css .='#button{';
            $restaurant_cafeteria_theme_css .='right: 20px;';
        $restaurant_cafeteria_theme_css .='}';
    }else if($restaurant_cafeteria_scroll_position == 'Left'){
        $restaurant_cafeteria_theme_css .='#button{';
            $restaurant_cafeteria_theme_css .='left: 20px;';
        $restaurant_cafeteria_theme_css .='}';
    }else if($restaurant_cafeteria_scroll_position == 'Center'){
        $restaurant_cafeteria_theme_css .='#button{';
            $restaurant_cafeteria_theme_css .='right: 50%;left: 50%;';
        $restaurant_cafeteria_theme_css .='}';
    }
