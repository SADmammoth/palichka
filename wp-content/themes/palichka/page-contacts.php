<?php
/**
 * Template name: Контакты
 * Template Post Type: page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
    <h1 class='h1-small background wide-toleft'>Обратная связь</h1>
      <div class='container'>
        <section class='leftside-section'>
          <form id='feedback-form' action='<?php echo get_template_directory_uri(); ?>/inc/sendmail_post.php' method='POST' >
            <input type='text' name='page' value='contacts' style='display: none'>
            <fieldset class='form-head'>
              <input id='feedback-email' class='form-input' type='email' name='email' placeholder='Email *' required/>
              <input id='feedback-subject' class='form-input' maxlength='60' type='text' name='subject' list='subjects' placeholder='Тема письма *' required/>
              <datalist id='subjects'>
                <option value='Аренда Палiчкi'>
                <option value='Отзыв от мастера'>
                <option value='Отзыв от покупателя'>
                <option value='Замечания по работе сайта'>
                <option value='Справочная информация'>
            </datalist>
            </fieldset>
            <fieldset class='form-body'>
              <textarea id='feedback-body' name='message' class='form-input' maxlength='998' style='resize: none' placeholder='Текст письма *' required></textarea>
            </fieldset>
            <fieldset class='form-footer'>
              <span class='submit_message'><i class="fas fa-check-circle"></i>Ваше сообщение успешно отправлено</span>
              <button type='submit' onclick='event.preventDefault(); show_message(this.form, ".submit_message")' target='submit_message' class='button'>Отправить</button>
            </fieldset>
          </form>
        </section>

        <section class='rightside-section'>
          <ul style='list-style-type: none;'>
            <li style='margin-bottom: 5px;'>
              <a class='h3' href='tel:<?php echo get_theme_mod(
                'phone'
              ); ?>'><i class="fas fa-mobile-alt pictogram" style='margin-right: 5px;'></i><?php echo get_theme_mod(
  'phone'
); ?></a>
            </li>
            <li style='margin-bottom: 5px; margin-left: -5px;'>
              <a class='h3' href='mailto:<?php echo get_theme_mod(
                'email'
              ); ?>'><i class="fas fa-at pictogram" style='margin-right: 5px;'></i><?php echo get_theme_mod(
  'email'
); ?></a>
            </li>
            <li  style='margin-bottom: 5px;'>
              <a class='h3' href='<?php echo get_theme_mod('link_on_map'); ?>'>
                <i class="fas fa-map-marker-alt pictogram" style='margin-right: 10px;'></i><?php echo get_theme_mod(
                  'adress'
                ); ?></a>
              <div class='mapbox' style='background-image: url("<?php echo get_theme_mod(
                'map_image'
              ); ?>")'>
                <script type="text/javascript" charset="utf-8" async src="<?php echo get_theme_mod(
                  'map_code_link'
                ); ?>"></script>
              </div>
            </li>
          </ul>
        </section>
      </div>
    </main>
  </div>
<?php get_footer();
