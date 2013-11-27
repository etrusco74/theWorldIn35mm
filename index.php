<?php
/**
 * Main index page. 
 * 
 * If we're on the homepage, then we enable all of the AJAX features. If 
 * displaying a single image, then we disable the info panel and previous/next 
 * links, instead displaying the shot info. However the EXIF panel will still
 * load. 
 *
 * If the user has clicked the 'Random' page, then we automatically redirect
 * to a random page. 
 *
 * @package TheWordIn35mm
 */
 
// Code for grabbing a random post from the database if necessary; we then redirect to the page.
if ($_GET['do'] == 'random') {
	$random_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_type = 'post' AND post_password = '' AND post_status = 'publish' ORDER BY RAND() LIMIT 1");
	wp_redirect(get_permalink($random_id));
}

//  header.
get_header();

// Begin post loop.
if (have_posts()) : while (have_posts()) : the_post(); 

	if (is_home() || is_single()) :

		//thumbConfig
		$thumbConfig = array('w='.im_dim(),'q=100');

		// post/image variables
		$id 		= $post->ID;
		$next_post = get_next_post(false) 		? get_next_post(false)->ID : 0;
		$prev_post = get_previous_post(false) 	? get_previous_post(false)->ID : 0;
		
		$next_post_perm = get_permalink($next_post);
		$prev_post_perm = get_permalink($prev_post);

		if (!is_null($image = YapbImage::getInstanceFromDb($id)))
		{
			$w = $post->image->width;
			$h = $post->image->height;

			$src 		= str_replace("&amp;", "&", $image->getThumbnailHref($thumbConfig));
			$w_thumb 	= $image->getThumbnailWidth($thumbConfig);
			$h_thumb 	= $image->getThumbnailHeight($thumbConfig);
		}

	?>

	<script type="text/javascript">
	function fadeCallback() {

		document.getElementById("image-border").style.backgroundImage = "none";

		if (<?php echo($prev_post);?> != 0) {
			document.getElementById("image-nav-prevlink").style.visibility = "visible";
			document.getElementById("image-nav-prevoverlay").style.display = "block";
		}
		if (<?php echo($next_post);?> != 0) {
			document.getElementById("image-nav-nextlink").style.visibility = "visible";
			document.getElementById("image-nav-nextoverlay").style.display = "block";
		}
	}

	window.onload = function() {
		var img = document.getElementById('photo');
		
		img.onload = function(evt) {
			// using custom fader since Effect.Appear() from scriptaculous
			// lacks a few things:
			// (1) callback function to do something when appear effect completes
			// (2) work with visibility style instead of display
			fade(img, 0.5, 10, fadeCallback);
		}
		
		// set img src
		img.src = '<?php echo($src); ?>';
	};

	// clears default value out of comment box
	function clearBox(box) {
		if(box.value == box.defaultValue) {
			box.value = "";
		}
	}
	</script>

<div id="image-container">	
	
	<div id="image-nav-links">
		<div id="image-nav-prevlink" style="visibility: hidden;">
			<a href="<? echo($prev_post_perm); ?>" accesskey="p" title="Previous Photo">&larr; previous</a>
		</div>
		<div id="image-nav-nextlink" style="visibility: hidden;">
			<a href="<? echo($next_post_perm); ?>" accesskey="n" title="Next Photo">next &rarr;</a>
		</div>
		<div class="clear"></div>
	</div>

	<table id="image-table" cellpadding="0" cellspacing="0" border="0" align="center">
		<tbody>
			<tr><td></td><td id="top-tr"></td><td></td></tr>
			<tr id="center-tr">
			<td id="left-td"></td>
			<td id="center-td">
			<div id="image-border">
				<img id="photo" src="<?php bloginfo('template_directory'); ?>/images/blank.gif" alt="<?php the_title() ?>" title="<?php the_title() ?>" style="width:<?=$w_thumb?>px; height:<?=$h_thumb?>px; visibility: hidden;" />
				<div id="image-nav-overlay" style="width:<?=$w_thumb?>px; height:<?=$h_thumb?>px;">
					<a href="<? echo($prev_post_perm); ?>" id="image-nav-prevoverlay" style="display: none;"></a>
					<a href="<? echo($next_post_perm); ?>" id="image-nav-nextoverlay" style="display: none;"></a>
				</div>
			</div>
			</td>
			<td id="right-td"></td>
			</tr>
			<tr><td></td><td id="bottom-tr"></td><td></td></tr>
		</tbody>
	</table>	

	<div id="image-info">
		<div class="image-title"><?php the_title() ?></div>
		<div class="image-comment"><a href="javascript:void(0);" onclick="Effect.toggle('comments-container','blind',{ duration: 0.75 }); return false;">Info + Comments (<?php comments_number(__('No Comments'), __('1 Comment'), __('% Comments')); ?>)</a></div>
		<div class="clear"></div>
		<div class="image-date"><?php the_date('jS F Y');?></div>
		<div class="clear"></div>
	</div>
	
	<div id="comments-container" style="display: none;">
		<div id="image-notes">
			<div id="description">
				<h3>Notes</h3>
				<ul>
					<li><?php the_content(); ?></li>
				</ul>
			</div>
			<div id="exif">
				<h3>EXIF</h3>
				<ul><?php yapb_exif('exiftag', ':', '<strong>', '</strong>', '<i>', '</i>') ?></ul>
			</div>
			<div id="exif">
			<h3>TAG</h3>
				<?php the_tags('<ul><li>','</li><li>','</li></ul>');?>
			</div>	
		</div>
		<div id="image-comments">
			<div id="comments">
				 <?php comments_template(); ?>
			</div>
			<div id="thanks">
				<p>Thanks for visiting. I really appreciate your support and comments!</p>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>	<!-- image-container //-->
	<?php endif;
//debug option
/*
echo("home - " . is_home() . "<br>");
echo("single - " . is_single() . "<br>");
echo("page - " . is_page() . "<br>");
echo("id - " . $id . "<br>");
echo("next - " . $next_post . "<br>");
echo("prev - " . $prev_post . "<br>");
echo("perm - " . $post_perm . "<br>");
echo("next - " . $next_post_perm . "<br>");
echo("prev - " . $prev_post_perm . "<br>");
echo("im_dim - " . im_dim() . "<br>");
echo("w - " . $w . "<br>");
echo("h - " . $h . "<br>");
echo("w-th - " . $w_thumb . "<br>");
echo("h-th - " . $h_thumb . "<br>");
*/
?>
<?php break; endwhile; endif;

get_footer(); ?>
