<?php
/**
 * Restaurant Cafeteria functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Restaurant Cafeteria
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Restaurant_Cafeteria_Loader.php' );

$Restaurant_Cafeteria_Loader = new \WPTRT\Autoload\Restaurant_Cafeteria_Loader();

$Restaurant_Cafeteria_Loader->restaurant_cafeteria_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$Restaurant_Cafeteria_Loader->restaurant_cafeteria_register();

if ( ! function_exists( 'restaurant_cafeteria_setup' ) ) :

	function restaurant_cafeteria_setup() {

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		load_theme_textdomain( 'restaurant-cafeteria', get_template_directory() . '/languages' );
		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
        add_image_size('restaurant-cafeteria-featured-header-image', 2000, 660, true);

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','restaurant-cafeteria' ),
	        'footer'=> esc_html__( 'Footer Menu','restaurant-cafeteria' ),
        ) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'restaurant_cafeteria_custom_background_args', array(
			'default-color' => 'f7ebe5',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 80,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_restaurant_cafeteria_dismissable_notice', 'restaurant_cafeteria_dismissable_notice');
	}
endif;
add_action( 'after_setup_theme', 'restaurant_cafeteria_setup' );


function restaurant_cafeteria_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'restaurant_cafeteria_content_width', 1170 );
}
add_action( 'after_setup_theme', 'restaurant_cafeteria_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function restaurant_cafeteria_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'restaurant-cafeteria' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'restaurant-cafeteria' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'restaurant-cafeteria' ),
		'id'            => 'restaurant-cafeteria-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'restaurant-cafeteria' ),
		'id'            => 'restaurant-cafeteria-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'restaurant-cafeteria' ),
		'id'            => 'restaurant-cafeteria-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'restaurant_cafeteria_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function restaurant_cafeteria_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'montserrat',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'amatic-sc',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'restaurant-cafeteria-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');

    wp_enqueue_style( 'owl.carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');

	wp_enqueue_style( 'restaurant-cafeteria-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'restaurant-cafeteria-style',$restaurant_cafeteria_theme_css );

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() .'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('restaurant-cafeteria-theme-js', get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('owl.carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'restaurant_cafeteria_scripts' );

/**
 * Enqueue Preloader.
 */
function restaurant_cafeteria_preloader() {

  $restaurant_cafeteria_theme_color_css = '';
  $restaurant_cafeteria_preloader_bg_color = get_theme_mod('restaurant_cafeteria_preloader_bg_color');
  $restaurant_cafeteria_preloader_dot_1_color = get_theme_mod('restaurant_cafeteria_preloader_dot_1_color');
  $restaurant_cafeteria_preloader_dot_2_color = get_theme_mod('restaurant_cafeteria_preloader_dot_2_color');

	if(get_theme_mod('restaurant_cafeteria_preloader_bg_color') == '') {
		$restaurant_cafeteria_preloader_bg_color = '#f26c4f';
	}
	if(get_theme_mod('restaurant_cafeteria_preloader_dot_1_color') == '') {
		$restaurant_cafeteria_preloader_dot_1_color = '#ffffff';
	}
	if(get_theme_mod('restaurant_cafeteria_preloader_dot_2_color') == '') {
		$restaurant_cafeteria_preloader_dot_2_color = '#000000';
	}
	$restaurant_cafeteria_theme_color_css = '
		.loading{
			background-color: '.esc_attr($restaurant_cafeteria_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($restaurant_cafeteria_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($restaurant_cafeteria_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'restaurant-cafeteria-style',$restaurant_cafeteria_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'restaurant_cafeteria_preloader' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

function restaurant_cafeteria_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/*dropdown page sanitization*/
function restaurant_cafeteria_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function restaurant_cafeteria_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}

/*radio button sanitization*/
function restaurant_cafeteria_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'restaurant_cafeteria_loop_columns');
if (!function_exists('restaurant_cafeteria_loop_columns')) {
	function restaurant_cafeteria_loop_columns() {
		$restaurant_cafeteria_columns = get_theme_mod( 'restaurant_cafeteria_products_per_row', 3 );
		return $restaurant_cafeteria_columns; // 3 products per row
	}
}

function restaurant_cafeteria_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'pro_version_footer' );
    $wp_customize->remove_control( 'pro_version_footer' );

}
add_action( 'customize_register', 'restaurant_cafeteria_remove_customize_register', 11 );

/**
 * Get CSS
 */

