<?php
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
     <h1 class='h1-small background wide-toleft'>Добро пожаловать на "Сваю Палiчку"!</h1>
     <section id ='main-section'>
      <form id='registration-form' action='<?php echo get_template_directory_uri().'/inc/users.php'?>' method='POST' class='insidelayout-fromleft'
       onsubmit="check_submit(this, <?php echo isset($_GET['signin'])?'true':'false'?>);">
      <h2 style='margin-bottom: -5px; padding-top: 20px;'><?php echo isset($_GET["signin"])?"Вход":"Регистрация"?></h2>
      <fieldset class='form-head' style='position: relative;'>
        <input class='form-input' id='name' name='username' type='text' placeholder='Логин<?php echo isset($_GET["signin"])?" или Email":""?>' onchange='<?php echo isset($_GET["signin"])?"check_validity_combined(this)":"check_validity(this)"?>' required/>
        <input class='form-input<?php echo isset($_GET["signin"])?" hidden":""?>' name='email' type='email' placeholder='Email'  onchange='check_validity(this)' require/>
        <div class='user_message hint error-message hidden' style='position: absolute; left: calc(100% + 10px); width: 80%; top: 10px;'>
        <i class='fas fa-times-circle' style='float: left; padding-right: 15px; clear: none;'></i>
        <span class='message' style='float: left; clear: none; width: 90%;'></span>
        </div>
        </fieldset>
        <fieldset class='form-body' style='position: relative;'>

        <input class='form-input' name='password' id='password'type='password' placeholder='Пароль' required/>
        <input class='form-input<?php echo isset($_GET["signin"])?" hidden":""?>' id='repeat_password' type='password' placeholder='Повторите пароль' require/>
        <div id='password_error' class='hint error-message hidden' style='position: absolute; left: calc(100% + 10px); width: 80%; top: 10px;'>
        <i class='fas fa-times-circle' style='float: left; padding-right: 15px; clear: none;'></i>
        <span class='message' style='float: left; clear: none; width: 90%;'></span>
        </div>
        </fieldset>
        <input type='hidden' name='reg' value='<?php echo isset($_GET["signin"])?'false':'true'?>'/>
        <input type='hidden' name='redirectpath' value='./redirect/?sigin=true'>
        <a class='link' href='<?php echo(get_site_url().'/register/'.(isset($_GET["signin"])?'':'?signin="true"'))?>' ?><?php echo isset($_GET["signin"])?"Регистрация":"Вход"?></a>
        <button type='submit' class='button' style='float: right'><?php echo isset($_GET["signin"])?"Войти":"Зарегистрироваться"?></button>
      </form>
      </section>
      </main>
  </div> 
<?php
 wp_enqueue_script( 'palichka-registration');
get_footer();
?>