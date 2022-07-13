<?php
/**
 * Generic Webcomic list News category posts template part
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php get_header(); ?>

<section id="content" class="cf">
<main>
<h1 class="highlight">News Archive</h1>
<hr>
<?php if(have_posts()): while(have_posts()): the_post(); ?>

<article>
<header>
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<p><time datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_time('H:i:s'); ?>"><?php echo get_the_date(); ?></time></p>
</header>

<div class="entry cf<?php if(in_category($news_cat->term_id)) { echo " news"; } ?>">
<?php the_excerpt(); ?>
</div><!-- .entry -->
</article>

<?php endwhile; ?>
<?php else: ?>
<?php get_404_template(); ?>
<?php endif; ?>

</main>
<?php get_sidebar(); ?>

</section><!-- #content -->

<?php get_footer(); ?>