<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package palichka
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php while (have_posts()):
    the_post();

    if ($_GET) {
      if (wp_get_current_user()->user_login === basename(get_permalink())) {
        if ($_GET['edit'] === 'true') {
          get_template_part('template-parts/content', 'editor');
        }
      } elseif ($_POST['edit'] === 'false') {

        $upload_id = reset(rwmb_meta('masters-photo'))['ID'];
        $photo = $_FILES['photo'];
        echo strpos($photo['type'], 'image/');
        if (strpos($photo['type'], 'image/') !== false) {
          $wordpress_upload_dir = wp_upload_dir();

          $i = 1;
          $new_file_path = $wordpress_upload_dir['path'] . '/' . $photo['name'];
          while (file_exists($new_file_path)) {
            $i++;
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $photo['name'];
          }
          if (move_uploaded_file($photo['tmp_name'], $new_file_path)) {
            $upload_id = wp_insert_attachment(
              array(
                'guid' => $new_file_path,
                'post_mime_type' => $photo['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', $photo['name']),
                'post_content' => '',
                'post_status' => 'inherit'
              ),
              $new_file_path,
              $_POST['post_id']
            );
            require_once ABSPATH . 'wp-admin/includes/image.php';
            wp_update_attachment_metadata(
              $upload_id,
              wp_generate_attachment_metadata($upload_id, $new_file_path)
            );
          }
        }
        wp_update_post(
          [
            'ID' => $_POST['post_id'],
            'post_type' => 'masters',
            'post_title' => $_POST['title'],
            'meta_input' => array('masters-photo' => $upload_id, 'masters-desc' => $_POST['desc'])
          ],
          false
        );
        ?>
        <script>
          document.location.href = '<?php echo get_permalink(); ?>'
        </script>
        <?php
      } else {
         ?>
      <script>
        document.location.href = '<?php echo get_site_url() . '/404.php'; ?>';
      </script>
      <?php
      }
    } else {
      get_template_part('template-parts/content', 'masters');
    }
  endwhile;
// End of the loop.
?>
    
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
