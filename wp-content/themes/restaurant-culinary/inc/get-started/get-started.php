<?php
/**
 * Added Omega Page. */

/**
 * Add a new page under Appearance
 */
function restaurant_culinary_menu()
{
  add_theme_page(__('Omega Options', 'restaurant-culinary'), __('Omega Options', 'restaurant-culinary'), 'edit_theme_options', 'restaurant-culinary-theme', 'restaurant_culinary_page');
}
add_action('admin_menu', 'restaurant_culinary_menu');


function restaurant_culinary_notice() {
    global $pagenow;
    if (is_admin() && ('themes.php' == $pagenow) && isset($_GET['activated'])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <div class="notice-content">
                <h2><?php esc_html_e('Thank You for installing Restaurant Culinary Theme!', 'restaurant-culinary') ?> </h2>
                <div class="info-link">
                    <a href="<?php echo esc_url( admin_url( 'themes.php?page=restaurant-culinary-theme' ) ); ?>"><?php esc_html_e('Omega Options', 'restaurant-culinary'); ?></a>
                </div>
                <div class="info-link">
                    <a href="<?php echo esc_url(RESTAURANT_CULINARY_LITE_DOCS_PRO); ?>" target="_blank"> <?php esc_html_e('Documentation', 'restaurant-culinary'); ?></a>
                </div>
                <div class="info-link">
                    <a href="<?php echo esc_url(RESTAURANT_CULINARY_BUY_NOW); ?>" target="_blank"> <?php esc_html_e('Upgrade to Pro', 'restaurant-culinary'); ?></a>
                </div>
                <div class="info-link">
                    <a href="<?php echo esc_url(RESTAURANT_CULINARY_DEMO_PRO); ?>" target="_blank"> <?php esc_html_e('Premium Demo', 'restaurant-culinary'); ?></a>
                </div>
            </div>
        </div>
    <?php }
}
add_action('admin_notices', 'restaurant_culinary_notice');


/**
 * Enqueue styles for the help page.
 */
function restaurant_culinary_admin_scripts($hook)
{
  wp_enqueue_style('restaurant-culinary-admin-style', get_template_directory_uri() . '/inc/get-started/get-started.css', array(), '');
}
add_action('admin_enqueue_scripts', 'restaurant_culinary_admin_scripts');

/**
 * Add the theme page
 */
function restaurant_culinary_page(){
$restaurant_culinary_user = wp_get_current_user();
$restaurant_culinary_theme = wp_get_theme();
?>
<div class="das-wrap">
  <div class="restaurant-culinary-panel header">
    <div class="restaurant-culinary-logo">
      <span></span>
      <h2><?php echo esc_html( $restaurant_culinary_theme ); ?></h2>
    </div>
    <p>
      <?php
        $restaurant_culinary_theme = wp_get_theme();
        echo wp_kses_post( apply_filters( 'omega_theme_description', esc_html( $restaurant_culinary_theme->get( 'Description' ) ) ) );
      ?>
    </p>
    <a class="btn btn-primary" href="<?php echo esc_url(admin_url('/customize.php?'));
?>"><?php esc_html_e('Edit With Customizer - Click Here', 'restaurant-culinary'); ?></a>
  </div>

  <div class="das-wrap-inner">
    <div class="das-col das-col-7">
      <div class="restaurant-culinary-panel">
        <div class="restaurant-culinary-panel-content">
          <div class="theme-title">
            <h3><?php esc_html_e('If you are facing any issue with our theme, submit a support ticket here.', 'restaurant-culinary'); ?></h3>
          </div>
          <a href="<?php echo esc_url( RESTAURANT_CULINARY_SUPPORT_FREE ); ?>" target="_blank"
            class="btn btn-secondary"><?php esc_html_e('Lite Theme Support.', 'restaurant-culinary'); ?></a>
        </div>
      </div>
      <div class="restaurant-culinary-panel">
        <div class="restaurant-culinary-panel-content">
          <div class="theme-title">
            <h3><?php esc_html_e('Please write a review if you appreciate the theme.', 'restaurant-culinary'); ?></h3>
          </div>
          <a href="<?php echo esc_url( RESTAURANT_CULINARY_REVIEW_FREE ); ?>" target="_blank"
            class="btn btn-secondary"><?php esc_html_e('Rank this topic.', 'restaurant-culinary'); ?></a>
        </div>
      </div>
       <div class="restaurant-culinary-panel">
        <div class="restaurant-culinary-panel-content">
          <div class="theme-title">
            <h3><?php esc_html_e('Follow our lite theme documentation to set up our lite theme as seen in the screenshot.', 'restaurant-culinary'); ?></h3>
          </div>
          <a href="<?php echo esc_url( RESTAURANT_CULINARY_LITE_DOCS_PRO ); ?>" target="_blank"
            class="btn btn-secondary"><?php esc_html_e('Lite Documentation.', 'restaurant-culinary'); ?></a>
        </div>
      </div>
    </div>
    <div class="das-col das-col-3">
      <div class="upgrade-div">
        <h4>
          <strong>
            <?php esc_html_e('Premium Features Include:', 'restaurant-culinary'); ?>
          </strong>
        </h4>
        <ul>
          <li>
            <?php esc_html_e('One Click Demo Content Importer', 'restaurant-culinary'); ?>
          </li>
          <li>
            <?php esc_html_e('Woocommerce Plugin Compatibility', 'restaurant-culinary'); ?>
          </li>
          <li>
            <?php esc_html_e('Multiple Section for the templates', 'restaurant-culinary'); ?>            
          </li>
          <li>
            <?php esc_html_e('For a better user experience, make the top of your menu sticky.', 'restaurant-culinary'); ?>  
          </li>
        </ul>
        <div class="text-center">
          <a href="<?php echo esc_url( RESTAURANT_CULINARY_BUY_NOW ); ?>" target="_blank"
            class="btn btn-success"><?php esc_html_e('Upgrade Pro $40', 'restaurant-culinary'); ?></a>
        </div>
      </div>
      <div class="restaurant-culinary-panel">
        <div class="restaurant-culinary-panel-content">
          <div class="theme-title">
            <h3><?php esc_html_e('Kindly view the premium themes live demo.', 'restaurant-culinary'); ?></h3>
          </div>
          <a class="btn btn-primary demo" href="<?php echo esc_url( RESTAURANT_CULINARY_DEMO_PRO ); ?>" target="_blank"
            class="btn btn-secondary"><?php esc_html_e('Live Demo.', 'restaurant-culinary'); ?></a>
        </div>
        <div class="restaurant-culinary-panel-content pro-doc">
          <div class="theme-title">
            <h3><?php esc_html_e('Follow our pro theme documentation to set up our premium theme as seen in the screenshot.', 'restaurant-culinary'); ?></h3>
          </div>
          <a href="<?php echo esc_url( RESTAURANT_CULINARY_DOCS_PRO ); ?>" target="_blank"
            class="btn btn-primary demo"><?php esc_html_e('Pro Documentation.', 'restaurant-culinary'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}