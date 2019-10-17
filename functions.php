<?php
/**
 * fco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fco
 */
ob_start();

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
		// add_image_size('fco-news-logo-300px', 300, 200, true);
		add_image_size('fco-news-logo-300px', 274, 156, true);
		add_image_size('fco-players-logo-big', 9999, 380);
		add_image_size('fco-players-logo-small', 9999, 220);
		add_image_size('fco-club-logo', 150, 150);
		add_image_size('fco-club-logo-small', 40, 40);
		// add_image_size( 'admin-list-thumb', 80, 80, false );

		//Фильтр, который НЕ загружает указанные размеры изображений для указанных типов постов:
		add_filter( 'intermediate_image_sizes_advanced', function( $sizes ){
			if( isset( $_REQUEST['post_id'] ) && 'post' == get_post_type($_REQUEST['post_id'] ) ) {
				unset( $sizes['fco-players-logo-big'] );
				unset( $sizes['fco-players-logo-small'] );
				unset( $sizes['fco-club-logo'] );
				unset( $sizes['fco-club-logo-small'] );
			}
			if( isset( $_REQUEST['post_id'] ) && 'team' == get_post_type($_REQUEST['post_id'] ) ) {
				unset( $sizes['fco-news-logo-1140px'] );
				unset( $sizes['fco-news-logo-300px'] );
				unset( $sizes['fco-club-logo'] );
				unset( $sizes['fco-club-logo-small'] );
				unset( $sizes['medium'] );
				unset( $sizes['large'] );
				unset( $sizes['thumb'] );
				unset( $sizes['post-thumbnail'] );
				
			}
			if( isset( $_REQUEST['post_id'] ) && 'team' == get_post_type($_REQUEST['post_id'] ) ) {
				unset( $sizes['fco-players-logo-big'] );
				unset( $sizes['fco-players-logo-small'] );
				unset( $sizes['fco-news-logo-1140px'] );
				unset( $sizes['fco-news-logo-300px'] );
				unset( $sizes['medium'] );
				unset( $sizes['large'] );
				unset( $sizes['thumb'] );
				unset( $sizes['post-thumbnail'] );
			}
			return $sizes;
		 
		} );
		
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
		'name'          => 'Sidebar основний',
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => 'Sidebar для новин',
		'id'            => 'sidebar-news',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => 'Sidebar для учасників',
		'id'            => 'sidebar-team',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
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
	register_post_type('team', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Учасники команди', // основное название для типа записи
			'singular_name'      => 'Команда', // название для одной записи этого типа
			'add_new'            => 'Додати учасника', // для добавления новой записи
			'add_new_item'       => 'Додати учасника', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редагувати дані учасника', // для редактирования типа записи
			'new_item'           => 'Новий учасник', // текст новой записи
			'view_item'          => 'Учасники', // для просмотра записи этого типа.
			'search_items'       => 'Шукати учасника', // для поиска по этим типам записи
			'not_found'          => 'Не знайдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не знайдено в корзині', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'ФК Олександрія', // название меню
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
		'menu_icon'           => get_template_directory_uri().'/assets/img/fco-logo-micro.png', 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => true,
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['age-group,role,player_category'],
		'has_archive'         => false,
		// 'rewrite'             => array('slug' => 'team'),
		'query_var'           => true,
	) );

	register_post_type('match', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Календар турнірів', // основное название для типа записи
			'singular_name'      => 'Турнір', // название для одной записи этого типа
			'add_new'            => 'Додати турнір', // для добавления новой записи
			'add_new_item'       => 'Додати турнір', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редагувати турнір', // для редактирования типа записи
			'new_item'           => 'Новий турнір', // текст новой записи
			'view_item'          => 'Турніри', // для просмотра записи этого типа.
			'search_items'       => 'Шукати турнір', // для поиска по этим типам записи
			'not_found'          => 'Не знайдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не знайдено в корзині', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Календар турнірів', // название меню
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
		'menu_icon'           => 'dashicons-sos', 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => true,
		'supports'            => [ 'title' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['age-groupe-match', 'season','tournament','stadium'],
		'has_archive'         => true,
		// 'rewrite'             => array('slug' => 'team'),
		'query_var'           => true,
	) );

	register_post_type('clubs', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Футбольні команди', // основное название для типа записи
			'singular_name'      => 'Футбольна команда', // название для одной записи этого типа
			'add_new'            => 'Додати футбольну команду', // для добавления новой записи
			'add_new_item'       => 'Додати футбольну команду', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редагувати футбольну команду', // для редактирования типа записи
			'new_item'           => 'Нова футбольна команда', // текст новой записи
			'view_item'          => 'Футбольні команди', // для просмотра записи этого типа.
			'search_items'       => 'Шукати футбольну команду', // для поиска по этим типам записи
			'not_found'          => 'Не знайдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не знайдено в корзині', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Футбольні команди', // название меню
		),
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		'exclude_from_search' => true, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-id-alt', 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => true,
		'supports'            => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => null,
		'has_archive'         => false,
		// 'rewrite'             => array('slug' => 'team'),
		'query_var'           => true,
	) );

	register_post_type('ligeas', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Ліга', // основное название для типа записи
			'singular_name'      => 'Ліга', // название для одной записи этого типа
			'add_new'            => 'Додати лігу', // для добавления новой записи
			'add_new_item'       => 'Додати лігу', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редагувати лігу', // для редактирования типа записи
			'new_item'           => 'Нова ліга', // текст новой записи
			'view_item'          => 'Ліга', // для просмотра записи этого типа.
			'search_items'       => 'Шукати лігу', // для поиска по этим типам записи
			'not_found'          => 'Не знайдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не знайдено в корзині', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Ліга-лого', // название меню
		),
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		'exclude_from_search' => true, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-megaphone', 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => true,
		'supports'            => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => null,
		'has_archive'         => true,
		'rewrite'             => array('slug' => 'ligeas'),
		'query_var'           => true,
	) );
}

