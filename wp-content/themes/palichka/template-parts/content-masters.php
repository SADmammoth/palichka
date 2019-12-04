<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

 get_header();
  ?>
 <section id='master-section'>
 <?php
 if(wp_get_current_user()->user_login === basename(get_permalink())):
 ?>
 <form class='floating-btn' action='' method='GET'>
    <input type='hidden' name='edit' value=true />
    <button type='submit' style='background: none'><i class='fas fa-edit pictogram'></i></button>
</form>
 <?php endif;?>
    <div class='container horizontal-flex-block' style='margin-bottom: 20px; position: relative; justify-content: flex-start;'>
      <img class='photo' width='200' height='200'  src='<?php $pic = reset(rwmb_meta('masters-photo'))['url']; echo $pic?$pic:get_site_url().'/wp-content/uploads/2019/08/tablero-de-paleta-de-pintura-con-contorno-de-pincel.png'?>' alt='<?php echo the_title()?>' title='<?php echo the_title() ?>' />
        <div class='master-description'>
          <div class='background'>
            <h1 class='h1-small'><?php echo the_title()?></h1>
          </div>
          <div class='main-text hyphenated'>
          <p>
          <?php echo rwmb_meta('masters-desc');

          ?>
          </p>
          <?php
          if(is_user_logged_in()):
          ?>
          <p>
            <form method="POST" action="<?php echo get_template_directory_uri()."/inc/like.php"?>">
          <input id='best_master' class='like' name='liked' type="checkbox" onchange="like(this, <?php echo get_the_ID().', '.get_current_user_id()?>)" <?php if(in_array(get_the_ID(), get_user_meta(get_current_user_id(), 'liked_masters', true))) echo 'checked'?>/>
          <label for='best_master'><span class='like_counter'><?php echo count(get_post_meta(get_the_ID(), 'liked_by_users', true))?></span></label>
          </form>
          </p>
          <?php 
          wp_enqueue_script( 'palichka-like' );      
          endif;?>
          </div>
        </div>
      </div>
    </section>
    <section id='palichka-section'>
      <div class='container'>
        <h2 class='h2 title'>"Палiчка" мастера</h2>
      </div>
      <div class='background'>
        <div class='container'>
          <div class='horizontal-flex-block palichka-grid '>
          <?php $gallery =  rwmb_meta('masters-gallery');
          $count = 1;
          $my_query = new WP_Query([
            'post_type'=>'masterpiece', 
            'meta_key' => 'masterpiece-master_link', 
            'meta_value' => get_the_ID()
          ]);
          
          $counter = $count;
          if($my_query->found_posts):
            while($my_query->have_posts()) {
              $counter = $counter+1;

              $my_query->the_post();
              get_template_part('template-parts/masterpiece-card');
              ?>
              </a>
              <?php
              if($counter === 6){
                ?>
                  <div id='more' onclick='show_additional_gallery(this, "#additional-master-gallery", this, ".shelf");' class='hflex-item action-box'>
                      <a class='link'>Больше</a>
                      <a class='pictogram'><i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class='shelf desktop'></div>
                <div id='additional-master-gallery' class='hidden horizontal-flex-block palichka-grid'>
              <?php
              }
            }
          
          if($counter > 5):?>
              <div id='less' onclick='hide_additional_gallery(this, "#additional-master-gallery", "#more", ".shelf");' class='hflex-item action-box'>
                <a class='pictogram'><i class="fas fa-chevron-left"></i></a>
                <a class='link'>Свернуть</a>
              </div>
              </div>
          <?php endif;
              else:
            ?>
            <p class='additional-text' style='text-align: center; width: 100%;'>Мастер пока не опубликовал ни одной работы. Либо они просто нарасхват)</p>
            <?php
              endif;
            ?>
        </div>
      </div>
    </section>
<?php
get_footer();
?>