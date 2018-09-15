<?php /* Template Name: Contact */ ?>

<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package woodwork
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="contact-page">


				<div class="banner" style="background-image: url( <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $img[0]; ?>) ">
					<div class="title">
						<h1><?php the_title(); ?></h1>
					</div>
				</div>

				<div class="contact-content">
					<div class="container">
						<h3><?php the_field('contact_heading');?></h3>
						<div class="content">
							<?php the_field('contact_content');?>
						</div>
					</div>
				</div>

				<div class="contact-form">
					<div class="container">
						<div class="form">
							<?php the_field('contact_form');?>
						</div>
					</div>
				</div>





				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
