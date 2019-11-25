<?php
/**
 * Template name: Мастера
 * Template Post Type: page
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

get_header();
require get_template_directory() . '/template-parts/archive-template.php'
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
     <h1 class='h1-small background wide-toleft'>Галерея мастеров</h1>
      <section class='cards vertical-flex-block wide-toleft' style='min-height: 49vh'>
      <?php $archive = get_the_archive_template('masters');
          echo($archive['cards']);
      ?>
      </section>
      <?php
          echo($archive['sidebar']); 
      ?>
      </main>
</div>
<?php
get_footer();
