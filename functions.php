<?php
/**
 * Generic Webcomic functions
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */

// admin javascript faff
function jo_post_format_metabox_selection($hook) {
    if('post.php' == $hook || 'post-new.php' == $hook) {
        wp_enqueue_script(
            'jo_post_format_metabox_js',
            get_template_directory_uri().'/js/post-format-metabox.js'
        );
    }
}
add_action('admin_enqueue_scripts', 'jo_post_format_metabox_selection');

// if news post, set format to 'aside' automatically
function jo_set_news_aside($postID) {
    if(has_post_format('aside', $postID) || !has_term('news', 'category', $postID)) {
        return;
    }
    set_post_format($postID, 'aside');
}
add_action('save_post', 'jo_set_news_aside');


// register custom main menu
function jo_custom_menu() {
    register_nav_menu('sidebar-menu', __('Sidebar Menu'));
}
add_action('init', 'jo_custom_menu');


/* Get Rid Of The Block Editor */
add_filter('use_block_editor_for_post','__return_false',10);

/* Use the Text Editor Only */
add_filter('user_can_richedit', '__return_false', 50);

/* Hide Text Editor Quick Tag Buttons */
function jo_remove_quicktags($qtInit) {
    $qtInit['buttons'] = 'strong,em,link,block,ul,ol,li,close';
    return $qtInit;
}
add_filter('quicktags_settings', 'jo_remove_quicktags');

/* Post Thumbnails */
add_theme_support('post-thumbnails');

/* Link Manager */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/* Image Sizes */
update_option('thumbnail_size_w', 600);
update_option('thumbnail_size_h', 600);
/* DO NOT GENERATE MEDIUM OR LARGE SIZES */
update_option('thumbnail_crop', 0);
update_option('medium_size_w', 0);
update_option('medium_size_h', 0);
update_option('large_size_w', 0);
update_option('large_size_h', 0);
/* DO NOT ORGANIZE BY YEAR/MONTH */
update_option('uploads_use_yearmonth_folders', 0);

/* Disable Wordpress medium_large Image Size */
function jo_customize_image_sizes($sizes) {
	unset($sizes['medium_large']); // 768px
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'jo_customize_image_sizes');
add_filter('max_srcset_image_width', create_function('', 'return 1;'));

/* Remove inline thumbnail image sizes */
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

/* Remove Excess Media Options */
function jo_media_view_strings($strings) {
    $strings['createGalleryTitle'] = '';
    $strings['createPlaylistTitle'] = '';
    $strings['createVideoPlaylistTitle'] = '';
    $strings['setFeaturedImageTitle'] = '';
    $strings['insertFromUrlTitle'] = '';
    return $strings;
}
add_filter('media_view_strings', 'jo_media_view_strings');

function jo_post_mime_types($strings) {
    unset($strings['audio']);
    unset($strings['video']);
    unset($strings['document']);
    unset($strings['spreadsheet']);
    unset($strings['archive']);
    return $strings;
}
add_filter('post_mime_types', 'jo_post_mime_types');

/* In order to unset 'document', 'spreadsheet', and 'archive', you also have to do this: */
function jo_ext2type() {
    unset($strings['document']);
    unset($strings['spreadsheet']);
    unset($strings['archive']);
}
add_filter('ext2type', 'jo_ext2type');

/* Set Defaults for Attached Images and hide the Attachment Display Settings section */
function jo_reset_image_settings() {
    ?>
    
    <style type="text/css">
        div.attachment-display-settings { display: none; }
    </style>
    
    <script type="text/javascript">
        if(typeof setUserSetting !== 'undefined') {
            setUserSetting('align', 'none');
            setUserSetting('urlbutton', 'none');
            setUserSetting('imgsize', 'thumbnail');
        }
    </script>
    
    <?php
}
add_action('admin_head-post.php', 'jo_reset_image_settings');
add_action('admin_head-post-new.php', 'jo_reset_image_settings');

/* Post Slug */
function the_slug() {
	$post_data = get_post($post->ID, ARRAY_A);
	$slug = $post_data['post_name'];
	echo $slug;
}
function get_the_slug() {
	$post_data = get_post($post->ID, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug;
}

/* Post Formats */
add_theme_support('post-formats', array('gallery','image','aside'));
add_post_type_support('page', 'post-formats', array('gallery','image')); // Enable post formats on pages


/* Get First or Last Page */
function get_bookend_permalink($sort = true) {
    $sort = $sort ? 'ASC' : 'DESC';
    $cat_reject = get_cat_id('news');
    global $post;
	$args = array(
		'numberposts'     => 1,
		'offset'          => 0,
		'orderby'         => 'post_date',
		'order'           => $sort,
		'post_status'     => 'publish',
        'cat'             => -$cat_reject
    );
	$posts = get_posts( $args );
    if($posts[0]->ID == $post->ID) {
        return;
    } else {
        $permalink = get_permalink($posts[0]->ID);
        return $permalink;
    }
}

/* Get Character First or Most Recent Appearance */
function get_character_bookend_permalink($character, $sort = true) {
    $sort = $sort ? 'ASC' : 'DESC';
    global $post;
	$args = array(
		'numberposts'     => 1,
		'offset'          => 0,
		'orderby'         => 'post_date',
		'order'           => $sort,
		'post_status'     => 'publish',
        'tag'            => $character
    );
	$posts = get_posts( $args );
    if($posts[0]->ID == $post->ID) {
        return;
    } else {
        $permalink = get_permalink($posts[0]->ID);
        return $permalink;
    }
}

/* List Chapter Titles with Links and Don't Include News Category */
function jo_list_chapters() {
    $cat_news = get_category_by_slug('news');
    if($cat_news) {
        $cat_news_id = $cat_news->term_id;
    }
    $args = array(
        'order' => 'ASC',
        'orderby' => 'slug',
        'exclude' => $cat_news_id,
        'parent' => 0,
    );
    $the_categories = get_categories($args);

    $output = "<ol>\n";
    foreach($the_categories as $category) :
        $args = array(
            'order' => 'ASC',
            'cat' => $category->term_id,
        );
        $query = new WP_Query($args);
        $posts = $query->posts;
        $post_ID = $posts[0]->ID;
        $permalink = get_permalink($post_ID);
        $output .= '<li><a href="' . $permalink . '">' . $category->name . '</a></li>' . "\n";
    endforeach;
    $output .= "</ol>\n";

    return $output;
}



/* THEME CUSTOMIZER API STUFF */
require_once('jo-customize/jo-customize.php');

/* Attachments Metabox */
require_once('jo-attachments/jo-attachments.php');
?>