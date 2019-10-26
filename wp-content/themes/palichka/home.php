<?php
 /**
 * Template name: Главная
 * Template Post Type: post, page, product, masters  
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */


get_header();
?>

<aside id="primary" class="content-area">
		<main id="main" class="site-main">
		<section id='main-section'>
      <div class='container' style='position: absolute; top: 25%;'>
        <h1 class='h1'><?php bloginfo( 'name' ); ?></h1>
        <p class='main-text'><?php bloginfo( 'description' ); ?></p>
      </div>
      <?php
      if(get_theme_mod('enable_panel')){
      ?>
      <nav class='leftside-wide-btngroup'>
        <?php 
          $nav = get_theme_mod('mainpage_nav');
         
          foreach($nav as $item){
            if(!$item['hidden']){
              ?>
                <a class='button' href='<?php echo $item['link']?>'><?php echo $item['link_text']?></a>
              <?php
            }
          }
        ?>
     
      </nav>
      <?php
    }
      ?>
    </section>

    <section class='desc-section'>
      <div class='background' style='float: left'>
        <div class='container'>
          <p class='main-text hyphenated'>
            <?php echo get_theme_mod( 'main_desc_text')?>
          </p>
        </div>
      </div>
      <div class='container'>
        <p class='additional-text hyphenated'>
        <?php echo get_theme_mod( 'sec_desc_text')?>
        </p>
      </div>
    </section>
    <?php get_template_part( 'template-parts/content-home', 'widgets' ); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
  <?php 
  if(get_theme_mod('hyphenate')) {
    wp_enqueue_script( 'palichka-hyphenate');
  }
  get_footer();
  ?>