<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

get_header();

?>

<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<section id='main-section'>
      <div class='container' style='position: absolute; top: 25%;'>
        <h1>Свая Палiчка</h1>
        <p class='main-text'>Яркая площадка креативной Беларуси</p>
      </div>
      <div class='leftside-wide-btngroup'>
        <a href='#news-section' class='button'>Посмотреть обновления</a>
      </div>
    </section>

    <section class='desc-section'>
      <div class='background'>
        <div class='container'>
          <p class='main-text hyphenated'>
            &quot;Свая палiчка&quot; предлагает покупателям большой выбор прекрасных изделий ручной работы, созданных в различных техниках лучшими мастерами страны. Мы организуем для мастеров-ремесленников торговые площадки, продвигает их в online и offline, способствует
            сотрудничеству бизнеса.
          </p>
        </div>
      </div>
      <div class='container'>
        <p class='additional-text hyphenated'>
          &quot;Свая палiчка&quot; собирает счастливых, креативных, позитивных людей; творческих, талантливых, &quot;рукастых&quot; мастеров; всех кто сохраняет и показывает зелёную планету; тех кто развивается сам и помогает развиваться другим.
        </p>
      </div>
    </section>

    <section id='masters-section' class='articles-grid'>
      <h2 class='title'>Лучшие мастера</h2>
      <p class='description hyphenated'>Без мастеров никогда не было бы нашей крамы: мы помогаем им найти ценителей их работ, а они нас вдохновляют! Каждый раз, покупая изделие, вы голосуете за лучшего мастера нашей крамы. Познакомьтесь с текущими лидерами!</p>
      <div class='articles background vertical-flex-block'>
        <article class='vflex-item masters-card card'></article>
        <article class='vflex-item masters-card card'></article>
      </div>
      <a href='#' class='button'>Посмотреть всех</a>
    </section>

    <section id='feedback-section' class='articles-grid'>
      <h2 class='title'>Рекомендации и отзывы</h2>
      <p class='description hyphenated'>Главное для нас – чтобы и мастера, и покупатели остались довольны. Мы рады получать положительные отзывы и готовы поделиться ими с Вами!</p>
      <div class='articles background vertical-flex-block'>
        <arcticle class='vflex-item review-card card'></arcticle>
        <arcticle class='vflex-item review-card card'></arcticle>
        <arcticle class='vflex-item review-card card'></arcticle>
      </div>
      <a href='#' class='button'>Оставить отзыв</a>
    </section>

    <section id='messege-section' class='message-grid'>
      <h2 class='message-title'>Вы Мастер и хотите завести сваю "Палiчку"?
        <br/>
        <span class='subtitle'>Вы можете сделать это онлайн!</span></h2>
      <a href='#' class='button'>Обратная связь</a>
      <p class='description hyphenated'>Мы можем гарантировать вам полную поддержку и всестороннюю консультацию, поможем снискать армию поклонников и истинное уважение коллег. Присоединяйтесь к дружному коллективу мастеров и покупателей!</p>
    </section>

    <section id='news-section'>
      <div class='container'>
        <h2>Обновления</h2>
      </div>
      <div class='background'>
        <div class='container news-grid'>
          <div class='medium-topic'>
            <h3>Блог</h3>
            <div class='cards vertical-flex-block'>
              <article class='vflex-item blog-card topic-card'></article>
              <a href='#' class='link'>Далее</a>
            </div>
          </div>
          <div class='small-topic'>
            <h3>Новые работы</h3>
            <div class='cards horizontal-flex-block'>
              <article class='hflex-item masterpiece-card topic-card'></article>
              <article class='hflex-item masterpiece-card topic-card'></article>
              <article class='hflex-item masterpiece-card topic-card'></article>
              <article class='hflex-item masterpiece-card topic-card desktop'></article>
              <article class='hflex-item masterpiece-card topic-card desktop'></article>
              <a href='#' class='hflex-item pictogram'><i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
          <div class='small-topic'>
            <h3>Новые мастера</h3>
            <div class='cards horizontal-flex-block'>
              <article class='hflex-item masters-card-min topic-card'></article>
              <article class='hflex-item masters-card-min topic-card'></article>
              <article class='hflex-item masters-card-min topic-card'></article>
              <article class='hflex-item masters-card-min topic-card desktop'></article>
              <article class='hflex-item masters-card-min topic-card desktop'></article>
              <a href='#' class='hflex-item pictogram'><i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
