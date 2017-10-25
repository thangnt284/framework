<?php

function k2_theme_logo()
{
    global $opt_theme_options;

    echo '<div class="main_logo">';

    if( $opt_theme_options['logo_type'] == 1 ) {

        $img = (!empty($opt_theme_options['main_logo']['url'])) ? $opt_theme_options['main_logo']['url'] : get_template_directory_uri().'/assets/images/logo.png';
        echo '<a href="' . esc_url(home_url('/')) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($img) . '"></a>';
    } elseif ($opt_theme_options['logo_type'] == 0 ){

        $text = (!empty($opt_theme_options['logo_text'])) ? $opt_theme_options['logo_text'] : get_bloginfo( "name" );

        echo '<h2 class="site-title"><a href="' . esc_url( home_url( '/' )) . '" rel="home">' . esc_html($text) . '</a></h2>';
    } else {
        echo '<h2 class="site-title"><a href="' . esc_url( home_url( '/' )) . '" rel="home">' . get_bloginfo( "name" ) . '</a></h2>';
        echo '<p class="site-description">' . get_bloginfo( "description" ) . '</p>';
    }

    echo '</div>';

    k2_theme_sticky_logo();
}

function k2_theme_sticky_logo(){
    global $opt_theme_options;

    /* sticky off. */
    if(empty($opt_theme_options['menu_sticky'])) {
        return;
    }

    /* default logo. */
    if(empty($opt_theme_options['sticky_logo_type']) || $opt_theme_options['sticky_logo_type'] == 'default') {
        return;
    }

    echo '<div class="sticky_logo hide">';

    if(isset($opt_theme_options['sticky_logo_type']) && $opt_theme_options['sticky_logo_type'] == 'img' && !empty($opt_theme_options['sticky_logo']['url'])) {
        echo '<a href="' . esc_url(home_url('/')) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['sticky_logo']['url']) . '"></a>';
    } elseif (isset($opt_theme_options['sticky_logo_type']) && $opt_theme_options['sticky_logo_type'] == 'text' && !empty($opt_theme_options['sticky_logo_text'])){
        echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' )) . '" rel="home">' . esc_html($opt_theme_options['sticky_logo_text']) . '</a></h1>';

        if(!empty($opt_theme_options['sticky_logo_text_sologan']))
            echo '<p class="site-description">'.esc_html($opt_theme_options['sticky_logo_text_sologan']).'</p>';

    } else {
        echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' )) . '" rel="home">' . get_bloginfo( "name" ) . '</a></h1>';
        echo '<p class="site-description">' . get_bloginfo( "description" ) . '</p>';
    }

    echo '</div>';
}
?>