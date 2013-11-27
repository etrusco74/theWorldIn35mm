<?php
/*
 * Template Name: About Page
 * Description: Page for creating information about you
 */
get_header();

	if (have_posts()) : while (have_posts()) : the_post();
	?>
	<div id="about-container">
		<?php the_content();?>
	</div> <!-- id=about-container -->
	<?php
	endwhile; endif;

get_footer();

?>
