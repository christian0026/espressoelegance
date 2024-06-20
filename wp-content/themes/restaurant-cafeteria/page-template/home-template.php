<?php
/**
 * Template Name: Home Template
 */

get_header(); 

$restaurant_cafeteria_banner_backgroud_image = get_theme_mod('restaurant_cafeteria_banner_background_image');
?>

<main id="skip-content">
  <section id="top-slider" >
    <?php $restaurant_cafeteria_slide_pages = array();
      for ( $restaurant_cafeteria_count = 1; $restaurant_cafeteria_count <= 3; $restaurant_cafeteria_count++ ) {
        $restaurant_cafeteria_mod = intval( get_theme_mod( 'restaurant_cafeteria_top_slider_page' . $restaurant_cafeteria_count ));
        if ( 'page-none-selected' != $restaurant_cafeteria_mod ) {
          $restaurant_cafeteria_slide_pages[] = $restaurant_cafeteria_mod;
        }
      }
      if( !empty($restaurant_cafeteria_slide_pages) ) :
        $restaurant_cafeteria_args = array(
          'post_type' => 'page',
          'post__in' => $restaurant_cafeteria_slide_pages,
          'orderby' => 'post__in'
        );
        $restaurant_cafeteria_query = new WP_Query( $restaurant_cafeteria_args );
        if ( $restaurant_cafeteria_query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $restaurant_cafeteria_query->have_posts() ) : $restaurant_cafeteria_query->the_post(); ?>
        <div class="slide-box">
          <div class="slider-image">
            <?php if(has_post_thumbnail()){
              the_post_thumbnail();
              } else{?>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/image/slider.png" alt="" />
            <?php } ?>
          </div>
          <div class="slider-inner-box">
            <?php if(get_theme_mod('restaurant_cafeteria_slider_short_heading') != ''){ ?>
                <h3 class="short-heading"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_slider_short_heading')); ?></h3>
              <?php }?>
            <h2 class="m-0"><?php the_title(); ?></h2>
            <div class="slide-btn mt-4">
              <a href="<?php the_permalink(); ?>"><?php esc_html_e('EXPLORE','restaurant-cafeteria'); ?></a>
            </div>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
  </section>
  <section class="featured py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-12 about-image align-self-center">
          <?php if(get_theme_mod('restaurant_cafeteria_about_us_left_image') != ''){ ?>
            <img src="<?php echo esc_url( get_theme_mod( 'restaurant_cafeteria_about_us_left_image' )); ?>">
          <?php }?>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-12 align-self-center">
            <div class="about-text-box">
              <?php if(get_theme_mod('restaurant_cafeteria_about_us_image_heading') != ''){ ?>
                <h3 class="image-heading mb-3"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_about_us_image_heading')); ?></h3>
              <?php }?>
              <?php if(get_theme_mod('restaurant_cafeteria_about_us_heading') != ''){ ?>
                <h4 class="main-heading mb-4"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_about_us_heading')); ?></h4>
              <?php }?>
              <?php if(get_theme_mod('restaurant_cafeteria_about_us_content') != ''){ ?>
                <p class="main-heading mb-4"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_about_us_content')); ?></p>
              <?php }?>

              <div class="row">
                <?php for ($i=1; $i <=4 ; $i++) {  ?>
                  <?php if(get_theme_mod('restaurant_cafeteria_about_us_list_heading'.$i) != ''){ ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-4">
                      <h5 class="tick-box"><i class=" <?php echo esc_attr(get_theme_mod('restaurant_cafeteria_about_us_list_icon'.$i,'fas fa-mobile-alt')); ?> me-2"></i><?php echo esc_html(get_theme_mod('restaurant_cafeteria_about_us_list_heading'.$i)); ?></h5>
                    </div>
                  <?php } ?>
                <?php }  ?>
              </div>
              <?php if(get_theme_mod('restaurant_cafeteria_about_us_button_url') != '' || get_theme_mod('restaurant_cafeteria_about_us_button_text') != ''){ ?>
                <div class="about-btn mt-4">
                  <a href="<?php echo esc_url(get_theme_mod('restaurant_cafeteria_about_us_button_url')); ?>"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_about_us_button_text')); ?></a>
                </div>
              <?php } ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 align-self-center text-right">
          <?php if(get_theme_mod('restaurant_cafeteria_about_us_image1') != ''){ ?>
            <img class="about-right-image-1 mb-3" src="<?php echo esc_url( get_theme_mod( 'restaurant_cafeteria_about_us_image1' )); ?>">
          <?php }?>
          <?php if(get_theme_mod('restaurant_cafeteria_about_us_image2') != ''){ ?>
            <img class="about-right-image-2" src="<?php echo esc_url( get_theme_mod( 'restaurant_cafeteria_about_us_image2' )); ?>">
          <?php }?>
        </div>         
      </div>
    </div>
  </section>
  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>