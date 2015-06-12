<?php
// remove dashboard widgets
function ps_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['redux_dashboard_widget']);
}
add_action('wp_dashboard_setup', 'ps_remove_dashboard_widgets' );

/**
 * Clean up wp_head()
 */
function head_cleanup() {
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  global $wp_widget_factory;
}
add_action('init', 'head_cleanup');


/* Fix for empty search queries redirecting to home page */
function roots_request_filter($query_vars) {
  if (isset($_GET['s']) && empty($_GET['s']) && !is_admin()) {
    $query_vars['s'] = ' ';
  }
  return $query_vars;
}
add_filter('request', 'roots_request_filter');


function remove_menus(){
/*   remove_menu_page( 'index.php' );                  //Dashboard */
  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
/*   remove_menu_page( 'edit.php?post_type=page' );    //Pages */
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'plugins.php' );                //Plugins
  remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
  remove_menu_page( 'pb_backupbuddy_backup');
  
}
add_action('for_you', 'remove_menus');

// unregister default widgets
 function unregister_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Text');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Nav_Menu_Widget');
 }
 add_action('widgets_init', 'unregister_default_widgets', 11);
 
 /** remove redux menu under the tools **/
add_action( 'admin_menu', 'remove_redux_menu',12 );
function remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}
 /** remove wp logo in admin **/
function annointed_admin_bar_remove() {
        global $wp_admin_bar;

        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
//     $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
    $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    $wp_admin_bar->remove_menu('wpseo-menu'); 
//     $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

function mytheme_admin_bar_render() {

    global $wp_admin_bar;
		// Add an option to visit the site.
		$wp_admin_bar->add_menu( array(
			'parent' => '',
			'id'     => 'view-site',
			'title'  => 'View Site',
			'href'   => home_url( '/' ),
			'meta' 	 => array( 'target' => '_blank', 'title' => 'view site' ),
		) );
		$wp_admin_bar->add_menu(array(
			'parent' => '', 
			'title' => 'rebuild', 
			'id' => 'rebuild-css', 
			'href' => 'javascript:void(0);', 
			'meta' => array('onclick' => 'rebuild()', 'title' => 'Rebuild CSS')));
}

add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

if ( ! function_exists( 'redux_disable_dev_mode_plugin' ) ) {
    function redux_disable_dev_mode_plugin( $redux ) {
        if ( $redux->args['opt_name'] != 'redux_demo' ) {
            $redux->args['dev_mode'] = false;
        }
    }

    add_action( 'redux/construct', 'redux_disable_dev_mode_plugin' );
}


// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// REMOVE WP jQuery 
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

function remove_jquery_migrate( &$scripts)
{
    if(!is_admin())
    {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2', true );
    }
}

function _remove_script_version( $src ){
$parts = explode( '?', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );