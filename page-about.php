<?php
/**
 * Generic Webcomic dedicated About page template
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<section id="content" class="cf">
<main>

<article>
<header>
<h1 class="highlight"><?php the_title(); ?></h1>
</header>

<div class="entry cf">
<?php the_content(); ?>
<hr>
<h3 class="highlight">Chapters</h3>
<?php echo jo_list_chapters(); ?>
</div><!-- .entry -->

<footer>
<p><?php the_tags('',', ',''); ?></p>
<p><time datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_time('H:i:s'); ?>"></time></p>
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