<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */
?>
<article id="post-<?php the_ID(); ?>" class='vflex-item masters-card card'>
  <a href='<?php echo get_permalink()?>' class='photo-box'>
    <img class='photo-thumb' width='150 ' height='150 '  src='<?php $pic = reset(rwmb_meta('masters-photo'))['url']; echo $pic?$pic:get_site_url().'/wp-content/uploads/2019/08/tablero-de-paleta-de-pintura-con-contorno-de-pincel.png'?>' alt='<?php echo the_title()?>' title='<?php echo the_title() ?>' />
  </a>
  <h2 class='h2'>
  <a href='<?php echo get_permalink()?>'>
    <?php $str = the_title(); echo (strlen($str)>20)? substr($str, 0, 20).'...' : $str;?>
  </a>
  <?php
          if(is_user_logged_in()):
          ?>
          
  <span class='additional-text' style='float: right; padding: 5px; padding-right: 10px;'>
        <form method="POST" action="<?php echo get_template_directory_uri()."/inc/like.php"?>"> 
          <input id='best_master_<?php echo get_the_ID()?>' class='like' name='liked' type="checkbox" onchange="like(this, <?php echo get_the_ID().', '.get_current_user_id()?>)" <?php if(in_array(get_the_ID(), get_user_meta(get_current_user_id(), 'liked_masters', true))) echo 'checked'?> />
          <label for='best_master_<?php echo get_the_ID()?>'><span class='like_counter'><?php $val = get_post_meta(get_the_ID(), 'liked_by_users', true); echo is_array($val)?count($val):0?></span></label>
        </form>
  </span>
  <?php 
  wp_enqueue_script( 'palichka-like' );      
  endif;?>
  </h2>
  
  <div class='works'>
  <?php 
    $count = 4;
    $my_query = new WP_Query([
                              'posts_per_page' => $count,
                              'post_type'=>'masterpiece', 
                              'meta_key' => 'masterpiece-master_link', 
                              'meta_value' => get_the_ID()
                            ]);

    if($my_query->have_posts()):?>
  
    <div class='horizontal-flex-block'>
      <?php
        while($my_query->have_posts()) {
          if($count === 0){
            break;
          }
          $my_query->the_post();
          get_template_part('template-parts/masterpiece-card-min');
          $count--;
        }
      ?>
    </div>
    <div class='shelf-min '></div>

  <?php
    else:    
  ?>
    <p class='description hyphenated'><?php $str = rwmb_meta('masters-desc'); echo (strlen($str)>350)? mb_substr($str, 0, 350).'...' : $str; ?></p>
  <?php endif;?>
  </div>
</article>