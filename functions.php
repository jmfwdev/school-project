<?php

/**
 * School Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Theme
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function school_theme_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School Theme, use a find and replace
		* to change 'school-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('school-theme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'school-theme'),
			'footer' => esc_html__('Footer', 'school-theme'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'school_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'school_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('school_theme_content_width', 640);
}
add_action('after_setup_theme', 'school_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'school-theme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'school-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'school_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function school_theme_scripts()
{
	wp_enqueue_style('school-theme-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('school-theme-style', 'rtl', 'replace');

	wp_enqueue_script('school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'school_theme_scripts');

function fwd_custom_font()
{
	wp_register_style(' my-google-font ', ' https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap ', false);
	wp_enqueue_style('my-google-font');
}

add_action(' wp_enqueue_scripts ', ' fwd_custom_font ');

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Custom Post Types & Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';


/**
 * Add filter
 */

// function fwd_title_place_holder($title){

// 	if( post_type_exists( 'fwd-staff' ) ){
// 		$my_title = "Add staff name";
// 		return $my_title;
// 	}

// 	return $title;

// }

// add_filter('enter_title_here', 'fwd_title_place_holder');

function fwd_title_place_holder($placeholder)
{
	// Check if we are on the admin post edit screen and the post type is 'your_custom_post_type'
	if (post_type_exists('fwd-staff')) {
		$my_title = "Add staff name";
		return $my_title;
	}
	// return $my_title;
}

function apply_custom_title_placeholder()
{
	global $post_type;
	if ('fwd-staff' === $post_type) {
		add_filter('enter_title_here', 'fwd_title_place_holder');
	}
}
add_action('admin_head-post-new.php', 'apply_custom_title_placeholder');
add_action('admin_head-post.php', 'apply_custom_title_placeholder');

/**
 * Custom Post Types
 */

// Students Post Type

function register_student_cpt()
{
	$labels = array(
		'name'                  => _x('Students', 'Post type general name', 'textdomain'),
		'singular_name'         => _x('Student', 'Post type singular name', 'textdomain'),
		'menu_name'             => _x('Students', 'Admin Menu text', 'textdomain'),
		'name_admin_bar'        => _x('Student', 'Add New on Toolbar', 'textdomain'),
		'add_new'               => __('Add New', 'textdomain'),
		'add_new_item'          => __('Add New Student', 'textdomain'),
		'new_item'              => __('New Student', 'textdomain'),
		'edit_item'             => __('Edit Student', 'textdomain'),
		'view_item'             => __('View Student', 'textdomain'),
		'all_items'             => __('All Students', 'textdomain'),
		'search_items'          => __('Search Students', 'textdomain'),
		'not_found'             => __('No students found.', 'textdomain'),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => true,
		'show_in_rest'       => true, // Enable Gutenberg block editor
		'supports'           => array('title', 'editor', 'excerpt', 'thumbnail'),
		'template'           => array(
			array('core/paragraph', array(
				'placeholder' => 'Add a short biography',
			)),
			array('core/button', array(
				'text' => 'Visit Portfolio',
			)),
		),
		'template_lock'      => 'all', // Prevent adding/removing/moving blocks
		'rewrite'            => array('slug' => 'students'),
		'menu_icon'          => 'dashicons-welcome-learn-more',
	);

	register_post_type('student', $args);
}
add_action('init', 'register_student_cpt');


function change_student_title_placeholder($title)
{
	$screen = get_current_screen();
	if ('student' == $screen->post_type) {
		$title = 'Add student name';
	}
	return $title;
}
add_filter('enter_title_here', 'change_student_title_placeholder');

function student_excerpt_length($length)
{
	if (is_post_type_archive('student')) {
		return 25;
	}
	return $length;
}
add_filter('excerpt_length', 'student_excerpt_length');

function student_excerpt_more($more)
{
	global $post;
	if (is_post_type_archive('student')) {
		return '... <a href="' . get_permalink($post->ID) . '">Read More about the Student</a>';
	}
	return $more;
}
add_filter('excerpt_more', 'student_excerpt_more');

function register_student_taxonomy()
{
	$labels = array(
		'name'              => _x('Categories', 'taxonomy general name'),
		'singular_name'     => _x('Category', 'taxonomy singular name'),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'hierarchical'      => true,
		'show_in_rest'      => true, // For Gutenberg
	);

	register_taxonomy('student_category', array('student'), $args);
}
add_action('init', 'register_student_taxonomy');

function add_student_categories()
{
	wp_insert_term('Designer', 'student_category');
	wp_insert_term('Developer', 'student_category');
}
add_action('init', 'add_student_categories');

add_image_size('student-thumbnail', 200, 300, true);

function enqueue_aos_library()
{
	if (is_singular('post') || is_post_type_archive('post') || is_home()) {
		wp_enqueue_style('aos-css', get_template_directory_uri() . '/css/aos.css');
		wp_enqueue_script('aos-js', get_template_directory_uri() . '/js/aos.js', array(), null, true);

		wp_add_inline_script('aos-js', 'AOS.init();');
	}
}

add_action('wp_enqueue_scripts', 'enqueue_aos_library');
