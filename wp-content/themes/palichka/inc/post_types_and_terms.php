<?php
function register_page_types() {
  $args = array(
      'public' => true,
      'has_archive' => false,
      'labels' => array(  
        'name' => 'Палiчкi',
        'singular_name'=> 'Палiчка',
        'not_found' => 'Мастера не найдены'
      ),
      'publicly_queryable' => true,
      'show_in_rest' => true,
      'template' => array(
        array('core/separator', array()),
      //     array( 'core/image', array(
      //       'className' => 'masters-photo',
      //     ) ),
      //     array( 'core/paragraph', array(
      //       'className' => 'main-text',
      //       'placeholder' => 'Несколько слов о мастере',
      //     ) ),
      //     array( 'core/gallery', array(
      //       'className' => 'some_works',
      //       'columns' => '5',
      //   ) ),
      //   array( 'core/gallery', array(
      //     'className' => 'all_works',
      //     'columns' => '5',
      // ) ),
      ),
      'template_lock' => 'all',
  );
  register_taxonomy( 
    'page_tag', 
    'page', 
    array( 
        'hierarchical'  => false, 
        'label'         => __( 'Метки', 'palichka' ), 
        'singular_name' => __( 'Метка', 'palichka' ), 
        'rewrite'       => true, 
        'query_var'     => true
    )  
  );


  register_post_type( 'masters', $args );

  register_taxonomy( 
    'masters_tag', 
    'masters', 
    array( 
        'hierarchical'  => false, 
        'label'         => __( 'Метки', 'palichka' ), 
        'singular_name' => __( 'Метка', 'palichka' ), 
        'rewrite'       => true, 
        'query_var'     => true 
    )  
  );

  $args = array(
    'public' => true,
    'has_archive' => false,
    'labels' => array(  
      'name' => 'Отзывы',
      'singular_name'=> 'Отзыв',
      'not_found' => 'Отзывы не найдены'
    ),
    'publicly_queryable' => true,
    'show_in_rest' => true,
    'template' => array(
      array('core/separator', array()),
    ),
    'template_lock' => 'all',
  );
    
  register_taxonomy( 
    'review_tag', 
    'review', 
    array( 
        'hierarchical'  => false, 
        'label'         => __( 'Метки', 'palichka' ), 
        'singular_name' => __( 'Метка', 'palichka' ), 
        'rewrite'       => true, 
        'query_var'     => true
    )  
  );

  register_post_type( 'review', $args );
  $args = array(
    'public' => true,
    'has_archive' => false,
    'labels' => array(  
      'name' => 'Работы',
      'singular_name'=> 'Работа',
      'not_found' => 'Работы не найдены'
    ),
    'publicly_queryable' => true,
    'show_in_rest' => true,
    'template' => array(
      array('core/separator', array()),
    ),
    'template_lock' => 'all',
  );
  register_post_type( 'masterpiece', $args );
    
  register_taxonomy( 
    'masterpiece_tag', 
    'masterpiece', 
    array( 
        'hierarchical'  => false, 
        'label'         => __( 'Метки', 'palichka' ), 
        'singular_name' => __( 'Метка', 'palichka' ), 
        'rewrite'       => true, 
        'query_var'     => true
    )  
  );

  register_taxonomy( 
    'attachment_tag', 
    'attachment',
    array( 
        'hierarchical'  => false, 
        'label'         => __( 'Метки', 'palichka' ), 
        'singular_name' => __( 'Метка', 'palichka' ), 
        'rewrite'       => true, 
        'query_var'     => true
    )  
  );

 
}
add_action( 'init', 'register_page_types' );
?>