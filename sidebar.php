<?php
/**
 * Generic Webcomic sidebar template part
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<section id="sidebar">

<section class="sidebarsection">
<h4>Latest News</h4>
<hr>
<?php
$query = array(
	'order' => 'DESC',
	'post_status' => array('publish', 'draft', 'inherit'),
	'posts_per_page' => 1,
    'category_name' => 'news'
);
query_posts($query);
if(have_posts()): while(have_posts()): the_post();
?>


<header>
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<p><time datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_time('H:i:s'); ?>"><?php echo get_the_date(); ?></time></p>
</header>

<div class="entry">
<?php the_excerpt(); ?>
</div><!-- .entry -->

<?php endwhile; ?>
<?php else: ?>
<p>No current news!</p>
<?php endif; ?>
</section><!-- .sidebarsection -->


<?php
$navloc = get_nav_menu_locations();
if($navloc) :
    $navobj = wp_get_nav_menu_object($navloc['sidebar-menu']);

$args = array(
    'name' => 'sidebar',
    'container' => '',
    'fallback_cb' => false
);
?>
<section class="sidebarsection">

<h4><?php echo $navobj->name; ?></h4>
<hr>
<?php wp_nav_menu($args); ?>
</section><!-- .sidebarsection -->
<?php endif; ?>

</section><!-- #sidebar -->