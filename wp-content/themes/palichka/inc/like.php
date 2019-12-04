<?php
require_once("../../../../wp-load.php");
$fetch_request = json_decode(file_get_contents('php://input'), true);
if($fetch_request){
  $_POST = $fetch_request;
}
if(isset($_POST) && isset($_POST["liked"])){
  if($_POST['liked']){
  $posts = get_user_meta( $_POST["user"], "liked_masters", true);
  $users = get_post_meta($_POST["post"], "liked_by_users", true);
  if($posts == '' || $posts == []){
    $posts = [$_POST["post"]];
  }
  else{
    $posts = array_merge($posts, [$_POST['post']]);
  }
  if($users == '' || $posts == []){
    $users = [$_POST["user"]];
  }
  else{
    $users = array_merge($users, [$_POST['user']]);
  }
  update_post_meta( $_POST["post"], "liked_by_users", $users);
  update_user_meta( $_POST["user"], "liked_masters", $posts);
}
  else{
    $posts = get_user_meta($_POST["user"], "liked_masters", true);
    update_user_meta( $_POST["user"], "liked_masters", array_diff($posts, [$_POST["post"]]));
    $users = get_post_meta($_POST["post"], "liked_by_users", true);
    update_post_meta( $_POST["post"], "liked_by_users", array_diff($users, [$_POST["user"]]));
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
      get_post_meta($value->ID, 'liked_by_users', true);
      wp_set_post_terms($value->ID, 'bestmaster', 'masters_tag');
  $i++;
}
}
?>