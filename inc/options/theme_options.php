<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (! class_exists('Redux')) {
    return;
}

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('opt_name', 'theme_opts');

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => $theme->get('Name'),
    'page_title' => $theme->get('Name'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => true,
    // Use a asynchronous font on the front end or font string
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-smiley',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    // 'open_expanded' => true, // Allow you to start the panel in an expanded way initially.
    'disable_save_warn' => true, // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-dashboard',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'dashicons-smiley',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit' => '', // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => ''
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right'
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover'
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave'
            )
        )
    )
);

Redux::setArgs($opt_name, $args);

/**
 * General Options.
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('General', 'cms-theme-framework'),
    'icon' => 'el-icon-adjust-alt',
    'fields' => array(
        array(
            'title'             => esc_html__('Layout', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Full width / Boxed.', 'cms-theme-framework'),
            'id'                => 'general_layout',
            'type'              => 'button_set',
            'options'           => array(
                                        1 => esc_html__('Full width', 'cms-theme-framework'),
                                        0 => esc_html__('Boxed', 'cms-theme-framework')
                                    ),
            'default'           => 1
        ),
        array(
            'title'             => esc_html__('Body Background', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Body background.', 'cms-theme-framework'),
            'id'                => 'general_background',
            'type'              => 'background',
            'output'            => array( 'body' ),
            'required'          => array( 'general_layout', '=', 0 )
        ),
        array(
            'title'             => esc_html__('Content Background', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Content background.', 'cms-theme-framework'),
            'id'                => 'general_content_background',
            'type'              => 'background',
            'output'            => array( '#content' ),
            'required'          => array( 'general_layout', '=', 0 )
        ),
        array(
            'subtitle'          => esc_html__('Enable back to top button.', 'cms-theme-framework'),
            'id'                => 'general_back_to_top',
            'type'              => 'switch',
            'title'             => esc_html__('Back To Top', 'cms-theme-framework'),
            'default'           => true,
        )
    )
));

/**
 * Header Options
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'cms-theme-framework'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id'                => 'header_layout',
            'title'             => esc_html__('Layouts', 'cms-theme-framework'),
            'subtitle'          => esc_html__('select a layout for header', 'cms-theme-framework'),
            'default'           => 'default',
            'type'              => 'image_select',
            'options'           => array(
                                        'default' => get_template_directory_uri().'/assets/images/header/h-style-1.png',
                                        'top' => get_template_directory_uri().'/assets/images/header/h-style-2.png'
                                    )
        ),
        array(
            'title'             => esc_html__('Logo Type', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Image / Text.', 'cms-theme-framework'),
            'id'                => 'logo_type',
            'type'              => 'button_set',
            'options'           => array(
                1 => esc_html__('Image', 'cms-theme-framework'),
                0 => esc_html__('Text', 'cms-theme-framework')
            ),
            'default'           => 1
        ),
        array(
            'title'             => esc_html__('Select Logo', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'cms-theme-framework'),
            'id'                => 'main_logo',
            'type'              => 'media',
            'url'               => true,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            ),
            'required'          => array( 'logo_type', '=', 1 )
        ),
        array(
            'subtitle'          => esc_html__('Set max height for logo.', 'cms-theme-framework'),
            'id'                => 'logo_max_height',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'width'             => false,
            'title'             => esc_html__('Logo Height', 'cms-theme-framework'),
            'required'          => array( 'logo_type', '=', 1 )
        ),
        array(
            'subtitle'          => esc_html__('Add custom logo text.', 'cms-theme-framework'),
            'id'                => 'logo_text',
            'type'              => 'text',
            'title'             => esc_html__('Logo Text', 'cms-theme-framework'),
            'required'          => array( 'logo_type', '=', 0 )
        ),
        array(
            'subtitle'          => esc_html__('Add custom sologan Text.', 'cms-theme-framework'),
            'id'                => 'logo_text_sologan',
            'type'              => 'text',
            'title'             => esc_html__('Sologan Text', 'cms-theme-framework'),
            'required'          => array( 'logo_type', '=', 0 )
        ),
        array(
            'id'                => 'header_background_color',
            'type'              => 'color_rgba',
            'title'             => __( 'Background Color', 'cms-theme-framework' ),
            'subtitle'          => __( 'Header background color', 'cms-theme-framework' ),
        ),
        array(
            'title'             => esc_html__('Background Image', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Header background image.', 'cms-theme-framework'),
            'id'                => 'header_background_image',
            'type'              => 'background',
            'preview'           => false,
            'background-color'  => false,
            'output'            => array( '#cshero-header' )
        ),
        array(
            'id'                => 'header_text_color',
            'type'              => 'color',
            'title'             => __( 'Text Color', 'cms-theme-framework' ),
            'subtitle'          => __( 'Select text color in header', 'cms-theme-framework' ),
            'output'            => array( '#cshero-header' ),
        ),
        array(
            'id'                => 'header_link_color',
            'type'              => 'link_color',
            'title'             => __( 'Links Color', 'cms-theme-framework' ),
            'subtitle'          => __( 'Select links color in header', 'cms-theme-framework' ),
            'regular'           => true,
            'hover'             => true,
            'active'            => true,
            'visited'           => true,
            'output'            => array( '#cshero-header a' ),
        ),
        array(
            'subtitle'          => esc_html__('Enable mega menu.', 'cms-theme-framework'),
            'id'                => 'mega_menu',
            'type'              => 'switch',
            'title'             => esc_html__('Mega Menu', 'cms-theme-framework'),
            'default'           => false,
        ),
    )
));

/* Menu Sticky */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-minus',
    'title' => esc_html__('Menu Sticky', 'cms-theme-framework'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle'          => esc_html__('enable sticky mode for menu.', 'cms-theme-framework'),
            'id'                => 'menu_sticky',
            'type'              => 'switch',
            'title'             => esc_html__('Sticky Header', 'cms-theme-framework'),
            'default'           => false,
        ),
        array(
            'title'             => esc_html__('Logo Type', 'cms-theme-framework'),
            'subtitle'          => esc_html__('From Main / Image / Text.', 'cms-theme-framework'),
            'id'                => 'sticky_logo_type',
            'type'              => 'button_set',
            'options'           => array(
                'default' => esc_html__('Main', 'cms-theme-framework'),
                'img' => esc_html__('Image', 'cms-theme-framework'),
                'text' => esc_html__('Text', 'cms-theme-framework')
            ),
            'default'           => null,
            'required'          => array( 'menu_sticky', '=', 1 )
        ),
        array(
            'title'             => esc_html__('Select Logo', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'cms-theme-framework'),
            'id'                => 'sticky_logo',
            'type'              => 'media',
            'url'               => true,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            ),
            'required'          => array( 'sticky_logo_type', '=', 'img' )
        ),
        array(
            'subtitle'          => esc_html__('Add custom logo text.', 'cms-theme-framework'),
            'id'                => 'sticky_logo_text',
            'type'              => 'text',
            'title'             => esc_html__('Logo Text', 'cms-theme-framework'),
            'required'          => array( 'sticky_logo_type', '=', 'text' )
        ),
        array(
            'subtitle'          => esc_html__('Add custom sologan Text.', 'cms-theme-framework'),
            'id'                => 'sticky_logo_text_sologan',
            'type'              => 'text',
            'title'             => esc_html__('Sologan Text', 'cms-theme-framework'),
            'required'          => array( 'sticky_logo_type', '=', 'text' )
        ),
        array(
            'id'                => 'sticky_background_color',
            'type'              => 'color_rgba',
            'title'             => __( 'Background Color', 'cms-theme-framework' ),
            'subtitle'          => __( 'Header background color', 'cms-theme-framework' ),
            'required'          => array( 'menu_sticky', '=', 1 )
        ),
        array(
            'title'             => esc_html__('Background Image', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Header background image.', 'cms-theme-framework'),
            'id'                => 'sticky_background_image',
            'type'              => 'background',
            'preview'           => false,
            'background-color'  => false,
            'output'            => array('#cshero-header.sticky-desktop.header-fixed'),
            'required'          => array( 'menu_sticky', '=', 1 )
        )
    )
));

