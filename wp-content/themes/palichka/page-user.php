<?php
if (!is_user_logged_in()) {
  wp_redirect(get_site_url() . '/404');
}
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
      <?php if (isset($_GET['edit'])) {
        if ($_GET['edit'] === 'true') {
          get_template_part('template-parts/content-usereditor');
        } else {

          if (isset($_POST)) {
            $args = [];
            if (isset($_POST['email'])) {
              $args['user_email'] = $_POST['email'];
            }
            if (isset($_POST['age'])) {
              update_user_meta($_POST['user_id'], 'age', $_POST['age']);
            }
            if (isset($_POST['word_about'])) {
              update_user_meta($_POST['user_id'], 'word_about', $_POST['word_about']);
            }
            if (isset($_FILES['photo'])) {
              $photo = $_FILES['photo'];
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
                    $_POST['user_id']
                  );
                  require_once ABSPATH . 'wp-admin/includes/image.php';
                  wp_update_attachment_metadata(
                    $upload_id,
                    wp_generate_attachment_metadata($upload_id, $new_file_path)
                  );
                }
                update_user_meta(
                  $_POST['user_id'],
                  $wpdb->get_blog_prefix() . 'user_avatar',
                  $upload_id
                );
              }
            }
            $user = get_user_by('id', $_POST['user_id']);
            foreach ($_POST as $name => $value) {
              if (strpos($name, 'review_') !== false) {
                $new = str_replace('review_', '', $name);
                if ($new === 'new') {
                  $id = wp_insert_post([
                    'post_type' => 'review',
                    'post_author' => $user->ID,
                    'post_title' => $user->user_nicename . '_' . $new,
                    'post_status' => 'pending',
                    'meta_input' => [
                      'review-photo' => get_user_meta($_POST['user_id'], 'user_avatar'),
                      'review-name' => $user->user_nicename,
                      'review-profession' => get_user_meta($user->ID, 'word_about', true),
                      'review-age' => get_user_meta($user->ID, 'age', true),
                      'review-body' => $value
                    ]
                  ]);
                  wp_update_post(['ID' => $id, 'post_status' => 'pending']);
                } else {
                  $old_value = str_replace("\"", "\\\"", get_post_meta($new, 'review-body', true));
                  $old_value = str_replace("\'", "\\\'", $old_value);
                  if ($old_value != $value) {
                    wp_update_post(['ID' => $new, 'post_status' => 'pending']);
                    update_post_meta($new, 'review-body', $value);
                  }
                }
              }
            }
          }
          wp_update_user($_POST['user_id'], $args);
          ?>
          <script>
          document.location.href='<?php echo get_site_url() . '/user'; ?>';
          </script>
          <?php
        }
      } else {
        get_template_part('template-parts/content-user');
      } ?>
    </main>
  </div>
<?php get_footer();
?>
