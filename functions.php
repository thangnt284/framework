<?php
/**
 * K2 Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 */


/**
 * Theme setup.
 */

function k2_theme_setup()
{

    // load language.
    load_theme_textdomain('k2-theme', get_template_directory() . '/languages');

    // Adds title tag
    add_theme_support("title-tag");

    // Add woocommerce
    add_theme_support('woocommerce');

    // Adds custom header
    add_theme_support('custom-header');

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // This theme supports a variety of post formats.
    add_theme_support('post-formats', array('video', 'gallery'));

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary_menu', esc_html__('Primary Menu', 'k2-theme'));

    /*
     * This theme supports custom background color and image,
     * and here we also set up the default background color.
     */
    add_theme_support('custom-background', array('default-color' => 'e6e6e6',));

    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support('post-thumbnails');

    set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop

    update_option('thumbnail_size_w', 150);
    update_option('thumbnail_size_h', 120);
    update_option('thumbnail_crop', 1);

    update_option('medium_size_w', 200);
    update_option('medium_size_h', 200);
    update_option('medium_crop', 1);

    update_option('large_size_w', 400);
    update_option('large_size_h', 400);
    update_option('large_crop', 1);

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
     */
    add_editor_style(array('assets/css/editor-style.css'));
}

add_action('after_setup_theme', 'k2_theme_setup');


/**
 * Add elements for VC
 */

add_action('vc_after_init', 'k2_theme_after_vc_params');

function k2_theme_after_vc_params()
{
}

/**
 * Enqueue scripts and styles for front-end.
 */
function k2_theme_front_end_scripts()
{

    global $wp_styles, $opt_meta_options;

    /* Adds JavaScript Bootstrap. */
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.2');

    /* Add main.js */
    wp_enqueue_script('k2-theme-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

    /* Add menu.js */
    wp_enqueue_script('k2-theme-menu', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '1.0.0', true);

    /* Comment */
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    /* Loads Bootstrap stylesheet. */
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');

    /* Loads Bootstrap stylesheet. */
    wp_enqueue_style('k2-theme-font', get_template_directory_uri() . '/assets/css/font.css');

    /* Loads our main stylesheet. */
    wp_enqueue_style('k2-theme-style', get_stylesheet_uri());

    /* Load static css*/
    wp_enqueue_style('k2-theme-static', get_template_directory_uri() . '/assets/css/static.css');
}

add_action('wp_enqueue_scripts', 'k2_theme_front_end_scripts');

/**
 * load admin scripts.
 */
function k2_theme_admin_scripts()
{

    /* Loads Bootstrap stylesheet. */
    wp_enqueue_style('k2-theme-font', get_template_directory_uri() . '/assets/css/font.css', array(), '4.3.0');

    wp_enqueue_style('vc-admin', get_template_directory_uri() . '/assets/css/vc-admin.css');

    $screen = get_current_screen();

    /* load js for edit post. */
    if ($screen->post_type == 'post') {
        /* post format select. */
        wp_enqueue_script('post-format', get_template_directory_uri() . '/assets/js/post-format.js', array(), '1.0.0', true);
    }
}

add_action('admin_enqueue_scripts', 'k2_theme_admin_scripts');

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 */
function k2_theme_widgets_init()
{

    global $opt_theme_options;

    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'k2-theme'),
        'id' => 'sidebar-blog',
        'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'k2-theme'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'k2_theme_widgets_init');

/**
 * Display navigation to next/previous comments when applicable.
 *
 */
function k2_theme_comment_nav()
{
    // Are there comments to navigate through?
    if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'k2-theme'); ?></h2>
            <div class="nav-links">
                <?php
                if ($prev_link = get_previous_comments_link(esc_html__('Older Comments', 'k2-theme'))) :
                    printf('<div class="nav-previous">%s</div>', $prev_link);
                endif;

                if ($next_link = get_next_comments_link(esc_html__('Newer Comments', 'k2-theme'))) :
                    printf('<div class="nav-next">%s</div>', $next_link);
                endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .comment-navigation -->
        <?php
    endif;
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 */
function k2_theme_paging_nav()
{
    // Don't print empty markup if there's only one page.
    if ($GLOBALS['wp_query']->max_num_pages < 2) {
        return;
    }

    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args = array();
    $url_parts = explode('?', $pagenum_link);

    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base' => $pagenum_link,
        'total' => $GLOBALS['wp_query']->max_num_pages,
        'current' => $paged,
        'mid_size' => 1,
        'add_args' => array_map('urlencode', $query_args),
        'prev_text' => '<i class="fa fa-angle-left"></i> Previous Page',
        'next_text' => 'Next Page <i class="fa fa-angle-right"></i>',
    ));

    if ($links) :

        ?>
        <nav class="paging-navigation clearfix">
            <?php echo wp_kses_post($links); ?>
        </nav><!-- .navigation -->
        <?php
    endif;
}

/**
 * Display navigation to next/previous post when applicable.
 *
 */
