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


			<section class="services">
				<div class="container">
					<div class="section-title">
						<h2>
							<?php the_field('services_title'); ?>
						</h2>
					</div>
					<div class="row">
						<div class="col-12 col-lg-4 service">
							<h3 class="title">
								<?php the_field('services_1_title'); ?>
							</h3>
							<div class="content">
								<?php the_field('service_1'); ?>
							</div>
						</div>

						<div class="col-12 col-lg-4 service">
							<h3 class="title">
								<?php the_field('services_2_title'); ?>
							</h3>
							<div class="content">
								<?php the_field('service_2'); ?>
							</div>
						</div>

						<div class="col-12 col-lg-4 service">
							<h3 class="title">
								<?php the_field('services_3_title'); ?>
							</h3>
							<div class="content">
								<?php the_field('service_3'); ?>
							</div>
						</div>

					</div>
				</div>
			</section>

			<section class="showcase">

				<?php for($x=1; $x<=3 ; $x++) { ?>
				<div class="container-fluid p-0">
					<div class="row no-gutters">

						<?php $blockContent = get_field('block_'.$x.''); ?>
						<?php $blockTitle = get_field('block_title_'.$x.''); ?>
						<?php $blockImg = get_field('block_image_'.$x.''); ?>
						<?php $var = ($x % 2); ?>
						<?php $y = ( $var == 0 ? 2 : 0);  ?>


						<div class="col-lg-6 order-lg-<?php echo $y; ?> showcase-img" style="background-image:url('<?php echo $blockImg['url']; ?>');">
						</div>
						<div class="col-lg-6 order-lg-1 block-flex">
							<div class="showcase-text">
								<div class="titile">
									<?php echo $blockTitle; ?>
								</div>
								<div class="content">
									<?php echo $blockContent; ?>
								</div>
							</div>
						</div>

					


					</div>
				</div>

				<?php }; ?>
			</section>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
