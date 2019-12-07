<?php
if(!is_user_logged_in()){
  wp_redirect( get_site_url().'/404' );
}
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
      <?php
      if(isset($_GET['edit'])){
        if($_GET['edit'] === 'true'){
        get_template_part('template-parts/content-usereditor');
        }
        else{
          if(isset($_POST)){
            $args = [];
            if(isset($_POST['email'])){
              $args['user_email']=$_POST['email'];
            }
            if(isset($_POST['age'])){
              update_user_meta($_POST['user_id'], 'age', $_POST['age']);
            }
            if(isset($_POST['word_about'])){
              update_user_meta($_POST['user_id'], 'word_about', $_POST['word_about']);
            }
          }
          wp_update_user($_POST['user_id'], $args);
          ?>
          <script>
          document.location.href='<?php echo get_site_url().'/user'?>';
          </script>
          <?php
        }
      }
      else{
        get_template_part('template-parts/content-user');
      }
      ?>
    </main>
  </div>
<?php
get_footer()
?>