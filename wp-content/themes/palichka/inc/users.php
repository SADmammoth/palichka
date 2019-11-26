<?php
require_once("../../../../wp-load.php");
$_POST = json_decode(file_get_contents('php://input'), true);
if((isset($_POST["username"]) && get_user_by('login', $_POST["username"]) 
|| (isset($_POST["email"]) && get_user_by('email', $_POST["email"])))){
  echo '{"userfound": true}';
}
else{
  echo '{"userfound": false}';
}



?>