/**
 * Page Title
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Title & BC', 'cms-theme-framework'),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id'                => 'page_title_layout',
            'title'             => esc_html__('Layouts', 'cms-theme-framework'),
            'subtitle'          => esc_html__('select a layout for page title', 'cms-theme-framework'),
            'default'           => '5',
            'type'              => 'image_select',
            'options'           => array(
                                    '2' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-1.png',
                                    '3' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-2.png',
                                    '4' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-3.png',
                                    '5' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-4.png',
                                    '6' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-5.png',
                                    '7' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-6.png',
                                )
        ),
        array(
            'title'             => esc_html__('Background', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Page title background.', 'cms-theme-framework'),
            'id'                => 'page_title_background',
            'type'              => 'background',
            'output'            => array( '#page-title' )
        ),
        array(
            'title'             => esc_html__('Typography', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Page title typography.', 'cms-theme-framework'),
            'id'                => 'page_title_typography',
            'type'              => 'typography',
            'google'            => true,
            'output'            => array( '#page-title #page-title-text h1' )
        ),
        array(
            'title'             => esc_html__('Padding', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Page title padding (top/bottom).', 'cms-theme-framework'),
            'id'                => 'page_title_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array( 'em', 'px', '%' ),
            'top'               => true,
            'right'             => false,
            'bottom'            => true,
            'left'              => false,
            'output'            => array( '#page-title' )
        ),
    )
));

/* Breadcrumb */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-random',
    'title' => esc_html__('Breadcrumb', 'cms-theme-framework'),
    'subsection' => true,
    'fields' => array(
        array(
            'title'             => esc_html__('Typography', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Breadcrumb typography.', 'cms-theme-framework'),
            'id'                => 'breadcrumb_typography',
            'type'              => 'typography',
            'google'            => true,
            'output'            => array( '#page-title #breadcrumb-text' )
        ),
        array(
            'id'                => 'breadcrumb_link_color',
            'type'              => 'link_color',
            'title'             => __( 'Link Color', 'cms-theme-framework' ),
            'subtitle'          => __( 'Select link color in breadcrumb', 'cms-theme-framework' ),
            'output'            => array( '#page-title #breadcrumb-text ul li a' ),
        ),
    )
));

