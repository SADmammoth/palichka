<?php
/**
 * The template for displaying archive pages
 * Template name: Masters
 * Template Post Type: page
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
    <h1 class='h1-small background wide-toleft'>Аренда &quot;Палiчкi&quot;</h1>
      <div class='container'>
        <section class='leftside-section'>
          <p class='main-text hyphenated'>
          <?php echo get_theme_mod('rent-desc');?>
          </p>
          <ul class='quote notype-list'>
          <?php $prices = get_theme_mod('rent_price_list');
          foreach($prices as $price){
            ?>
             <li>
              <strong class="price"><?php echo $price['value']?> BYN/мес <em class='discount'><?php if( $price['discount'] !== ''){ echo '-'.$price['discount'].'%';}?></em></strong>
              <p class='description'><?php echo $price['desc']?></p>
            </li>
            <?php
          }
          ?>
          </ul>
            <p class='description' style='display: inline-block;'>Для получения подробной информации, воспользуйтесь <strong>формой обратной связи</strng>
            <a href='#feedback-email' class='pictogram desktop'><i class='fas fa-chevron-right'></i></a>
            <a href='./contacts.html' class='pictogram handheld'><i class='fas fa-chevron-right'></i></a></p>
        </section>

        <section class='rightside-section'>
        <form id='feedback-form' action='<?php echo get_template_directory_uri()?>/inc/sendmail_post.php' method='POST' >
            <input type='text' name='page' value='rentprices' style='display: none'>
            <fieldset class='form-head'>
              <input id='feedback-email' class='form-input' type='email' name='email' placeholder='Email *' required/>
              <input id='feedback-subject' class='form-input' maxlength='60' type='text' name='subject' value='Аренда Палiчкi' list='subjects' placeholder='Тема письма *' required/>
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
      </div>
    </main>
  </div>
<?php
get_footer();
