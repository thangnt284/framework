<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php k2_theme_favicon_icon(); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php k2_theme_page_loading(); ?>

<div class="wrap-site">

	<header class="header-site">

		<?php k2_theme_header(); ?>
		<?php k2_theme_nav_menu(); ?>
	</header><!-- #masthead -->

    <?php k2_theme_page_title(); ?><!-- #page-title -->

	<div class="content-site">