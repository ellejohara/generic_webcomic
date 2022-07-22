<?php
/**
 * Generic Webcomic dedicated Gallery page template
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

<?php
if(have_posts()): while(have_posts()): the_post();
$page_entry = get_the_content();
$page_entry = apply_filters( 'the_content', $page_entry );
$page_entry = str_replace( ']]>', ']]&gt;', $page_entry );
endwhile;
else:
endif;

$attachments = array(
	'order' => 'ASC',
	'orderby' => 'menu_order',
	'post_type' => 'attachment',
	'post_status' => array('publish','draft','inherit'),
	'numberposts' => -1,
	'posts_per_page' => 12,
	'post_parent' => $post->ID,
	'paged' => $paged,
);
query_posts($attachments);
if(have_posts()): while(have_posts()): the_post();
?>

<?php if($page_entry): ?>
<section class="page-entry">
<div class="entry">
<h1 class="highlight">Gallery</h1>
</div><!-- .entry -->
<?php echo $page_entry; ?>
</section>
<?php endif; ?>

<figure>
<a href="<?php the_permalink(); ?>">
<?php echo wp_get_attachment_image($post->ID, 'thumbnail'); ?>
</a>
</figure>

<?php endwhile; ?>
<?php else: ?>
<?php get_404_template(); ?>
<?php endif; ?>

</section><!-- #image -->

<nav id="navigation">
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
</nav>

<?php get_footer(); ?>