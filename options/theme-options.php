<?php

if (!class_exists('theme-options-config')) {

    class theme_options_config {

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


            // ACTUAL DECLARATION OF SECTIONS

            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => 'General Settings', 
                'fields'    => array(
                    array(
                        'id'        => 'fav-icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => 'Fav Icon',
                        'compiler'  => 'true',
                        'readonly'	=> false,
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle'  => 'upload a valid fav Icon <a href="#">doc coming soon</a>',
                        'default'   => array('url' => 'http://assets.webcreationcentre.com.au/favicon.ico'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),

                    array(
                        'id'        => 'analitics',
                        'type'      => 'text',
                        'title'     => 'Analitics Code',
                        'subtitle'  => 'Add Your Google Analitics tracking code here dont have one?<br/> <a href="#">how to get a tracking code</a>',
                        'default'   => '',
                        'placeholder' => 'UA-000000000-7',
                    ),
                    array(
                        'id'        => 'GoogleWT',
                        'type'      => 'text',
                        'title'     => 'Google Webmaster Tools',
                        'subtitle'  => 'Add Your Google Webmaster Tools Verification Code. dont have one?<br/> <a href="#">how to get a Verification Code</a>',
                        'default'   => '',
                        'placeholder' => 'AD8bg8lslMSyINKNJvplGyZH-WzK9j5paGpo29_khao',
                    ),
                    
                    array(
                        'id'        => 'copyright',
                        'type'      => 'editor',
                        'title'     => 'Footer Text',
                        'subtitle'  => 'You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]',
                        'default'   => '&copy; [current-year] Webcreationcentre',
                        'args'   => array(
					        'teeny'            => true,
					        'textarea_rows'    => 3,
					        'media_buttons'	   => false,
					    )
                    ),
                )
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => 'Styling Options',
                'fields'    => array(
                    array(
                        'id'        => 'primary-colour',
                        'type'      => 'color',
                        'title'     => 'Primary Colour',
                        'default'   => '#1FDA9A',
                        'validate'  => 'color',
                        'transparent' => false,
                        'compiler'  => true,
                    ),
                    array(
                        'id'        => 'accent-colour',
                        'type'      => 'color',
                        'title'     => 'Accent Colour',
                        'default'   => '#EE4B3E',
                        'validate'  => 'color',
                        'transparent' => false,
                        'compiler'  => true,
                    ),
                    array(
                        'id'        => 'background-colour',
                        'type'      => 'color',
                        'title'     => 'Background Colour',
                        'default'   => '#F2F2F3',
                        'validate'  => 'color',
                        'transparent' => false,
                        'compiler'  => true,
                    ),
                    array(
                        'id'        => 'font-colour',
                        'type'      => 'color',
                        'title'     => 'Font Colour',
                        'default'   => '#333333',
                        'validate'  => 'color',
                        'transparent' => false,
                        'compiler'  => true,
                    ),
                    array(
                        'id'            => 'rounding',
                        'type'          => 'slider',
                        'title'         => 'Rounding',
                        'subtitle'      => 'This sets border radius on items dynamicly',
                        'default'       => 0,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 30,
                        'resolution'    => 1,
                        'display_value' => 'text',
                        'compiler'  => true,
                    ),
                )
            );

                        
            $this->sections[] = array(
                'icon'      => 'el-icon-list-alt',
                'title'     => 'Advanced Options (will work next update)',
                'fields'    => array(
                    array(
                        'id'        => 'custom-css',
                        'type'      => 'ace_editor',
                        'title'     => 'CSS Code',
                        'subtitle'  => 'Paste your CSS code here.',
                        'mode'      => 'css',
                        'theme'     => 'chrome',
                        'default'   => "#testid{\nmargin: 0 auto;\n}"
                    ),

                    array(
                        'id'        => 'custom-js',
                        'type'      => 'ace_editor',
                        'title'     => 'JS Code',
                        'subtitle'  => 'Paste your JS code here.',
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'default'   => "jQuery(document).ready(function(){\n\n});"
                    ),
                    
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
                'opt_name' => 'theme_options',
                'display_name' => 'Theme Options',
                'page_slug' => '_options',
                'page_title' => 'Theme Options',
                'update_notice' => true,
                'menu_type' => 'submenu',
                'menu_title' => 'Theme Options',
                'allow_sub_menu' => true,
                'page_parent' => 'themes.php',
                'page_parent_post_type' => 'your_post_type',
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
    $reduxConfig = new theme_options_config();
}