function k2_theme_post_nav()
{
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    if (!$next && !$previous)
        return;
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links clearfix">
            <?php
            $prev_post = get_previous_post();
            if (!empty($prev_post)): ?>
                <a class="btn btn-default post-prev left" href="<?php echo get_permalink($prev_post->ID); ?>"><i
                            class="fa fa-angle-left"></i><?php echo esc_attr($prev_post->post_title); ?></a>
            <?php endif; ?>
            <?php
            $next_post = get_next_post();
            if (is_a($next_post, 'WP_Post')) { ?>
                <a class="btn btn-default post-next right"
                   href="<?php echo get_permalink($next_post->ID); ?>"><?php echo get_the_title($next_post->ID); ?><i
                            class="fa fa-angle-right"></i></a>
            <?php } ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}

function k2_theme_get_sidebar($check)
{
    global $opt_theme_options;

    $_sidebar = 'right';
    if (!empty($opt_theme_options[$check])) {

        $_sidebar = $opt_theme_options[$check];
    }

    return 'is-sidebar-' . esc_attr($_sidebar);
}

/**
 * Move comment field to bottom of Comment form
 */

add_filter('comment_form_fields', 'k2_theme_field_comment');

function k2_theme_field_comment($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}

function k2_theme_favicon_icon()
{
    global $opt_theme_options;

    if ( !empty($opt_theme_options['fav_icon']['url']) ) {

        echo esc_url($opt_theme_options['fav_icon']['url']);
    } else {
        echo get_template_directory_uri() . '/assets/images/fav.png';
    }
}


function k2_theme_back_to_top()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['general_back_to_top'])) {
        ?>
        <div class="k2-theme-back-to-top"><i class="fa fa-angle-double-up"></i></div><?php
    }
}

function k2_theme_header()
{
    global $opt_theme_options, $opt_meta_options;

    if ( empty($opt_theme_options) ) {
        get_template_part('inc/header/header', '1');
        return;
    }

    if (is_page() && !empty($opt_meta_options['header_layout']))
        $opt_theme_options['header_layout'] = $opt_meta_options['header_layout'];

    /* load custom header template. */
    get_template_part('inc/header/header', $opt_theme_options['header_layout']);
}

function k2_theme_page_loading()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['page_loading'])) {
        echo '<div id="book-junky-loadding"><div class="wrap-loading">
        <div class="bounceball"></div>
        <div class="text">';
        echo esc_html__("NOW LOADING", "book-junky");
        echo '</div></div></div>';
    }
}

function k2_theme_page_title(){
    global $opt_theme_options, $opt_meta_options;

    /* default. */
    $layout = '2';

    /* get theme options */
    if( !empty($opt_theme_options['page_title_layout']))
        $layout = $opt_theme_options['page_title_layout'];

    /* custom layout from page. */
    if( is_page() && !empty($opt_meta_options['page_title_layout']))
        $layout = $opt_meta_options['page_title_layout'];

    ?>
    <div class="page-title">
        <div class="container">
        <div class="row">
        <?php switch ($layout){
            case '2':
                ?>
                <div id="page-title-text" class="col-xs-12"><h1><?php k2_theme_get_page_title(); ?></h1></div>
                <div id="breadcrumb-text" class="col-xs-12"><?php k2_theme_get_bread_crumb(); ?></div>
                <?php
                break;
            default : 
                echo "Kennji";
        } ?>
        </div>
        </div>
    </div><!-- #page-title -->
    <?php
}

function k2_theme_get_bread_crumb() 
{

    if(!function_exists('bcn_display')) return;

    bcn_display();
}

function k2_theme_get_page_title()
{

    global $opt_meta_options;

    if (!is_archive()){
        /* page. */
        if(is_page()) :
            /* custom title. */
            if(!empty($opt_meta_options['page_title_text'])):
                echo esc_html($opt_meta_options['page_title_text']);
            else :
                the_title();
            endif;
        elseif (is_front_page()):
            esc_html_e('Blog', 'k2-theme');
        /* search */
        elseif (is_search()):
            printf( esc_html__( 'Search Results for: %s', 'k2-theme' ), '<span>' . get_search_query() . '</span>' );
        /* 404 */
        elseif (is_404()):
            esc_html_e( '404', 'k2-theme');
        /* other */
        else :
            the_title();
        endif;
    } else {
        /* category. */
        if ( is_category() ) :
            single_cat_title();
        elseif ( is_tag() ) :
            /* tag. */
            single_tag_title();
        /* author. */
        elseif ( is_author() ) :
            printf( esc_html__( 'Author: %s', 'k2-theme' ), '<span class="vcard">' . get_the_author() . '</span>' );
        /* date */
        elseif ( is_day() ) :
            printf( esc_html__( 'Day: %s', 'k2-theme' ), '<span>' . get_the_date('j') . '</span>' );
        elseif ( is_month() ) :
            printf( esc_html__( 'Month: %s', 'k2-theme' ), '<span>' . get_the_date('F') . '</span>' );
        elseif ( is_year() ) :
            printf( esc_html__( 'Year: %s', 'k2-theme' ), '<span>' . get_the_date('Y') . '</span>' );
        /* post format */
        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            esc_html_e( 'Asides', 'k2-theme' );
        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            esc_html_e( 'Galleries', 'k2-theme');
        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            esc_html_e( 'Images', 'k2-theme');
        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            esc_html_e( 'Videos', 'k2-theme' );
        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            esc_html_e( 'Quotes', 'k2-theme' );
        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            esc_html_e( 'Links', 'k2-theme' );
        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            esc_html_e( 'Statuses', 'k2-theme' );
        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            esc_html_e( 'Audios', 'k2-theme' );
        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            esc_html_e( 'Chats', 'k2-theme' );
        /* woocommerce */
        elseif (function_exists('is_woocommerce') && is_woocommerce()):
            woocommerce_page_title();
        else :
            /* other */
            the_title();
        endif;
    }
}

