<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woodwork
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">


	<link rel="stylesheet" type="text/css" media="all" href="<?php  bloginfo('template_directory');  ?>/css/main.css" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'woodwork' ); ?></a>

	<header id="masthead" class="site-header">

		<div class="container">
			<div class="row">
				<div class="mobile_nav col-4" data-menu="off">
					<a class="menu-toggle" href="javascript:void(0);"><span></span></a>
				</div>

				<div class="header_container col-6">
					<div class="header_logo">
						<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
						<<?php echo $heading_tag; ?> id="site-title">
						<a class="logo" href="<?php echo home_url()?>">
							<span class=""><?php bloginfo('name') ?></span>
						</a>
						</<?php echo $heading_tag; ?>>
					</div>
				</div>
			</div>
		</div>

      	<nav id="site-navigation" class="main-navigation">
			
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
