/**
 * Generic Webcomic CSS Customization
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */

(function($) {

wp.customize.bind('preview-ready', function() {
    wp.customize.preview.bind('update-color-scheme-css', function(css) {
        $('#jo-color-scheme-css').html(css);
    });
});

wp.customize('copyright_credit', function(value) {
    value.bind(function(to) {
        $('#copyright-name').text(to);
    });
});


})(jQuery);