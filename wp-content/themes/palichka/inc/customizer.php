<?php
/**
 * palichka Theme Customizer
 *
 * @package palichka
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function palichka_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'palichka_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'palichka_customize_partial_blogdescription',
		) );
  }
  
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('custom_css');
    $wp_customize->remove_section('static_front_page');
    $wp_customize->remove_control('header_textcolor');
    
     //! Panel "COLORS"
     $wp_customize->add_setting( 'dark_background', array(
      'default'           => '#BEDEFF',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'dark_background_input',
        array(
            'label'    => __( 'Темный фон', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'dark_background'
        )
      )
    );

    $wp_customize->add_setting( 'background', array(
      'default'           => '#E0F3FF',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'background_input',
        array(
            'label'    => __( 'Фон секций', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'background'
        )
      )
    );

    $wp_customize->add_setting( 'light_background', array(
      'default'           => '#F1FAFF',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'light_background_input',
        array(
            'label'    => __( 'Светлый фон', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'light_background'
        )
      )
    );

    $wp_customize->add_setting( 'buttons_color', array(
      'default'           => '#9CCEFF',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'buttons_color_input',
        array(
            'label'    => __( 'Цвет кнопок', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'buttons_color'
        )
      )
    );

    $wp_customize->add_setting( 'buttons_hover', array(
      'default'           => '#6DB5FC',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'buttons_hover_input',
        array(
            'label'    => __( 'Цвет кнопок при наведении', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'buttons_hover'
        )
      )
    );

    $wp_customize->add_setting( 'shadow', array(
      'default'           => '#5d62ff',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'shadow_input',
        array(
            'label'    => __( 'Цвет тени', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'shadow'
        )
      )
    );

    $wp_customize->add_setting( 'shadow_opacity', array(
      'default'           => '10',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Control( 
      $wp_customize,
    'shadow_opacity_input',
        array(
            'label'    => __( 'Прозрачность тени', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'shadow_opacity',
            'type' => 'number',
            'input_attrs' => array(
              'min' => '0',
              'max' => '100',
              'step'=> '10',
            )
        )
      )
    );
  
    $wp_customize->add_setting( 'primary_text_color', array(
      'default'           => '#0026a5',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'primary_text_color_input',
        array(
            'label'    => __( 'Цвет главного текста', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'primary_text_color'
        )
      )
    );

    $wp_customize->add_setting( 'secondary_text_color', array(
      'default'           => '#00255c',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'secondary_text_color_input',
        array(
            'label'    => __( 'Цвет второстепенного текста', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'secondary_text_color'
        )
      )
    );

    $wp_customize->add_setting( 'common_text_color', array(
      'default'           => '#00255c',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
  
    $wp_customize->add_control( new WP_Customize_Color_Control( 
      $wp_customize,
    'common_text_color_input',
        array(
            'label'    => __( 'Цвет обычного текста', 'palichka' ),
            'section'  => 'colors',
            'settings' => 'common_text_color'
        )
      )
    );

    //! Panel Globals

    $wp_customize->add_section( 'globals', array(
      'panel' => '',
      'title'          => __( 'Глобальные настройки', 'palichka' ),
      'description'    => __( 'Настройки, общие для всех страниц сайта', 'palichka' ),
    ) );
    

    $wp_customize->add_setting( 'hyphenate', array(
      'default'           => 'true',
    ));

    
 
   
    $wp_customize->add_control( new WP_Customize_Control(
      $wp_customize, 
    'hyphenate_checkbox',
        array(
            'label'    => __( 'Переносы в тексте сайта', 'palichka' ),
            'section'  => 'globals',
            'settings' => 'hyphenate',
            'type'     => 'checkbox',
        )
      )
  );

  $wp_customize->add_setting( 'copy_name', array(
    'default'           => __( 'ИП Вася', 'palichka' ),
    'sanitize_callback' => 'sanitize_text',
 ) );
 
 $wp_customize->add_control( new WP_Customize_Control(
     $wp_customize,
   'copy_name_input',
       array(
           'label'    => __( 'Имя копирайта для отображения в футере', 'palichka' ),
           'section'  => 'globals',
           'settings' => 'copy_name',
           'type'     => 'text'
       )
     )
 );

 $wp_customize->add_setting( 'copy_year', array(
   'default'=>'',
  'sanitize_callback' => 'wpse_intval',
) );

 $wp_customize->add_control( new WP_Customize_Control(
  $wp_customize,
'copy_year_input',
    array(
        'label'    => __( 'Начальный год копирайта для отображения в футере', 'palichka' ),
        'section'  => 'globals',
        'settings' => 'copy_year',
        'type'     => 'number',
        'input_attrs' => array(
          'min' => 1900,
          'max' => date('Y'),
          'step' => 1,
          ),
    )
  )
);

function wpse_intval( $value ) {
  return (int) $value;
}

  //! Panel "Mainpage"
  $wp_customize->add_panel( 'mainpage', array(
    'priority'       => 500,
    'theme_supports' => '',
    'title'          => __( 'Настройки главной страницы', 'palichka' ),
    'description'    => __( 'Настроить различные элементы главной страницы', 'palichka' ),
  ) );

     //! Panel "Mainpage"
     $wp_customize->add_panel( 'mainpage', array(
       'priority'       => 500,
       'theme_supports' => '',
       'title'          => __( 'Настройки главной страницы', 'palichka' ),
       'description'    => __( 'Настроить различные элементы главной страницы', 'palichka' ),
     ) );

     $wp_customize->add_control( new WP_Customize_Control(
      $wp_customize,
    'main_desc_text_input',
        array(
            'label'    => __( 'Имя копирайта для отображения в футере', 'palichka' ),
            'section'  => 'site_desc',
            'settings' => 'main_desc_text',
            'type'     => 'text'
        )
      )
  );
 
      //! Panel "Mainpage"
      $wp_customize->add_panel( 'mainpage', array(
        'priority'       => 500,
        'theme_supports' => '',
        'title'          => __( 'Настройки главной страницы', 'palichka' ),
        'description'    => __( 'Настроить различные элементы главной страницы', 'palichka' ),
      ) );
     
     //! Sections\
     
     //!Main block
     $wp_customize->add_section( 'main_block' , array(
       'title'    => __('Главный блок','palichka'),
       'panel'    => 'mainpage',
       'priority' => 10
     ) );
   
     //# Background image
     $wp_customize->add_setting( 'pick_main_picture', array(
       'default'           => 'null',
     ) );
   
     $wp_customize->add_control( new WP_Customize_Image_Control(
       $wp_customize,
     'pick_main_picture_dialog',
         array(
             'label'    => __( 'Фоновая картинка главного блока', 'palichka' ),
             'section'  => 'main_block',
             'settings' => 'pick_main_picture'
         )
       )
     );
   
   //# Main page navigation button visibility checkbox
     $wp_customize->add_setting( 'enable_panel', array(
       'default'           => 'true',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
      'enable_panel_checkbox',
          array(
              'label'    => __( 'Отображать панель в главной секции', 'palichka' ),
              'section'  => 'main_block',
              'settings' => 'enable_panel',
              'type'     => 'checkbox'
          )
        )
    );
    
    //! Kirki mainpage_nav in kirki.php//

     //!Site description block
     $wp_customize->add_section( 'site_desc' , array(
       'title'    => __('Блок "Описание"','palichka'),
       'panel'    => 'mainpage',
       'priority' => 11
     ) );
   
     //# Main description block
     $wp_customize->add_setting( 'main_desc_text', array(
        'default'           => __( '', 'palichka' ),
        'sanitize_callback' => 'sanitize_text',
     ) );
     
     $wp_customize->add_control( new WP_Customize_Control(
         $wp_customize,
       'main_desc_text_input',
           array(
               'label'    => __( 'Главное описание', 'palichka' ),
               'section'  => 'site_desc',
               'settings' => 'main_desc_text',
               'type'     => 'text'
           )
         )
     );
     //####
   
     //# Secondary descripton block
     $wp_customize->add_setting( 'sec_desc_text', array(
       'default'           => __( '', 'palichka' ),
       'sanitize_callback' => 'sanitize_text'
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
      'sec_desc_text_input',
          array(
              'label'    => __( 'Дополнительное описание', 'palichka' ),
              'section'  => 'site_desc',
              'settings' => 'sec_desc_text',
              'type'     => 'text'
          )
        )
    );
   //####

    //!Site content block
    $wp_customize->add_section( 'site_content' , array(
      'title'    => __('Контент сайта','palichka'),
      'panel'    => 'mainpage',
      'priority' => 12
    ) );

    $wp_customize->add_setting( 'news_cards', array(
   ) );

  

    //! Panel "Contacts page"

    $wp_customize->add_section( 'contacts', array(
      'priority'       => 600,
      'theme_supports' => '',
      'title'          => __( 'Настройки страницы "Контакты"', 'palichka' ),
      'description'    => __( 'Настроить различные элементы страницы "Контакты"', 'palichka' ),
    ) );

  $wp_customize->add_setting( 'phone', array(
      'default'           => '+375 29 111-11-11',
  ) );
  
  $wp_customize->add_control( new WP_Customize_Control(
      $wp_customize, 
    'phone_input',
        array(
            'label'    => __( 'Телефон', 'palichka' ),
            'section'  => 'contacts',
            'settings' => 'phone',
            'type'     => 'text',
        )
      )
  );

  $wp_customize->add_setting( 'email', array(
    'default'           => 'svaya.palichka@info.by',
) );

$wp_customize->add_control( new WP_Customize_Control(
    $wp_customize, 
  'email_input',
      array(
          'label'    => __( 'Email', 'palichka' ),
          'section'  => 'contacts',
          'settings' => 'email',
          'type'     => 'email',
      )
    )
);



$wp_customize->add_setting( 'map_image', array(
  'default'           => 'null',
) );

$wp_customize->add_control( new WP_Customize_Image_Control(
  $wp_customize,
'pick_map_image_dialog',
    array(
        'label'    => __( 'Картинка, отображаемая при загрузке карты', 'palichka' ),
        'section'  => 'contacts',
        'settings' => 'map_image'
    )
  )
);

$wp_customize->add_setting( 'map_code_link', array(
    'default'           => "",
));

$wp_customize->add_control( new WP_Customize_Control(
    $wp_customize, 
  'map_code_link_input',
      array(
          'label'    => __( 'Ссылка на карту', 'palichka' ),
          'section'  => 'contacts',
          'settings' => 'map_code_link',
          'type'     => 'url',
      )
    )
);

$wp_customize->add_setting( 'link_on_map', array(
    'default'           => 'https://yandex.by/maps/155/gomel/?ll=31.006746%2C52.428851&mode=usermaps&source=constructor&um=constructor%3A48aa09255f7b87136b085b14a724126378ab3965881b489652c6c51f68f6d150&z=19',
));

$wp_customize->add_control( new WP_Customize_Control(
    $wp_customize, 
  'link_on_map_input',
      array(
          'label'    => __( 'Ссылка, привязанная к карте', 'palichka' ),
          'section'  => 'contacts',
          'settings' => 'link_on_map',
          'type'     => 'url',
      )
    )
);

$wp_customize->add_setting( 'adress', array(
  'default'           => 'г. Гомель, ул. Ирининская 7',
));

$wp_customize->add_control( new WP_Customize_Control(
  $wp_customize, 
'adress_input',
    array(
        'label'    => __( 'Ссылка на карту', 'palichka' ),
        'section'  => 'contacts',
        'settings' => 'adress',
        'type'     => 'text',
    )
  )
);

  //! Panel "Rent prices page"

     $wp_customize->add_section( 'rentprices', array(
      'priority'       => 700,
      'theme_supports' => '',
      'title'          => __( 'Настройки страницы "Аренда"', 'palichka' ),
      'description'    => __( 'Настроить различные элементы страницы "Аренда"', 'palichka' ),
    ) );
 
    $wp_customize->add_setting( 'rent-desc', array(
      'default'           => '',
    ));
    
    $wp_customize->add_control( new WP_Customize_Control(
      $wp_customize, 
    'adress_input',
        array(
            'label'    => __( 'Описание аренды', 'palichka' ),
            'section'  => 'rentprices',
            'settings' => 'rent-desc',
            'type'     => 'text',
        )
      )
    );

    $wp_customize->add_setting( 'rent_price_list', array(
      'default'           => '',
    ));

    //! Kirki rent_price_list in kirki.php //
   
     function sanitize_text( $text ) {
         return sanitize_text_field( $text );
     }
}
add_action( 'customize_register', 'palichka_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function palichka_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function palichka_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function palichka_customize_preview_js() {
	wp_enqueue_script( 'palichka-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'palichka_customize_preview_js' );

