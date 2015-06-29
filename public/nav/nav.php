<?php
include_once ps_dir.'public/nav/navwalker.php';
// require_once( 'functions.php' );	

// =============================================================================
// ENQUEUED SCRIPTS AND STYLES
// =============================================================================
function supermenu_scripts() {
	
  global $nav_options;
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
	global $nav_options;
/* 	log_me($nav_options['nav-type']); */
	if ($nav_options['nav-type'] == 1){
		include_once ps_dir.'public/nav/default.php';	
		include_once ps_dir.'public/nav/mobile.php';
	}elseif ($nav_options['nav-type'] == 2){
		echo('sorry no sidebar yet');
	}
	elseif ($nav_options['nav-type'] == 3){
		?>
		<style type="text/css" media="screen">
			body{
				margin-top: 0 !important;
			}
		</style>
		<?php
	}
	
}
add_shortcode( 'nav', 'nav_shortcode' ); 

