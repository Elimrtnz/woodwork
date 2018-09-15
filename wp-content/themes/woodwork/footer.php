<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woodwork
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="copyright">
	      &copy;<?php echo date('Y') . " " . get_bloginfo('name').": Ralphs Custom Cabinets and Woodwork"; ?> 
	      <p><a href="http://www.yoursite.com/" target="_blank" rel="nofollow">Los Angeles Website Design by Elias Martinez</a></p>
    	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
