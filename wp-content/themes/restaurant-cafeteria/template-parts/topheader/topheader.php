<?php
/**
 * Displays top header
 *
 * @package Restaurant Cafeteria
 */
?>

<div class="top-info text-end">
	<div class="container">
		<div class="header-box">
			<?php get_template_part('template-parts/navigation/nav'); ?>
		</div>
		<!-- <div class="row">
			<div class="col-lg-7 col-md-6 col-sm-4 align-self-center text-start">
				<?php if ( get_theme_mod('restaurant_cafeteria_topbar_text') != "" ) {?>
					<p class="tobar-text m-0"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_topbar_text')); ?></p> 
				<?php }?>
			</div>
			<div class="col-lg-5 col-md-6 col-sm-8 align-self-center">
				<div class="row">
					<div class="col-lg-8 col-md-7 col-sm-12 align-self-center">
						<?php if ( get_theme_mod('restaurant_cafeteria_topbar_mail_text') != "" ) {?>
					        <div class=" text-center text-lg-end py-2">
					            <p class="location m-0"><i class="fas fa-envelope me-2"></i><a href="mailto:<?php echo esc_attr(get_theme_mod('restaurant_cafeteria_topbar_mail_text')); ?>"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_topbar_mail_text')); ?></a></p>  
					        </div>
				        <?php }?>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-12 align-self-center">
						<?php if ( get_theme_mod('restaurant_cafeteria_topbar_phone_text') != "" ) {?>
					        <div class=" text-center text-lg-end py-2">
					            <p class="location m-0"><i class="fas fa-phone-volume me-2"></i><a href="tell:<?php echo esc_attr(get_theme_mod('restaurant_cafeteria_topbar_phone_text')); ?>"><?php echo esc_html(get_theme_mod('restaurant_cafeteria_topbar_phone_text')); ?></a></p>  
					        </div>
				        <?php }?>
					</div>
				</div>
			</div>
		</div> -->
	</div>
</div>