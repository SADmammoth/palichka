<form id='userform' enctype="multipart/form-data" action='<?php echo get_permalink() .
  "?edit=false"; ?>' method='POST' onsubmit='event.preventDefault(); if((this.email_validated || this.email_validated === undefined)&&(this.age_validated || this.age_validated === undefined)){this.submit();}'>
<section id='master-section'>
 <?php $user = wp_get_current_user(); ?>
    <input type='hidden' name='user_id' value='<?php echo get_current_user_id(); ?>'/>
    <button type='submit' class='floating-btn'><i class='fas fa-check pictogram'></i></button>
    <div class='container horizontal-flex-block' style='margin-bottom: 20px; position: relative; justify-content: flex-start;'>
    <input type='file' id='photo_input' name='photo' accept="image/png,image/gif,image/jpeg" style="display: none;  padding: 0; border: 0" onchange='document.getElementById("photo").setAttribute("src", window.URL.createObjectURL(this.files[0]))'/>
    <label for='photo_input'  style='margin-top: -100px; position: relative' ><i class='fas fa-edit' style='font-size: 1.5rem; left: 8px; top: 8px;position: absolute; text-shadow: 0 0 2px white'></i><img  class='photo' id='photo' width='200' height='200' src='<?php echo get_current_user_avatar()
      ? get_current_user_avatar()
      : get_site_url() .
        '/wp-content/uploads/2019/08/tablero-de-paleta-de-pintura-con-contorno-de-pincel.png'; ?>' alt='<?php echo the_title(); ?>' title='<?php echo the_title(); ?>'/></label>
    </label>
        <div class='master-description'>
          <div class='background'>
            <h1 class='h1-small'>
              <?php echo $user->user_firstname
                ? $user->user_firstname . ' ' . $user->lastname
                : $user->user_login; ?>
            </h1>
            Зарегистрирован: 
          <?php
          $date = DateTime::createFromFormat('Y-m-j H:i:s', $user->user_registered);
          setlocale(LC_ALL, "ru_RU.UTF-8", "Russian_Russia.UTF-8");
          echo strftime('%e %b %Yг.', $date->getTimestamp());
          ?>
          </div>
        <p class='main-text additional-text option option-box' style='padding: 5px; height: 55px; margin-bottom: 10px;'>
        <label
              for="email"
                  class="additional-text"
                  style="font-size: 1.5rem; margin: 5px 2px"
                >
                <i class="fas fa-edit"></i>
                </label>
                <input
                  id="email"
                  name="email"
                  class="option-box"
                  type="text"
                  value="<?php echo $user->user_email; ?>"
                  placeholder="Email"
                  style='text-indent: 10px; padding: 0px;'
                  onchange='check_email(this, this.form.age_validated || this.form.age_validated===undefined, "<?php echo get_template_directory_uri() .
                    "/inc/users.php"; ?>"); if(this.value === "<?php echo $user->user_email; ?>"){this.form.email_validated = true; hide_user_message(true);}'
                />
       
        </p>
        <?php wp_enqueue_script('palichka-registration'); ?>
        <p class='main-text additional-text option option-box'  style='padding: 5px; height: 55px; margin-bottom: 10px;'>
        <label
              for="word_about"
                  class="additional-text"
                  style="font-size: 1.5rem; margin: 5px 2px"
                >
                <i class="fas fa-edit"></i>
                </label>
                <input
                  id="word_about"
                  name="word_about"
                  class="option-box"
                  type="text"
                  <?php
                  $info = get_user_meta(get_current_user_id(), 'word_about', true);
                  echo $info !== '' ? 'value=' . '"' . $info . '"' : '';
                  ?>
                  placeholder="Пару слов: профессия/мировоззрение/вероисповедание и т.п."
                  style='text-indent: 10px; padding: 0px;'
                />
        </p>
        <p class='main-text additional-text option option-box'  style='padding: 5px; height: 55px; margin-bottom: 10px;'>
        <label
              for="age"
                  class="additional-text"
                  style="font-size: 1.5rem; margin: 5px 2px"
                >
                <i class="fas fa-edit"></i>
                </label>
                <input
                  id="age"
                  name="age"
                  class="option-box"
                  type="text"
                  <?php
                  $age = get_user_meta(get_current_user_id(), 'age', true);
                  echo $age !== '' ? 'value=' . '"' . $age . '"' : '';
                  ?>
                  placeholder="Возраст, ?? лет"
                  style='text-indent: 10px; padding: 0px;'
                  onchange='this.form.age_validated = /[0-9]{2,3} (лет)|(год)|(года)/.test(this.value); if(!this.form.age_validated){user_message(this.form, "Возраст введен в неверном формате");}else if(this.form.email_validated || this.form.email_validated === undefined){hide_user_message(this.form);}'
                />
        </p>
        <div class='user_message hint error-message hidden main-text' style='height: 15px; width: 50%; position: absolute;'>
        <i class='fas fa-times-circle' style='float: left; padding-right: 15px; clear: none;'></i>
        <span class='message' style='float: left; clear: none; width: 80%;'></span>
        </div>
        </div>
      </div>
    </section>
    <section>
    <h2 class='background wide-toleft'>Ваш отзыв</h2>
    <div id='reviewsection' class='vertical-flex-block wide-toleft background' style='margin-bottom: 30px' style='justify-content: center;'>
        <script>
        let form = document.getElementById('userform');
        if(form.checkValidity() && (this.email_validated || this.email_validated === undefined)&&(this.age_validated || this.age_validated === undefined)){
          document.getElementById('reviewsection').innerHTML = `
          <?php
          $query = new WP_Query([
            'author' => get_current_user_id() === 1 ? 'any' : get_current_user_id(),
            'post_status' => 'any',
            'post_type' => 'review'
          ]);
          if (!$query->have_posts()) {
            while ($query->have_posts()) {
              $query->the_post(); ?>
            <p class='additional-text'><?php echo the_title(); ?></p>
            <label
              for="'review_<?php echo get_the_ID(); ?>'"
                  class="additional-text"
                  style="font-size: 1.5rem; margin: 5px 2px"
                >
                <i class="fas fa-edit"></i>
                </label>
            <textarea id='review_<?php echo get_the_ID(); ?>' name='review_<?php echo get_the_ID(); ?>' class='option-box option' style='resize: none; height: 70px' rows='3' cols='70'><?php echo rwmb_meta(
  'review-body'
); ?></textarea>
            <?php
            }
          } else {
             ?>
            <label
              for="review_new"
                  class="additional-text"
                  style="font-size: 1.5rem; margin: 5px 2px"
                >
                <i class="fas fa-edit"></i>
                Текст отзыва
                </label>
            <textarea id='review_new' name='review_new'  class='option-box option' style='resize: none; height: 70px' rows='3' cols='70'></textarea>
            <?php
          }
          ?>
          `
        }
        </script>
    </div>
    </section>
      </form>