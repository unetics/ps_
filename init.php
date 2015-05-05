<?php
/**
 *
 *	Plugin Name: Pressed Core
 *	Plugin URI: http://pressedsites.com/
 *	Description: helper functions and classes for building great wordpress themes.
 *	Version: 0.1.1.1
 *	Author: Mitchell Bray
 *	Author URI: http://webcreationcentre.com.au/
 *	GitHub Plugin URI:	unetics/ps_
 *	GitHub Branch:		master
 *
 */
 
//  Define url vars
define("ps_ver", '0.2.0.0');
define("ps_url", plugin_dir_url( __FILE__ ));
define("ps_dir", plugin_dir_path( __FILE__ ));

require_once ps_dir.'lib/less/Less.php';
require_once ps_dir.'common/common.php';
require_once ps_dir.'admin/admin.php';
require_once ps_dir.'public/public.php';

// Public only init function
function add_public_init() { 
	do_action ( 'public_init' );
}
! is_admin() and add_action( 'init', 'add_public_init' );


function create_ps_menu() {
	global $wp_admin_bar;

	$menu_id = 'ps_';
	$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => 'ps_'));
	$wp_admin_bar->add_menu(array(
							'parent' => $menu_id, 
							'title' => 'rebuild css', 
							'id' => 'public-css', 
							'href' => 'javascript:void(0);', 
							'meta' => array('onclick' => 'public-css()')));
	}
add_action('admin_bar_menu', 'create_ps_menu', 2000);

