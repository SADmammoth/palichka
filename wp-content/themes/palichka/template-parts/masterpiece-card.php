<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */
?>
<article id="post-<?php the_ID(); ?>" class='vflex-item masterpiece-card card' style='cursor: pointer' onclick='location.href="<?php echo get_permalink(
  rwmb_meta("masterpiece-master_link")
); ?>"'>
    <img style='height: 100%; width: 100%' width='150' height='150' src='<?php echo reset(
      rwmb_meta('masterpiece-image')
    )['url']; ?>' alt='<?php echo the_title(); ?>' title='<?php echo the_title(); ?>'>
</article>