/**
 * Generic Webcomic Hide/Show Admin Metaboxes
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */

jQuery(function($) {

	$(document).ready(function(){
	   // hide gallery and image metaboxes by default
       $("#jo-images-metabox").hide();
       $("#postimagediv").hide();
       
		// Show hidden metaboxes on saved posts
        if($("input#post-format-0").is(":checked")){
            $("#jo-images-metabox").hide();
            $("#postimagediv").hide();
        }
        
        if($("input#post-format-aside").is(":checked")){
            $("#jo-images-metabox").hide();
            $("#postimagediv").hide();
        }
        
		if($("input#post-format-gallery").is(":checked")){
            $("#jo-images-metabox").show();
		}
        
        if($("input#post-format-image").is(":checked")){
            $("#postimagediv").show();
		}
        
        if($("input#post-format-aside").is(":checked")){
            $("#tagsdiv-post_tag").hide();
		}
		
		// Show metabox when selecting relevant format
		$("input#post-format-gallery").change(function(){
			if($(this).is(":checked")){
                $("#jo-images-metabox").show();
                $("#postimagediv").hide();
			}
		});
		
		// Hide metabox when selecting other format
		$("input#post-format-0").change(function(){
			if($(this).is(":checked")){
                $("#jo-images-metabox").hide();
                $("#postimagediv").hide();
                $("#tagsdiv-post_tag").hide();
			}
		});
        $("input#post-format-gallery").change(function(){
			if($(this).is(":checked")){
                $("#jo-images-metabox").show();
                $("#postimagediv").hide();
                $("#tagsdiv-post_tag").hide();
			}
		});
		$("input#post-format-image").change(function(){
			if($(this).is(":checked")){
                $("#jo-images-metabox").hide();
                $("#postimagediv").show();
                $("#tagsdiv-post_tag").show();
			}
		});
        $("input#post-format-aside").change(function(){
			if($(this).is(":checked")){
                $("#jo-images-metabox").hide();
                $("#postimagediv").hide();
                $("#tagsdiv-post_tag").hide();
			}
		});
	});
});