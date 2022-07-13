<?php
/**
 * Generic Webcomic media attachment template part
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
<section id="image" class="cf">
<figure>
<?php
$alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
echo wp_get_attachment_image($post->ID, 'full', false, array('alt' => $alt));
?>
</figure>
</section><!-- #image -->


<nav id="navigation">
<ul>
<?php if(get_previous_image_link()): ?>
<li class="keyback"><?php previous_image_link(0, '&lsaquo;'); ?></li>
<?php else: ?>
<li><span>&lsaquo;</span></li>
<?php endif; ?>

<?php if(get_next_image_link()): ?>
<li class="keynext"><?php next_image_link(0, '&rsaquo;'); ?></li>
<?php else: ?>
<li><span>&rsaquo;</span></li>
<?php endif; ?>
</ul>
</nav>


<?php
$first_name = $post->post_title;
$full_name = $post->post_excerpt;
$description = $post->post_content;
?>

<section id="content" class="cf">
<main>

<article>
<header>
<h1 class="highlight"><?php the_excerpt(); ?></h1>
</header>

<div class="entry">
<?php the_content(); ?>
<?php
$parent = get_the_title($post->post_parent);
if($parent == 'Characters') :
?>

<?php $slug = get_the_slug(); ?>
<ul>
<li><a href="<?php echo get_home_url(); ?>/tag/<?php echo $slug; ?>">Pages featuring <?php the_title(); ?></a></li>
<li><a href="<?php echo get_character_bookend_permalink($slug); ?>"><?php the_title(); ?>'s First Appearance</a></li>
<li><a href="<?php echo get_character_bookend_permalink($slug, false); ?>"><?php the_title(); ?>'s Latest Appearance</a></li>
<li><a href="<?php echo get_home_url(); ?>/characters/">Return to Characters</a></li>
</ul>

<?php endif; ?>

<?php
$parent = get_the_title($post->post_parent);
if($parent == 'Gallery') :
?>
<p><a href="<?php echo get_home_url(); ?>/gallery/">Return to Gallery</a></p>
<?php endif; ?>

</div><!-- .entry -->

<footer>
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