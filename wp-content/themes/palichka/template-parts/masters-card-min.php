<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */
?>
<article id="post-<?php the_ID(); ?>" class='vflex-item masters-card-min card' style='cursor: pointer' onclick='location.href="<?php echo get_permalink(
  rwmb_meta("masterpiece-master_link")
); ?>"'>
  <img class='photo-min' height= '80' width='80' src='<?php
  $pic = reset(rwmb_meta('masters-photo'))['url'];
  echo $pic
    ? $pic
    : get_site_url() .
      '/wp-content/uploads/2019/08/tablero-de-paleta-de-pintura-con-contorno-de-pincel.png';
  ?>' alt='<?php echo the_title(); ?>' title='<?php echo the_title(); ?>'>
</article>