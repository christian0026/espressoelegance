(function( $ ) {
	wp.customize.bind( 'ready', function() {

		var optPrefix = '#customize-control-restaurant_cafeteria_options-';
		
		// Label
		function restaurant_cafeteria_customizer_label( id, title ) {

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-restaurant_cafeteria_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'restaurant_cafeteria_scroll_hide' || id === 'restaurant_cafeteria_preloader_hide' || id === 'restaurant_cafeteria_sticky_header' || id === 'restaurant_cafeteria_products_per_row' || id === 'restaurant_cafeteria_scroll_top_position' || id === 'restaurant_cafeteria_products_per_row')  {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-restaurant_cafeteria_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Colors

			if ( id === 'restaurant_cafeteria_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-restaurant_cafeteria_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-restaurant_cafeteria_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			//  Header

			if ( id === 'restaurant_cafeteria_topbar_phone_text' || id === 'restaurant_cafeteria_header_button_text_1' || id === 'restaurant_cafeteria_header_search_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-restaurant_cafeteria_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'restaurant_cafeteria_slider_short_heading' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-restaurant_cafeteria_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// About Us

			if ( id === 'restaurant_cafeteria_about_us_left_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-restaurant_cafeteria_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'restaurant_cafeteria_footer_text_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-restaurant_cafeteria_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}

	    // Site Identity
		restaurant_cafeteria_customizer_label( 'custom_logo', 'Logo Setup' );
		restaurant_cafeteria_customizer_label( 'site_icon', 'Favicon' );

		// General Setting
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_preloader_hide', 'Preloader' );
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_scroll_hide', 'Scroll To Top' );
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_scroll_top_position', 'Scroll to top Position' );
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_products_per_row', 'woocommerce Setting' );

		// Colors
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_theme_color', 'Theme Color' );
		restaurant_cafeteria_customizer_label( 'background_color', 'Colors' );
		restaurant_cafeteria_customizer_label( 'background_image', 'Image' );

		//Header Image
		restaurant_cafeteria_customizer_label( 'header_image', 'Header Image' );

		// Header
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_header_button_text_1', 'Header Button' );
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_topbar_phone_text', 'Phone Number' );
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_header_search_setting', 'Header Search' );

		//Slider
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_slider_short_heading', 'Slider' );

		//About Us
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_about_us_left_image', 'About Us' );

		//Footer
		restaurant_cafeteria_customizer_label( 'restaurant_cafeteria_footer_text_setting', 'Footer' );
	

	});

})( jQuery );
