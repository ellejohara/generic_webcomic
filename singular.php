<?php
/**
 * Generic Webcomic catchall template for Posts and Pages
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php get_header(); ?>

<?php if(!is_page()): ?>
<section id="image" class="cf">
<?php endif; ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<?php if(!is_page()): ?>
<figure>
<?php the_post_thumbnail('full'); ?>
</figure>
</section><!-- #image -->
<?php endif; ?>

<?php if(!is_page()): ?>
<?php $news_cat = get_category_by_slug('news'); ?>
<?php if(!in_category($news_cat->term_id)): ?>
<?php get_template_part('navigation'); ?>
<?php endif; ?>
<?php endif; ?>

<section id="content" class="cf">
<main>

<article>
<header>
<?php if(is_page()) : ?>
<h1 class="highlight"><?php the_title(); ?></h1>
<?php else: ?>
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php endif; ?>
</header>

<div class="entry cf<?php if(in_category($news_cat->term_id)) { echo " news"; } ?>">
<?php the_content(); ?>
</div><!-- .entry -->

<footer>
<p><?php the_category(); ?></p>
<p><?php the_tags('',', ',''); ?></p>
<?php if(!is_page()): ?>
<p><time datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_time('H:i:s'); ?>"><?php echo get_the_date(); ?></time></p>
<?php endif; //!is_page() ?>
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