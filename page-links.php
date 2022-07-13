<?php
/**
 * Generic Webcomic dedicated Links page template
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
<?php if(have_posts()): while(have_posts()): the_post(); ?>

<article>
<header>
<h1 class="highlight"><?php the_title(); ?></h1>
</header>

<div class="entry">
<time datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_time('H:i:s'); ?>"></time>
<?php the_content(); ?>
</div><!-- .entry -->
<hr>
<div class="bookmarks">
<?php
// this gets the link category ID, name, and description
$cats = get_terms('link_category');
foreach($cats as $cat) {
    $term_id = apply_filters('link_category', $cat->term_id);
    $term_ids[] = $term_id;
    $category[$term_id]['name'] = apply_filters('link_category', $cat->name);
    $category[$term_id]['description'] = apply_filters('link_category', $cat->description);
}
//pre($category);

echo '<ul>';
foreach($term_ids as $term_id) {
    $bookmarks = get_bookmarks(array('category' => $term_id));
    echo '<li>';
    echo '<h2 class="highlight">'. $category[$term_id]['name'] . '</h2>';
    echo '<p>' . $category[$term_id]['description'] . '</p>';
    echo '</li>';
    echo '<li>';
    echo '<ul>';
    foreach($bookmarks as $bookmark) {
        $link_url = apply_filters('bookmark', $bookmark->link_url);
        $link_name = apply_filters('bookmark', $bookmark->link_name);
        $link_image = apply_filters('bookmark', $bookmark->link_image);
        $link_target = apply_filters('bookmark', $bookmark->link_target);
        $link_description = apply_filters('bookmark', $bookmark->link_description);
        $link_visible = apply_filters('bookmark', $bookmark->link_visible);
        
        if($link_visible) {
            echo '<li>';
            if($link_image) {
                echo '<a href="'.$link_url.'">';
                echo '<img src="'.$link_image.'">';
                echo '</a>';
            }
            echo '<h3><a href="'.$link_url.'" target="'.$link_target.'">'.$link_name.'</a></h3>';
            echo '<p>'.$link_description.'</p>';
            echo '</li>';
        }
    }
    echo '</ul>';
    echo '</li>';
}
echo '</ul>'
?>
</div><!-- .bookmarks -->

</article>

<?php endwhile; ?>
<?php else: ?>
<?php get_404_template(); ?>
<?php endif; ?>

</main>
<?php get_sidebar(); ?>

</section><!-- #content -->

<?php get_footer(); ?>