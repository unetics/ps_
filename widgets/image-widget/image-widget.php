<?php
/*
Widget Name: Image widget
Description: A very simple image widget.
Author: Mitchell Bray
Author URI: http://webcreationcentre.com.au
*/

class Image_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'ps_image',
			'Image',
			array(
				'description' => 'A simple image widget with massive power.',
				'panels_icon' => 'dashicons dashicons-format-image',
			),
			array(

			),
			array(
				'image' => array(
					'type' => 'media',
					'label' => 'Image file',
					'library' => 'image',
					'fallback' => true,
				),

				'size' => array(
					'type' => 'select',
					'label' => 'Image size',
					'options' => array(
						'full' => 'Full',
						'large' => 'Large', 
						'medium' => 'Medium', 
						'thumb' => 'Thumbnail', 
					),
				),

				'title' => array(
					'type' => 'text',
					'label' => 'Title text',
				),

				'alt' => array(
					'type' => 'text',
					'label' => 'Alt text',
				),

				'url' => array(
					'type' => 'link',
					'label' => 'Destination URL', 
				),
				'new_window' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => 'Open in new window', 
				),

				'bound' => array(
					'type' => 'checkbox',
					'default' => true,
					'label' => 'Bound',
					'description' => "Make sure the image doesn't extend beyond its container.",
				),
				'full_width' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => 'Full Width', 
					'description' => "Resize image to fit its container.",
				),
				'zoomable' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => 'Zoomable',
					'description' => 'can click to view lager version of the image',
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

siteorigin_widget_register('ps_image', __FILE__, 'Image_Widget');