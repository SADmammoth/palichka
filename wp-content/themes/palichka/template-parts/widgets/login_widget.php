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
    ?>
    <form class='background' style='margin-top: -8px;'>
    <div class='dropdown' style='padding: 0 5px;'>
      <label class='link additional-text' for='signin'>Войти</label>
      <input id='signin' class='common-dropdown dropdown-trigger' type='checkbox'/>
      <div class='option-dropdown-content dropdown-content vertical-flex-block' style='width: 230%; padding-bottom: 10px;'>
        <input type='text' class='option option-box' name='login' placeholder='Имя или email'/>
        <input type='password' class='option option-box' name='password' placeholder='Пароль'/>
        <div style='width: 100%;'>
        <a onclick='close_dropdown(this);' class='link hint' style='cursor: pointer'>Отмена</a>
        <button type='submit' class='button' style='float: right;'>Войти</button>
        </div>
      </div>
    </div>
    </form>
    <div>
      <a href='<?php echo get_site_url().'/register'?>' class='link hint'>Зарегистрироваться</a>
    </div>
    <?php
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