<?php
/**
 * @package WordPress
 * @subpackage theWorldIn35mm
 */
 
 if (is_home()) {
	$myposts = get_posts('numberposts=1&orderby=ID&order=DESC');
	foreach ($myposts as $post)
		break;
 	$wp_query->is_single = true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="keywords" 		content="theworldin35mm, white, one-column, fixed-width, theme-options, photoblogging" />
	<meta name="description" 	content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />
	
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<style type="text/css" media="screen">@import url( <?php bloginfo('stylesheet_url'); ?> );</style>
	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scriptaculous/prototype.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scriptaculous/effects.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fade.js"></script>

	<link rel="alternate" type="application/rss+xml" 	title="RSS 2.0" 	href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" 				title="RSS .92" 	href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" 	title="Atom 1.0" 	href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php wp_head(); ?>
</head>

<body>
<div id="topborder"></div>

<div id="header">
	<div id="site-title">
		<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>
	</div>
	<div id="menu">
		<ul>
			<li><a href="<?php bloginfo('url'); ?>" title=Homepage">home</a></li>&nbsp;
			<?if(get_opt_or_default('showrand')):?><li><a href="<?php bloginfo('url');?>/?do=random"><?_e('Random',TD);?></a></li>&nbsp;<?endif;?>
			<?php wp_list_pages('title_li=&link_before= &sort_column=menu_order'); ?>
		</ul>
		<!-- <div id="sub-title"></div> //-->
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>

<div id="page"> 
	<div class="wrapper">
<!-- end header -->
