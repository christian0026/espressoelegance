<?php
/**
 * Displays featured image header
 *
 * @package Restaurant Cafeteria
 */
?>

<div class="featured-header-image">
    <img src="<?php the_post_thumbnail_url( 'restaurant-cafeteria-featured-header-image' ); ?>">
    <div class="bg-gradient">
        <header class="entry-header centered">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header>
    </div>
</div>