<?php
/**
 * fco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fco
 */

if ( ! function_exists( 'fco_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fco_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on fco, use a find and replace
		 * to change 'fco' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fco', get_template_directory() . '/languages' );

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

		add_image_size('fco-news-logo-1140px', 1140, 9999);
		add_image_size('fco-news-logo-300px', 300, 200, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'main-menu', 'Меню шаблона' );

		//Use Walker for customization mobile menu
		class Mobile_Walker_Nav_Menu extends Walker_Nav_Menu {
			public function start_lvl( &$output, $depth = 0, $args = array() ) {
				if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
					$t = '';
					$n = '';
				} else {
					$t = "\t";
					$n = "\n";
				}
				$indent = str_repeat( $t, $depth );
		
				// Default class.
				$classes = array( 'sub-menu' );
		
				/**
				 * Filters the CSS class(es) applied to a menu list element.
				 *
				 * @since 4.8.0
				 *
				 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
				 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
				 * @param int      $depth   Depth of menu item. Used for padding.
				 */
				$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		
				$output .= "{$n}{$indent}<span class='sidebar-menu-arrow'></span><ul$class_names>{$n}";
			}
		}

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
		add_theme_support( 'custom-background', apply_filters( 'fco_custom_background_args', array(
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
add_action( 'after_setup_theme', 'fco_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fco_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fco' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'fco' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'fco_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fco_scripts() {
	// wp_enqueue_style( 'fco-style', get_stylesheet_uri() );
	wp_enqueue_style( 'law-normalize', get_template_directory_uri() . '/assets/css/normalize.css' );
	wp_enqueue_style( 'law-fonts', get_template_directory_uri() . '/assets/css/fonts.css' );
	wp_enqueue_style( 'law-fontawesome-bootstrap', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'law-fontawesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );
	wp_enqueue_style( 'law-slick', get_template_directory_uri() . '/assets/libs/slick/slick.css' );
	wp_enqueue_style( 'law-slick-theme', get_template_directory_uri() . '/assets/libs/slick/slick-theme.css' );
	wp_enqueue_style( 'law-main', get_template_directory_uri() . '/assets/css/main.css' );
	wp_enqueue_style( 'law-media', get_template_directory_uri() . '/assets/css/media.css' );

	add_action( 'wp_enqueue_scripts', 'my_scripts_method', 11 );
	function my_scripts_method() {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_template_directory_uri() . '/assets/libs/jquery-3.2.1.min.js', '', '', true );
		wp_enqueue_script( 'jquery' );
	}
	wp_enqueue_script( 'fco-common', get_template_directory_uri() . '/assets/js/common.js', array('jquery'), '', true );
	wp_enqueue_script( 'fco-slick', get_template_directory_uri() . '/assets/libs/slick/slick.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'fco-carousel', get_template_directory_uri() . '/assets/js/carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fco_scripts' );

//Debug mode
define('WP_DEBUG', true);

//Add plugin TGM
require_once dirname( __FILE__ ) . '/inc/tgm/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'fco_register_required_plugins' );
 
function fco_register_required_plugins() {
 
    $plugins = array( 
		array(
			'name'      => 'Unyson',
			'slug'      => 'unyson',
			'required'  => true,
		),
		array(
			'name'      => 'Classic Editor',
			'slug'      => 'classic-editor',
			'required'  => true,
		),
		array(
			'name'      => 'Advanced Custom Fields',
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
		)
	 );
    $config = array( 
		'dismissable'  => true,
		'is_automatic' => true,  
	 );
 
    tgmpa( $plugins, $config );
 
}

add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type('command', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Команда', // основное название для типа записи
			'singular_name'      => 'команда', // название для одной записи этого типа
			'add_new'            => 'Добавить команда', // для добавления новой записи
			'add_new_item'       => 'Добавление команда', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование команда', // для редактирования типа записи
			'new_item'           => 'Новое команда', // текст новой записи
			'view_item'          => 'Смотреть команда', // для просмотра записи этого типа.
			'search_items'       => 'Искать команда', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Команда', // название меню
		),
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null, 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	) );
}

// хук, через который подключается функция
// регистрирующая новые таксономии (create_book_taxonomies)
add_action( 'init', 'create_book_taxonomies' );

// функция, создающая 2 новые таксономии "genres" и "writers" для постов типа "book"
function create_book_taxonomies(){

	// Добавляем древовидную таксономию 'genre' (как категории)
	register_taxonomy('genre', array('command'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => _x( 'Genres', 'taxonomy general name' ),
			'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
			'search_items'      =>  __( 'Search Genres' ),
			'all_items'         => __( 'All Genres' ),
			'parent_item'       => __( 'Parent Genre' ),
			'parent_item_colon' => __( 'Parent Genre:' ),
			'edit_item'         => __( 'Edit Genre' ),
			'update_item'       => __( 'Update Genre' ),
			'add_new_item'      => __( 'Add New Genre' ),
			'new_item_name'     => __( 'New Genre Name' ),
			'menu_name'         => __( 'Genre' ),
		),
		'show_ui'       => true,
		'query_var'     => true,
		//'rewrite'       => array( 'slug' => 'the_genre' ), // свой слаг в URL
	));

	// Добавляем НЕ древовидную таксономию 'writer' (как метки)
	register_taxonomy('writer', 'command',array(
		'hierarchical'  => false,
		'labels'        => array(
			'name'                        => _x( 'Writers', 'taxonomy general name' ),
			'singular_name'               => _x( 'Writer', 'taxonomy singular name' ),
			'search_items'                =>  __( 'Search Writers' ),
			'popular_items'               => __( 'Popular Writers' ),
			'all_items'                   => __( 'All Writers' ),
			'parent_item'                 => null,
			'parent_item_colon'           => null,
			'edit_item'                   => __( 'Edit Writer' ),
			'update_item'                 => __( 'Update Writer' ),
			'add_new_item'                => __( 'Add New Writer' ),
			'new_item_name'               => __( 'New Writer Name' ),
			'separate_items_with_commas'  => __( 'Separate writers with commas' ),
			'add_or_remove_items'         => __( 'Add or remove writers' ),
			'choose_from_most_used'       => __( 'Choose from the most used writers' ),
			'menu_name'                   => __( 'Writers' ),
		),
		'show_ui'       => true,
		'query_var'     => true,
		//'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
	));
}

add_theme_support( 'post-formats', array( 'video', 'gallery' ) );