add_action( 'init', 'create_team_taxonomies' );

function create_team_taxonomies(){
	register_taxonomy('age-group', array('team'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => 'Вікова група',
			'singular_name'     => 'Вікова група',
			'search_items'      => 'Пошук групи',
			'all_items'         => 'Усі групи',
			'edit_item'         => 'Редагувати групу',
			'update_item'       => 'Оновити групу',
			'add_new_item'      => 'Додати групу',
			'new_item_name'     => 'Нова група',
			'menu_name'         => 'Вікова група',
		),
		'show_ui'       => true,
		'show_admin_column' => true,
		'show_in_menu'	=> false,
		'query_var'     => true,
		// 'rewrite'       => array( 'slug' => 'team', "with_front" => false ), // свой слаг в URL
	));

	register_taxonomy('age-group-match', array('match'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => 'Вікова група',
			'singular_name'     => 'Вікова група',
			'search_items'      => 'Пошук групи',
			'all_items'         => 'Усі групи',
			'edit_item'         => 'Редагувати групу',
			'update_item'       => 'Оновити групу',
			'add_new_item'      => 'Додати групу',
			'new_item_name'     => 'Нова група',
			'menu_name'         => 'Вікова група',
		),
		'show_ui'       => true,
		'show_admin_column' => true,
		'show_in_menu'	=> true,
		'query_var'     => true,
		'rewrite'       => array( 'slug' => 'age-group-match', "with_front" => false ), // свой слаг в URL
	));
	
	register_taxonomy('role', array('team'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => 'Роль',
			'singular_name'     => 'Роль',
			'search_items'      => 'Пошук ролі',
			'all_items'         => 'Усі ролі',
			'edit_item'         => 'Редагувати роль',
			'update_item'       => 'Оновити роль',
			'add_new_item'      => 'Додати роль',
			'new_item_name'     => 'Нова роль',
			'menu_name'         => 'Роль',
		),
		'show_ui'       => true,
		'show_in_menu'	=> false,
		'show_admin_column' => true,
		'query_var'     => true,
		// 'rewrite'       => array( 'slug' => 'team', "with_front" => false ), // свой слаг в URL
	));

	register_taxonomy('player_category', array('team'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => 'Амплуа гравця',
			'singular_name'     => 'Амплуа гравця',
			'search_items'      => 'Пошук амплуа',
			'all_items'         => 'Усі амплуа',
			'edit_item'         => 'Редагувати амплуа',
			'update_item'       => 'Оновити амплуа',
			'add_new_item'      => 'Додати амплуа',
			'new_item_name'     => 'Нове амплуа',
			'menu_name'         => 'Амплуа гравця',
		),
		'show_ui'       => false,
		'show_in_menu'	=> false,
		// 'show_admin_column' => true,
		'query_var'     => true,
		'rewrite'       => array( 'slug' => 'player_category' ), // свой слаг в URL
		'show_in_rest' => true
	));
	register_taxonomy('season', array('match'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => 'Сезон',
			'singular_name'     => 'Сезон',
			'search_items'      => 'Пошук сезону',
			'all_items'         => 'Усі сезони',
			'edit_item'         => 'Редагувати сезон',
			'update_item'       => 'Оновити сезон',
			'add_new_item'      => 'Додати сезон',
			'new_item_name'     => 'Новий сезон',
			'menu_name'         => 'Сезон',
		),
		'show_ui'       => true,
		'show_admin_column' => true,
		'show_in_menu'	=> true,
		'query_var'     => true,
		// 'rewrite'       => array( 'slug' => 'team', "with_front" => false ), // свой слаг в URL
	));
	register_taxonomy('tournament', array('match'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => 'Турнір',
			'singular_name'     => 'Турнір',
			'search_items'      => 'Пошук турніру',
			'all_items'         => 'Усі турніри',
			'edit_item'         => 'Редагувати турнір',
			'update_item'       => 'Оновити турнір',
			'add_new_item'      => 'Додати турнір',
			'new_item_name'     => 'Новий турнір',
			'menu_name'         => 'Турнір',
		),
		'show_ui'       => true,
		'show_admin_column' => true,
		'show_in_menu'	=> true,
		'query_var'     => true,
		// 'rewrite'       => array( 'slug' => 'team', "with_front" => false ), // свой слаг в URL
	));
	register_taxonomy('stadium', array('match'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => 'Стадіон',
			'singular_name'     => 'Стадіон',
			'search_items'      => 'Пошук стадіону',
			'all_items'         => 'Усі стадіони',
			'edit_item'         => 'Редагувати стадіон',
			'update_item'       => 'Оновити стадіон',
			'add_new_item'      => 'Додати стадіон',
			'new_item_name'     => 'Новий стадіон',
			'menu_name'         => 'Стадіони',
		),
		'show_ui'       => true,
		'show_admin_column' => true,
		'show_in_menu'	=> true,
		'query_var'     => true,
		// 'rewrite'       => array( 'slug' => 'team', "with_front" => false ), // свой слаг в URL
	));
	
}

