<?php

class LoginWidget extends WP_Widget
{
  public function __construct()
  {
    $widget_options = array(
      'classname' => 'login_widget',
      'description' => 'Виджет для входа и регистрации пользователей'
    );
    parent::__construct('login_widget', 'Вход/регистрация', $widget_options);
  }

  public function widget($args, $instance)
  {
    if (!is_user_logged_in()): ?>
<form action='<?php echo get_template_directory_uri() .
  '/inc/users.php'; ?>' method='POST' class='background'
  style='margin-top: -8px;' onsubmit='check_submit(this)'>
  <div class='dropdown' style='padding: 0 5px; margin-left: 25px'>
    <label class='link additional-text' for='signin'>Войти</label>
    <input id='signin' class='common-dropdown dropdown-trigger' type='checkbox' />
    <div class='option-dropdown-content dropdown-content vertical-flex-block'
      style='width: 240%; left: -125px; padding-bottom: 10px;'>
      <input type='text' class='option option-box' name='username' placeholder='Логин или Email'
        onchange='check_signin(this)' />
      <input type='password' class='option option-box' name='password' placeholder='Пароль' />
      <div class='user_message hint error-message hidden' style='width: 90%; margin-bottom: 5px;'>
        <i class='fas fa-times-circle' style='float: left; padding-right: 15px; clear: none;'></i>
        <span class='message' style='float: left; clear: none; width: 80%;'></span>
      </div>
      <div style='width: 100%;'>
        <a onclick='close_dropdown(this, true, false);' class='link hint' style='cursor: pointer'>Отмена</a>
        <input type='hidden' name='reg' value='false'>
        <input type='hidden' name='redirectpath' value=''>
        <button type='submit' class='button' style='float: right;'>Войти</button>
        <?php wp_enqueue_script('palichka-registration'); ?>
      </div>
    </div>
  </div>
</form>
<div>
  <a href='<?php echo get_site_url() .
    '/register'; ?>' style='margin: 0 5px;' class='link hint'>Зарегистрироваться</a>
</div>
<?php else: ?>
<div class='login-widget' style='width: 200px; max-height: 80px; box-sizing: border-box;'>
  <div class='hint' style='margin-top: 5px;'>Вы вошли, как</div>
  <div class='background additional-text' style='margin-top: 2px; padding: 5px; padding-top: 25px; width: 100%; position: relative;'>
    <strong class='link' onclick='document.location.href="<?php echo get_site_url() .
      "/user"; ?>"' style='position: absolute; top: 2px; left: 50%; transform: translateX(-50%)'><?php
$name = wp_get_current_user()->user_firstname
  ? wp_get_current_user()->user_firstname
  : wp_get_current_user()->user_login;
echo strlen($name) > 15 ? substr($name, 0, 15) . '...' : $name;
?></strong>
    <a class='hint' style='text-align: center; width: 100%; display: block; padding-top: 8px;'
      href='<?php echo wp_logout_url(get_site_url()); ?>'>Выход</a>
  </div>
</div>

<?php endif;
  }

  public function form($instance)
  {
    ?>
<p>
  <strong>Виджет входа/регистрации успешно добавлен</strong>
</p>
<?php
  }

  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    return $instance;
  }
}

function register_login_widget()
{
  register_widget('LoginWidget');
}
add_action('widgets_init', 'register_login_widget');
?>
