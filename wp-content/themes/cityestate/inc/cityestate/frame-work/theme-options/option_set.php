<?php

    // RDX Framework Barebones Sample Config File     
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name;
    $opt_name = "cityestate_options";
    
    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options','cityestate'),
        'page_title'           => esc_html__( 'Theme Options','cityestate'),
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
        'admin_bar_icon'       => 'dashicons-admin-settings',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose a priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
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
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_cityestate_options',
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
        
        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
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

    Redux::setArgs( $opt_name, $args );

    $allowed_html_array = array(
        'i' => array(
            'class' => array()
        ),
        'span' => array(
            'class' => array()
        ),
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array()
        )
    );

    // Set General Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/general.php';

    // Set Logo And Favicon Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/logo-favicon.php';

    // Set Headers Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/headers.php';

    // My Account Pages
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/my-account.php';

    // Set Login And Register Option
    if( class_exists('CityEstate_User_Login_Register') ):
        require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/login-register.php';
    endif;

    // Set Price And Currency Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/price-currency.php';

    // Set Typography Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/typography.php';

    // Set Style Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/style.php';

    // Set Property Detail Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/property.php';

    // Set Print Property Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/print-property.php';

    // Set Add Property Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/add-property.php';

    // Set Contact Form 7 Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/contact-form-7.php';

    // Set Payment And Membership Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/payment-membership.php';

    // Set Email Management Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/email-management.php';

    // Set Advance Search Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/advance-search.php';

    // Set Property Taxonomy Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/property-taxonomy.php';

    // Set Google Map Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/google-map.php';

    // Set Agents Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/agents.php';

    // Set Search 404 Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/search-404.php';

    // Set Blog Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/blog.php';
    
    // Set Custom Code Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/custom-code.php';

    // Set Footer Option
    require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/options/footer.php';