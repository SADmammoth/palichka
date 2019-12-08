<?php
/**
 * The template for displaying 404 pages (not found)
 *
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package palichka
 */
wp_head(); ?>
 <header style='width: 40%; height: 70px; box-shadow: none; box-sizing: content-box;'>
    <div class='container'>
    <div class='branding'>
          <?php the_custom_logo(); ?>
				  <a href="<?php echo esc_url(
        home_url('/')
      ); ?>" rel="home" ><p class='h2' class="sitename"><?php bloginfo('name'); ?></p></a>
        </div>
  </header>
	<div id="primary" class="content-area">
    
		<main id="main" class="site-main">
   

  <main style='margin-top: 0; height: 70vh; padding-top: 15vh; box-sizing: border-box;'>
    <img width='476' height='386' src='<?php echo get_site_url(); ?>/wp-content/uploads/2019/08/404.gif' alt='' style='float:left; margin-left: var(--viewport-padding); width: calc(40% - var(--viewport-padding)); object-fit: contain;'>
    <div style='display: inline-block; margin-left: 40px; margin-top: 50px;'>
      <h1 class='h1' style='font-size: 5rem'>404</h1>
      <h2 class='h1-small'>Какую страницу вы ищете?</h2>
      <p class='h2' style='margin: 0;'>Этой у наc нет...</p>
    </div>
  </main>

  <footer style='background: none; height: 22vh; box-sizing: border-box; margin: 0; box-shadow: none;'>
      <h2 class='h2' style=' margin: 0 auto;  margin-bottom: 2vh; height: 5vh; width: 250px; box-sizing: border-box;'>Но есть другие!</h2>
      <nav style='background: var(--dark-background);  height: 12vh; box-sizing: border-box;'>
        <ul class='horizontal-flex-block' style='width: 20%; height: 100%; margin: 0 auto; '>
        
        <?php wp_nav_menu(array(
          'theme_location' => 'navigation-footer',
          'container' => false,
          'items_wrap' => '%3$s',
          'add_li_class' => 'nav-item hflex-item'
        )); ?>
        </ul>
      </nav>
      <div class='copyrights' style='height: 3vh; box-sizing: border-box;'>
        <p class='hint'>&copy; <?php echo (get_theme_mod('copy_year') == date('Y')
          ? date('Y')
          : get_theme_mod('copy_year') . '-' . date('Y')) .
          ', ' .
          get_theme_mod('copy_name'); ?></p>
      </div>
  </footer>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php wp_footer();
?>
