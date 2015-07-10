<?php

/*
Widget Name: Tabs
Description: This widget Display Tabs.
Author: Ingenious Solutions
Author URI: http://ingenious-web.com/
*/

class Tabs extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'tabs',
			__('Tabs', 'addon-so-widgets-bundle'),
			array(
				'description' => __('Tabs Component.', 'addon-so-widgets-bundle'),
                'panels_groups' => array('addonso')
			),
			array(

			),
			array(
				'widget_title' => array(
					'type' => 'text',
					'label' => __('Widget Title', 'addon-so-widgets-bundle'),
					'default' => ''
				),


                'repeater' => array(
                    'type' => 'repeater',
                    'label' => __( 'Tabs' , 'addon-so-widgets-bundle' ),
                    'item_name'  => __( 'Tab', 'addon-so-widgets-bundle' ),
                    'item_label' => array(
                        'selector'     => "[id*='repeat_text']",
                        'update_event' => 'change',
                        'value_method' => 'val'
                    ),
                    'fields' => array(

                        'tab_title' => array(
                            'type' => 'text',
                            'label' => __('Tab Title', 'addon-so-widgets-bundle'),
                            'default' => ''
                        ),


                        'tab_content' => array(
                            'type' => 'textarea',
                            'label' => __( 'Tab Content', 'addon-so-widgets-bundle' ),
                            'default' => '',
                            'allow_html_formatting' => true,
                            'rows' => 10
                        ),
                    )
                ),

                'tabs_selection' => array(
                    'type' => 'radio',
                    'label' => __( 'Choose Tabs Style', 'addon-so-widgets-bundle' ),
                    'default' => 'horizontal',
                    'options' => array(
                        'horizontal' => __( 'Horizontal Tabs', 'addon-so-widgets-bundle' ),
                        'vertical' => __( 'Vertical Tabs', 'addon-so-widgets-bundle' ),
                    )
                ),


                'tabs_styling' => array(
                    'type' => 'section',
                    'label' => __( 'Widget styling' , 'widget-form-fields-text-domain' ),
                    'hide' => true,
                    'fields' => array(

                        'bg_color' => array(
                            'type' => 'color',
                            'label' => __( 'background color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),

                        'inactive_tab_color' => array(
                            'type' => 'color',
                            'label' => __( 'Inactive Tab color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),

                        'active_tab_color' => array(
                            'type' => 'color',
                            'label' => __( 'Active Tab color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),

                        'tab_content_color' => array(
                            'type' => 'color',
                            'label' => __( 'Tab Content color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),



                    )
                ),


			),
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'tabs-template';
	}

	function get_style_name($instance) {
		return 'tabs-style';
	}

    function get_less_variables( $instance ) {
        return array(
            'bg_color' => $instance['tabs_styling']['bg_color'],
            'inactive_tab_color' => $instance['tabs_styling']['inactive_tab_color'],
            'active_tab_color' => $instance['tabs_styling']['active_tab_color'],
            'tab_content_color' => $instance['tabs_styling']['tab_content_color'],
        );
    }

}

siteorigin_widget_register('tabs', __FILE__, 'Tabs');