<?php

/*
 * Titan Framework options sample code. We've placed here some
 * working examples to get your feet wet
 * @see	http://www.titanframework.net/get-started/
 */


add_action( 'tf_create_options', 'demo_ather_create_options' );

/**
 * Initialize Titan & options here
 */
function demo_ather_create_options() {

	$titan = TitanFramework::getInstance( 'demo_ather' );
	
	
	/**
	 * Create a Theme Customizer panel where we can edit some options.
	 * You should put options here that change the look of your theme.
	 */
	


    $myMetaBox = $titan->createMetaBox( array(
        'name' => 'Testimonial Options',
        'post_type' => 'testimonial',
    ) );

    $myMetaBox->createOption( array(
        'name' => __( 'Username', 'demo_ather' ),
        'id' => 'testimonial_user',
        'type' => 'text',
        'desc' => __( '', 'demo_ather' ),
    ) );

    $myMetaBox->createOption( array(
        'name' => __( 'User Url', 'demo_ather' ),
        'id' => 'testimonial_url',
        'type' => 'text',
        'desc' => __( '', 'demo_ather' ),
    ) );


// Customizer options

    $uso_testimonials = $titan->createThemeCustomizerSection( array(
        'name' => 'Color Options',
        'panel' => 'Testimonial',
    ) );

    $uso_testimonials->createOption( array(
        'name' => 'Background Color',
        'id' => 'background_color',
        'type' => 'color',
        'desc' => 'Pick a color',
        'default' => '#EEE',
        'css' => '.testimonial_content { background-color: value !important; }'
    ) );


    $uso_testimonials->createOption( array(
        'name' => 'Text Color',
        'id' => 'text_color',
        'type' => 'color',
        'desc' => 'Pick a color',
        'default' => '#888',
        'css' => '.testimonial_content p { color: value !important; }'
    ) );





}