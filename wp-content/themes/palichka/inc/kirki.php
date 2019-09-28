<?php 

if(class_exists('Kirki')){

  function kirki_init(){
function posttypes_choice($args, $output){
  $cat = get_post_types($args, $output);
  $result= [];
  foreach($cat as $item){
    $result[$item->name] = $item->label;
  }
  return $result;
 }

 function terms_choice($term){
  $cat = get_terms($term);
  $result= [];
  foreach($cat as $item){
    $result[$item->slug] = $item->name;
  }
  return $result;
 }

 function choose_pages() {
  $pages = get_pages();
  $result = [];
  foreach($pages as $page){
    $result[$page->guid] = $page->post_title;
  }
  return $result;
}

function widget_choice($type){
  $widgets = get_option( 'widget_'.$type );
  $result = [];

  $widget_ids = array_keys($widgets);
  foreach($widget_ids as $widget_id){
    if(is_int($widget_id)){
      $result[$type.'-'.$widget_id] = reset(get_widget($type.'-'.$widget_id, ['title']));
    }
  }
  return $result;
}

Kirki::add_field( 'mainpage_nav', [
  'type'        => 'repeater',
  'label'       => esc_html__( 'Навигация по гланой странице', 'palichka' ),
  'description' => esc_html__('(не имеет эффекта, если флаг "Отображать панель в главной секции" отключен)', 'palichka' ),
  'section'     => 'main_block',
  'priority'    => 11,
  'row_label' => [
    'type'  => 'text',
    'value' => esc_html__( 'Секция', 'palichka' ),
  ],
  'button_label' => esc_html__('Добавить ссылку', 'palichka' ),
  'settings'     => 'mainpage_nav',
  'default'      => mainpage_nav(),
  'fields' => [
    'link_text' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Текст ссылки', 'palichka' ),
      'description' => esc_html__( 'Текст, отображаемый на кнопке', 'palichka' ),
    ],
    'link'  => [
      'type'        => 'text',
      'label'       => esc_html__( 'Адрес ссылки', 'palichka' ),
      'description' => esc_html__( 'Не изменяйте, если не знаете, что это', 'palichka' ),
    ],
    'hidden' => [
      'type'        => 'checkbox',
      'label'       => esc_html__( 'Скрыть ссылку на панели', 'palichka' ),
    ],
  ]
] );

Kirki::add_field( 'topic_widgets', [
  'type'        => 'repeater',
  'label'       => esc_html__( 'Виджеты разделов', 'palichka' ),
  'section'     => 'site_content',
  'row_label' => [
    'type'  => 'text',
    'value' => esc_html__( 'Виджет раздела', 'palichka' ),
  ],
  'button_label' => esc_html__('Добавить виджет', 'palichka' ),
  'settings'     => 'topic_widgets',
  'fields' => [
    'widget'  => [
      'type'        => 'select',  
      'label'       => esc_html__( 'Настраиваемый виджет', 'palichka' ),
      'defalut' => 'false',
      'choices' => array_merge(['false' => 'Пусто'], widget_choice('topics_grid')),
      
    ],
    'title' => [
      'type'        => 'text',
      'label'       => esc_html__( 'Название виджета', 'palichka' ),
    ],
    'topic'  => [
      'type'        => 'select',  
      'label'       => esc_html__( 'Раздел блога', 'palichka' ),
      'choices' =>  array_merge([false=> 'Все'], posttypes_choice(['public' => true], 'objects')),
    ],
    'tag'  => [
      'type'        => 'select',  
      'label'       => esc_html__( 'Теги', 'palichka' ),
      'choices' =>  array_merge([false=> 'Все'], terms_choice('post_tag')),
    ],
    'layout'  => [
      'type'        => 'select',  
      'label'       => esc_html__( 'Шаблон', 'palichka' ),
      'choices' =>  array(
        'false' => 'Не отображать',
        'big-topic' => 'Большой виджет (x3)',
        'medium-topic' => 'Средний виджет (x2)',
        'small-topic' => 'Малый виджет (x1)',
      ),
    ],
    'cards_count' => [
      'type'        => 'number',
      'label'       => esc_html__( 'Количество карточек', 'palichka' ),
      'default'     => '0',
      'input_attr' => array(
        'min' => '0',
        'max' => '5',
        'step'=> '1',
      )
      ],
      'link' => [
        'type' => 'select',
        'label' => esc_html__( 'Ссылка на страницу', 'palichka' ),
        'choices' => choose_pages()
      ]
      ],
]
);

Kirki::add_field( 'rent_price_list', [
  'type'        => 'repeater',
  'label'       => esc_html__( 'Цены на аренду', 'palichka' ),
  'section'     => 'rentprices',
  'row_label' => [
    'type'  => 'text',
    'value' => esc_html__( 'Категория', 'palichka' ),
  ],
  'button_label' => esc_html__('Добавить новую категорию', 'palichka' ),
  'settings'     => 'rent_price_list',
  'fields' => [
    'value' => [
      'type'        => 'number',
      'label'       => esc_html__( 'Цена', 'palichka' ),
    ],
    'desc'  => [
      'type'        => 'text',  
      'label'       => esc_html__( 'Описание', 'palichka' ),
    ],
    'discount'  => [
      'type'        => 'number',  
      'label'       => esc_html__( 'Скидка (Оставить пустым, если нет)', 'palichka' ),
    ],
  ]
] 
);
}
add_action('init', 'kirki_init');
}

?>
