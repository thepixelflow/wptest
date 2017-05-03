<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('admin_folder_Redux_Framework_config')) {

    class admin_folder_Redux_Framework_config {

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

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'business-one'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'business-one'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            $args['dev_mode'] = false;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
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

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'business-one'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','business-one'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','business-one'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'business-one'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'business-one'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'business-one') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
           
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('General Settings', 'business-one'),
                'icon'      => 'el-icon-home',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(

                   
                    
                    array(
                        'id'        => 'section-media-end',
                        'type'      => 'section',
                        'indent'    => false // Indent all options below until the next 'section' option is set.
                    ),
                    array(
                        'id'        => 'logo',
                        'type'      => 'media',
                        'title'     => __('Logo', 'business-one'),
                        'desc'      => __('Maximum logo size should be 200px x 30px, if you want to seem properly on retina screens, upload 400px x 30px.', 'business-one'),
                        'subtitle'  => __('Upload a Logo', 'business-one'),
                    ),
                    array(
                        'id'        => 'favicon',
                        'type'      => 'media',
                        'title'     => __('Favicon', 'business-one'),
                        'desc'      => __('Image should be ico format and 16x16 size ( Exp: favicon.ico ) ', 'business-one'),
                        'subtitle'  => __('Upload a favicon', 'business-one'),
                    ),  

                     array(
                        'id'        => 'opt-ace-editor-css',
                        'type'      => 'ace_editor',
                        'title'     => __('CSS Code', 'business-one'),
                        'subtitle'  => __('Paste your CSS code here.', 'business-one'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default'   => "body{\n}"
                    ),
                    array(
                        'id'        => 'opt-ace-editor-js',
                        'type'      => 'ace_editor',
                        'title'     => __('JS Code', 'business-one'),
                        'subtitle'  => __('Paste your JS code here.', 'business-one'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default'   => "jQuery(document).ready(function(){\n\n});"
                    ), 

                     array(
                        'id'        => 'credit',
                        'type'      => 'switch',
                        'title'     => __('Themes\' Credit Links', 'business-one'),
                        'subtitle'  => __('Theme by Burak Aydin | Powered by WordPress', 'business-one'),
                        'default'   => true,
                    ), 

                     array(
                        'id'        => 'opt-editor',
                        'type'      => 'editor',
                        'title'     => __('Footer Text', 'business-one'),                       
                        'default'   => '© Copyrights 2014. All Rights Reserved.',
                    ),                                    
                   
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('Homepage Settings', 'business-one'),
                'fields'    => array( 
                  array(
                        'id'        => 'opt-gallery',
                        'type'      => 'gallery',
                        'title'     => __('Add/Edit Slider', 'business-one'),
                        'subtitle'  => __('Create top slider. You can add multiple images.', 'business-one'),
                        'desc'      => __('Sliders\' images move, texts don\'t', 'business-one'),
                    ),
                    array(
                        'id'        => 'slider-title',
                        'type'      => 'text',
                        'title'     => __('Slider Title', 'business-one'),
                        'subtitle'  => __('No HTML is allowed.', 'business-one'),
                       
                        'validate'  => 'no_html',
                        'preg'      => array(
                            'pattern'       => '/[^a-zA-Z_ -]/s', 
                            'replacement'   => 'no numbers'
                         ),
                        'default'   => '0'
                    ),                  
                    
                    array(
                        'id'        => 'slider-text',
                        'type'      => 'textarea',
                        'title'     => __('Slider Description', 'business-one'),
                        'subtitle'  => __('Type some description', 'business-one'),                        
                        'validate'  => 'no_html',
                        'default'   => 'Sample Text'
                    ),

                    array(
                        'id'        => 'slider-url',
                        'type'      => 'text',
                        'title'     => __('Button Url for Slider', 'business-one'),
                        'subtitle'  => __('This must be a URL.', 'business-one'),
                        'desc'      => __('Url Validated', 'business-one'),
                        'validate'  => 'url',
                        'default'   => '',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ), 

                     array(
                        'id'    => 'opt-divide',
                        'type'  => 'divide'
                    ), 

                    array(
                        'id'        => 'divider-bg',
                        'type'      => 'media',
                        'title'     => __('Divider Image', 'business-one'),
                        'desc'      => __('Minimum height should be 1000px', 'business-one'),
                        'subtitle'  => __('Upload a background image of divider', 'business-one'),
                    ), 

                    array(
                        'id'        => 'divider-text',
                        'type'      => 'text',
                        'title'     => __('Divider Text', 'business-one'),
                        'subtitle'  => __('You can type a motto', 'business-one'),                        
                        'validate'  => 'no_html',
                        'default'   => ''
                    ), 

                     array(
                        'id'    => 'opt-divide',
                        'type'  => 'divide'
                    ), 


                     array(
                        'id'        => 'about-textarea',
                        'type'      => 'textarea',
                        'title'     => __('History in About Section', 'business-one'),
                        'subtitle'  => __('Type your company history.', 'business-one'),                        
                        'validate'  => 'no_html',
                        'default'   => ''
                    ),



                    array(
                        'id'    => 'opt-divide',
                        'type'  => 'divide'
                    ), 


                    array(
                        'id'        => 'service-bg',
                        'type'      => 'media',
                        'title'     => __('Service Image', 'business-one'),
                        'desc'      => __('Minimum height should be 1000px', 'business-one'),
                        'subtitle'  => __('Upload a background image of service section', 'business-one'),
                    ),  

                      array(
                        'id'        => 'service-notice',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'info',
                        'title'     => __('Extra Service Info for Service Section', 'business-one'),
                        
                    ),  

                     array(
                        'id'        => 'extra-img',
                        'type'      => 'media',
                        'title'     => __('Extra Service Image', 'business-one'),                        
                        'subtitle'  => __('Upload an image of extra service section', 'business-one'),
                    ),

                     array(
                        'id'        => 'extra-text',
                        'type'      => 'text',
                        'title'     => __('Extra Service Title', 'business-one'),
                        'subtitle'  => __('Type a title.', 'business-one'),                        
                        'validate'  => 'no_html',
                        'default'   => ''
                    ),  

                    array(
                        'id'        => 'extra-textarea',
                        'type'      => 'textarea',
                        'title'     => __('Extra Service Description', 'business-one'),
                        'subtitle'  => __('Type some description', 'business-one'),                        
                        'validate'  => 'no_html',
                        'default'   => ''
                    ), 

                    array(
                        'id'        => 'extra-url',
                        'type'      => 'text',
                        'title'     => __('Button Url for Extra Service', 'business-one'),
                        'subtitle'  => __('This must be a URL.', 'business-one'),
                        'desc'      => __('Url Validated', 'business-one'),
                        'validate'  => 'url',
                        'default'   => '',                       
                    ),

                     array(
                        'id'    => 'opt-divide',
                        'type'  => 'divide'
                    ),

                       array(
                        'id'        => 'client-bg',
                        'type'      => 'media',
                        'title'     => __('Client Section Background', 'business-one'),                        
                        'subtitle'  => __('Upload an image for client section', 'business-one'),
                    ),


                   
                )
            );




                $this->sections[] = array(
                'title'     => __('Homepage Descriptions', 'business-one'),
                'icon'      => 'el-icon-comment',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'        => 'about-text',
                        'type'      => 'textarea',
                        'title'     => __('About Section Description', 'business-one'),
                        'subtitle'  => __('It will be come under the About Sections\' title.', 'business-one'),                        
                        'validate'  => 'no_html',
                        'default'   => ''
                    ), 

                    array(
                        'id'        => 'portfolio-text',
                        'type'      => 'textarea',
                        'title'     => __('Portfolio Section Description', 'business-one'),
                        'subtitle'  => __('It will be come under the Portfolio Sections\' title.', 'business-one'),                        
                        'validate'  => 'no_html',
                        'default'   => ''
                    ),

                                                      
                   
                ),
            );

           
          
          

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'business-one') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'business-one') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'business-one') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'business-one') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            
            

            $this->sections[] = array(
                'title'     => __('Import / Export', 'business-one'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'business-one'),
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
                    
            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'business-one'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'business-one'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            

           

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>Theme by <a href="http://burak-aydin.com" target="_blank">Burak Aydin</a></p>', 'business-one');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'business',
                'display_name' => 'Business One WordPress Theme',
                'page_slug' => '_options',
                'page_title' => 'Business One Options',
                'intro_text' => '',
                'footer_text' => 'Business one Theme by Burak Aydin',
                'admin_bar' => '1',
                'menu_type' => 'submenu',
                'menu_title' => 'Business One Options',
                'allow_sub_menu' => '1',
                'page_parent_post_type' => 'your_post_type',
                'page_priority' => '100',
                'default_mark' => '*',
                'google_api_key' => 'muslum-baba',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_color' => '#dd3333',
                  'icon_size' => 'large',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                    'style' => 'youtube',
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
                      'effect' => 'fade',
                      'duration' => '100',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'effect' => 'fade',
                      'duration' => '100',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => '1',
                'compiler' => '1',
                'global_variable' => 'business',
                'page_icon' => 'icon-upload',
                'page_permissions' => 'manage_options',
                'save_defaults' => '1',
                'show_import_export' => '1',
                'last_tab' => '1',
                'transient_time' => '3600',
                'network_sites' => '1',
                'dev_mode' => false
              );

            
            $this->args['share_icons'][] = array(
                'url'   => 'http://burak-aydin.com/',
                'title' => 'My Personal Page',
                'icon'  => 'el-icon-website-alt'
            ); 

            $this->args['share_icons'][] = array(
                'url'   => 'http://profiles.wordpress.org/burakkaptan/',
                'title' => 'My WordPress Profile',
                'icon'  => 'el-icon-wordpress'
            );            
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.behance.net/buraksdu',
                'title' => 'Follow me on Behance',
                'icon'  => 'el-icon-behance'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://tr.linkedin.com/pub/burak-ayd%C4%B1n/91/800/181',
                'title' => 'Find me on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://twitter.com/buraksdu',
                'title' => 'Follow me on Twitter',
                'icon'  => 'el-icon-twitter'
            );

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new admin_folder_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('admin_folder_my_custom_field')):
    function admin_folder_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('admin_folder_validate_callback_function')):
    function admin_folder_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
