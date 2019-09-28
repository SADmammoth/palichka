<?php 
function masters_post( $meta_boxes ) {
	$prefix = 'masters-';

	$meta_boxes[] = array(
		'id' => 'masters',
		'title' => esc_html__( 'Палiчка', 'palichka' ),
		'post_types' => array('masters' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => 'true',
		'fields' => array(
			array(
				'id' => $prefix . 'photo',
				'type' => 'image_advanced',
        'name' => esc_html__( 'Фото мастера', 'palichka' ),
				'attributes' => array(
					'width' => '400',
					'height' => '400',
					'alt' => 'Сергей Ковриго',
					'title' => 'Сергей Ковриго',
				),
				'max_file_uploads' => '1',
			),
			array(
				'id' => $prefix . 'desc',
				'type' => 'text',
				'name' => esc_html__( 'Описание', 'palichka' ),
				'desc' => esc_html__( 'Несколько слов о мастере', 'palichka' ),
				'placeholder' => esc_html__( 'Описание', 'palichka' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'masters_post' );

function review_post( $meta_boxes ) {
	$prefix = 'review-';

	$meta_boxes[] = array(
		'id' => 'review',
		'title' => esc_html__( 'Отзыв', 'palichka' ),
		'post_types' => array('review' ),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'true',
		'fields' => array(
			array(
				'id' => $prefix . 'photo',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Фото', 'palichka' ),
				'max_file_uploads' => '1',
				'max_status' => 'false',
			),
			array(
				'id' => $prefix . 'name',
				'type' => 'text',
				'name' => esc_html__( 'ФИО', 'palichka' ),
			),
			array(
				'id' => $prefix . 'profession',
				'type' => 'text',
				'name' => esc_html__( 'Профессия', 'palichka' ),
			),
			array(
				'id' => $prefix . 'age',
				'type' => 'text',
				'name' => esc_html__( 'Возраст', 'palichka' ),
				'placeholder' => esc_html__( '?? лет', 'palichka' ),
			),
			array(
				'id' => $prefix . 'body',
				'type' => 'textarea',
				'name' => esc_html__( 'Содержание', 'palichka' ),
				'rows' => 3,
				'cols' => 70,
			),
		),
  );
  

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'review_post' );
function masterpiece_post( $meta_boxes ) {
	$prefix = 'masterpiece-';

	$meta_boxes[] = array(
		'id' => 'masterpiece',
		'title' => esc_html__( 'Работы', 'palichka' ),
		'post_types' => array('masterpiece'),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'true',
		'fields' => array(
			array(
				'id' => $prefix . 'image',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Изображение', 'palichka' ),
				'max_file_  uploads' => '1',
				'max_status' => 'true',
			),
			array(
				'id' => $prefix . 'master_link',
				'type' => 'post',
				'name' => esc_html__( 'Мастер', 'palichka' ),
				'post_type' => 'masters',
				'field_type' => 'select',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'masterpiece_post' );
?>