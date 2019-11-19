<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package palichka
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
      
      if ($_GET){
        if($_GET['edit']==='true'){
          get_template_part( 'template-parts/content', 'editor' );
        }
        if($_GET['edit']==='false'){
          wp_update_post(['ID'=> get_the_ID(), 'post_title'=>$_GET['title'], 'meta_input'=>array('masters-desc'=>$_GET['desc'])], false);
          ?>
          <script>
            document.location.href = '<?php echo get_permalink() ?>'
          </script>
          <?php
        }
      }
      else if($_POST){
      
      }
      else{
        get_template_part( 'template-parts/content', 'masters' );
      }
      
		endwhile; // End of the loop.
		?>
    
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
