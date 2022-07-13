/**
 * Generic Webcomic CSS Customization
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */

(function(api) {
var cssTemplate = wp.template('jo-color-scheme'),
    colorSettings = [
        'background_color',
        'text_color',
        'highlight_color',
        'link_color',
        'link_hover',
        'link_active'
    ];

function updateColors(scheme) {
    scheme = scheme || 'default';
    var colors = colorScheme[scheme].colors;
    _.each(colorSettings, function(key, index) {
        var color = colors[index];
        api(key).set(color);
        api.control(key).container.find('.color-picker-hex')
            .data('data-default-color', color)
            .wpColorPicker('defaultColor', color);
    });
}

api.controlConstructor.select = api.Control.extend({
    ready: function() {
        if('color_scheme' === this.id) {
            this.setting.bind('change', updateColors);
        }
    }
});

function updateCSS() {
    var scheme = api('color_scheme')(), css,
        colors = _.object(colorSettings, colorScheme[scheme].colors);
    
    _.each(colorSettings, function(setting) {
        colors[setting] = api(setting)();
    });
    
    css = cssTemplate(colors);
    
    api.previewer.send('update-color-scheme-css', css);
}

_.each(colorSettings, function(setting) {
    api(setting, function(setting) {
        setting.bind(updateCSS);
    });
});
})(wp.customize);