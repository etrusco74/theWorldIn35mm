<?php
/**
 * @package WordPress
 * @subpackage theWorldIn35mm
 */
?>
	</div> <!-- id=wrapper -->
</div> <!-- id=page -->
<?php
$copy = get_opt_or_default('copyright');
$year = ($yeartmp = get_opt_or_default('copyright_year')) ? $yeartmp : date('Y');
?>
<div id="footer">
Powered by <a href="http://wordpress.org/">WordPress</a> and <a href="http://johannes.jarolim.com/yapb/">YAPB</a><br />
Based on the original template <a href="http://www.theworldin35mm.org/">theWorldIn35mm</a> for <a href="http://www.pixelpost.org/">pixelpost</a> rewrite for wordpress by <a href="http://www.pensando.it/">Etrusco</a> <br />
<a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> - <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>.<br />
<?php if ($copy):?>&copy; <?=$copy?> <?=$year?>.<?php endif;?>
</div> <!-- id=footer -->
<?php wp_footer(); ?>
</body>
</html>