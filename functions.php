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
    register_nav_menu('primary', esc_html__('Primary Menu', 'k2-theme'));

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

    /* one page. */
    if (is_page() && isset($opt_meta_options['page_one_page']) && $opt_meta_options['page_one_page']) {
        wp_register_script('jquery.singlePageNav', get_template_directory_uri() . '/assets/js/jquery.singlePageNav.js', array('jquery'), '1.2.0');
        wp_localize_script('jquery.singlePageNav', 'one_page_options', array('filter' => '.is-one-page', 'speed' => $opt_meta_options['page_one_page_speed']));
        wp_enqueue_script('jquery.singlePageNav');
    }

    /* Adds JavaScript Bootstrap. */
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.2');

    /* Add main.js */
    wp_enqueue_script('k2-theme-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

    /* Add menu.js */
    wp_enqueue_script('k2-theme-menu', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '1.0.0', true);

    /* Comment */
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    /** ----------------------------------------------------------------------------------- */

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

/* core functions. */
//require_once(get_template_directory() . '/inc/functions.php');

/**
 * Move comment field to bottom of Comment form
 */

function k2_theme_field_comment($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}

add_filter('comment_form_fields', 'k2_theme_field_comment');
