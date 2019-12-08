<?php
/*
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

get_header(); ?>
  <h1 class='h1-small background wide-toleft' style='width: 40%;'><?php the_title(); ?></h1>
  <div class='post-content container'>
  <img class='preview-photo' height='500px' src='<?php the_post_thumbnail_url(); ?>'>
 
    <?php if (has_excerpt()) { ?>
        <p class='main-text post-text'><?php echo get_the_excerpt(); ?></p>
      <?php } ?>
     <?php the_content(); ?>;
    </span>
  </div>
  
<?php get_footer();
?>
