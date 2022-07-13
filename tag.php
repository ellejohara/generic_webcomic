<?php
/**
 * Generic Webcomic tag template part
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php get_header(); ?>

<section id="content">
<main>
<article>
<header>
<?php
$tag = single_tag_title('', false);
$name = ucfirst($tag); // Capitalize the name
// check to see if character profile page exists
$character_path = '/characters/'.$tag.'/';
$character_page = get_page_by_path($character_path);
?>

<?php if($character_page) : ?>
<h1 class="highlight">Pages featuring <a href="<?php echo get_home_url() . $character_path; ?>"><?php echo $name; ?></a></h1>
<?php else: ?>
<h1 class="highlight">Pages featuring <?php echo $name; ?></h1>
<?php endif; ?>

</header>
</article>
</main>
</section><!-- #content -->
<section id="gallery" class="cf">
<?php query_posts($query_string .'&order=ASC'); ?>
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