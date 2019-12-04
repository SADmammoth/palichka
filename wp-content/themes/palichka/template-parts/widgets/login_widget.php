<?php 
class LoginWidget extends WP_Widget {
  public function __construct() {
    $widget_options = array( 
      'classname' => 'login_widget',
      'description' => 'Виджет для входа и регистрации пользователей'
    );
    parent::__construct( 'login_widget', 'Вход/регистрация', $widget_options );
  }

  public function widget( $args, $instance ) {
    if(!is_user_logged_in()):
    ?>
    <form action='<?php echo get_template_directory_uri().'/inc/users.php'?>' method='POST' class='background' style='margin-top: -8px;'
    onsubmit="check_submit(this)">
    <div class='dropdown' style='padding: 0 5px;'>
      <label class='link additional-text' for='signin'>Войти</label>
      <input id='signin' class='common-dropdown dropdown-trigger' type='checkbox'/>
      <div class='option-dropdown-content dropdown-content vertical-flex-block' style='width: 230%; padding-bottom: 10px;'>
        <input type='text' class='option option-box' name='username' placeholder='Логин или Email' onchange='check_validity_combined(this)'/>
        <input type='password' class='option option-box' name='password' placeholder='Пароль'/>
        <div class='user_message hint error-message hidden' style='width: 90%; margin-bottom: 5px;'>
        <i class='fas fa-times-circle' style='float: left; padding-right: 15px; clear: none;'></i>
        <span class='message' style='float: left; clear: none; width: 80%;'></span>
        </div>
        <div style='width: 100%;'>
        <a onclick='close_dropdown(this);' class='link hint' style='cursor: pointer'>Отмена</a>
        <input type='hidden' name='reg' value='false'>
        <input type='hidden' name='redirectpath' value=''>
        <button type='submit' class='button' style='float: right;'>Войти</button>
        <?php wp_enqueue_script( 'palichka-registration');?>
        </div>
      </div>
    </div>
    </form>
    <div>
      <a href='<?php echo get_site_url().'/register'?>' style='margin: 0 5px;' class='link hint'>Зарегистрироваться</a>
    </div>
    <?php
    else:
    ?>
    <div style='width: 200px'>
    <div class='hint' style='margin-top: 5px;'>Вы вошли, как</div>
    <div class='background additional-text' style=' margin-top: 2px; padding: 5px; padding-top: 0px;'>
    <div>
    <?php 
    $name = wp_get_current_user()->user_firstname?wp_get_current_user()->user_firstname:wp_get_current_user()->user_login;
    echo (strlen($name)>15)? substr($name, 0, 15).'...' : $name;?>
    </div>
    <a class='link hint' style='text-align: right; width: 100%; display: block;' href='<?php echo wp_logout_url(get_site_url())?>'>Выход</a>
    </div>
    </div>
    
    <?php
    
  endif;
  }

  public function form( $instance ) {
   ?>
   <p>
      <strong>Виджет входа/регистрации успешно добавлен</strong>
   </p>
   <?php
  }

  public function update($new_instance, $old_instance){
    $instance = $old_instance;
    return $instance;
  }
}
function register_login_widget() { 
  register_widget( 'LoginWidget' );
}
add_action( 'widgets_init', 'register_login_widget');
?>