<?php

function palichka_widgets_init() {
	register_sidebar( array(
    'name' => __( 'Контент главной страницы', 'palichka' ),
    'id' => 'main-content',
    'description' => __( 'Блоки, размещенные на главной странице, в основной области', 'palichka' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
    ) );  
register_sidebar( array(
  'name' => __( 'Виджет в заголовке', 'palichka' ),
  'id' => 'header-widget',
  'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
   ) );
}

add_action( 'widgets_init', 'palichka_widgets_init' );


function restrict_widget_count($sidebars){
   if (isset($sidebars['header-widget'])) {
      foreach($sidebars['header-widget'] as $id=>$widget){
        if($id >= 1){
          $sidebars['wp_inactive_widgets']= array_merge($sidebars['wp_inactive_widgets'], [$widget]);
          $sidebars['header-widget'][$id] = false;
        }
      }
   }
   return $sidebars;
}


add_filter( 'sidebars_widgets', 'restrict_widget_count', 10 );

// function restrict_widget_count(){
//   $sidebars = wp_get_sidebars_widgets();
//   if(isset($sidebars['header-widget'])){
//     foreach($sidebars['header-widget'] as $i=>$widget){
//       do_action('delete_widget', $widget, 'header-widget');
//     }
//   }
// }


// add_action('widgets.php', 'restrict_widget_count');

// function lock_widgets($instance, $widget){
//   return false;
// }


// add_filter( 'widget_form_callback', 'lock_widgets', 1, 2);
?>