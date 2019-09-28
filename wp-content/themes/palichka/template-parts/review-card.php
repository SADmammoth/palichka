<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */
?>
<article id="post-<?php the_ID(); ?>" class='vflex-item review-card card'>
  <img class='avatar' height= '100' width='100' src='<?php echo reset(rwmb_meta('review-photo'))['url']?>' alt='<?php echo the_title()?>' title='<?php echo the_title() ?>' >
  <h3 class='h3 title'><?php echo rwmb_meta('review-name') ?></h3>
  <p class='additional-text subtitle'><?php echo rwmb_meta('review-age') ?>, <?php echo rwmb_meta('review-profession') ?></p>
  <p class='description hyhpenated'>
    <?php echo rwmb_meta('review-body') ?>
  </p>
</article>