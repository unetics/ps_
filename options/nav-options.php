<?php

if (!class_exists('nav-options-config')) {

    class nav_options_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            
            
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css) {
            log_me('The compiler hook has run!');
            do_action ( 'rebuild' );
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {
		global $theme_options;

            // ACTUAL DECLARATION OF SECTIONS

            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => 'General Settings', 
                'fields'    => array(
                    array(
                        'id'        => 'nav-type',
                        'type'      => 'button_set',
                        'title'     => 'Navigation Type',
                        'subtitle'  => 'Select the nav type that is required',
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => 'Bar', 
/*                             '2' => 'Sidebar',  */
                            '3' => 'none'
                        ), 
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'fullwidth',
                        'type'      => 'switch',
                        'required'  => array('nav-type', '=', '1'),
                        'title'     => 'Make Nav Fullwidth',
                        'subtitle'  => '',
                        'default'   => 1,
                    ),
                    array(
                        'id'            => 'nav-width',
                        'type'          => 'slider',
                        'title'         => 'nav-width',
                        'subtitle'      => 'this sets the nav width as % of page',
                        'required'  	=> array('fullwidth', '=', '0'),
                        'default'       => 100,
                        'min'           => 0,
                        'step'          => 5,
                        'max'           => 100,
                        'resolution'    => 1,
                        'display_value' => 'text',
                        'compiler'  => true,
                    ),

                 )
            );
            


            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => 'Desktop Menu',
                'heading' => '',
                'fields'    => array(

                    $fields = array(
			       'id' => 'logo-start',
			       'type' => 'section',
			       'title' => 'Logo Style Options',
			       'indent' => true,
			       'required'  => array('nav-type', '=', 1),
				   ),

                    array(
                        'id'        => 'desktop_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => 'Logo Desktop',
                        'compiler'  => 'true',
                        'readonly'	=> false,
                        'subtitle'  => 'upload a Desktop logo <a href="#">doc coming soon</a>',
                        'default'   => array('url' => 'http://assets.webcreationcentre.com.au/wcc-logo.png'),
                    ),
                    				 
					array(
					    'id'     => 'section-end',
					    'type'   => 'section',
					    'indent' => false,
					),

	                
                    $fields = array(
			       'id' => 'navbar-start',
			       'type' => 'section',
			       'title' => 'NavBar Style Options',
			       'indent' => true,
			       'required'  => array('nav-type', '=', 1),
				   ),

                    array(
                        'id'            => 'desktop_height',
                        'type'          => 'slider',
                        'title'         => 'Menu Height',
                        'subtitle'      => 'this sets the height of menu in px',
                        'default'       => 100,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 500,
                        'resolution'    => 1,
                        'display_value' => 'text',
                        'compiler'  => true,
                    ),
                    array(
                        'id'            => 'body_margin_top',
                        'type'          => 'slider',
                        'title'         => 'Body Margin Top',
                        'subtitle'      => 'this sets the height before page content in px (usually the same as menu height)',
                        'default'       => 100,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 500,
                        'resolution'    => 1,
                        'display_value' => 'text',
                        'compiler'  => true,
                    ),
						// Other field arrays go here.
						array(
	                        'id'        => 'background-colour',
	                        'type'      => 'color',
	                        'title'     => 'Background Colour',
	                        'default'   => 'white',
	                        'validate'  => 'color',
	                        'compiler'  => true,
	                    ),
	                    array(
	                        'id'        => 'desktop_shadow',
	                        'type'      => 'button_set',
	                        'title'     => 'Shadow Type',
// 	                        'subtitle'  => 'Select the nav type that is required',
	                        
	                        //Must provide key => value pairs for radio options
	                        'options'   => array(
		                        '0' => 'None',
	                            '1' => 'Small', 
	                            '2' => 'Medium', 
	                            '3' => 'Large'
	                        ), 
	                        'default'   => '1',
	                        'compiler'  => true,
	                    ),
					 
					array(
					    'id'     => 'section-end',
					    'type'   => 'section',
					    'indent' => false,
					),
					
					
					$fields = array(
			       'id' => 'menu-start',
			       'type' => 'section',
			       'title' => 'Menu Style Options',
			       'indent' => true,
			       'required'  => array('nav-type', '=', 1),
				   ),
						array(
						    'id'       => 'menu-link-color',
						    'type'     => 'link_color',
						    'title'    => 'Menu Top Links Colour',
						    'default'  => array(
						        'regular'  => $theme_options['font-colour'], 
						        'hover'    => $theme_options['primary-colour'], 
						        'active'   => $theme_options['primary-colour'], 
						    ),
						    'compiler'  => true,
						),
						array(
                        'id'            => 'desktop_typography',
                        'type'          => 'typography',
                        'title'         => 'Menu Typography',
                        'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => false,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'font-family'	=> false,
                        'line-height'   => true,
                        'letter-spacing'=> true,  // Defaults to false
                        'color'         => false,
                        'text-align'	=> false,
                        'default'       => array(
                            'font-style'    => '700',
                            'font-size'     => '16px',
                            'line-height'   => '30px',
                            'letter-spacing' => '3px',
                            'font-weight' => '700'),
                        'preview' => array('text' => 'ooga booga'),
                    ),
					 
					array(
					    'id'     => 'section-end',
					    'type'   => 'section',
					    'indent' => false,
					),
					
					
					
					$fields = array(
			       'id' => 'dropdown-start',
			       'type' => 'section',
			       'title' => 'Dropdown Style Options',
// 			       'subtitle' => 'Primary nav.',
			       'indent' => true,
			       'required'  => array('nav-type', '=', 1),
				   ),
				   
					   array(
						    'id'        => 'dropdown-color',
						    'type'      => 'color_rgba',
						    'title'     => 'Dropdown Background',
						 
						    'compiler'  => true,
						    'default'   => array(
						        'color'     => '#fdfdfd',
						        'alpha'     => 1
						    ),
						 
						    // These options display a fully functional color palette.  Omit this argument
						    // for the minimal color picker, and change as desired.
						    'options'       => array(
						        'show_input'                => true,
						        'show_initial'              => true,
						        'show_alpha'                => true,
						        'show_palette'              => false,
						        'show_palette_only'         => false,
						        'show_selection_palette'    => true,
						        'max_palette_size'          => 5,
						        'allow_empty'               => true,
						        'clickout_fires_change'     => true,
						        'choose_text'               => 'Choose',
						        'cancel_text'               => 'Cancel',
						        'show_buttons'              => true,
						        'use_extended_classes'      => true,
						        'palette'                   => null,  // show default
						        'input_text'                => 'Select Color'
						    ),                        
						),
						array(
						    'id'       => 'dropdown-link-color',
						    'type'     => 'link_color',
						    'title'    => 'Menu Top Links Colour',
						    'active'	=> false,
						    'default'  => array(
						        'regular'  => '#1e73be', // blue
						        'hover'    => '#dd3333', // red
						    ),
						),
						array(
                        'id'            => 'dropdown-typography',
                        'type'          => 'typography',
                        'title'         => 'dropdown Typography',
                        'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => false,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'font-family'	=> false,
                        'line-height'   => true,
                        'letter-spacing'=> true,  // Defaults to false
                        'color'         => false,
                        'text-align'	=> false,
                        'default'       => array(                            
                            'font-size'     => '16px',
                            'line-height'   => '30px',
                            'letter-spacing' => '3px',
                            'font-weight' => '400'),
                        'preview' => array('text' => 'ooga booga'),
                    ),
					 
					array(
					    'id'     => 'section-end',
					    'type'   => 'section',
					    'indent' => false,
					),					
					
                )
            );
            
            
            $this->sections[] = array(
                'icon'      => 'el-icon-tasks',
                'title'     => 'Descktop Scrolling Menu', 
                'fields'    => array(
	                array(
                        'id'            => 'desktop_scroll_trigger',
                        'type'          => 'slider',
                        'title'         => 'Scroll Trigger Braekpoint',
                        'subtitle'      => 'this sets the scroll from top in px 0px means no trigger',
                        'default'       => 100,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 500,
                        'resolution'    => 1,
                        'display_value' => 'text',
                        'compiler'  => true,
                    ),
                    
                    array(
                        'id'        => 'desktop_logo_scroll',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => 'Logo Desktop scroll',
                        'compiler'  => 'true',
                        'readonly'	=> false,
                        'subtitle'  => 'upload a Desktop logo <a href="#">doc coming soon</a>',
                        'default'   => '',
                        'required'  => array('desktop_scroll_trigger', '>=', 1),
                    ),
                   
                   $fields = array(
			       'id' => 'navbar-start',
			       'type' => 'section',
			       'title' => 'NavBar Style Options',
			       'indent' => true,
			       'required'  => array('nav-type', '=', 1),
				   ),

                    array(
                        'id'            => 'desktop_height_scroll',
                        'type'          => 'slider',
                        'title'         => 'Scroll Menu Height',
                        'subtitle'      => 'this sets the height of menu after scroll trigger in px',
                        'default'       => 100,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 500,
                        'resolution'    => 1,
                        'display_value' => 'text',
                        'compiler'  => true,
                    ),
						// Other field arrays go here.
						array(
	                        'id'        => 'desktop_background_scroll',
	                        'type'      => 'color',
	                        'title'     => 'Background Colour',
	                        'default'   => 'white',
	                        'validate'  => 'color',
	                        'compiler'  => true,
	                    ),
	                    array(
	                        'id'        => 'desktop_shadow_scroll',
	                        'type'      => 'button_set',
	                        'title'     => 'Shadow Type',
// 	                        'subtitle'  => 'Select the nav type that is required',
	                        
	                        //Must provide key => value pairs for radio options
	                        'options'   => array(
		                        '0' => 'None',
	                            '1' => 'Small', 
	                            '2' => 'Medium', 
	                            '3' => 'Large'
	                        ), 
	                        'default'   => '1',
	                        'compiler'  => true,
	                    ),
					 
					array(
					    'id'     => 'section-end',
					    'type'   => 'section',
					    'indent' => false,
					),
					
										$fields = array(
			       'id' => 'menu-start',
			       'type' => 'section',
			       'title' => 'Menu Style Options',
			       'indent' => true,
			       'required'  => array('nav-type', '=', 1),
				   ),
						array(
						    'id'       => 'menu-link-color_scroll',
						    'type'     => 'link_color',
						    'title'    => 'Menu Top Links Colour',
						    'default'  => array(
						        'regular'  => $theme_options['font-colour'], 
						        'hover'    => $theme_options['primary-colour'], 
						        'active'    => $theme_options['primary-colour'], 
						    ),
						),
						array(
                        'id'            => 'desktop_typography_scroll',
                        'type'          => 'typography',
                        'title'         => 'Menu Typography',
                        'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => false,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'font-family'	=> false,
                        'line-height'   => true,
                        'letter-spacing'=> true,  // Defaults to false
                        'color'         => false,
                        'text-align'	=> false,
                        'default'       => array(
                            'font-style'    => '700',
                            'font-size'     => '14px',
                            'line-height'   => '30px',
                            'letter-spacing' => '3px',
                            'font-weight' => '700'),
                        'preview' => array('text' => 'ooga booga'),
                    ),
					 
					array(
					    'id'     => 'section-end',
					    'type'   => 'section',
					    'indent' => false,
					),
                    
                    	                

	                                   
                 )
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-indent-right',
                'title'     => 'Mobile Menu', 
                'fields'    => array(
	                

                 )
            );
            
            $this->sections[] = array(
                'icon'      => 'el-icon-tasks',
                'title'     => 'Mobile Scrolling Menu', 
                'fields'    => array(
	                


                 )
            );
           
            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework-demo'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     

        }

        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'nav_options',
                'display_name' => 'Nav Options',
                'page_slug' => 'nav_options',
                'page_title' => 'Nav Options',
                'update_notice' => true,
                'menu_type' => 'submenu',
                'menu_title' => 'Nav Options',
                'allow_sub_menu' => true,
                'page_parent' => 'themes.php',
                'page_priority' => '1',
                'default_mark' => '*',
                'hints' => 
                array(
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'compiler' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => true,
                'disable_save_warn' => true,
                'database' => 'options',
                'transient_time' => '3600',
                'network_sites' => true,
                'hide_expand' => true,
                'dev_mode' => false,
              );
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new nav_options_config();
}

