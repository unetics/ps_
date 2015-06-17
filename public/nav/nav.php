<?php
include_once ps_dir.'public/nav/navwalker.php';
// require_once( 'functions.php' );	

// =============================================================================
// ENQUEUED SCRIPTS AND STYLES
// =============================================================================
function supermenu_scripts() {
	
	global $nav_options;
log_me($nav_options['desktop_logo_scroll']['url']);
  wp_register_script( 'supermenu', plugins_url( 'supermenu-min.js', __FILE__ ), array( 'jquery' ));
  wp_localize_script( 'supermenu', 'supermenu_vars', array(
    'sm_menu_change_size'					=> true,
    'sm_effect_triggerpoint'				=> '100',
    'sm_fixed_menu'							=> 1,
    'sm_visible_load'						=> 1,
    'sm_change_color'						=> '',
    'sm_after_fixed_menu' 					=> 'fixed_basic',
    'sm_hide_then_show_fade'				=> 1,
    'sm_new_menu_width'						=> 'container_then_full_width',
    'sm_menu_configura_padding' 			=> 'automatic',
    'sm_change_menu_width'					=> 780,
    'body_class'							=> '',
    'desktop_logo'							=> $nav_options['desktop_logo']['url'],    
    'desktop_logo_scroll'					=> $nav_options['desktop_logo_scroll']['url'],
  ) );
  wp_enqueue_script( 'supermenu' );
}
add_action('wp_enqueue_scripts', 'supermenu_scripts');


// =============================================================================
// BUILDING THE [SUPERMENU] SHORTCODE
// =============================================================================
function the_nav() { 
/*
	global $supermenu;
	require_once( SUPERMENU_DIR.'/core/variables.php' );
*/
// 	if ( $topmenu_status == true ) { 
// 		do_action('supermenu_before_topmenu');
// 		include_once( 'default.php' );
// 		include_once( 'mobile.php' );
		include_once ps_dir.'public/nav/default.php';	
		include_once ps_dir.'public/nav/mobile.php';
// 		echo "header";	
// 		do_action('supermenu_after_topmenu');
/*
	}
	if ( $superside_menu == true ) {
		do_action('supermenu_before_superside');
		include_once( SUPERMENU_DIR.'/views/superside/'.$superside_layout.'.php' );
		do_action('supermenu_before_superside');
	}
*/
// 	include(SUPERMENU_DIR.'/views/partials/searchform.php');
}
add_shortcode( 'nav', 'nav_shortcode' ); 

// =============================================================================
// SUPERSIDE MENU REGISTRATION
// =============================================================================
/*
add_action('wp_head','automatic_integration');
function automatic_integration() {
		echo do_shortcode('[nav]');
}
*/
