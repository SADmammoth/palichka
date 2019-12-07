<section id='master-section'>
 <?php
 $user = wp_get_current_user();
 ?>
 <form class='floating-btn' action='' method='GET'>
    <input type='hidden' name='edit' value=true />
    <button type='submit' style='background: none'><i class='fas fa-edit pictogram'></i></button>
</form>
    <div class='container horizontal-flex-block' style='margin-bottom: 20px; position: relative; justify-content: flex-start;'>
      <img class='photo' width='200' height='200'  src='<?php echo get_current_user_avatar()?get_current_user_avatar():get_site_url().'/wp-content/uploads/2019/08/tablero-de-paleta-de-pintura-con-contorno-de-pincel.png'?>' alt='<?php echo the_title()?>' title='<?php echo the_title() ?>' />
        <div class='master-description'>
          <div class='background'>
            <h1 class='h1-small'>
              <?php echo $user->user_firstname?$user->user_firstname.' '.$user->lastname:$user->user_login?>
            </h1>
            Зарегистрирован: 
          <?php
          $date = DateTime::createFromFormat('Y-m-j H:i:s', $user->user_registered);
          setlocale(LC_ALL, "ru_RU.UTF-8", "Russian_Russia.UTF-8");
          echo  strftime('%e %b %Yг.', $date->getTimestamp()) ; ?>
          </div>
          <p class='main-text additional-text'>
        <i class='fas fa-envelope'></i>
        <?php echo $user->user_email?>
        </p>
        <p class='main-text additional-text'>
        <i class='fas fa-info-circle'></i>
          <?php $info = get_user_meta(get_current_user_id(), 'word_about', true); echo $info!==''?$info:'Информация не указана'?>
        </p>
        <p class='main-text additional-text'>
        <i class='fas fa-calendar-check'></i>
          <?php $age = get_user_meta(get_current_user_id(), 'age', true); echo $age!==''?$age:'Возраст не указан' ?>
        </p>
        </div>
      </div>
    </section>
    <section>
    <?php
       
        $query = new WP_Query([
          'author'=> get_current_user_id()===1?0:get_current_user_id(),
          'post_status' => 'any',
          'post_type'=>'review',
        ]);
        if($query->have_posts()):
        ?>
    <h2 class='background wide-toleft'>Ваш отзыв</h2>
    <div class='vertical-flex-block wide-toleft background' style='margin-bottom: 30px' style='justify-content: center;'>
      <?php

        while($query->have_posts()){
          $query->the_post();
          get_template_part('template-parts/review-card');
        }
      endif;
        ?>
        
    </div>
    </section>