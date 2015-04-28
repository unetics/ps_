<?php
/**
 *
 *	Plugin Name: Pressed Core
 *	Plugin URI: http://pressedsites.com/
 *	Description: helper functions and classes for building great wordpress themes.
 *	Version: 0.1.0.1
 *	Author: Mitchell Bray
 *	Author URI: http://webcreationcentre.com.au/
 *	GitHub Plugin URI:	unetics/ps_
 *	GitHub Branch:		master
 *
 */
 
//  Define url vars
define("ps_ver", '0.1.0.0');
define("ps_url", plugin_dir_url( __FILE__ ));
define("ps_dir", plugin_dir_path( __FILE__ ));

require_once ps_dir.'lib/less/Less.php';
require_once ps_dir.'common/common.php';
require_once ps_dir.'admin/admin.php';
require_once ps_dir.'public/public.php';


function add_public_init() { 
	do_action ( 'public_init' );
}
! is_admin() and add_action( 'init', 'add_public_init' );