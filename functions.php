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
		// add_image_size( 'admin-list-thumb', 80, 80, false );

		//Фильтр, который НЕ загружает указанные размеры изображений для указанных типов постов:
		add_filter( 'intermediate_image_sizes_advanced', function( $sizes ){
			if( isset( $_REQUEST['post_id'] ) && 'post' == get_post_type($_REQUEST['post_id'] ) ) {
				unset( $sizes['fco-players-logo-big'] );
				unset( $sizes['fco-players-logo-small'] );
			}
			if( isset( $_REQUEST['post_id'] ) && 'team' == get_post_type($_REQUEST['post_id'] ) ) {
				unset( $sizes['fco-news-logo-1140px'] );
				unset( $sizes['fco-news-logo-300px'] );
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
		'name'          => 'Sidebar',
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
		'menu_icon'           => 'dashicons-admin-users', 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => true,
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['team'],
		'has_archive'         => false,
		// 'rewrite'             => array('slug' => 'team'),
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
			'name'              => 'Категорія гравця',
			'singular_name'     => 'Категорія гравця',
			'search_items'      => 'Пошук категорії',
			'all_items'         => 'Усі категорії',
			'edit_item'         => 'Редагувати категорію',
			'update_item'       => 'Оновити категорію',
			'add_new_item'      => 'Додати категорію',
			'new_item_name'     => 'Нова категорія',
			'menu_name'         => 'Категорія гравця',
		),
		'show_ui'       => false,
		'show_in_menu'	=> false,
		'show_admin_column' => false,
		'query_var'     => true,
		'rewrite'       => array( 'slug' => 'player_category' ), // свой слаг в URL
		'show_in_rest' => true
	));
}

add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

//Делаем возможность фильтровать записи с дополнительными фильтрами (таксономией):
function filter_by_taxonomies( $post_type, $which ) {

	// Apply this only on a specific post type
	if ( 'team' !== $post_type )
		return;

	// A list of taxonomy slugs to filter by
	$taxonomies = array( 'age-group', 'role', 'player_category' );

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
add_action( 'restrict_manage_posts', 'filter_by_taxonomies' , 10, 2);


//Выводим превьюшку участника в таблице со списком учасников клуба
add_filter('manage_team_posts_columns', 'add_img_column');
add_filter('manage_team_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
  $columns = array_slice($columns, 0, 1, true) + array("img_taxonomy" => "Фото", 'player_number' => 'Номер гравця') + array_slice($columns, 1, count($columns) - 1, true) + array("player_category" => "Категорія гравця");
  return $columns;
}

function manage_img_column($column_name, $post_id) {
 if( $column_name == 'img_thumbl' ) {
	echo '<a href="' . get_edit_post_link() . '">';
  echo get_the_post_thumbnail($post_id, 'admin-list-thumb');
  echo '</a>';
 }
 return $column_name;
}
http://fco/wp-admin/post.php?post=453&action=edit

//Доп. функция для вывода полей ACF:
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
	case 'img_taxonomy':
		$term_id = get_post_meta ( $post_id, 'member_photo_small', true );
		$member_name = get_post_meta ( $post_id, 'member_name', true );
		$member_familyname = get_post_meta ( $post_id, 'member_familyname', true );
		$fio = $member_familyname . " " . $member_name;
		echo '<a href="' . home_url() . '/wp-admin/post.php?post=' . $post_id . '&action=edit">';
		echo wp_get_attachment_image($term_id, [64,64], '', ['title' => $fio]);
		echo '</a>';
		// print_r(get_term( $term_id ));
		// echo '<pre>';
		// print_r(get_post_meta( $post_id ));
		// echo '</pre>';
		break;
	}
  }
  add_action ( 'manage_team_posts_custom_column', 'team_custom_column', 10, 2 );

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
			echo '		<div class="news-item-image ' . $postFormat . '">';
			echo '			<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
							if (get_post_format() === "video") {
								$youtube_id = get_field('youtube_link');
								echo "<img src='https://img.youtube.com/vi/$youtube_id/mqdefault.jpg'>";
							}
							else {
								if (has_post_thumbnail()){
									the_post_thumbnail( 'fco-news-logo-300px' );
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





 ?>