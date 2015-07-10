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
}
add_action( 'rebuild', 'make_admin_css' );


function load_admin_css() {
        wp_register_style( 'custom_wp_admin_css', ps_url.'admin/assets/css/admin.css', false );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_admin_css' );

function load_admin_js(){
	wp_register_script('chosened', ps_url.'admin/assets/js/chosen.jquery.js', false);
	wp_enqueue_script('chosened');
}
add_action( 'admin_enqueue_scripts', 'load_admin_js' );

function rebuild_javascript() { ?>
	<script type="text/javascript" >
		function rebuild() {
		  jQuery(document).ready(function($) {
			var data = {
				'action': 'rebuild'
			};
	
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			$.post(ajaxurl, data, function(response) {
				console.log(response);
			});
		});
		}
	</script> <?php
}
add_action( 'admin_footer', 'rebuild_javascript' ); 



function rebuild_callback() {
	do_action ( 'rebuild' );
/*         log_me('css compiled'); */
	wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_rebuild', 'rebuild_callback' );





