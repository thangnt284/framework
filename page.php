<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

get_header(); ?>

<div class="container">
    
    <div class="row">

        <div class="col-xs-12">

            <main id="main" class="site-main">

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    ?>
                    <div class="entry-content">

                        <?php the_content(); ?>
                    </div><!-- .entry-content -->

                    <?php 

                    edit_post_link( esc_html__( 'Edit', 'k2-theme' ), '<span class="edit-link">', '</span>' );
                    // End the loop.
                endwhile;
                ?>
            </main><!-- .site-main -->
        </div>
    </div>
</div><!-- .content-area -->

<?php get_footer(); ?>