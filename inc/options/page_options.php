<?php
/**
 * Meta box config file
 */
if (! class_exists('MetaFramework')) {
    return;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'opt_meta_options'),
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Allow you to start the panel in an expanded way initially.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field
    'disable_save_warn' => true,
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => false,

    'output' => false,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => false,
    // save meta to multiple keys.
    'meta_mode' => 'multiple'
);

// -> Set Option To Panel.
MetaFramework::setArgs($args);

add_action('admin_init', 'et3_theme_framework_meta_boxs');

MetaFramework::init();

function et3_theme_framework_meta_boxs()
{

    /** page options */
    MetaFramework::setMetabox(array(
        'id' => '_page_main_options',
        'label' => esc_html__('Page Setting', 'cms-theme-framework'),
        'post_type' => 'page',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => false,
        'sections' => array(
            array(
                'title' => __('Header', 'cms-theme-framework'),
                'id' => 'tab-page-header',
                'icon' => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id' => 'header_layout',
                        'title' => esc_html__('Layouts', 'cms-theme-framework'),
                        'subtitle' => esc_html__('select a layout for header', 'cms-theme-framework'),
                        'default' => '',
                        'type' => 'image_select',
                        'options' => array(
                            '' => get_template_directory_uri() . '/assets/images/header/h-default.png',
                            'default' => get_template_directory_uri() . '/assets/images/header/h-style-1.png',
                            'top' => get_template_directory_uri() . '/assets/images/header/h-style-2.png'
                        ),
                    ),
                    array(
                        'id' => 'header_menu',
                        'type' => 'select',
                        'title' => __('Select Menu', 'cms-theme-framework'),
                        'subtitle' => __('custom menu for current page', 'cms-theme-framework'),
                        'options' => et3_theme_framework_get_nav_menu(),
                        'default' => '',
                    ),
                )
            ),
            array(
                'title' => __('Page Title & BC', 'cms-theme-framework'),
                'id' => 'tab-page-title-bc',
                'icon' => 'el el-map-marker',
                'fields' => array(
                    array(
                        'id' => 'page_title_layout',
                        'title' => esc_html__('Layouts', 'cms-theme-framework'),
                        'subtitle' => esc_html__('select a layout for page title', 'cms-theme-framework'),
                        'default' => '5',
                        'type' => 'image_select',
                        'options' => array(
                            '' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-default.png',
                            '1' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-0.png',
                            '2' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-1.png',
                            '3' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-2.png',
                            '4' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-3.png',
                            '5' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-4.png',
                            '6' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-5.png',
                            '7' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-6.png',
                        ),
                    ),
                    array(
                        'id' => 'page_title_text',
                        'type' => 'text',
                        'title' => esc_html__('Custom Title', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Custom current page title.', 'cms-theme-framework'),
                    )
                )
            ),
            array(
                'title' => __('One Page', 'cms-theme-framework'),
                'id' => 'tab-one-page',
                'icon' => 'el el-download-alt',
                'fields' => array(
                    array(
                        'subtitle' => esc_html__('Enable one page mode for current page.', 'cms-theme-framework'),
                        'id' => 'page_one_page',
                        'type' => 'switch',
                        'title' => esc_html__('Enable', 'cms-theme-framework'),
                        'default' => false,
                    ),
                    array(
                        'id'            => 'page_one_page_speed',
                        'type'          => 'slider',
                        'title'         => esc_attr__( 'Speed', 'cms-theme-framework' ),
                        'default'       => 1000,
                        'min'           => 500,
                        'step'          => 100,
                        'max'           => 5000,
                        'display_value' => 'text',
                        'required' => array('page_one_page', '=', 1)
                    ),
                )
            )
        )
    ));

    /** post options */
    MetaFramework::setMetabox(array(
        'id' => '_page_post_format_options',
        'label' => esc_html__('Post Format', 'cms-theme-framework'),
        'post_type' => 'post',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => true,
        'sections' => array(
            array(
                'title' => '',
                'id' => 'color-Color',
                'icon' => 'el el-laptop',
                'fields' => array(
                    array(
                        'id' => 'opt-video-type',
                        'type' => 'select',
                        'title' => esc_html__('Select Video Type', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Local video, Youtube, Vimeo', 'cms-theme-framework'),
                        'options' => array(
                            'local' => esc_html__('Upload', 'cms-theme-framework'),
                            'youtube' => esc_html__('Youtube', 'cms-theme-framework'),
                            'vimeo' => esc_html__('Vimeo', 'cms-theme-framework'),
                        )
                    ),
                    array(
                        'id' => 'otp-video-local',
                        'type' => 'media',
                        'url' => true,
                        'mode' => false,
                        'title' => esc_html__('Local Video', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Upload video media using the WordPress native uploader', 'cms-theme-framework'),
                        'required' => array('opt-video-type', '=', 'local')
                    ),
                    array(
                        'id' => 'opt-video-youtube',
                        'type' => 'text',
                        'title' => esc_html__('Youtube', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Load video from Youtube.', 'cms-theme-framework'),
                        'placeholder' => esc_html__('https://youtu.be/iNJdPyoqt8U', 'cms-theme-framework'),
                        'required' => array('opt-video-type', '=', 'youtube')
                    ),
                    array(
                        'id' => 'opt-video-vimeo',
                        'type' => 'text',
                        'title' => esc_html__('Vimeo', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Load video from Vimeo.', 'cms-theme-framework'),
                        'placeholder' => esc_html__('https://vimeo.com/155673893', 'cms-theme-framework'),
                        'required' => array('opt-video-type', '=', 'vimeo')
                    ),
                    array(
                        'id' => 'otp-video-thumb',
                        'type' => 'media',
                        'url' => true,
                        'mode' => false,
                        'title' => esc_html__('Video Thumb', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Upload thumb media using the WordPress native uploader', 'cms-theme-framework'),
                        'required' => array('opt-video-type', '=', 'local')
                    ),
                    array(
                        'id' => 'otp-audio',
                        'type' => 'media',
                        'url' => true,
                        'mode' => false,
                        'title' => esc_html__('Audio Media', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Upload audio media using the WordPress native uploader', 'cms-theme-framework'),
                    ),
                    array(
                        'id' => 'opt-gallery',
                        'type' => 'gallery',
                        'title' => esc_html__('Add/Edit Gallery', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'cms-theme-framework'),
                    ),
                    array(
                        'id' => 'opt-quote-title',
                        'type' => 'text',
                        'title' => esc_html__('Quote Title', 'cms-theme-framework'),
                        'subtitle' => esc_html__('Quote title or quote name...', 'cms-theme-framework'),
                    ),
                    array(
                        'id' => 'opt-quote-content',
                        'type' => 'textarea',
                        'title' => esc_html__('Quote Content', 'cms-theme-framework'),
                    ),
                )
            ),
        )
    ));
}