add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

//Делаем возможность фильтровать записи с дополнительными фильтрами (таксономией):
add_action( 'restrict_manage_posts', 'filter_by_taxonomies' , 10, 2);
function filter_by_taxonomies( $post_type, $which ) {

	// Apply this only on a specific post type
	if ( $post_type === 'team' ){
		// A list of taxonomy slugs to filter by
		$taxonomies = array( 'age-group', 'role', 'player_category' );
	}
	elseif ( $post_type === 'match' ){
		// A list of taxonomy slugs to filter by
		$taxonomies = array( 'age-group-match', 'season', 'tournament', 'stadium' );
	}
	else return;

	foreach ( $taxonomies as $taxonomy_slug ) {
		// Retrieve taxonomy data
		$taxonomy_obj = get_taxonomy( $taxonomy_slug );
		$taxonomy_name = $taxonomy_obj->labels->all_items;

		// Retrieve taxonomy terms
		$terms = get_terms( $taxonomy_slug );

		// Display filter HTML
		echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
		echo '<option value="">' . $taxonomy_name . '</option>';
		foreach ( $terms as $term ) {
			printf(
				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
				$term->slug,
				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name,
				$term->count
			);
		}
		echo '</select>';
	}

}

//Выводим ID статьи в таблице со списком статей
add_filter('manage_post_posts_columns', 'add_id_column');
function add_id_column($columns) {
	$columns = $columns + array("id" => "ID");
	return $columns;
}
add_action( "manage_post_posts_custom_column", 'id_column_content', 10, 3);
function id_column_content( $column_name ){
    if ($column_name === 'id') {
		echo get_the_ID();
    }
}

