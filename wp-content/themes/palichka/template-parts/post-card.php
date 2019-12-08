<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */
?>

<article id="post-<?php the_ID(); ?>" class='vflex-item blog-card card'>
  <a href='<?php echo get_permalink(); ?>' class='photo-box'>
    <img class='photo-thumb' width='150' height='150' src='<?php the_post_thumbnail_url(); ?>'>
  </a>
  
  <h4 class='title main-text'><a href='<?php echo get_permalink(); ?>'>
  <?php
  $str = the_title();
  echo strlen($str) > 18 ? substr($str, 0, 18) . '...' : $str;
  ?>
</a></h4>
  
  <p class='description'><?php
  $str = get_the_excerpt();
  echo strlen($str) > 117 ? substr($str, 0, 117) . '...' : $str;
  ?></p>
  
  <a href='<?php echo get_permalink(); ?>' class='link'>Читать далее</a><i class='fas fa-chevron-right pictogram'></i>
  </a>
</article>
