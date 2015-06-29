<?php
/**
 *
 *	Plugin Name: Pressed Core
 *	Plugin URI: http://pressedsites.com/
 *	Description: helper functions and classes for building great wordpress themes.
 *	Version: 0.2.7.3
 *	Author: Mitchell Bray
 *	Author URI: http://webcreationcentre.com.au/
 *	GitHub Plugin URI:	unetics/ps_
 *	GitHub Branch:		master
 *
 */
 
//  Define url vars
define("ps_ver", '0.2.7.0');
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


function ps_is_it_me()
{
    $current_user = wp_get_current_user();
    if($current_user->user_login == 'echoedlight'){
       do_action ( 'for_me' );
    }
    else{
	    do_action ( 'for_you' );
    }
}
add_action('admin_init', 'ps_is_it_me');


function hi_there(){
   include_once ps_dir.'plugins/todo/todo.php';
}
add_action('for_me', 'hi_there');

function hi_there_you(){
}
add_action('for_you', 'hi_there_you');

include_once ps_dir.'plugins/cleaner/cleaner.php';
include_once ps_dir.'plugins/keypress/keypress.php';
include_once ps_dir.'plugins/ie/ie.php';
include_once ps_dir.'plugins/pages/pages.php';

function PS_IM_REACTIVATED() {

    // Activation code here...
    
    function my_admin_notice() {   ?>
    <div class="updated">
        <p><?= 'PS_ was Updated to V'.ps_ver; ?></p>
    </div>
    <?php
	    do_action ( 'rebuild' );
	}
	add_action( 'admin_notices', 'my_admin_notice' );
	    
}
register_activation_hook( __FILE__, 'PS_IM_REACTIVATED' ); //done on plugin update 