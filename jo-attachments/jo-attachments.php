<?php
/**
 * Generic Webcomic Attachments Admin Metabox
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php
function jo_images_metabox_enqueue($hook) {
    if('post.php' == $hook || 'post-new.php' == $hook) {
        wp_enqueue_style('jo-images-metabox', get_template_directory_uri().'/jo-attachments/jo-attachments.css');
    }
}
add_action('admin_enqueue_scripts', 'jo_images_metabox_enqueue');

function jo_attached_images_metabox($post_type) {
    $types = array('post', 'page', 'custom-post-type');
    
    if(in_array($post_type, $types)) {
        add_meta_box(
            'jo-images-metabox',
            'Attached Images',
            'jo_populate_metabox',
            $post_type,
            'normal',
            'high',
        );
    }
}
add_action('add_meta_boxes', 'jo_attached_images_metabox');


function jo_populate_metabox($post) {
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_parent' => $post->ID,
        'numberposts' => -1,
    );
    $attachments = get_posts($args);
    
    echo '<ul id="jo-attachments">';
    foreach($attachments as $image) {
        $img_src = wp_get_attachment_image_src($image->ID);
        echo '<li><img src="'.$img_src[0].'"></li>';
    }
    echo '</ul>';
}
?>