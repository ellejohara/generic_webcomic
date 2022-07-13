/**
 * Generic Webcomic Keyboard Navigation
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */

jQuery(document).ready(function () {
	jQuery(document).keydown(function(e) {
		var url = false;
		if (e.which == 37) {  // Left arrow key code
			url = jQuery('.keyback a').attr('href');
		}
        else if (e.which == 39) {  // Right arrow key code
			url = jQuery('.keynext a').attr('href');
		}
		if (url) {
			window.location = url;
		}
	});
});