//Выводим превьюшку участника в таблице со списком учасников клуба
add_filter('manage_team_posts_columns', 'add_img_column');
function add_img_column($columns) {
	$columns = array_slice($columns, 0, 1, true) + array("img_attached" => "Фото", 'player_number' => 'Номер гравця') + array_slice($columns, 1, count($columns) - 1, true) + array("player_category" => "Амплуа гравця");
	return $columns;
}
//Доп. функция для вывода полей ACF:
add_action ( 'manage_team_posts_custom_column', 'team_custom_column', 10, 2 );
function team_custom_column ( $column, $post_id ) {
	switch ( $column ) {
		case 'player_number':
		echo get_post_meta ( $post_id, 'player_number', true );
		break;
	case 'player_category':
		$term_id = get_post_meta ( $post_id, 'player_category', true );
		$term = get_term( $term_id, 'player_category' );
		echo '<a href="' . home_url() . '/wp-admin/edit.php?post_type=team&player_category=' . $term->slug .'">';
		echo $term->name;
		echo '</a>';
		break;
	case 'img_attached':
		$term_id = get_post_meta ( $post_id, 'member_photo_small', true );
		$member_name = get_post_meta ( $post_id, 'member_name', true );
		$member_familyname = get_post_meta ( $post_id, 'member_familyname', true );
		$fio = $member_familyname . " " . $member_name;
		echo '<a href="' . home_url() . '/wp-admin/post.php?post=' . $post_id . '&action=edit">';
		echo wp_get_attachment_image($term_id, [64,64], '', ['title' => $fio]);
		echo '</a>';
		break;
	case 'img_thumbnail': //Если нужно вывести именно картинку превью, а не присоедененную картинку
		echo '<a href="' . get_edit_post_link() . '">';
		echo get_the_post_thumbnail($post_id, 'admin-list-thumb');
		echo '</a>';
		break;

	}
}

//Выводим превьюшку поста в таблице со списком турниров
add_filter('manage_match_posts_columns', 'add_img_match_post_column');
function add_img_match_post_column($columns) {
	$columns = array_slice($columns, 0, 1, true) + array("tour_number" => "Тур", "img_attached" => "Превью", 'date_tour' => 'Дата') + array_slice($columns, 1, count($columns) - 1, true) + array('photo' => 'Фотозвіт', 'video' => 'Відеозвіт');
	unset($columns['date']);
	return $columns;
}
//Доп. функция для вывода превью турнира:
add_action ( 'manage_match_posts_custom_column', 'post_maych_custom_column', 10, 2 );
function post_maych_custom_column ( $column, $post_id ) {
	$present = " style = 'color: green; font-size: 26px; vertical-align: middle; margin: 0px 20%;'";
	$notpresent = " style = 'color: red; font-size: 46px; vertical-align: middle; margin: 0px 20%;'";
	$terms = get_terms(['taxonomy' => 'season', 'fields' => 'id=>name']);
        
	switch ( $column ) {
		case 'tour_number':
			echo get_field('tour_number');
			break;
		case 'img_attached':
			$id_post_zvit = get_field('tour_zvit_text');
			echo '<a href="' . get_edit_post_link() . '">';
			echo get_the_post_thumbnail($id_post_zvit, [64,64]);
			echo '</a>';
			break;
		case 'date_tour' :
			echo get_field('tour_date');
			break;
		case 'photo' :
			if (get_field('tour_zvit_photo')) echo "<span $present>+</span>"; else echo "<span $notpresent>-</span>";
			break;
		case 'video' :
			if (get_field('tour_zvit_video')) echo "<span $present'>+</span>"; else echo "<span $notpresent'>-</span>";
			break;
	}
	
}

//Выводим превьюшку лого в таблице со списком турниров
add_filter( "manage_edit-tournament_columns", 'custom_column_header', 10);
function custom_column_header( $columns ){
    $columns['tour_logo'] = 'Лого';
    return $columns;
}

