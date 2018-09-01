<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package woodwork
 */

get_header();
?>

<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php /* Slick Slider using Custom Post Type */ ?>
			<?php query_posts( array('post_type' => 'slider_images', 'orderby' => 'menu_order', 'order' => 'ASC' ,  'post_status'=>'publish'  )); ?>
			<div class="slickslider">
				<ul class="slides">
					<?php if(have_posts()): while (have_posts()) : the_post(); ?>
						<?php if ( has_post_thumbnail() ): ?>
							<?php
							$custom = get_post_custom(get_the_ID());  
							$link =  $custom["link1"][0]; ?> 
							<?php if ( has_post_thumbnail()) : ?>      
								<li class="slide" style="background: url( <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); //echo $img[0]; ?>) " >
									<img src="<?php echo $img[0]; ?>">
									
								</li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endwhile; endif;?>
				</ul>
			</div>
			<?php wp_reset_query(); ?>

			<div class="icon">
				<i class="fas fa-pencil"></i>


			</div>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
