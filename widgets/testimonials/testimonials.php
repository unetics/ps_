<?php

/*
Widget Name: Testimonials
Description: Testimonials.
Author: Ingenious Solutions
Author URI: http://ingenious-web.com/
*/

class Testimonials extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'testimonials',
			__('Testimonials', 'addon-so-widgets-bundle'),
			array(
				'description' => __('Testimonials.', 'addon-so-widgets-bundle'),
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


                'posts' => array(
                    'type' => 'posts',
                    'label' => __('Select Testimonials', 'addon-so-widgets-bundle'),
                ),


                'layout_selection' => array(
                    'type' => 'radio',
                    'label' => __( 'Choose a style', 'addon-so-widgets-bundle' ),
                    'default' => 'rotator',
                    'options' => array(
                        'rotator' => __( 'Testimonial Rotator', 'addon-so-widgets-bundle' ),
                        'grid' => __( 'Testimonial Gird ', 'addon-so-widgets-bundle' ),
                    )
                ),



                'grid_selection' => array(
                    'type' => 'radio',
                    'label' => __( 'Choose a Gird Layout ( Only for Testimonial Grid )', 'addon-so-widgets-bundle' ),
                    'default' => '',
                    'options' => array(
                        'col-md-6' => __( 'Two Columns', 'addon-so-widgets-bundle' ),
                        'col-md-4' => __( 'Three Columns', 'addon-so-widgets-bundle' ),
                        'col-md-3' => __( 'Four Columns', 'addon-so-widgets-bundle' ),
                        'col-md-12' => __( 'Full Width', 'addon-so-widgets-bundle' ),
                    )
                ),



			),
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'testimonials-template';
	}

	function get_style_name($instance) {
		return 'testimonials-style';
	}

}


add_action('wp_head','carousel_scripts');

function carousel_scripts()
{

    echo "<script>



$(document).ready(function() {

    $('.testimonial_carousel').owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        navigation:false,
        items : 1
    });



});

</script>";

}

function my_custom_post_product() {
    $labels = array(
        'name'               => _x( 'Testimonial', 'post type general name' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'testimonial' ),
        'add_new_item'       => __( 'Add New Testimonial' ),
        'edit_item'          => __( 'Edit Testimonial' ),
        'new_item'           => __( 'New Testimonial' ),
        'all_items'          => __( 'All Testimonial' ),
        'view_item'          => __( 'View Testimonial' ),
        'search_items'       => __( 'Search Testimonial' ),
        'not_found'          => __( 'No testimonial found' ),
        'not_found_in_trash' => __( 'No testimonial found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Testimonial'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'   => true,
    );
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'my_custom_post_product' );



//require_once( 'tpl/testimonial-options.php' );



siteorigin_widget_register('testimonials', __FILE__, 'Testimonials');