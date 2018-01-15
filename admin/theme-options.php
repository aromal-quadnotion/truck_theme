<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
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

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>'.esc_html__('The compiler hook has run!', 'oscar').'</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                

               
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => esc_html__( 'Section via hook', 'oscar' ),
                    'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'oscar' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            
            public function setSections() {

                

                
                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( esc_html__( 'Customize &#8220;%s&#8221;', 'oscar' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'oscar' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'oscar' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo esc_html($this->theme->display( 'Name' )); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( esc_html__( 'By %s', 'oscar' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( esc_html__( 'Version %s', 'oscar' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . esc_html__( 'Tags', 'oscar' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo esc_html($this->theme->display( 'Description' )); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . esc_html__( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'oscar' ) . '</p>', esc_html__( 'http://codex.wordpress.org/Child_Themes', 'oscar' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( get_template_directory().'/admin/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( get_template_directory().'/admin/info-html.html' );
                }


                
                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                    'icon'   => 'ion ion-settings',
                    'title'  => esc_html__( 'General Settings', 'oscar' ),
                    'fields' => array(
                        array(
                            'id'       => 'highlight_color',
                            'type'     => 'color',
                            'output'   => array( '.main' ),
                            'title'    => esc_html__( 'Highlight Color', 'oscar' ),
                            'subtitle' => esc_html__( 'Pick a highlight color for the theme (default: #FFE902).', 'oscar' ),
                            'default'  => '#FFE902',
                            'validate' => 'color',
                            'transparent' => false
                        ),
                        array(
                            'id'       => 'loading-animation-opt',
                            'type'     => 'switch', 
                            'title'    => esc_html__( 'Page Loading Animation', 'oscar' ),
                            'subtitle' => '',
                            'on'       => 'ON',
                            'off'      => 'OFF',
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'load-animation',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Loading Image', 'oscar' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'oscar' ),
                            
                        ),
                        array(
                            'id'       => 'load-animation2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Loading Image (Retina)', 'oscar' ),
                            'subtitle' => esc_html__( 'Upload your loading image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'oscar' ),
                        ),
                        array(
                            'id'       => 'mob_nav_logo',
                            'type'     => 'media',
                            'title'    => __( 'Mobile Navigation Logo', 'oscar' ),
                            'subtitle'     => __( 'Upload or Select the logo. ', 'oscar' ),
                            
                        ),
                        array(
                            'id'       => 'mob_nav_logo2x',
                            'type'     => 'media',
                            'title'    => __( 'Mobile Navigation Logo (Retina)', 'oscar' ),
                            'subtitle' => __( 'Upload your logo for retina display.<br>It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. <br/>Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'oscar' ),
                        ),
                        array(
                            'id'       => 'blog-header',
                            'type'     => 'switch', 
                            'title'    => esc_html__( 'Blog Header Text', 'oscar' ),
                            'on'       => esc_html__('SHOW', 'oscar'),
                            'off'      => esc_html__('HIDE', 'oscar'),
                            'default'  => true
                        ),
                        array(
                            'id' => 'blog-header-title',
                            'type' => 'text',
                            'title' => esc_html__('Blog Header Title', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => '',
                            'required' => array(
                                array('blog-header', 'equals' , true),
                            )
                        ),
                        array(
                            'id' => 'blog-header-promo',
                            'type' => 'text',
                            'title' => esc_html__('Blog Header Promotional Text', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => '',
                            'required' => array(
                                array('blog-header', 'equals' , true),
                            )
                        ),
                        array(
                            'id' => 'google-map-api-key',
                            'type' => 'text',
                            'title' => esc_html__('Google Map Api Key', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => ''
                        ),

                    )
                );
                

                $this->sections[] = array(
                    'icon'   => 'ion ion-arrow-down-c',
                    'title'  => esc_html__( 'Vertical Header Settings', 'oscar' ),
                    'fields' => array(
                        array(
                            'id'       => 'verti-head-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Logo Image', 'oscar' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'oscar' ),
                            
                        ),
                        array(
                            'id'       => 'verti-head-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Logo Image (Retina)', 'oscar' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'oscar' ),
                        ),
                        array(
                            'id'          => 'oscar-social-media-icons',
                            'type'        => 'slides',
                            'title'       => esc_html__( 'Social Icon Options', 'oscar' ),
                            'subtitle'    => esc_html__( 'Unlimited icons with drag and drop option.', 'oscar' ),
                            'url'         => true,
                            'description' => false,
                            'placeholder' => array(
                                'title'   => esc_html__( 'Title', 'oscar' )
                            ),
                        ),
                        
                        
                        
                        
                        
                    )   
                );
                                

                
                
                $this->sections[] = array(
                    'icon'   => 'el-icon-envelope',
                    'title'  => esc_html__( 'Contact Form Settings', 'oscar' ),
                    'fields' => array(
                        array(
                            'id' => 'name_placeholder',
                            'type' => 'text',
                            'title' => esc_html__('Placeholder For Name', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Your Name', 'oscar')
                            ),
                        array(
                            'id' => 'name_err_msg',
                            'type' => 'text',
                            'title' => esc_html__('Error Message For Name', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Name must not be empty', 'oscar')
                            ),
                        array(
                            'id' => 'email_placeholder',
                            'type' => 'text',
                            'title' => esc_html__('Placeholder For Email', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Your Email ID', 'oscar')
                            ),
                        array(
                            'id' => 'email_err_msg',
                            'type' => 'text',
                            'title' => esc_html__('Error Message For Email', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Please provide a valid email', 'oscar')
                            ),
                        array(
                            'id' => 'message_placeholder',
                            'type' => 'text',
                            'title' => esc_html__('Placeholder For Message', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Your Message', 'oscar')
                            ),
                        array(
                            'id' => 'message_err_msg',
                            'type' => 'text',
                            'title' => esc_html__('Error Message For Message', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Message should not be empty', 'oscar')
                            ),
                        array(
                            'id' => 'submit_btn_txt',
                            'type' => 'text',
                            'title' => esc_html__('Text For Submit Button', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Send Message', 'oscar')
                            ),
                        array(
                            'id' => 'thanks_msg_header',
                            'type' => 'text',
                            'title' => esc_html__('Thanks Message Header', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Thanks For Your Comment', 'oscar')
                            ),
                        array(
                            'id' => 'thanks_msg',
                            'type' => 'textarea',
                            'title' => esc_html__('Thanks Message', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Lorem ipsum dolor siter amet mundium corpes illon tolves lorem ipsum dolor. Quisque nec est id ante consectetur tristique. Suspendisse potenti.', 'oscar')
                            ),
                        array(
                            'id' => 'contact_email',
                            'type' => 'text',
                            'title' => esc_html__('Contact form Email', 'oscar'),
                            'validate' => 'email', 
                            'subtitle' => esc_html__('Contact form submissions will be mailed to this address', 'oscar'),
                            'default' => 'mail@domain.tld'
                            ),
                        array(
                            'id' => 'contact_email_sub',
                            'type' => 'text',
                            'title' => esc_html__('Contact Email Subject', 'oscar'),
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => esc_html__('Contact form submission from Signature', 'oscar')
                            )

                    )
                );


                

                $this->sections[] = array(
                    'icon'   => 'ion ion-ios7-paw',
                    'title'  => esc_html__( 'Footer Settings', 'oscar' ),
                    'fields' => array(
                        array(
                            'id' => 'oscar-footer-lft-title',
                            'type' => 'text',
                            'title' => esc_html__('Left Panel Title', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => 'Oscar',
                        ),
                         array(
                            'id' => 'oscar-footer-lft-txt',
                            'type' => 'textarea',
                            'title' => esc_html__('Left Panel Text Content', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => 'A homegrown design studio from Berlin.<br/> We create beatuful identities & amazing logo for modern business.',
                        ),
                        array(
                            'id' => 'oscar-footer-rht-title',
                            'type' => 'text',
                            'title' => esc_html__('Right Panel Title', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => '&copy;',
                        ),
                         array(
                            'id' => 'oscar-footer-rht-txt',
                            'type' => 'textarea',
                            'title' => esc_html__('Right Panel Text Content', 'oscar'), 
                            'subtitle' => esc_html__('', 'oscar'),
                            'default' => 'Copyright 2016 Designova.<br/>Creative WordPress theme.',
                        ),
                        
                        
                        
                    )
                );

                

                $this->sections[] = array(
                    'icon'   => 'ion ion-code',
                    'title'  => esc_html__( 'Additional CSS', 'oscar' ),
                    'fields' => array(
                        array(
                            'id'       => 'additional_css',
                            'type'     => 'ace_editor',
                            'title'    => esc_html__( 'Additional CSS Code', 'oscar' ),
                            'subtitle' => esc_html__( 'Paste your CSS code here.', 'oscar' ),
                            'mode'     => 'css',
                            'theme'    => 'monokai',
                            'desc'     => '',
                            'default'  => "#item-selector{\nmargin: 0 auto;\n}"
                        )
                        
                    )
                );

                $this->sections[] = array(
                    'id'     => 'wbc_importer_section',
                    'title'  => esc_html__( 'Demo Importer', 'oscar' ),
                    'desc'   => '<p class="description">'. apply_filters( 'wbc_importer_description', esc_html__( 'Works best to import on a new install of WordPress', 'oscar' ) ).'</p>',
                    'icon'   => 'el-icon-delicious',
                    'fields' => array(
                        array(
                            'id'   => 'wbc_demo_importer',
                            'type' => 'wbc_importer'
                        )
                    )
                );

                

                $theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__( '<strong>Theme URL:</strong> ', 'oscar' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__( '<strong>Author:</strong> ', 'oscar' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__( '<strong>Version:</strong> ', 'oscar' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__( '<strong>Tags:</strong> ', 'oscar' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

                

                

                

                $this->sections[] = array(
                    'title'  => esc_html__( 'Import / Export', 'oscar' ),
                    'desc'   => esc_html__( 'Import and Export your Redux Framework settings from file, text or URL.', 'oscar' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => esc_html__('Save and restore your Redux options', 'oscar'),
                            'full_width' => false,
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-info-circle',
                    'title'  => esc_html__( 'Theme Information', 'oscar' ),
                    'desc'   => esc_html__( '<p class="description">This is the Description. Again HTML is allowed</p>', 'oscar' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

                
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => esc_html__( 'Theme Information 1', 'oscar' ),
                    'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'oscar' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => esc_html__( 'Theme Information 2', 'oscar' ),
                    'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'oscar' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'oscar' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'oscar_wp',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => esc_html__( 'Theme Options', 'oscar' ),
                    'page_title'           => esc_html__( 'Theme Options', 'oscar' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-heart',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => true,
                    // Show the time the page took to load, etc
                    'update_notice'        => false,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => false,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => 'dashicons-heart',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'oscar_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                

                $this->args['admin_bar_links'][] = array(
                    'id'    => 'oscar-support',
                    'href'   => 'https://www.designova.net/support.html',
                    'title' => esc_html__( 'Support', 'oscar' ),
                );

                

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/designovastudio/',
                    'title' => esc_html__('Like us on Facebook', 'oscar'),
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://twitter.com/designovastudio/',
                    'title' => esc_html__('Follow us on Twitter','oscar'),
                    'icon'  => 'el-icon-twitter'
                );
                

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( esc_html__( 'For theme support please contact us through our support system: http://www.designova.net/support.html', 'oscar' ), $v );
                } else {
                    $this->args['intro_text'] = esc_html__( 'For theme support please contact us through our support system: http://www.designova.net/support.html', 'oscar' );
                }

                // Add content after the form.
                $this->args['footer_text'] = esc_html__( 'For theme support please contact us through our support system: http://www.designova.net/support.html', 'oscar' );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                

                $return['value'] = $value;
                $field['msg']    = esc_html__('your custom error message', 'oscar');
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo 'CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
    } else {
        echo esc_html__("The class named Redux_Framework_sample_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>", "oscar");
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            

            $return['value'] = $value;
            $field['msg']    = esc_html__('your custom error message', 'oscar');
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;
