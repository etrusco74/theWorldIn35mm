<?php 
/*
 * Template Name: Archive
 * Description: Hack for creating mosaic of all images posted on the site.
 */
 
get_header(); 

if (have_posts()) : ?>

<div id="browse-container">

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
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
	while (have_posts()) : the_post();	
		$id = $post->ID;
		echo '<a href="'.get_permalink($id).'">';
		echo '<img class="thumbnails" src="'.square_thumb($id).'" alt="thumb" />';
		echo '</a>';
	endwhile; 
?>
	</div>
</div>
<?php 
	else :
		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>".__("Sorry, but there aren't any posts in the %s category yet.", 'kubrick').'</h2>', single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo('<h2>'.__("Sorry, but there aren't any posts with this date.", 'kubrick').'</h2>');
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>".__("Sorry, but there aren't any posts by %s yet.", 'kubrick')."</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>".__('No posts found.', 'kubrick').'</h2>');
		}
	  get_search_form();
	endif;

get_footer(); 
?>
