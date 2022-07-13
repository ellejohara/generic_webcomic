<?php
/**
 * Generic Webcomic Admin CSS Theme Customization
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php
function jo_customize_register($wp_customize) {
    $wp_customize->add_section('jo_colors', array(
        'title' => 'Colors',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('color_scheme', array(
		'default' => 'default',
		'transport' => 'refresh',
	));
    
	$color_schemes = jo_get_scheme_presets();
    
	$choices = array();
    foreach($color_schemes as $scheme => $value) {
		$choices[$scheme] = $value['label'];
	}
    
    $wp_customize->add_control('color_scheme', array(
		'label' => 'Color Scheme',
		'section' => 'jo_colors',
		'type' => 'select',
		'choices' => $choices,
	));
    
    $elements = jo_get_elements();
    $the_schemes = jo_get_scheme_presets();
    $i = 0;
    
    foreach($elements as $key => $label) {
		$wp_customize->add_setting($key, array(
			'transport' => 'refresh',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $key, array(
			'label' => $label,
			'section' => 'jo_colors',
            'settings' => $key,
		)));
        $i++;
	}
    
    $wp_customize->add_section('jo_header', array(
        'title' => 'Header',
        'priority' => 10,
    ));
    
    $wp_customize->add_setting('title_image', array(
        'default' => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'title_image', array(
        'label' => 'Webcomic Title Image',
        'section' => 'jo_header',
    )));
    
    $wp_customize->add_setting('title_align', array(
        'default' => 'left',
        'transport' => 'refresh',
    ));
    
    $alignments = array(
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    );
    
    $wp_customize->add_control('title_align', array(
        'label' => 'Title Image Alignment',
        'section' => 'jo_header',
        'type' => 'select',
        'choices' => $alignments,
    ));
    
    $wp_customize->add_setting('header_bg', array(
        'default' => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_bg', array(
        'label' => 'Header Background Image',
        'section' => 'jo_header',
    )));
    
    $wp_customize->add_setting('header_height', array(
        'default' => 30,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('header_height', array(
        'type' => 'range',
        'section' => 'jo_header',
        'label' => 'Header Height',
        'input_attrs' => array(
            'min' => 10,
            'max' => 30,
            'step' => 1,
        ),
    ));
    
    $wp_customize->add_setting('menu_align', array(
        'default' => 'flex-start',
        'transport' => 'refresh',
    ));
    
    $menualigns = array(
        'flex-start' => 'Left',
        'center' => 'Center',
        'space-between' => 'Justify',
        'flex-end' => 'Right',
    );
    
    $wp_customize->add_control('menu_align', array(
        'label' => 'Main Menu Alignment',
        'section' => 'jo_header',
        'type' => 'select',
        'choices' => $menualigns,
    ));
    
    
    
    $wp_customize->add_section('jo_footer', array(
        'title' => 'Footer',
        'priority' => 170,
    ));
    
    $wp_customize->add_setting('copyright_credit', array(
		'default' => get_bloginfo('name'),
		'transport' => 'postMessage',
	));
    
    $wp_customize->add_control('copyright_credit', array(
		'label' => 'Copyright Credit',
		'section' => 'jo_footer',
		'type' => 'text',
	));
    
    $wp_customize->add_setting('theme_credit', array(
		'default' => 1,
		'transport' => 'refresh',
	));
    
    $wp_customize->add_control('theme_credit', array(
		'label' => 'Generic Webcomic Theme Credit',
		'section' => 'jo_footer',
		'type' => 'checkbox',
	));
    
    $wp_customize->add_setting('footer_align', array(
        'default' => 'left',
        'transport' => 'refresh',
    ));
    
    $footeralign = array(
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    );
    
    $wp_customize->add_control('footer_align', array(
        'label' => 'Footer Text Alignment',
        'section' => 'jo_footer',
        'type' => 'select',
        'choices' => $footeralign,
    ));
    
    
    $wp_customize->remove_section('title_tagline');
    $wp_customize->remove_section('static_front_page');
    $wp_customize->remove_section('custom_css');
    
}
add_action('customize_register', 'jo_customize_register');

function jo_get_elements() {
    // the html elements to style
    $elements = array(
        'background_color' => 'Background Color',
        'text_color' => 'Text Color',
        'highlight_color' => 'Highlight Color',
        'link_color' => 'Link Color',
        'link_hover' => 'Link Hover Color',
        'link_active' => 'Link Active Color',
    );
    
    return $elements;
}

// array of color palettes into themes
function jo_get_scheme_presets() {
	$schemes = array(
		'default' => array(
			'label' => 'Default',
			'colors' => array (
				'fafaf8',
				'444444',
				'66cc00',
				'0066cc',
				'cc0000',
				'6600cc',
			),
		),
		'strangeandunusual' => array(
			'label' => 'Strange and Unusual',
			'colors' => array(
				'161413',
				'b2aea4',
				'9030ff',
				'ba0000',
				'9d86a5',
				'490042',
			),
		),
		'darkroast' => array(
			'label' => 'Dark Roast',
			'colors' => array(
				'332200',
				'ffcc99',
				'996600',
				'ff9933',
				'ff6600',
				'663300',
			),
		),
        'blackcherry' => array(
            'label' => 'Black Cherry',
            'colors' => array(
                '4f0000',
                'ffcccc',
                'ff7272',
                'ff0000',
                'ff7272',
                '280000',
            ),
        ),
        'mangosorbetto' => array(
            'label' => 'Mango Sorbetto',
            'colors' => array(
                'e8c56d',
                '2c6300',
                'fffabf',
                'cc3204',
                '843812',
                'd37b00',
            ),
        ),
        'citrussalad' => array(
            'label' => 'Citrus Salad',
            'colors' => array(
                'fffabc',
                '2d8709',
                'ff2d9d',
                'dd4504',
                '8ed817',
                'e8a600',
            ),
        ),
        'gaulofboy' => array(
            'label' => 'Gaul of Boy',
            'colors' => array(
                '5da8bf',
                'c6fdff',
                'e8f8ff',
                '014370',
                'c6fdff',
                '16799e',
            ),
        ),
        'bathypelagiczone' => array(
            'label' => 'Bathypelagic Zone',
            'colors' => array(
                '00232d',
                'adf4ff',
                'e5fbff',
                '1d6487',
                'adf4ff',
                '004159',
            ),
        ),
        'amethystgrape' => array(
            'label' => 'Amethyst Grape',
            'colors' => array(
                '472351',
                'd2adff',
                'c644ea',
                'ef7fef',
                'c15eb6',
                '2f0433',
            ),
        ),
        'peascarrots' => array(
            'label' => 'Peas and Carrots',
            'colors' => array(
                'adc698',
                '503047',
                'ffffff',
                'c05746',
                '503047',
                'd0e3c4',
            ),
        ),
	);
	
	return $schemes;
}

function jo_get_color_scheme() {
    $the_scheme = get_theme_mod('color_scheme', 'default');
    $color_schemes = jo_get_scheme_presets();
    
    if(array_key_exists($the_scheme, $color_schemes)) {
        return $color_schemes[$the_scheme]['colors'];
    }
}

function jo_get_active_color_scheme () {
    $elements = jo_get_elements(); // get the html elements to be styled
    $schemes = jo_get_scheme_presets(); // get the built-in color schemes
    $default = $schemes['default']['colors']; // get the default scheme
    $i = 0;
    foreach($elements as $key => $value) {
        $color = get_theme_mod($key); // get the active hex code for each element
        if(!$color) {
        	$color = $default[$i]; // set color from default theme if mod not yet set
        }
        $color = sanitize_hex_color_no_hash($color); // get rid of any preexisting #s
        $active_colors[] = '#'.$color; // now put new #s in front
        $i++;
    }
    
    return $active_colors;
}

function jo_color_scheme_css() {
    // this is the function that does the magic
    // instead of referring to the existing array
    // find out what the actual current values of the color pickers are
    $color_scheme = jo_get_active_color_scheme();
    
    $colors = array(
        'background_color' => $color_scheme[0],
        'text_color' => $color_scheme[1],
        'highlight_color' => $color_scheme[2],
        'link_color' => $color_scheme[3],
        'link_hover' => $color_scheme[4],
        'link_active' => $color_scheme[5],
    );
    
    $color_scheme_css = jo_get_color_scheme_css($colors);
    
    $output = '<style type="text/css" id="#jo-color-scheme-css">';
    $output .= $color_scheme_css;
    $output .= '</style>';
    
    echo $output;
}
add_action('wp_head', 'jo_color_scheme_css');

function jo_customize_preview_js() {
    wp_enqueue_script(
        'jo_customize-preview',
        get_template_directory_uri().'/jo-customize/jo-customize-preview.js',
        array('customize-preview'),
        '',
        true
    );
}
add_action('customize_preview_init', 'jo_customize_preview_js');

function jo_customize_control_js() {
    wp_enqueue_script(
        'jo-customize-controls',
        get_template_directory_uri().'/jo-customize/jo-customize-controls.js',
        array('customize-controls', 'iris', 'underscore', 'wp-util'),
        '',
        true
    );
    wp_localize_script(
        'jo-customize-controls',
        'colorScheme',
        jo_get_scheme_presets()
    );
}
add_action('customize_controls_enqueue_scripts', 'jo_customize_control_js');

function jo_get_color_scheme_css($colors) {
    $colors = wp_parse_args($colors, array(
        'background_color' => '',
        'text_color' => '',
        'highlight_color' => '',
        'link_color' => '',
        'link_hover' => '',
        'link_active' => '',
    ));
    
    $theme_credit = get_theme_mod('theme_credit');
    $theme_css = '';
    if(!$theme_credit) {
        $theme_css = '#generic-webcomic-credit { display: block; }';
    }
    
    $header_bg = get_theme_mod('header_bg');
    if(!$header_bg) {
        $header_bg = get_template_directory_uri() . '/images/header.png';
    }
    
    $header_height = get_theme_mod('header_height');
    if(!$header_height) {
        $header_height = 30;
    }
    
    $title_align = get_theme_mod('title_align');
    if(!$title_align) {
        $title_align = 'left';
    }
    
    $menu_align = get_theme_mod('menu_align');
    if(!$menu_align) {
        $menu_align = 'flex-start';
    }
    
    $footer_align = get_theme_mod('footer_align');
    if(!$footer_align) {
        $footer_align = 'left';
    }
    
    $css = <<<CSS
    html {
        --bgcolor: {$colors['background_color']};
        --text-color: {$colors['text_color']};
        --highlight-color: {$colors['highlight_color']};
        --link-color: {$colors['link_color']};
        --link-hover: {$colors['link_hover']};
        --link-active: {$colors['link_active']};
        --header-bgimage: url('{$header_bg}');
        --header-height: {$header_height}vh;
        --title-align: {$title_align};
        --menu-align: {$menu_align};
        --footer-align: {$footer_align};
    }
CSS;
    
    $css .= $theme_css;
    
    return $css;
    
}

function jo_color_scheme_css_template() {
    $elements = jo_get_elements();
    foreach($elements as $k => $v) {
        $colors[$k] = '{{ data.'.$k.' }}';
    }
    ?>
    
    <script type="text/html" id="tmpl-jo-color-scheme">
    <?php echo jo_get_color_scheme_css($colors); ?>
    </script>
    
    <?php
}
add_action('customize_controls_print_footer_scripts', 'jo_color_scheme_css_template');
?>