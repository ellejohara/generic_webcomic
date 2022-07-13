<?php
/**
 * Generic Webcomic index page - everything without a template gets this template
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php get_header(); ?>

<section id="gallery" class="cf">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<figure>
<a href="<?php the_permalink(); ?>">
<?php the_post_thumbnail('thumbnail'); ?>
</a>
</figure>

<?php endwhile; ?>
<?php else: ?>
<?php get_404_template(); ?>
<?php endif; ?>

</section><!-- #image -->

<?php get_template_part('navigation'); ?>

<?php get_footer(); ?>