function k2_theme_post_video() 
{

    global $opt_meta_options, $wp_embed;

    /* no video. */
    if(empty($opt_meta_options['opt-video-type'])) {
        et3_theme_framework_post_thumbnail();
        return;
    }

    if($opt_meta_options['opt-video-type'] == 'local' && !empty($opt_meta_options['otp-video-local']['id'])){

        $video = wp_get_attachment_metadata($opt_meta_options['otp-video-local']['id']);

        echo do_shortcode('[video width="'.esc_attr($opt_meta_options['otp-video-local']['width']).'" height="'.esc_attr($opt_meta_options['otp-video-local']['height']).'" '.$video['fileformat'].'="'.esc_url($opt_meta_options['otp-video-local']['url']).'" poster="'.esc_url($opt_meta_options['otp-video-thumb']['url']).'"][/video]');

    } elseif($opt_meta_options['opt-video-type'] == 'youtube' && !empty($opt_meta_options['opt-video-youtube'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt-video-youtube']).'[/embed]'));

    } elseif($opt_meta_options['opt-video-type'] == 'vimeo' && !empty($opt_meta_options['opt-video-vimeo'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt-video-vimeo']).'[/embed]'));
    }
}

function k2_theme_post_gallery()
{
    global $opt_meta_options;

    /* no audio. */
    if(empty($opt_meta_options['opt-gallery'])) {
        et3_theme_framework_post_thumbnail();
        return;
    }

    $array_id = explode(",", $opt_meta_options['opt-gallery']);

    ?>
    <div id="post-gallery" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $i = 0; ?>
            <?php foreach ($array_id as $image_id): ?>
                <?php
                $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                if($attachment_image[0] != ''):?>
                    <div class="item <?php if( $i == 0 ){ echo 'active'; } ?>">
                        <img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                    </div>
                <?php $i++; endif; ?>
            <?php endforeach; ?>
        </div>
        <a class="left carousel-control" href="#post-gallery" role="button" data-slide="prev">
            <span class="fa fa-angle-left"></span>
        </a>
        <a class="right carousel-control" href="#post-gallery" role="button" data-slide="next">
            <span class="fa fa-angle-right"></span>
        </a>
    </div>
    <?php
}

function k2_theme_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    echo '<div class="post-thumbnail">';
            the_post_thumbnail('large');
    echo '</div>';
}

function k2_theme_single_comment()
{

    global $opt_theme_options;

    if (!empty($opt_theme_options['single_comment'])) :
        /* If comments are open or we have at least one comment, load up the comment template.*/

        if (comments_open() || get_comments_number()) :

            comments_template();
        endif;
    endif;
}

function k2_theme_single_tag()
{
    global $opt_theme_options;
    if (!empty($opt_theme_options['single_tag'])) :
        ?>
        <div class="entry-categories"><?php the_terms(get_the_ID(), 'post_tag', '', ''); ?></div>
        <?php
    endif;
}

function k2_theme_edit_link()
{
    edit_post_link(
        'Edit',
        '<span class="edit-link">',
        '</span>'
    );
}

function k2_theme_header_navigation()
{
    global $opt_meta_options;

    $attr = array(
        'menu_class' => 'nav-menu menu-main-menu',
        'theme_location' => 'primary_menu',
    );

    if ( is_page() && !empty($opt_meta_options['header_menu']) )
    {

        $attr['menu'] = $opt_meta_options['header_menu'];
    }

    $locations = get_nav_menu_locations();

    if ( !empty($locations['primary_menu']) )
    {

        wp_nav_menu($attr);
    }

    else
    {

        ?>
        <a class="opt-nav" href="<?php echo get_admin_url(); ?>nav-menus.php">

            <?php esc_html_e('Create And Select Primary Menu', 'k2-theme'); ?>
        </a>
        <?php
    }
}

function k2_theme_header_class()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['menu_sticky'])) {

        $class = 'menu-sticky';
    }

    echo esc_attr($class);
}

/* core functions. */
require_once(get_template_directory() . '/inc/functions.php');



