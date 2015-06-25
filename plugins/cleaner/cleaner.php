<?php
// remove dashboard widgets
if( ! function_exists('ps_remove_dashboard_widgets') ) {
function ps_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']);
	unset($wp_meta_boxes['dashboard']['side']['core']);
}
add_action('wp_dashboard_setup', 'ps_remove_dashboard_widgets' );
}

// Clean up wp_head()
if( ! function_exists('ps_head_cleanup') ) {
function ps_head_cleanup() {
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}
add_action('init', 'ps_head_cleanup');
}

// Fix for empty search queries redirecting to home page 
if( ! function_exists('ps_request_filter') ) {
function ps_request_filter($query_vars) {
  if (isset($_GET['s']) && empty($_GET['s']) && !is_admin()) {
    $query_vars['s'] = ' ';
  }
  return $query_vars;
}
add_filter('request', 'ps_request_filter');
}

if( ! function_exists('ps_remove_menus') ) {
function ps_remove_menus(){
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
  remove_submenu_page('tools.php','redux-about'); 	// remove redux menu under the tools 
  
}
add_action('for_you', 'ps_remove_menus');
}

// unregister default widgets
if( ! function_exists('ps_unregister_widgets') ) {
 function ps_unregister_widgets() {
	 $unregistered = array('WP_Widget_Pages', 'WP_Widget_Calendar', 'WP_Widget_Archives', 'WP_Widget_Links', 'WP_Widget_Meta', 'WP_Widget_Search', 'WP_Widget_Text', 'WP_Widget_Categories', 'WP_Widget_Recent_Posts', 'WP_Widget_Recent_Comments', 'WP_Widget_RSS', 'WP_Widget_Tag_Cloud', 'WP_Nav_Menu_Widget');
	 
	foreach ($unregistered as $unregister) {
    	unregister_widget($unregister);
    }
 }
 add_action('widgets_init', 'ps_unregister_widgets', 11);
 }

if( ! function_exists('ps_hide_admin_bar_items') ) {
function ps_hide_admin_bar_items() {
    global $wp_admin_bar;
    $hidden = array('wp-logo', 'about', 'wporg', 'documentation', 'support-forums', 'feedback', 'site-name', 'view-site', 'comments', 'new-content', 'w3tc', 'wpseo-menu');

    foreach ($hidden as $hide) {
	    $wp_admin_bar->remove_menu($hide);
    }
}
add_action( 'wp_before_admin_bar_render', 'ps_hide_admin_bar_items' );
}

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

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// REMOVE WP jQuery 
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

function remove_jquery_migrate( &$scripts){
    if(!is_admin()){
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2', true );
    }
}
