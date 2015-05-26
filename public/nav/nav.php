<?php
include_once ps_dir.'public/nav/navwalker.php';
// require_once( 'functions.php' );	

// =============================================================================
// ENQUEUED SCRIPTS AND STYLES
// =============================================================================
function supermenu_scripts() {
/*
  global $supermenu;

  $superside_layout		= $supermenu['sm-superside-layout'];
	$superside_aside		= $supermenu['sm-superside-aside-out'];
	$sm_superside_transition			= $supermenu['sm-superside-transition'];
	if ($supermenu['sm-superside-menu'] == true) {
		$classes = 'superside-enabled '.$superside_layout.' '.$sm_superside_transition.' '.$superside_aside;
	}
  $sm_menu_change_size 					= ($supermenu['sm-change-menu-size'] == true) ? 'change-size' : '';
*/
//   wp_enqueue_style( 'sm-bootstrap-css', plugins_url( '/assets/css/bootstrap.min.css', __FILE__ ) );
//   wp_enqueue_style( 'sm-animatecss', plugins_url( '/assets/css/animate.css', __FILE__ ) );
//   wp_enqueue_style( 'supermenu', plugins_url( '/assets/css/supermenu.css', __FILE__ ) );
//   wp_enqueue_style( 'sm-fontawesome', plugins_url( '/assets/css/font-awesome.min.css', __FILE__ ) );
//   wp_enqueue_style( 'supermenu-dynamic', plugins_url( '/style.sass.php', __FILE__ ) );
//   wp_register_script( 'sm-headroom', plugins_url( '/assets/js/headroom.js', __FILE__ ), array( 'jquery' ), SUPERMENU_VERSION, true );
//   wp_enqueue_script( 'sm-headroom' );
//   wp_register_script( 'sm-modernizr', plugins_url( '/assets/js/modernizr.js', __FILE__ ), array( 'jquery' ), SUPERMENU_VERSION, true );
//   wp_enqueue_script( 'sm-modernizr' );
//   wp_register_script( 'sm-jquery-mobile', plugins_url( '/assets/js/jquery.mobile.custom.js', __FILE__ ), array( 'jquery' ), SUPERMENU_VERSION, true );
//   wp_enqueue_script( 'sm-jquery-mobile' );
  wp_register_script( 'supermenu', plugins_url( 'supermenu.js', __FILE__ ), array( 'jquery' ));
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
    'body_class'							=> ''
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