/**
 * Content
 *
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'cms-theme-framework'),
    'icon' => 'el-icon-pencil',
    'fields' => array(
    )
));

/* archive */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Archive', 'cms-theme-framework'),
    'icon' => 'el-icon-list',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'archive_layout',
            'title'             => esc_html__('Layouts', 'cms-theme-framework'),
            'subtitle'          => esc_html__('select a layout for archive, search, index...', 'cms-theme-framework'),
            'default'           => 'right',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
        array(
            'subtitle'          => esc_html__('Show author.', 'cms-theme-framework'),
            'id'                => 'archive_author',
            'type'              => 'switch',
            'title'             => esc_html__('Author', 'cms-theme-framework'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show categories.', 'cms-theme-framework'),
            'id'                => 'archive_categories',
            'type'              => 'switch',
            'title'             => esc_html__('Categories', 'cms-theme-framework'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show tags.', 'cms-theme-framework'),
            'id'                => 'archive_tag',
            'type'              => 'switch',
            'title'             => esc_html__('Tags', 'cms-theme-framework'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show comment count.', 'cms-theme-framework'),
            'id'                => 'archive_comment',
            'type'              => 'switch',
            'title'             => esc_html__('Comment', 'cms-theme-framework'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show date time.', 'cms-theme-framework'),
            'id'                => 'archive_date',
            'type'              => 'switch',
            'title'             => esc_html__('Date', 'cms-theme-framework'),
            'default'           => true,
        )
    )
));

/* Single */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Single', 'cms-theme-framework'),
    'icon' => 'el-icon-file-edit',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'single_layout',
            'title'             => esc_html__('Layouts', 'cms-theme-framework'),
            'subtitle'          => esc_html__('select a layout for single...', 'cms-theme-framework'),
            'default'           => 'right',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
        array(
            'subtitle'          => esc_html__('Show author.', 'cms-theme-framework'),
            'id'                => 'single_author',
            'type'              => 'switch',
            'title'             => esc_html__('Author', 'cms-theme-framework'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show categories.', 'cms-theme-framework'),
            'id'                => 'single_categories',
            'type'              => 'switch',
            'title'             => esc_html__('Categories', 'cms-theme-framework'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show tags.', 'cms-theme-framework'),
            'id'                => 'single_tag',
            'type'              => 'switch',
            'title'             => esc_html__('Tags', 'cms-theme-framework'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show comment count.', 'cms-theme-framework'),
            'id'                => 'single_comment',
            'type'              => 'switch',
            'title'             => esc_html__('Comment', 'cms-theme-framework'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show date time.', 'cms-theme-framework'),
            'id'                => 'single_date',
            'type'              => 'switch',
            'title'             => esc_html__('Date', 'cms-theme-framework'),
            'default'           => true,
        )
    )
));

/**
 * Styling
 * 
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Styling', 'cms-theme-framework'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => esc_html__('Set color main color.', 'cms-theme-framework'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'cms-theme-framework'),
            'default' => '#6e4692'
        ),
        array(
            'id'       => 'link_color',
            'type'     => 'link_color',
            'title'    => __( 'Links Color', 'cms-theme-framework' ),
            'subtitle' => __( 'Select Links Color Option', 'cms-theme-framework' ),
            'regular'   => true,
            'hover'     => true,
            'active'    => true,
            'visited'   => true,
            'output'   => array( 'a' ),
        ),
    )
));

/**
 * Typography
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'cms-theme-framework'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'cms-theme-framework')
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => esc_html__('H1', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h1'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'cms-theme-framework')
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => esc_html__('H2', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h2'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'cms-theme-framework')
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => esc_html__('H3', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h3'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'cms-theme-framework')
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => esc_html__('H4', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h4'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'cms-theme-framework')
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => esc_html__('H5', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h5'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'cms-theme-framework')
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => esc_html__('H6', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h6'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'cms-theme-framework')
        )
    )
));

/* extra font. */
$custom_font_1 = Redux::getOption($opt_name, 'google-font-selector-1');
$custom_font_1 = !empty($custom_font_1) ? explode(',', $custom_font_1) : array();

Redux::setSection($opt_name, array(
    'title' => esc_html__('Extra Fonts', 'cms-theme-framework'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => esc_html__('Custom Font', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  =>  $custom_font_1,
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'cms-theme-framework'),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-weight' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => esc_html__('Selector 1', 'cms-theme-framework'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'cms-theme-framework'),
            'validate' => 'no_html',
            'default' => '',
        )
    )
));

/**
 * Footer
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'cms-theme-framework'),
    'icon' => 'el el-website',
    'fields' => array()
));

/* footer top. */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top', 'cms-theme-framework'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'footer-top-column',
            'type'     => 'select',
            'title'    => esc_html__( 'Column', 'cms-theme-framework' ),
            'subtitle' => esc_html__( 'Select Footer Column', 'cms-theme-framework' ),
            'default'    => 2,
            'options'  => array(
                1 => esc_html__('1', 'cms-theme-framework' ),
                2 => esc_html__('2', 'cms-theme-framework' ),
                3 => esc_html__('3', 'cms-theme-framework' ),
                4 => esc_html__('4', 'cms-theme-framework' ),
            )
        ),
        array(
            'title'             => esc_html__('Background', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Footer top background.', 'cms-theme-framework'),
            'id'                => 'footer_top_background',
            'type'              => 'background',
            'output'            => array( 'footer #footer-top' )
        ),
        array(
            'title'             => esc_html__('Padding', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Footer top padding (top/bottom).', 'cms-theme-framework'),
            'id'                => 'footer_top_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array('px'),
            'right'             => false,
            'left'              => false,
            'output'            => array( 'footer #footer-top' )
        )
    )
));

