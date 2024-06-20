<?php
/**
 * Displays main header
 *
 * @package Restaurant Cafeteria
 */
?>

<div class="main-header text-center text-md-start text-lg-start">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-4 col-sm-6 col-12 logo-box align-self-center">
                <div class="navbar-brand ">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $restaurant_cafeteria_blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $restaurant_cafeteria_blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                                <?php if( get_theme_mod('restaurant_cafeteria_logo_title_text',true) != ''){ ?>
                                    <h1 class="site-title py-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php } ?>
                            <?php else : ?>
                                <?php if( get_theme_mod('restaurant_cafeteria_logo_title_text',true) != ''){ ?>
                                    <p class="site-title "><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                <?php } ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $restaurant_cafeteria_description = get_bloginfo( 'description', 'display' );
                            if ( $restaurant_cafeteria_description || is_customize_preview() ) :
                        ?>
                        <?php if( get_theme_mod('restaurant_cafeteria_theme_description',false) != ''){ ?>
                            <p class="site-description pb-2"><?php echo esc_html($restaurant_cafeteria_description); ?></p>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 align-self-center">
                <?php if ( get_theme_mod('restaurant_cafeteria_topbar_phone_text') != "" ) {?>
                    <div class=" text-center text-lg-end py-2">
                        <p class="location m-0"><i class="fas fa-phone-volume me-2"></i><a href="tell:<?php echo esc_attr(get_theme_mod('restaurant_cafeteria_topbar_phone_text')); ?>"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_topbar_phone_text')); ?></a></p>  
                    </div>
                <?php }?>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 align-self-center buttons-head">
                <?php if(get_theme_mod('restaurant_cafeteria_header_button_url_1') != '' || get_theme_mod('restaurant_cafeteria_header_button_text_1') != ''){ ?>
                    <span class="head-btn">
                        <a href="<?php echo esc_url(get_theme_mod('restaurant_cafeteria_header_button_url_1')); ?>"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_header_button_text_1')); ?></a>
                    </span>
                <?php } ?>
                <?php if(get_theme_mod('restaurant_cafeteria_header_button_url_2') != '' || get_theme_mod('restaurant_cafeteria_header_button_text_2') != ''){ ?>
                    <span class="head-btn">
                        <a href="<?php echo esc_url(get_theme_mod('restaurant_cafeteria_header_button_url_2')); ?>"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_header_button_text_2')); ?></a>
                    </span>
                <?php } ?>
                <?php if(get_theme_mod('restaurant_cafeteria_header_button_url_3') != '' || get_theme_mod('restaurant_cafeteria_header_button_text_3') != ''){ ?>
                    <span class="head-btn">
                        <a href="<?php echo esc_url(get_theme_mod('restaurant_cafeteria_header_button_url_3')); ?>"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_header_button_text_3')); ?></a>
                    </span>
                <?php } ?>
                <?php if(get_theme_mod('restaurant_cafeteria_header_search_setting',false) != ''){ ?>
                    <span class="head-search">
                        <div class="header-search-wrapper">
                            <span class="search-main">
                                <i class="fa fa-search"></i>
                            </span>
                            <div class="search-form-main clearfix">
                                <form method="get" class="search-form">
                                  <label>
                                    <input type="search" class="search-field form-control" placeholder="Search …" value="" name="s">
                                  </label>
                                  <input type="submit" class="search-submit btn btn-primary mt-3" value="Search">
                                </form>
                            </div>
                        </div>
                    </span>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
