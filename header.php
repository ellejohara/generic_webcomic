<?php
/**
 * Generic Webcomic header template part
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>

<title><?php bloginfo('title'); ?></title>

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width" initial-scale="1">
<meta name="description" content="<?php bloginfo('description'); ?>">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

<?php wp_enqueue_script('jquery'); ?>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="container">
<header id="header">
<?php
if(!get_theme_mod('title_image')) {
    $title_image = get_template_directory_uri() . '/images/title.png';
} else {
    $title_image = get_theme_mod('title_image');
}
?>
<a id="comictitle" href="<?php echo get_home_url(); ?>">
<img src="<?php echo $title_image ?>">
</a>

<nav>
<ul>
<li><a href="<?php echo get_home_url(); ?>">Home</a></li>
<?php $menuitems = array('About','Characters','Gallery','Links'); ?>
<?php foreach($menuitems as $menuitem) : ?>
<?php if($page = get_page_by_title($menuitem)): ?>
<li><a href="<?php echo get_page_link($page->ID); ?>"><?php echo $menuitem; ?></a></li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
</nav>
</header><!-- #header -->
