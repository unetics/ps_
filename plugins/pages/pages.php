<?php /** Add dashboard widget for page links to wb backend */
	function wps_recent_posts_dw() {
?>
	<style type="text/css" media="screen">
		#wps_recent_posts_dw .active_page{
					border: 1px solid #d8dbe1;
					background: #eee;
					padding: 10px;
					margin: 0;
		}
		#wps_recent_posts_dw .active_page a{
			float: right;
			margin-right: 10px;
		}
	</style>
   <ul>
     <?php
          $args = array(
			'child_of' => 0,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish'
		); 
		$pages = get_pages($args); 		
                foreach( $pages as $page ) :  setup_postdata($page); ?>
                    <li class="active_page"><?= $page->post_title;?> 
                    	<a href="<?= get_edit_post_link( $page->ID ); ?>"  title="Edit Page" >
	                    	<span class="dashicons dashicons-welcome-write-blog"></span>
	                    </a>
	                    <a target="_blank" href="<?= ( $page->guid ); ?>"  title="View Page"  >
		                    <span class="dashicons dashicons-welcome-view-site"></span>
	                    </a>
                    </li>
          <?php endforeach; ?>
   </ul>
<?php
}

function add_wps_recent_posts_dw() {
       wp_add_dashboard_widget( 'wps_recent_posts_dw', 'Pages', 'wps_recent_posts_dw' );
}
add_action('wp_dashboard_setup', 'add_wps_recent_posts_dw' );
