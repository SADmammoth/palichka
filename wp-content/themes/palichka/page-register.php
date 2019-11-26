<?php
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
     <h1 class='h1-small background wide-toleft'>Добро пожаловать на "Свою Палiчку"!</h1>
     <section id ='main-section'>
      <form id='registration-form' class='insidelayout-fromleft'>
      <fieldset class='form-head'>
      <h2>Регистрация</h2>
        <input class='form-input' id='name' name='login' type='text' placeholder='Логин' require/>
        <input class='form-input' name='email' type='email' placeholder='Почта' require/>
        </fieldset>
        <fieldset class='form-body' style='position: relative;'>

        <input class='form-input' name='password' id='password'type='password' placeholder='Пароль' require/>
        <input class='form-input' id='repeat_password' type='password' placeholder='Повторите пароль' require/>
        <div id='password_error' class='hint error-message hidden' style='position: absolute; left: calc(100% + 10px); width: 80%; top: 10px;'>
        <i class='fas fa-times-circle' style='float: left; padding-right: 15px; clear: none;'></i>
        <span class='message' style='float: left; clear: none; width: 90%;'></span>
        </div>
        </fieldset>
       
        <button class='button' type='submit'>Зарегистрироваться</button>
        
      </form>
    
      </section>
      </main>
  </div> 
<?php
 wp_enqueue_script( 'palichka-registration');
get_footer();
?>