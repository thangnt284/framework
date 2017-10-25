<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 */

/* get side-bar position. */
$_get_sidebar = k2_theme_get_sidebar( 'archive_layout' );
$blog_column = $sidebar_col = '';

if($_get_sidebar == 'is-sidebar-full' ) {

    $blog_column = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
    $sidebar_col = 'hidden-xs hidden-sm hidden-md hidden-lg';
} 

else {

    if( is_active_sidebar( 'sidebar-blog' ) ){

        $blog_column = 'col-xs-12 col-sm-7 col-md-8';
        $sidebar_col = 'col-xs-12 col-sm-5 col-md-4';
    }
    else{

        $blog_column = 'col-xs-12';
        $sidebar_col = 'hidden-xs hidden-sm hidden-md hidden-lg';
    }
}

get_header(); ?>

<section class="container blog-default <?php echo esc_attr($_get_sidebar); ?>">
    <div class="row">
        <?php if($_get_sidebar == 'is-sidebar-left'){ ?>
            
            <div class="<?php echo esc_html($sidebar_col);?>">
                <?php get_sidebar(); ?>
            </div>

        <?php }?>
        <div class="<?php echo esc_html($blog_column);?>">
            <main id="main" class="site-main">

                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                        get_template_part( 'post-templates/archives/content', get_post_format() );

                    endwhile; // end of the loop.

                    /* blog nav. */
                    k2_theme_paging_nav();

                else :
                    /* content none. */
                    get_template_part( 'post-templates/archives', 'none' );

                endif; ?>

            </main><!-- #content -->
        </div>

        <?php if($_get_sidebar == 'is-sidebar-right'){ ?>
            
            <div class="<?php echo esc_html($sidebar_col);?>">
                <?php get_sidebar(); ?>
            </div>

        <?php }?>

    </div>
</section><!-- #primary -->

<?php get_footer(); ?>