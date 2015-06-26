<?php /** Add keyboard shortcuts to wb backend */
if (!class_exists('Keypress')) {
	
class Keypress {
	
	function __construct(){
		add_action('admin_head', array( $this, 'wp_save_hijack'));
	}
	
	function wp_save_hijack(){
		$screen = get_current_screen();
		if($screen->base == 'post'){ ?>
			<script type="text/javascript">
				document.addEventListener("keydown", function(e) {
				  if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
						  document.getElementById('publish').click();		
						  e.preventDefault();
				  }
				}, false);
			</script> <?php
		}
	}
	
}

$Keypress = new Keypress;

}