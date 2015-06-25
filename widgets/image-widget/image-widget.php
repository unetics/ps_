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
					'label' => __('Image file', 'siteorigin-widgets'),
					'library' => 'image',
					'fallback' => true,
				),

				'size' => array(
					'type' => 'select',
					'label' => __('Image size', 'siteorigin-widgets'),
					'options' => array(
						'full' => __('Full', 'siteorigin-widgets'),
						'large' => __('Large', 'siteorigin-widgets'),
						'medium' => __('Medium', 'siteorigin-widgets'),
						'thumb' => __('Thumbnail', 'siteorigin-widgets'),
					),
				),

				'title' => array(
					'type' => 'text',
					'label' => __('Title text', 'siteorigin-widgets'),
				),

				'alt' => array(
					'type' => 'text',
					'label' => __('Alt text', 'siteorigin-widgets'),
				),

				'url' => array(
					'type' => 'link',
					'label' => __('Destination URL', 'siteorigin-widgets'),
				),
				'new_window' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => __('Open in new window', 'siteorigin-widgets'),
				),

				'bound' => array(
					'type' => 'checkbox',
					'default' => true,
					'label' => __('Bound', 'siteorigin-widgets'),
					'description' => __("Make sure the image doesn't extend beyond its container.", 'siteorigin-widgets'),
				),
				'full_width' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => __('Full Width', 'siteorigin-widgets'),
					'description' => __("Resize image to fit its container.", 'siteorigin-widgets'),
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