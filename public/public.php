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