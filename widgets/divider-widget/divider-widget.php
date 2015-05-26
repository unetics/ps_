<?php
/*
Widget Name: Divider Widget
Description: Displays a styled HR (also useful for adding space).
Author: Mitchell Bray
Author URI: http://echoedlight.com
*/

class Lists_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-lists',
			'Lists',
			array(
				'description' => 'Displays a list.',
				'panels_icon' => 'dashicons dashicons-editor-ul',
			),
			array(),
			array(
					'item_label' => array(
						'selector' => "[id*='list-content']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'content' => array(
							'type' => 'text',
							'label' => 'List Item Content',
						),					
						// The Icon
/*
						'icon' => array(
							'type' => 'svgIcon',
							'label' => 'Icon',
						),
*/
					),

			),
			plugin_dir_path(__FILE__).'../'
		);
	}

	function get_style_name($instance){
		return false;
	}

	function get_template_name($instance){
		return 'base';
	}

/*
	function enqueue_frontend_scripts(){
		return false;
	}
*/
}

siteorigin_widget_register('lists', __FILE__, 'Lists_Widget');

/*
<p>
	<label for="<?php echo $this->get_field_id('height') ?>">Height in px (adds equal margin to top and bottom)</label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('height') ?>" name="<?php echo $this->get_field_name('height') ?>" value="<?php echo esc_attr($instance['height']) ?>" />
</p>
		
<div>
	<label>Display Line?</label>
	<select id="<?= $this->get_field_id('line');?>" name="<?= $this->get_field_name('line'); ?>">
		<option value="" <?php selected('', $instance['line'],true);?>>yes</option>
		<option value="invisible" <?php selected('invisible', $instance['line'],true);?>>No</option>
	</select>
</div>
*/