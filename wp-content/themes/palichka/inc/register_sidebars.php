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
}
add_action( 'widgets_init', 'palichka_widgets_init' );
?>