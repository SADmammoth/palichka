<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package palichka
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
      <div class='container'>
        <div class='horizontal-flex-block'>
        <div class='branding'>
          <?php
            the_custom_logo();
          ?>
				  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" ><p class='h2' class="sitename"><?php bloginfo( 'name' ); ?></p></a>
        </div>
        <?php
			wp_nav_menu( array(
				'theme_location' => 'navigation-header',
        'menu_class'     => 'header-nav horizontal-flex-block',
        'container'      => 'nav',
        'container_class'=> 'header-nav-container desktop',
        'add_li_class'=>'nav-item hflex-item'
			) );
      ?>
        <nav class='social-nav-container desktop'>
      <p class='hint'>Ищите нас в соцсетях:</p>
       <?php
			wp_nav_menu( array(
        'theme_location' => 'social-header',
        'menu_class'     => 'social-nav horizontal-flex-block',
        'container'      => false,
        'add_li_class'=> 'hflex-item'
      ) );

      ?>
      </nav>
          <div class='dropdown handheld'>
            <input class='burger-icon dropdown-trigger' type='checkbox'>
            <div class='burger-menu-bottom dropdown-content'>
            <?php
			    wp_nav_menu( array(
            'theme_location' => 'navigation-header',
            'menu_class'     => 'header-nav vertical-flex-block',
            'container'      => 'nav',
            'container_class'=> 'header-nav-container',
            'add_li_class'=>'nav-item vflex-item'
          ) );
          ?>
                 
          <?php
          wp_nav_menu( array(
            'theme_location' => 'social-header',
            'menu_class'     => 'social-nav horizontal-flex-block',
            'container'      => 'nav',
            'container_class'=>'social-nav horizontal-flex-block',
            'add_li_class'=> 'hflex-item'
          ) );
          ?>
              <a onclick='close_dropdown(this);' class='close-dropdown pictogram'><i class='fas fa-times'></i></a>
            </div>
          </div>
        </div>
    </header>
	

	<div id="content" class="site-content">
 