add_action( "manage_tournament_custom_column", 'custom_column_content', 10, 3);
function custom_column_content( $value, $column_name, $term_id ){
    if ($column_name === 'tour_logo') {
		$thumb = get_field('liga-logo', 'category_'.$term_id);
		echo wp_get_attachment_image($thumb, 'thumbnail');
    }
    return $columns;
}


//Доп. функция для вывода превью поста:
add_action ( 'manage_posts_custom_column', 'post_custom_column', 10, 2 );
function post_custom_column ( $column, $post_id ) {
	if ( $column === 'img_attached' ) {
		echo get_post_type( $post_id ).'777';
		echo '<a href="' . get_edit_post_link() . '">';
		echo get_the_post_thumbnail($post_id, [64,64]);
		echo '</a>';
	}
}




//Выводим превьюшку участника в таблице со списком слайдеров
add_filter('manage_wxas_slider_posts_columns', 'add_wxas_slider_column');
function add_wxas_slider_column($columns) {
	$columns = array_slice($columns, 0, 2, true) + array("slider_id" => "Слайдер") + array_slice($columns, 1, count($columns) - 1, true);
	return $columns;
}
//Доп. функция для вывода значений id слайдера:
add_action ( 'manage_wxas_slider_posts_custom_column', 'wxas_slider_custom_column', 10, 2 );
function wxas_slider_custom_column ( $column, $post_id ) {
	switch ( $column ) {
		case 'slider_id':
			echo '[wxas id="' . get_the_ID( ) . '"]';
			break;
	
	

	}
}

//Выводим превьюшку в таблице со списком клубов
add_filter('manage_clubs_posts_columns', 'add_img_club_column');
function add_img_club_column($columns) {
	$columns = array_slice($columns, 0, 1, true) + array("img_attached" => "Лого") + array_slice($columns, 1, count($columns) - 1, true);
	return $columns;
}

//Доп. функция для вывода превью лого клуба:
add_action ( 'manage_clubs_posts_custom_column', 'logo_custom_column', 10, 2 );
function logo_custom_column ( $column, $post_id ) {
	if ( $column === 'img_attached' ) {
		$term_id = get_post_meta ( $post_id, 'fclub_logo', true );
		echo '<a href="' . get_edit_post_link() . '">';
		echo wp_get_attachment_image($term_id, [64,64], '');
		echo '</a>';
	}
}

//Шорт-коды
add_shortcode('fco_tags', 'fco_tags_function');
function fco_tags_function(){
	$tags = get_the_tag_list('<div class="widget-body"><div class="widget-tags-block"><span>', '</span><span>', '</span></div></div>');
	return $tags;
}

add_shortcode('fco_anonse', 'fco_anonse_function');
function fco_anonse_function(){
	$return = '<div class="widget-body">
	<div class="info-block__body">
		<div class="info-block__logo">
			<div class="info-block__logo--tur">
				9-й тур<br>сезон 2019/2020
			</div>
			<img src="img/upl.png" alt="">
		</div>
		<div class="info-block__meta">
			<span class="info-block__date">
				21 вересня 2019р
			</span>
			<span class="info-block__stadium">
				КСК "Олімпійський", м.Київ
			</span>

		</div>
		<div class="info-block__kickoff-container">
			<div class="info-block__team-container">
				<span class="info-block__team-title info-block__team-title--home">
					Колос
				</span>
				<div class="info-block__team-img">
					<img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/desna_0.png" alt="">
				</div>
			</div>
			<div class="info-block__time">
				<span class="clock-icon"></span>
				<span class="knock_time">21:45</span>
			</div>
			<div class="info-block__team-container">
				<div class="info-block__team-img">
					<img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/olexandriya.png" alt="">
				</div>
				<span class="info-block__team-title info-block__team-title--away">
					Олександрія
				</span>

			</div>
		</div>
		<div class="info-block__btn-container">
			<a href="#" class="btn info-block__btn info-block__btn--single">
				<span class="buy-ticket">Купити квіток</span>
			</a>
			<a href="#" class="btn info-block__btn info-block__btn--single">
				<span class="match-center">Матч центр</span>
			</a>
		</div>
	</div>
</div>';
    return $return;
}

include_once('customization.php');

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
	<nav class="pagination-wrapper" role="navigation">
		%3$s
	</nav>    
	';
}

