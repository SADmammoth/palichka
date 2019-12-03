<?php
require_once("../../../../wp-load.php");
$fetch_request = json_decode(file_get_contents('php://input'), true);
if($fetch_request){
  $_POST = $fetch_request;
}
if(isset($_POST) && isset($_POST["liked"])){
  if($_POST['liked']){
  update_user_meta( $_POST["user"], "liked_master", $_POST["post"]);
  $arr = get_post_meta($_POST["post"], "liked_by_users", true);
  if($arr == ''){
    $arr = [];
  }
  if(!in_array($_POST["user"], $arr)){
    if($arr != []){
      $arr = array_merge($arr, $_POST["user"]);
    }
    else{
      $arr = [$_POST["user"]];
    }
    update_post_meta( $_POST["post"], "liked_by_users", $arr);
  }
}
  else{
    update_user_meta($_POST["user"], 'liked_master', false); 
    $arr = get_post_meta($_POST["post"], "liked_by_users", true);
    update_post_meta( $_POST["post"], "liked_by_users", array_diff($arr, [$_POST["user"]]));
  }

 
  foreach(get_posts(['post_type'=>'masters', 'tax_query' => array(
    array(
      'taxonomy' => 'masters_tag',
      'terms' => 'bestmaster'
    )
    )]) as $key=>$value){
      wp_remove_object_terms($value->ID, 'bestmaster', 'masters_tag');
    }
  $i = 0;
 
  foreach(get_posts(['post_type'=>'masters', 'meta_key' => 'liked_by_users',
  'orderby'   => 'meta_value', 'meta_query' => array(
    array(
        'key' => 'liked_by_users',
        'value' => serialize(array()),
        'compare' => '!=',
    )
)]) as $key=>$value){
    if($i >= 2){
    break;
  }
  echo print_r(get_post_meta($value->ID, 'liked_by_users', true));
      wp_set_post_terms($value->ID, 'bestmaster', 'masters_tag');
  $i++;
}
}
?>