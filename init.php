<?php
/**
 *
 *	Plugin Name: Pressed Core
 *	Plugin URI: http://pressedsites.com/
 *	Description: helper functions and classes for building great wordpress themes.
 *	Version: 0.2.4.5
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

include_once 'options/theme-options.php';
include_once 'options/nav-options.php';
// include_once 'options/options-init.php';
require_once ps_dir.'lib/less/Less.php';
require_once ps_dir.'common/common.php';
require_once ps_dir.'admin/admin.php';
require_once ps_dir.'public/public.php';

// Public only init function
function add_public_init() { 
	do_action ( 'public_init' );
}
! is_admin() and add_action( 'init', 'add_public_init' );


function add_widgets_collection($folders){
    $folders[] = plugin_dir_path( __FILE__ )."widgets/";
    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'add_widgets_collection');
