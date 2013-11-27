<?php
/*
 * Template Name: Mosaic Page
 * Description: Page for creating mosaic of all images posted on the site.
 */

get_header();

if (have_posts()) : while (have_posts()) : the_post();

?>
<div id="browse-container">
	
	<div id="category-container">
		<h3>Categories</h3>
		<ul><?php wp_list_categories('orderby=name&show_count=1&title_li='); ?></ul>	
		<h3>Archives</h3>
		<ul><?php wp_get_archives('type=monthly&show_post_count=1'); ?> </ul>
		<?php if ( function_exists('wp_tag_cloud') ) : ?>
		<h3>Tags</h3>
		<ul><?php wp_tag_cloud('smallest=8&largest=16&number=10'); ?></ul>
		<?php endif; ?>
	</div>
	
	<div id="thumbnail-container">
	<?php
	$posts = get_posts('numberposts=-1&order=DESC');
	$postyear = 0;
	foreach ($posts as $post) { 	
		echo '<a href="'.get_permalink($post->ID).'">';
		echo '<img class="thumbnails" src="'.square_thumb($post->ID).'" alt="thumb" />';
		echo '</a>';
	} ?>
	</div>
	
</div>
<?
endwhile; endif;

get_footer();

?>