function restaurant_cafeteria_getpage_css($hook) {
	wp_register_script( 'admin-notice-script', get_template_directory_uri() . '/inc/admin/js/admin-notice-script.js', array( 'jquery' ) );
   	wp_localize_script('admin-notice-script','restaurant_cafeteria',
		array('admin_ajax'	=>	admin_url('admin-ajax.php'),'wpnonce'  =>	wp_create_nonce('restaurant_cafeteria_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('admin-notice-script');

    wp_localize_script( 'admin-notice-script', 'restaurant_cafeteria_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_restaurant-cafeteria-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'restaurant-cafeteria-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'restaurant_cafeteria_getpage_css' );

if ( ! defined( 'RESTAURANT_CAFETERIA_CONTACT_SUPPORT' ) ) {
define('RESTAURANT_CAFETERIA_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/restaurant-cafeteria/','restaurant-cafeteria'));
}
if ( ! defined( 'RESTAURANT_CAFETERIA_REVIEW' ) ) {
define('RESTAURANT_CAFETERIA_REVIEW',__('https://wordpress.org/support/theme/restaurant-cafeteria/reviews/','restaurant-cafeteria'));
}
if ( ! defined( 'RESTAURANT_CAFETERIA_LIVE_DEMO' ) ) {
define('RESTAURANT_CAFETERIA_LIVE_DEMO',__('https://demo.themagnifico.net/restaurant-cafeteria/','restaurant-cafeteria'));
}
if ( ! defined( 'RESTAURANT_CAFETERIA_GET_PREMIUM_PRO' ) ) {
define('RESTAURANT_CAFETERIA_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/cafeteria-wordpress-theme/','restaurant-cafeteria'));
}
if ( ! defined( 'RESTAURANT_CAFETERIA_PRO_DOC' ) ) {
define('RESTAURANT_CAFETERIA_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/restaurant-cafeteria-pro-doc/','restaurant-cafeteria'));
}
if ( ! defined( 'RESTAURANT_CAFETERIA_PRO_FREE_DOC' ) ) {
define('RESTAURANT_CAFETERIA_PRO_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/restaurant-cafeteria-free-doc/','restaurant-cafeteria'));
}

add_action('admin_menu', 'restaurant_cafeteria_themepage');
function restaurant_cafeteria_themepage(){

	$restaurant_cafeteria_theme_test = wp_get_theme();

	$restaurant_cafeteria_theme_info = add_theme_page( __('Theme Options','restaurant-cafeteria'), __(' Theme Options','restaurant-cafeteria'), 'manage_options', 'restaurant-cafeteria-info.php', 'restaurant_cafeteria_info_page' );
}

function restaurant_cafeteria_info_page() {
	$restaurant_cafeteria_theme_user = wp_get_current_user();
	$restaurant_cafeteria_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap restaurant-cafeteria-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','restaurant-cafeteria'); ?><?php echo esc_html( $restaurant_cafeteria_theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "restaurant-cafeteria"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Restaurant Cafeteria , feel free to contact us for any support regarding our theme.", "restaurant-cafeteria"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "restaurant-cafeteria"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "restaurant-cafeteria"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "restaurant-cafeteria"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_GET_PREMIUM_PRO ); ?>" class="button button-primary get prem">
							<?php esc_html_e("Get Premium", "restaurant-cafeteria"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "restaurant-cafeteria"); ?></h3>
						<p><?php esc_html_e("If You love Restaurant Cafeteria theme then we would appreciate your review about our theme.", "restaurant-cafeteria"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "restaurant-cafeteria"); ?>
						</a></p>
					</div>
				</div>

				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Free Documentation", "restaurant-cafeteria"); ?></h3>
						<p><?php esc_html_e("Our guide is available if you require any help configuring and setting up the theme. Easy and quick way to setup the theme.", "restaurant-cafeteria"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_PRO_FREE_DOC ); ?>" class="button button-primary get">
							<?php esc_html_e("Free Documentation", "restaurant-cafeteria"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php esc_html_e("Free Vs Premium","restaurant-cafeteria"); ?></h2>
		<div class="restaurant-cafeteria-button-container">
			<a target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "restaurant-cafeteria"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "restaurant-cafeteria"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "restaurant-cafeteria"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "restaurant-cafeteria"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "restaurant-cafeteria"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "restaurant-cafeteria"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "restaurant-cafeteria"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "restaurant-cafeteria"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Premium Support", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "restaurant-cafeteria"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="restaurant-cafeteria-button-container">
			<a target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_GET_PREMIUM_PRO ); ?>" class="button button-primary get prem">
				<?php esc_html_e("Go Premium", "restaurant-cafeteria"); ?>
			</a>
		</div>
	</div>
	<?php
}

//Admin Notice For Getstart
function restaurant_cafeteria_ajax_notice_handler() {
	if (!wp_verify_nonce($_POST['wpnonce'], 'restaurant_cafeteria_dismissed_notice_nonce')) {
		exit;
	}
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}
add_action( 'wp_ajax_restaurant_cafeteria_dismissed_notice_handler', 'restaurant_cafeteria_ajax_notice_handler' );

function restaurant_cafeteria_deprecated_hook_admin_notice() {

    $restaurant_cafeteria_dismissed = get_user_meta(get_current_user_id(), 'restaurant_cafeteria_dismissable_notice', true);
    if ( !$restaurant_cafeteria_dismissed) { ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
	    	<div class="tm-admin-image">
	    		<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
	    	</div>
	    	<div class="tm-admin-content" style="padding-left: 30px; align-self: center">
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'restaurant-cafeteria'); ?><?php echo wp_get_theme(); ?><h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'restaurant-cafeteria'); ?><p>
	        	<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=restaurant-cafeteria-info.php' )); ?>"><?php esc_html_e( 'Get started', 'restaurant-cafeteria' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_PRO_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation', 'restaurant-cafeteria' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span class="dashicons dashicons-admin-links"></span>
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( RESTAURANT_CAFETERIA_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'restaurant-cafeteria' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'restaurant_cafeteria_deprecated_hook_admin_notice' );

function restaurant_cafeteria_switch_theme() {
    delete_user_meta(get_current_user_id(), 'restaurant_cafeteria_dismissable_notice');
}
add_action('after_switch_theme', 'restaurant_cafeteria_switch_theme');
function restaurant_cafeteria_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'restaurant_cafeteria_dismissable_notice', true);
    die();
}
