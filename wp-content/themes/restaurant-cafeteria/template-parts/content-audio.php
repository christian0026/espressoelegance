<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restaurant Cafeteria
 */
?>

<?php
  $restaurant_cafeteria_content = apply_filters( 'the_content', get_the_content() );
  $restaurant_cafeteria_audio = false;

  // Only get audio from the content if a playlist isn't present.
  if ( false === strpos( $restaurant_cafeteria_content, 'wp-playlist-script' ) ) {
    $restaurant_cafeteria_audio = get_media_embedded_in_content( $restaurant_cafeteria_content, array( 'audio' ) );
  }
?>

  <div class="col-lg-6 col-md-6 col-sm-6">
    <article id="post-<?php the_ID(); ?>" <?php post_class('article-box'); ?>>
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the audio file.
          if ( ! empty( $restaurant_cafeteria_audio ) ) {
            foreach ( $restaurant_cafeteria_audio as $restaurant_cafeteria_audio_html ) {
              echo '<div class="entry-audio">';
                echo $restaurant_cafeteria_audio_html;
              echo '</div><!-- .entry-audio -->';
            }
          };
        };
      ?>
      <div class="serv-cont">
        <div class="meta-info-box my-2">
          <span class="entry-author"><?php esc_html_e('BY','restaurant-cafeteria'); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
          <span class="ms-2"><?php echo esc_html(get_the_date()); ?></span>
        </div>
        <div class="post-summery">
          <?php the_title('<h3 class="entry-title pb-3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>');?>
          <p><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
          <a href="<?php the_permalink(); ?>" class="btn-text"><?php esc_html_e('Read More','restaurant-cafeteria'); ?></a>
        </div>
      </div>
    </article>
  </div>