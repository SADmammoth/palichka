<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

get_header(); ?>
<form enctype="multipart/form-data" action='<?php echo get_permalink(); ?>' method='POST'>
 <section id='master-section'>
 
 <input type='hidden' name='post_id' value='<?php get_current_user_id(); ?>'/>
 <div class='floating-btn'>
    <input type='hidden' name='edit' value=false />
    <button type='submit' style='background: none'><i class='fas fa-check pictogram'></i></button>
</div>
    <div class='container horizontal-flex-block' style='position: relative; justify-content: flex-start;'>
          <input type='file' id='photo_input' name='photo' accept="image/png,image/gif,image/jpeg" style="display: none;  padding: 0; border: 0" onchange='console.log(); document.getElementById("photo").setAttribute("src", window.URL.createObjectURL(this.files[0]))'/>
          <label for='photo_input' style='position: relative;'><i class='fas fa-edit' style='font-size: 1.5rem; left: 8px; top: 8px;position: absolute; text-shadow: 0 0 2px white'></i><img  class='photo' id='photo' width='200' height='200' src='<?php
          $pic = reset(rwmb_meta('masters-photo'))['url'];
          echo $pic
            ? $pic
            : get_site_url() .
              '/wp-content/uploads/2019/08/tablero-de-paleta-de-pintura-con-contorno-de-pincel.png';
          ?>' alt='<?php echo the_title(); ?>' title='<?php echo the_title(); ?>' />
          </label>
        <div class='master-description'>
          <div class='background'>
            <h1  class="h1-small option option-box"
                style="height: 70px; padding: 7px 18px; margin: 0"
              > <label
                  for="title"
                  class="additional-text"
                  style="font-size: 1.5rem; margin: 11px -5px"
                >
                  <i class="fas fa-edit"></i>
                </label>
                <input
                  id="title"
                  name="title"
                  class="option-box"
                  type="text"
                  value="<?php echo the_title(); ?>"
                  placeholder="ФИО или псевдоним  "
                /></h1>
          </div>
          <div
              class="main-text option-box option"
              style="margin: -10px 0 0 50px; padding: 15px; height: 160px; width: 88%"
            >
              <label for="desc" class="additional-text" style="font-size: 1.5rem;">
                <i class="fas fa-edit"></i>
              </label>
              <textarea
                id="desc"
                name='desc'
                class="option-box"
                style="margin: 0 30px; resize: none; overflow: hidden; width: 90%"
              ><?php echo rwmb_meta('masters-desc'); ?></textarea
              >
            </div>
          </div>
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
          <?php
          $gallery = rwmb_meta('masters-gallery');
          $count = 1;
          $my_query = new WP_Query([
            'post_type' => 'masterpiece',
            'meta_key' => 'masterpiece-master_link',
            'meta_value' => get_the_ID()
          ]);

          $counter = $count;
          if ($my_query->found_posts):
            while ($my_query->have_posts()) {

              $counter = $counter + 1;
              $my_query->the_post();
              get_template_part('template-parts/masterpiece-card');
              ?>
              </a>
              <?php if ($counter === 6) { ?>
                  <div id='more' onclick='show_additional_gallery(this, "#additional-master-gallery", this, ".shelf");' class='hflex-item action-box'>
                      <a class='link'>Больше</a>
                      <a class='pictogram'><i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class='shelf desktop'></div>
                <div id='additional-master-gallery' class='hidden horizontal-flex-block palichka-grid'>
              <?php }
            }

            if ($counter > 5): ?>
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
    </form>
<?php get_footer();
?>
