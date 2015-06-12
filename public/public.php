<?php
require_once ps_dir.'public/nav/nav.php';			
function ps_get_styles() {
	$styles = array();	
	
	if(has_filter('ps_add_styles')) {
		$styles = apply_filters('ps_add_styles', $styles);
	}

	return $styles;
}



function ps_get_styleVars() {
	global $theme_options;
	global $nav_options;
// 	log_me($theme_options);

	$vars = array(
// 		Theme Options
		'primary_colour' 			=> $theme_options['primary-colour'],
		'accent_colour' 			=> $theme_options['accent-colour'],
		'background_colour' 		=> $theme_options['background-colour'], 
		'text_colour'				=> $theme_options['font-colour'], 
		'rounding' 					=> $theme_options['rounding'], 
// 		Nav Options
		'nav-background' 			=> $nav_options['background-colour'],
		'nav-background-scroll' 	=> $nav_options['background-colour'],
		'menu-link-color' 			=> $nav_options['menu-link-color']['regular'],
		'menu-link-color-hover' 	=> $nav_options['menu-link-color']['hover'],
		'menu-link-color-active' 	=> $nav_options['menu-link-color']['active'],
		'box-shadow'				=> $nav_options['box-shadow'],
		'top-level-font-size'		=> $nav_options['menu-typography']['font-size'],
	);
	return $vars;

}

function make_css() {
	
	$styles = ps_get_styles();
	$styleVars = ps_get_styleVars();
	
	try{
		$options = array( 	'compress' 			=> true,
							'sourceMap'         => true,
							'sourceMapWriteTo'  => ps_dir.'public/assets/css/filename.map',
							'sourceMapURL'      => ps_url.'public/assets/css/filename.map', );
		$parser = new Less_Parser($options);
	
		$styles = ps_get_styles();
		foreach($styles as $style) :
			$parser->parseFile($style, '' );
		endforeach;
		$parser->ModifyVars( $styleVars );
		$parser->compileCss(ps_dir.'public/assets/css/main.css');
	}catch(Exception $e){
		$error_message = $e->getMessage();
		log_me($error_message);
	}
}
add_action( 'rebuild', 'make_css' );

function load_css() {
        wp_register_style( 'main_css', ps_url.'public/assets/css/main.css', false, ps_ver );
        wp_enqueue_style( 'main_css' );
}
add_action( 'wp_enqueue_scripts', 'load_css' );

add_filter('wp_nav_menu_items', 'do_shortcode'); // add shortcodes to menus

// disable the admin bar
show_admin_bar(false);

/**
 * @param $icon_value
 * @param bool $icon_styles
 *
 * @return bool|string
 */
function ps_get_icon($icon_value, $icon_styles = false) {
	if( empty( $icon_value ) ) return false;
	list( $family, $icon ) = explode('-', $icon_value, 2);
	if( empty( $family ) || empty( $icon ) ) return false;

	static $widget_icon_families;
	static $widget_icons_enqueued = array();
	
	if( empty($widget_icon_families) ) $widget_icon_families = apply_filters('siteorigin_widgets_icon_families', array() );
	if( empty($widget_icon_families[$family]) || empty($widget_icon_families[$family]['icons'][$icon]) ) return false;
	
// 	log_me($widget_icon_families[$family]['icons'][$icon]);

	if(empty($widget_icons_enqueued[$family]) && !empty($widget_icon_families[$family]['style_uri'])) {
// 		log_me($widget_icon_families[$family]['style_uri']);
		if( !wp_style_is( 'siteorigin-widget-icon-font-'.$family ) ) {
			wp_enqueue_style('siteorigin-widget-icon-font-'.$family, $widget_icon_families[$family]['style_uri'] );
		}
		return '<i class="i-alt sow-icon-' . esc_attr($family) . '" data-sow-icon="' . $widget_icon_families[$family]['icons'][$icon] . '" ' . ( !empty($icon_styles) ? 'style="'.implode('; ', $icon_styles).'"' : '' ) . '></i> ';
	}
	else {
		return false;
	}

}



// padding: 0 calc((100% - 1020px)/2)