<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-base-url="<?php echo esc_url( home_url( '/' ) ); ?>">
	<?php wp_body_open(); ?>
	<div id="wrapper" class="hfeed">
		<header id="header" role="banner">
			<div id="menu-wrapper" class="clearfix">
				<div id="branding">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Kanceparie RP"></a>
				</div>
				<nav id="menu" role="navigation">
					<button type="button" class="menu-toggle"><span class="menu-icon">&#9776;</span><span class="menu-text screen-reader-text"><?php esc_html_e( ' Menu', 'generic' ); ?></span></button>
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
					<div id="search"><?php get_search_form(); ?></div>
				</nav>	
			</div>
		</header>
			
		<div id="container">
			<?php if ( is_active_sidebar( 'undermenu-1' ) ) : ?>
				<div class="undermenu-sidebar">
					<?php dynamic_sidebar( 'undermenu-1' ); ?>
				</div>
			<?php endif; ?>