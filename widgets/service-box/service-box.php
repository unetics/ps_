<?php

/*
Widget Name: Service Box
Description: This widget displays a 'Service Box!'.
Author: Ingenious Solutions
Author URI: http://ingenious-web.com/
*/

class Service_Box extends SiteOrigin_Widget {
    function __construct() {

        parent::__construct(
            'service-box',
            __('Service Box', 'addon-so-widgets-bundle'),
            array(
                'description' => __('Service Box.', 'addon-so-widgets-bundle'),
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
                'opt_selector' => array(
                    'type' => 'select',
                    'label' => __( 'First choose an option', 'widget-form-fields-text-domain' ),
                    'default' => 'blank',
                    'state_emitter' => array(
                        'callback' => 'select',
                        'args' => array( 'opt_selector' )
                    ),
                    'options' => array(
                        'blank' => __( 'Select an option', 'widget-form-fields-text-domain' ),
                        'icon' => __( 'Icon', 'widget-form-fields-text-domain' ),
                        'icon_image' => __( 'Icon Image', 'widget-form-fields-text-domain' ),
                    )
                ),

                'icon_selection' => array(
                    'type' => 'radio',
                    'label' => __( 'Choose Alignment', 'addon-so-widgets-bundle' ),
                    'default' => 'top',
                    'options' => array(
                        'top' => __( 'Top', 'addon-so-widgets-bundle' ),
                        'left' => __( 'Left', 'addon-so-widgets-bundle' ),
                    )
                ),


                //ICON SECTION
                'icon_section' => array(
                    'type' => 'section',
                    'label' => __( 'Icon' , 'widget-form-fields-text-domain' ),
                    'hide' => true,
                    'state_handler' => array(
                        'opt_selector[icon]' => array('show'),
                        'opt_selector[icon_image]' => array('hide'),
                        'opt_selector[blank]' => array('hide'),
                    ),

                    'fields' => array(

                        'icon_size' => array(
                            'type' => 'slider',
                            'label' => __( 'Set icon size', 'addon-so-widgets-bundle' ),
                            'default' => 3,
                            'min' => 2,
                            'max' => 100,
                            'integer' => true
                        ),

                        'icon' => array(
                            'type' => 'icon',
                            'label' => __('Select an icon', 'addon-so-widgets-bundle'),
                        ),


                    )
                ),


                //ICON IMAGE SECTION
                'icon_image_section' => array(
                    'type' => 'section',
                    'label' => __( 'Icon Image' , 'widget-form-fields-text-domain' ),
                    'hide' => true,
                    'state_handler' => array(
                        'opt_selector[icon_image]' => array('show'),
                        'opt_selector[icon]' => array('hide'),
                        'opt_selector[blank]' => array('hide'),
                    ),
                    'fields' => array(

                        'icon_img_width' => array(
                            'type' => 'slider',
                            'label' => __( 'Set Image Width', 'addon-so-widgets-bundle' ),
                            'default' => 3,
                            'min' => 2,
                            'max' => 100,
                            'integer' => true
                        ),

                        'icon_image' => array(
                            'type' => 'media',
                            'label' => __( 'Choose Image', 'addon-so-widgets-bundle' ),
                            'choose' => __( 'Choose image', 'addon-so-widgets-bundle' ),
                            'update' => __( 'Set image', 'addon-so-widgets-bundle' ),
                            'library' => 'image'
                        ),

                    )
                ),

                'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'addon-so-widgets-bundle'),
                    'default' => ''
                ),

                'content' => array(
                    'type' => 'textarea',
                    'label' => __( 'Content', 'addon-so-widgets-bundle' ),
                    'default' => '',
                    'allow_html_formatting' => true,
                    'rows' => 10
                ),

                'btn_text' => array(
                    'type' => 'text',
                    'label' => __('Button Text', 'addon-so-widgets-bundle'),
                    'default' => ''
                ),


                'btn_url' => array(
                    'type' => 'text',
                    'label' => __('Button Url', 'addon-so-widgets-bundle'),
                    'default' => ''
                ),

                'styling' => array(
                    'type' => 'section',
                    'label' => __( 'Widget styling' , 'widget-form-fields-text-domain' ),
                    'hide' => true,
                    'fields' => array(

                        'bg_color' => array(
                            'type' => 'color',
                            'label' => __( 'Background color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),

                        'icon_color' => array(
                            'type' => 'color',
                            'label' => __( 'Icon color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),
                        'title_color' => array(
                            'type' => 'color',
                            'label' => __( 'Title color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),

                        'content_color' => array(
                            'type' => 'color',
                            'label' => __( 'Content color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),

                        'box_padding' => array(
                            'type' => 'slider',
                            'label' => __( 'Service box padding', 'widget-form-fields-text-domain' ),
                            'default' => 24,
                            'min' => 2,
                            'max' => 37,
                            'integer' => true
                        ),
                        'box_border' => array(
                            'type' => 'select',
                            'label' => __( 'Border styled', 'widget-form-fields-text-domain' ),
                            'default' => '',
                            'options' => array(
                                'solid' => __( 'Solid', 'widget-form-fields-text-domain' ),
                                'dashed' => __( 'Dashed', 'widget-form-fields-text-domain' ),
                                'dotted' => __( 'Dotted', 'widget-form-fields-text-domain' ),
                            )
                        ),
                        'box_border_width' => array(
                            'type' => 'slider',
                            'label' => __( 'Border Width', 'widget-form-fields-text-domain' ),
                            'default' => 0,
                            'min' => 2,
                            'max' => 37,
                            'integer' => true
                        ),
                        'border_color' => array(
                            'type' => 'color',
                            'label' => __( 'Border color', 'widget-form-fields-text-domain' ),
                            'default' => ''
                        ),


                    )
                ),


            ),
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'service-box-template';
    }

    function get_style_name($instance) {
        return 'service-box-style';
    }

    function get_less_variables( $instance ) {
        return array(
            'background_color' => $instance['styling']['bg_color'],
            'icon_color' => $instance['styling']['icon_color'],
            'title_color' => $instance['styling']['title_color'],
            'content_color' => $instance['styling']['content_color'],
            'box_padding' => $instance['styling']['box_padding'].'px',
            'box_border' => $instance['styling']['box_border'],
            'box_border_width' => $instance['styling']['box_border_width'].'px',
            'box_border_color' => $instance['styling']['border_color'],
        );
    }



}


siteorigin_widget_register('service-box', __FILE__, 'Service_Box');