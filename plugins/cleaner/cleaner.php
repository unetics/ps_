<?php /** Clean some functions of WordPress */
if (!class_exists('Cleaner')) {
	
class Cleaner {

	function __construct(){
		if(is_admin()){
			add_action('wp_dashboard_setup', array( $this, 'ps_remove_dashboard_widgets') ); // remove dashboard widgets
			add_action('for_you', array( $this, 'ps_remove_menus')); // remove menu items for clients 
			add_action( 'wp_before_admin_bar_render', array( $this, 'ps_hide_admin_bar_items' )); // hide menu bar items
			add_action( 'wp_before_admin_bar_render', array( $this, 'mytheme_admin_bar_render' )); // add items to admin bar 
		}else{
			add_action('init', array( $this, 'ps_head_cleanup')); // Clean up wp_head()
			add_filter('request', array( $this, 'ps_request_filter')); // Fix for empty search queries redirecting to home page 
			add_filter( 'wp_default_scripts', array( $this,'remove_jquery_migrate' )); // REMOVE WP jQuery Migrate
		}
		add_action('widgets_init', array( $this, 'ps_unregister_widgets'), 11); // unregister default widgets
	}
	
	function ps_remove_dashboard_widgets() {
		global $wp_meta_boxes;
		unset($wp_meta_boxes['dashboard']['normal']['core']);
		unset($wp_meta_boxes['dashboard']['side']['core']);
	}
	
	function ps_head_cleanup() {
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	}
	
	function ps_request_filter($query_vars) {
	if (isset($_GET['s']) && empty($_GET['s'])) {
		$query_vars['s'] = ' ';
	}
	return $query_vars;
	}

	function ps_remove_menus(){
// 		remove_menu_page( 'edit.php' );                   //Posts
// 		remove_menu_page( 'upload.php' );                 //Media
		remove_menu_page( 'edit-comments.php' );          //Comments
		remove_menu_page( 'themes.php' );                 //Appearance
		remove_menu_page( 'plugins.php' );                //Plugins
		remove_menu_page( 'users.php' );                  //Users
		remove_menu_page( 'tools.php' );                  //Tools
		remove_menu_page( 'options-general.php' );        //Settings
		remove_menu_page( 'pb_backupbuddy_backup');
		remove_submenu_page('tools.php','redux-about'); 	// remove redux menu under the tools  
	}
	
	function ps_unregister_widgets() {
		$unregistered = array('WP_Widget_Pages', 'WP_Widget_Calendar', 'WP_Widget_Archives', 'WP_Widget_Links', 'WP_Widget_Meta', 'WP_Widget_Search', 'WP_Widget_Text', 'WP_Widget_Categories', 'WP_Widget_Recent_Posts', 'WP_Widget_Recent_Comments', 'WP_Widget_RSS', 'WP_Widget_Tag_Cloud', 'WP_Nav_Menu_Widget');
	 
		foreach ($unregistered as $unregister) {
			unregister_widget($unregister);
		}
	}
	
	function ps_hide_admin_bar_items() {
	    global $wp_admin_bar;
	    $hidden = array('wp-logo', 'about', 'wporg', 'documentation', 'support-forums', 'feedback', 'site-name', 'view-site', 'comments', 'new-content', 'w3tc', 'wpseo-menu');
	
	    foreach ($hidden as $hide) {
		    $wp_admin_bar->remove_menu($hide);
	    }
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
				'title' => 'Rebuild', 
				'id' => 'rebuild-css', 
				'href' => 'javascript:void(0);', 
				'meta' => array('onclick' => 'rebuild()', 'title' => 'Rebuild CSS')));
	}
	
	function remove_jquery_migrate( &$scripts){
	        $scripts->remove( 'jquery');
	        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2', true );
	}

}



$cleaner = new Cleaner;

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
}
