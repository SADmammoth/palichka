<!-- <?php
header("Content-type: text/css; charset: UTF-8"); 
define('WP_USE_THEMES', false);

include('../../../../wp-load.php');

$to = get_theme_mod('email');
$email = $_POST['email']; 
$subject = $_POST['subject']; 
$message = 'Send by '.$email.' from site for administrator<br/>'.$_POST['message'];

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

add_filter( 'wp_mail_content_type', 'set_content_type' );
function set_content_type( $content_type ) {
	return 'text/html';
}
wp_mail($to, $subject, $message, $headers);
$reply_subject = 'Ответ на "'.$subject.'"';
$reply_message = 'Спасибо, что воспользовались формой обратной связи на сайте "Свая Палiчка"!<br/>
                  Ваше сообщение:<br/>
                  &lt;Тема&gt;: '.$subject.
             '<br/>&lt;Текст&gt;: '.$_POST['message'];
wp_mail($email, $reply_subject, $reply_message, $headers);
remove_filter( 'wp_mail_content_type', 'set_content_type' );

header('Refresh: 0; url='.get_site_url().'/'.$_POST['page']);
?>
Ваше сообщение успешно отправлено
<?php 