//Вывод записей по указанным таксономиям и формирование кода для отображения на странице с участниками команды
function fco_member_items($age_group, $role, $player_category = '', $block_width = '23'){
	if ($role === 'players'){
		$args = [
			'post_type' => 'team',
			'tax_query' => [
				'relation' => 'AND',
				[
					'taxonomy' => 'age-group',
					'field'    => 'slug',
					'terms'    => $age_group,
				],
				[
					'taxonomy' => 'role',
					'field'    => 'slug',
					'terms'    => $role,
				],
				[
					'taxonomy' => 'player_category',
					'field'    => 'slug',
					'terms'    => $player_category,
				]
			]
		];
	}
	else {
		$args = [
			'post_type' => 'team',
			'tax_query' => [
				'relation' => 'AND',
				[
					'taxonomy' => 'age-group',
					'field'    => 'slug',
					'terms'    => $age_group,
				],
				[
					'taxonomy' => 'role',
					'field'    => 'slug',
					'terms'    => $role,
				]
			]
		];
	}
	$query = new WP_Query( $args );
	if ( $query->have_posts() ){
		while ( $query->have_posts() ) {
			$query->the_post();
				if ($role === 'players'){
					echo '<div class="w' . $block_width .' team-block-item">';
					echo '            <a href="' . get_the_permalink() . '">';
					echo '                <div class="team-block-item-img">';
					echo '                    <img class="img-responsive" src="' . get_field('member_photo_small') . '" width="260" height="220" alt="">';
					echo '                </div>';
					echo '                <div class="team-block-item-content">';
					echo '                    <div class="team-block-item-content-fio-wrapper">';
					echo '                        <div class="team-block-item-content-name">';
					echo                             get_field('member_name');
					echo '                        </div>';
					echo '                        <div class="team-block-item-content-familyname">';
					echo                             get_field('member_familyname');
					echo '                        </div>';
					echo '                    </div>';
					echo '                    <div class="team-block-item-content-number">';
					echo                             get_field('player_number');
					
					echo '                    </div>';
					echo '                </div>';
					echo '            </a>';
					echo '        </div>';
				}
				else {
					echo '<div class="w' . $block_width .' team-block-item">';
					echo '            <a href="' . get_the_permalink() . '">';
					echo '                <div class="team-block-item-img">';
					echo '                    <img class="img-responsive" src="' . get_field('member_photo_small') . '" width="260" height="220" alt="' . get_field('member_familyname') . ' " " ' . get_field('member_name') . '">';
					echo '                </div>';
					echo '					<div class="team-block-item-content-nonplayers">';
					echo '				<div class="team-block-item-content-nonplayers-firstname">';
					echo                     get_field('member_name');
					echo '				</div>';
					echo '				<div class="team-block-item-content-nonplayers-familyname">';
					echo                             get_field('member_familyname');
					echo '				</div>';

					echo '				<div class="team-block-item-content-nonplayers-title">';
					echo                             get_field('member_role');
					echo '				</div>';
					echo '			</div>';
					echo '            </a>';
					echo '        </div>';
				}
		}
	}
	wp_reset_query(); 
	wp_reset_postdata();
} 

