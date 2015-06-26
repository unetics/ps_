<?php
/*
Widget Name: List widget
Description: Displays a Ul.
Author: Mitchell Bray
Author URI: http://echoedlight.com
*/

if (!class_exists('PS_Lists_Widget')) {

class PS_Lists_Widget extends SiteOrigin_Widget {
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
				'list' => array(
					'type' => 'repeater',
					'label' => 'List Items',
					'item_name' => 'List Item',
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
					),
				),
				'style' => array(
					'type' => 'select',
					'label' => 'List Style',
					'default' => 'default',
					'options' => array(
						'default' => 'default',
						'nostyle' => 'nostyle',
						'boxed' => 'boxed',
						'boxed-invert' => 'boxed-invert',
					),
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
}

siteorigin_widget_register('lists', __FILE__, 'PS_Lists_Widget');

}