<?php

$blog_column = $sidebar_col = '';
$_get_sidebar = k2_theme_get_sidebar( 'single_layout' );

if($_get_sidebar == 'is-sidebar-full' ) {

    $blog_column = 'col-xs-12';
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

<div id="primary" class="container single-blog <?php echo esc_attr($_get_sidebar); ?>">

    <div class="row">

        <?php if($_get_sidebar == 'is-sidebar-left'){ ?>
            
            <div class="<?php echo esc_html($sidebar_col);?>">

                <?php get_sidebar(); ?>
            </div>

        <?php }?>

        <div class="<?php echo esc_attr($blog_column); ?>">

            <main id="main" class="site-main" role="main">

                <?php
                /* Start the loop.*/
                while ( have_posts() ) : the_post();

                    /* Include the single content template.*/
                    get_template_part( 'single-templates/single/content', get_post_format() );

                    k2_theme_single_comment();

                    /* End the loop. */
                endwhile;
                ?>
            </main>
        </div><!-- #main -->

        <?php if($_get_sidebar == 'is-sidebar-right'){ ?>
            
            <div class="<?php echo esc_html($sidebar_col);?>">
                <?php get_sidebar(); ?>
            </div>
        <?php }?>
    </div>
</div><!-- #primary -->

<?php get_footer(); ?>