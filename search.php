<?php
/**
 * The template for displaying Search Results pages
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
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

        $blog_column = 'col-xs-12 col-sm-7 col-md-8 col-lg-8';
        $sidebar_col = 'col-xs-12 col-sm-5 col-md-4 col-lg-4';
    }
    else{

        $blog_column = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
        $sidebar_col = 'hidden-xs hidden-sm hidden-md hidden-lg';
    }
}

get_header(); ?>

<section id="primary" class="container blog-default <?php echo esc_attr($_get_sidebar); ?>">
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

                    ?>

                    <header class="entry-header">

                        <h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'k2-theme' ); ?></h1>
                    </header>

                    <div class="entry-content">

                        <p>
                            <?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'k2-theme' ); ?>
                        </p>

                        <?php get_search_form(); ?>
                    </div><!-- .entry-content -->
                    <?php
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