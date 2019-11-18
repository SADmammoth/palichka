<?php
/**
 * palichka functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package palichka
 * @subpackage Свая Палiчка
 * @since Свая Палiчка 1.0
 */

if ( ! function_exists( 'palichka_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function palichka_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on palichka, use a find and replace
		 * to change 'palichka' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'palichka', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
      'navigation-header' => esc_html__( 'Навигация в заголовке', 'palichka' ),
      'social-header' => esc_html__( 'Соцсети в заголовке', 'palichka' ),
      'social-footer' => esc_html__( 'Соцсети в подвале', 'palichka' ),
      'navigation-footer' => esc_html__( 'Навигация в подвале', 'palichka' ),
      'mainpage-navigation' => esc_html__( 'Навигация в главном блоке', 'palichka' )
    ) );
    

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'palichka_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'palichka_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function palichka_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'palichka_content_width', 640 );
}
add_action( 'after_setup_theme', 'palichka_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


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

/**
 * Enqueue scripts and styles.
 */
function palichka_scripts() {
  wp_enqueue_style( 'palichka-normalize', get_template_directory_uri().'/layouts/normalize.css' );
  wp_enqueue_style( 'palichka-customize-root-vars', get_template_directory_uri().'/layouts/customize-root-vars.php' );
  wp_enqueue_script( 'fontawesome-script', 'https://kit.fontawesome.com/0de215b32e.js', array(), '5.2.3', true);
  wp_enqueue_style( 'palichka-style', get_stylesheet_uri() );

  wp_register_script( 'palichka-hyphenate', get_template_directory_uri() . '/js/hyphenate.js', array(), '2.0', true );
  wp_enqueue_script( 'palichka-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
  wp_enqueue_script( 'palichka-scripts', get_template_directory_uri() . '/js/minor-scripts.js', array(), null, true );
	wp_enqueue_script( 'palichka-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
  }
  
}
add_action( 'wp_enqueue_scripts', 'palichka_scripts' );


function my_block_plugin_editor_scripts() {
  wp_enqueue_script(
    'my-block-editor-js',
    get_template_directory_uri(  ).'/js/blocks.js',
    [ 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n' ]
);
  };

add_action( 'enqueue_block_editor_assets', 'my_block_plugin_editor_scripts' );

function add_additional_class_on_li($classes, $item, $args) {
  if($args->add_li_class) {
      $classes[] = $args->add_li_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

function register_page_types() {
  $args = array(
      'public' => true,
      'has_archive' => false,
      'label'  => 'Палiчкi',
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
    'label'  => 'Отзывы',
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
    'label'  => 'Работы',
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



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
require get_template_directory() . '/template-parts/widgets/articles_grid_widget.php';
require get_template_directory() . '/template-parts/widgets/get_widget.php';
require get_template_directory() . '/template-parts/widgets/topics_grid_widget.php';
require get_template_directory() . '/template-parts/widgets/message_widget.php';
require get_template_directory() . '/template-parts/mainpage_nav.php';
require get_template_directory() . '/inc/metaboxes.php';
require get_template_directory() . '/inc/kirki.php'; ?>