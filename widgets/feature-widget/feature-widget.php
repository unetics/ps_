<?php
/*
Widget Name: Feature widget
Description: Displays a Ul.
Author: Mitchell Bray
Author URI: http://echoedlight.com
*/

class Feature_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-feature',
			'Feature',
			array(
				'description' => 'Displays a list.',
				'panels_icon' => 'dashicons dashicons-screenoptions',
			),
			array(),
			array(
				'button_icon' => array(
					'type' => 'section',
					'label' => __('Icon', 'siteorigin-widgets'),
					'fields' => array(
						'icon_selected' => array(
							'type' => 'icon',
							'label' => __('Icon', 'siteorigin-widgets'),
						),

						'icon_color' => array(
							'type' => 'select',
							'label' => 'Icon Colour',
							'default' => '',
							'options' => array(
								'' => 'Primary',
								'fbox-dark' => 'Dark',
								'fbox-light' => 'Light',
								),
						),
						'icon_pos' => array(
							'type' => 'select',
							'label' => 'Icon Position',
							'default' => '',
							'options' => array(
								'' => 'Left',
								'fbox-right' => 'Right',
								'fbox-center' => 'Centre',
								),
						),
						'icon_size' => array(
							'type' => 'select',
							'label' => 'Icon Size',
							'default' => '',
							'options' => array(
								'fbox-large' => 'Large',
								'' => 'Nomal',
								'fbox-small' => 'Small',
								),
						),
						
				),
				),
				'feature_heading' => array(
                            'type' => 'text',
                            'label' => 'Heading',
                            'default' => ''
                        ),
/*
                'feature_sub_heading' => array(
                            'type' => 'text',
                            'label' => 'Sub Heading',
                            'default' => ''
                        ),
*/
                        
                'feature_content' => array(
                            'type' => 'textarea',
                            'label' => 'Content',
                            'default' => '',
                            'allow_html_formatting' => true,
                            'rows' => 10
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

siteorigin_widget_register('feature', __FILE__, 'Feature_Widget');