/* footer bottom. */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Bottom', 'cms-theme-framework'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'footer-bottom-column',
            'type'     => 'select',
            'title'    => esc_html__( 'Column', 'cms-theme-framework' ),
            'subtitle' => esc_html__( 'Select Footer Column', 'cms-theme-framework' ),
            'default'    => 4,
            'options'  => array(
                1 => esc_html__('1', 'cms-theme-framework' ),
                2 => esc_html__('2', 'cms-theme-framework' ),
                3 => esc_html__('3', 'cms-theme-framework' ),
                4 => esc_html__('4', 'cms-theme-framework' ),
            )
        ),
        array(
            'title'             => esc_html__('Background', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Footer top background.', 'cms-theme-framework'),
            'id'                => 'footer_bottom_background',
            'type'              => 'background',
            'output'            => array( 'footer #footer-bottom' )
        ),
        array(
            'title'             => esc_html__('Padding', 'cms-theme-framework'),
            'subtitle'          => esc_html__('Footer top padding (top/bottom).', 'cms-theme-framework'),
            'id'                => 'footer_bottom_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array('px'),
            'right'             => false,
            'left'              => false,
            'output'            => array( 'footer #footer-bottom' )
        )
    )
));

/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Optimal Core', 'cms-theme-framework'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => esc_html__('no minimize , generate css over time...', 'cms-theme-framework'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => esc_html__('Dev Mode (not recommended)', 'cms-theme-framework'),
            'default' => false
        )
    )
));