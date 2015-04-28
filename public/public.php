<?php
		
function ps_get_styles() {
	$styles = array(
		
	);	
	
	if(has_filter('ps_add_styles')) {
		$styles = apply_filters('ps_add_styles', $styles);
	}
	
	return $styles;
}

// 	example of how to add less files //
/*	
function ps_add_extra_styles($styles) { 
	$extra_styles = array(
		'file.less'
	);
 
	// combine the two arrays
	$styles = array_merge($extra_styles, $styles);
 
	return $styles;
}
add_filter('ps_add_styles', 'ps_add_extra_styles');
*/



function make_css() {
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
		$parser->parse( '@color: #4D926F; #header { color: @color; } h2 { color: @color; }' );
		$parser->ModifyVars( array('nice-grey'=>'#333') );
		$parser->compileCss(ps_dir.'public/assets/css/main.css');
	}catch(Exception $e){
		$error_message = $e->getMessage();
		log_me($error_message);
	}
	add_action( 'wp_enqueue_scripts', 'load_css' );
}

add_action( 'init', 'make_css' );

function load_css() {
        wp_register_style( 'main_css', ps_url.'public/assets/css/main.css', false, ps_ver );
        wp_enqueue_style( 'main_css' );
}