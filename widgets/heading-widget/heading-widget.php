<?php
/*
Widget Name: Heading widget
Description: Displays H1-H4.
Author: Mitchell Bray
Author URI: http://echoedlight.com
*/

if (!class_exists('PS_Heading_Widget')) {

class PS_Heading_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'ps-heading',
			'Heading',
			array(
				'description' => 'Displays H1-H4.',
				'panels_icon' => 'dashicons dashicons-editor-ul',
				'has_preview' => false,
			), //widget_options
			array(), //control_options
			array(
				'heading_content' => array(
                    'type' => 'text',
                    'label' => 'Heading',
                    'placeholder' => 'Enter your heading content here.',
                    'default' => '',
                ),
                'heading_size' => array(
                    'type' => 'select',
                    'label' => 'Heading Size',
                    'default' => 'f24px',
                    'options' => array(
                        'f16px' => '16',
                        'f18px' => '18',
                        'f20px' => '20',
                        'f22px' => '22',
                        'f24px' => '24',
                        'f26px' => '26',
                        'f28px' => '28',
                        'f36px' => '36',
                        'f48px' => '48',
                        'f72px' => '72',
                    ),
                    'class' => 'half',
                ),
                'heading_type' => array(
                    'type' => 'select',
                    'label' => 'Heading Type',
                    'default' => 'H2',
                    'options' => array(
                        'H1' => 'H1',
                        'H2' => 'H2',
                        'H3' => 'H3',
                        'H4' => 'H4',
                    ),
                    'class' => 'half',
                ),
                'heading_align' => array(
                    'type' => 'select',
                    'label' => 'Heading Align',
                    'default' => 'text_center',
                    'options' => array(
                        'text_left' => 'Left',
                        'text_center' => 'Center',
                        'text_right' => 'Right',
                    ),
                    'class' => 'half',
                ),
                'heading_weight' => array(
                    'type' => 'select',
                    'label' => 'Heading Weight',
                    'default' => 'normal',
                    'options' => array(
                        'lighter' => 'Lighter',
                        'normal' => 'Normal',
                        'bold' => 'Bold',
                        'bolder' => 'Bolder',
                    ),
                    'class' => 'half',
                    
                ),
                'heading_colour' => array(
                    'type' => 'select',
                    'label' => 'Heading Colour',
                    'default' => 'font_colour',
                    'options' => array(
                        'black' => 'Black',
                        'dark_grey' => 'Dark Grey',
                        'mid_grey' => 'Mid Grey',
                        'light_grey' => 'Light Grey',
                        'white' => 'White',
                        'font_colour' => 'Font Colour',
                        'primary_colour' => 'Primary Colour',
                        'accent_colour' => 'Accent Colour',
                        'background_colour' => 'Background Colour',                                               
                    )
                ),		
			), //fields
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
siteorigin_widget_register('ps-heading', __FILE__, 'PS_Heading_Widget');

}