<?php
/**
 * Generic Webcomic default home page template part
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php get_header(); ?>

<section id="image" class="cf">

<?php
$attachments = array(
	'order' => 'DESC',
    'post_format' => 'post-format-image',
	//'orderby' => 'date',
	//'post_type' => 'attachment',
	'post_status' => 'publish',
	//'numberposts' => -1,
	'posts_per_page' => 1,
	//'post_parent' => $post->ID,
	//'paged' => $paged,
);
query_posts($attachments);
if(have_posts()): while(have_posts()): the_post(); ?>

<figure>
<?php the_post_thumbnail('full'); ?>
</figure>
</section><!-- #image -->

<?php //endwhile; ?>



<nav id="navigation">
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

<?php if(get_next_post(true,'','post_format')): ?>
<li class="keynext"><?php next_post_link('%link', '&rsaquo;'); ?></li>
<?php else: ?>
<li><span>&rsaquo;</span></li>
<?php endif; ?>

<?php if($latest = get_bookend_permalink(false)): ?>
<li><a href="<?php echo $latest; ?>">&raquo;</a></li>
<?php else: ?>
<li><span>&raquo;</span></li>
<?php endif; ?>
</ul>
</nav>



<?php //rewind_posts(); ?>
<?php //while(have_posts()): the_post(); ?>
<section id="content" class="cf">
<main>

<article>
<header>
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
</header>

<div class="entry">
<?php the_content(); ?>
</div><!-- .entry -->

<footer>
<p><?php the_category(); ?></p>
<p><?php the_tags('',', ',''); ?></p>
<p><time datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_time('H:i:s'); ?>"><?php echo get_the_date(); ?></time></p>
</footer>
</article>

<?php endwhile; ?>
<?php else: ?>
<?php get_404_template(); ?>
<?php endif; ?>

</main>
<?php get_sidebar(); ?>

</section><!-- #content -->

<?php get_footer(); ?>