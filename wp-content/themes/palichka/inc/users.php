<?php
require_once("../../../../wp-load.php");
$fetch_request = json_decode(file_get_contents('php://input'), true);
if($fetch_request){
  $_POST = $fetch_request;
}
if((isset($_POST["username"]) && get_user_by('login', $_POST["username"]) 
|| (isset($_POST["email"]) && get_user_by('email', $_POST["email"])))){
  if(!$_POST["reg"]){
  echo '{"code": 200, "message":"Request succesful", "userfound": true}';
  }
  else{
    http_response_code(500);
    echo '{"code": 500, "message":"User already exists"}';
  }
}
else{
  if(!$_POST["reg"]){
  echo '{"code": 200, "message":"Request succesful", "userfound": false}';
  }
  else{
      $user_id = wp_create_user($_POST["username"],  $_POST["password"], $_POST["email"]);
      $user = new WP_User( $user_id );
      $user->set_role( 'subscriber' );
    echo `{"code": 200, "message":"Request succesful", "user_id":`.json_encode($user_id).`}`;
    header("Location: ".get_site_url());
  }
}



?>