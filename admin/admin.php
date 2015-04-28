<?php
		
function ps_get_admin_styles() {
	$styles = array(
		ps_dir.'admin/assets/less/admin.less'
	);	
	
	if(has_filter('ps_add_admin_styles')) {
		$styles = apply_filters('ps_add_admin_styles', $styles);
	}
	
	return $styles;
}

/*
function ps_add_extra_styles($styles) { 
	$extra_styles = array();
 
	// combine the two arrays
	$styles = array_merge($extra_styles, $styles);
 
	return $styles;
}
add_filter('ps_add_admin_styles', 'ps_add_extra_styles');
*/



function make_admin_css() {
	try{
		$options = array( 	'compress' 			=> true,
							'sourceMap'         => true,
							'sourceMapWriteTo'  => ps_dir.'admin/assets/css/filename.map',
							'sourceMapURL'      => ps_url.'admin/assets/css/filename.map', );
		$parser = new Less_Parser($options);
	
		$styles = ps_get_admin_styles();
		foreach($styles as $style) :
			$parser->parseFile($style, '' );
		endforeach;
		$parser->ModifyVars( array('nice-grey'=>'#333') );
		$parser->compileCss(ps_dir.'admin/assets/css/admin.css');
	}catch(Exception $e){
		$error_message = $e->getMessage();
		log_me($error_message);
	}
	add_action( 'admin_enqueue_scripts', 'load_admin_css' );
}

add_action( 'admin_init', 'make_admin_css' );

function load_admin_css() {
        wp_register_style( 'custom_wp_admin_css', ps_url.'admin/assets/css/admin.css', false, ps_ver );
        wp_enqueue_style( 'custom_wp_admin_css' );
}