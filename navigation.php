<?php
/**
 * Generic Webcomic navigation template - note: not all navigation is on this template
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<nav id="navigation">
<?php if(is_archive()) : ?>

<ul>
<?php if(get_previous_posts_link()): ?>
<li class="keyback"><?php previous_posts_link('&lsaquo;'); ?></li>
<?php else: ?>
<li><span>&lsaquo;</span></li>
<?php endif; ?>

<?php if(get_next_posts_link()): ?>
<li class="keynext"><?php next_posts_link('&rsaquo;'); ?></li>
<?php else: ?>
<li><span>&rsaquo;</span></li>
<?php endif; ?>
</ul>
<?php endif; ?>






<?php if(is_single()): ?>

<ul>
<?php if($first = get_bookend_permalink()): ?>
<li><a href="<?php echo $first; ?>">&laquo;</a></li>
<?php else: ?>
<li><span>&laquo;</span></li>
<?php endif; ?>

<?php if(get_previous_post(true,'','post_format')): ?>
<li class="keyback"><?php previous_post_link('%link', '&lsaquo;'); ?></li>
<?php else: ?>
<li><span>&lsaquo;</span></li>
<?php endif; ?>

<?php
// additional code to determine if next page is most recent page
// if so, go to home page instead of single page
$next = get_next_post(true,'','post_format');
$latest = get_bookend_permalink(false);
$l_id = url_to_postid($latest);

$next_is_home =  $next->ID == $l_id ? true : false;
?>

<?php if($next): ?>
<?php if($next_is_home): ?>
<li class="keynext"><a href="<?php echo get_home_url(); ?>">&rsaquo;</a></li>
<?php else: ?>
<li class="keynext"><?php next_post_link('%link', '&rsaquo;'); ?></li>
<?php endif; ?>
<?php else: ?>
<li><span>&rsaquo;</span></li>
<?php endif; ?>

<?php if($latest = get_bookend_permalink(false)): ?>
<li><a href="<?php echo get_home_url(); ?>">&raquo;</a></li>
<?php else: ?>
<li><span>&raquo;</span></li>
<?php endif; ?>
</ul>
<?php endif; ?>

</nav><!-- #navigation -->