//Вывод превью записей по заданным критериям + пагинация
function fco_view_items($cat, $number_posts, $user_cat, $current_post_ID = ''){
	global $wp_query;

	$args = array(
		'posts_per_page' => $number_posts,
		'post__not_in' => array($current_post_ID),
		'order' => 'DESC',
		'orderby' => 'date',
		'cat' => $cat,
		'paged' => get_query_var('paged') ?: 1
	);

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ){
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();
			
			if ($user_cat == '') {
				$category = get_the_category();
				$cat_name = $category[0]->cat_name;
			}
			else $cat_name = get_the_category_by_ID($user_cat);
			
			if (get_post_format() === "video") $postFormat = 'youtube-news';
			elseif (get_post_format() === "gallery") $postFormat = 'foto-news';
			else $postFormat = 'self-news';

			echo '<div class="w23 news-item">';
			echo '	<div class="news-item-media-block">';
			if (get_field('google_photo_url')) echo '<div class="has-google-url" title="Присутнє посилання на Google-Фото"></div>';
			echo '		<div class="news-item-image ' . $postFormat . '">';
			echo '			<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
							if (get_post_format() === "video") {
								$youtube_id = get_field('youtube_link');
								echo "<img src='https://img.youtube.com/vi/$youtube_id/mqdefault.jpg'>";
							}
							else {
								if (has_post_thumbnail()){
									echo '<img src="' .get_the_post_thumbnail_url(get_the_ID(), 'fco-news-logo-300px' ). '" alt="' .get_the_title(). '">';
									
								}
								else {
									echo "<img src='". get_template_directory_uri() . "/assets/img/no-photo-available.jpg' >";
								}
							}
			echo '			</a>';
			echo '		</div>';
			echo '		<div class="news-item-meta">';
			echo '			<div class="news-date">';
							echo get_the_date('d.m.Y');
			echo '			</div>';
			echo '			<div class="news-category">';
							echo $cat_name;
			echo '			</div>';
			echo '		</div>';
			echo '	</div>';
			echo '	<div class="news-item-title">';
			echo '		<span>';
			echo '			<a href="' . get_the_permalink() . '"';
			echo '				title="' . get_the_title() . '">' . get_the_title() . '</a>';
			echo '		</span>';
			echo '	</div>';
			echo '</div>';
		} //endwhile
	} //endif
	else echo "<p>Нет постов по вашим критериям</p>";
}

function fco_pagination(){
	the_posts_pagination(
		array(
			'type' => 'list'
			)
		); 
}


 //Removes media buttons from post types.
add_filter( 'wp_editor_settings', function( $settings ) {
    $current_screen = get_current_screen();

    // Post types for which the media buttons should be removed.
    $post_types = array( 'team' );

    // Bail out if media buttons should not be removed for the current post type.
    if ( ! $current_screen || ! in_array( $current_screen->post_type, $post_types, true ) ) {
        return $settings;
    }

    $settings['media_buttons'] = false;

    return $settings;
} );

//Функция возвращает путь на основе страницы-родителя: main, u-21 или u-19 
function get_preUrlLink(){
	$parentName = get_parentName();
	return home_url() . '/team/' . $parentName;
}

//Функция возвращает имя страницы-родителя: main, u-21 или u-19 
function get_parentName(){
	return get_post(get_post()->post_parent)->post_name;
}

//Функция возвращает имя ФК - Александрия, U-19 или <U-21></U-21>
function fco_get_fcName(){
	$parentID = get_post(get_post()->post_parent);
	print_r($parentID);
	switch ( $parentID ) {
		case 'player_number':
			echo get_post_meta ( $post_id, 'player_number', true );
			break;

}



}

//Делаем приоритет страниц выше, чему у тегов (нужно, когда тег и Custom-page имеют одинаковое имя)
add_action( 'init', 'wpse16902_init' );
function wpse16902_init() {
    $GLOBALS['wp_rewrite']->use_verbose_page_rules = true;
}

add_filter( 'page_rewrite_rules', 'wpse16902_collect_page_rewrite_rules' );
function wpse16902_collect_page_rewrite_rules( $page_rewrite_rules )
{
    $GLOBALS['wpse16902_page_rewrite_rules'] = $page_rewrite_rules;
    return array();
}

add_filter( 'rewrite_rules_array', 'wspe16902_prepend_page_rewrite_rules' );
function wspe16902_prepend_page_rewrite_rules( $rewrite_rules )
{
    return $GLOBALS['wpse16902_page_rewrite_rules'] + $rewrite_rules;
}

function secureData($data) {
	foreach($data as $key => $value) {
		if (is_array($value)) secureData($value);
		else $data[$key] = htmlspecialchars(trim($value));
	}
	return $data;
}

//По переданной дате в формтате 20.10.2019 возвращаем 20 жовтня 2019
function ukrainianDate($date){
	$monthArray = ['', 'Січня', 'Лютого', 'Березня', 'Квітня', 'Травня', 'Червня', 'Липня', 'Серпня', 'Вересня', 'Жовтня', 'Листопад', 'Грудня'];
	$dateArray = explode('.', $date);
	return $dateArray[0] . ' ' . $monthArray[(int)$dateArray[1]] . ' ' . $dateArray[2];
}

 ?>