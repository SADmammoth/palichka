<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package palichka
 */
?>

	</div><!-- #content -->
  <footer>
  <div class='background wide-toleft'>
  <div class='branding'>
          <?php the_custom_logo(); ?>
				  <a href="<?php echo esc_url(
        home_url('/')
      ); ?>" rel="home" ><p class='h2' class="sitename"><?php bloginfo('name'); ?></p></a>
      </div>
      <?php wp_nav_menu(array(
        'theme_location' => 'social-footer',
        'menu_class' => 'social-nav horizontal-flex-block',
        'container' => 'nav',
        'container_class' => 'social-nav-container',
        'add_li_class' => 'hflex-item'
      )); ?>
      <?php wp_nav_menu(array(
        'theme_location' => 'navigation-footer',
        'menu_class' => 'footer-nav horizontal-flex-block',
        'container' => 'nav',
        'container_class' => 'footer-nav-container desktop insidelayout-fromright',
        'add_li_class' => 'nav-item hflex-item'
      )); ?>
    </div>
    <div class='copyrights '>
      <p class='hint '>&copy; <?php echo (get_theme_mod('copy_year') == date('Y')
        ? date('Y')
        : get_theme_mod('copy_year') . '-' . date('Y')) .
        ', ' .
        get_theme_mod('copy_name'); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
