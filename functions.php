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
 * Custom Post Types
 */

// Students Post Type

function register_student_post_type()
{
	$labels = array(
		'name'                  => _x('Students', 'Post Type General Name', 'school-theme'),
		'singular_name'         => _x('Student', 'Post Type Singular Name', 'school-theme'),
		'menu_name'             => __('Students', 'school-theme'),
		'name_admin_bar'        => __('Student', 'school-theme'),
		'archives'              => __('Student Archives', 'school-theme'),
		'attributes'            => __('Student Attributes', 'school-theme'),
		'parent_item_colon'     => __('Parent Student:', 'school-theme'),
		'all_items'             => __('All Students', 'school-theme'),
		'add_new_item'          => __('Add New Student', 'school-theme'),
		'add_new'               => __('Add New', 'school-theme'),
		'new_item'              => __('New Student', 'school-theme'),
		'edit_item'             => __('Edit Student', 'school-theme'),
		'update_item'           => __('Update Student', 'school-theme'),
		'view_item'             => __('View Student', 'school-theme'),
		'view_items'            => __('View Students', 'school-theme'),
		'search_items'          => __('Search Student', 'school-theme'),
		'not_found'             => __('Not found', 'school-theme'),
		'not_found_in_trash'    => __('Not found in Trash', 'school-theme'),
		'featured_image'        => __('Featured Image', 'school-theme'),
		'set_featured_image'    => __('Set featured image', 'school-theme'),
		'remove_featured_image' => __('Remove featured image', 'school-theme'),
		'use_featured_image'    => __('Use as featured image', 'school-theme'),
		'insert_into_item'      => __('Insert into student', 'school-theme'),
		'uploaded_to_this_item' => __('Uploaded to this student', 'school-theme'),
		'items_list'            => __('Students list', 'school-theme'),
		'items_list_navigation' => __('Students list navigation', 'school-theme'),
		'filter_items_list'     => __('Filter students list', 'school-theme'),
	);
	$args = array(
		'label'                 => __('Student', 'school-theme'),
		'description'           => __('Post Type Description', 'school-theme'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
		'taxonomies'            => array('category', 'post_tag'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'rewrite'               => array('slug' => 'student'),
		'template'              => array(
			array('core/paragraph', array(
				'placeholder' => 'Add student name',
			)),
			array('core/paragraph', array(
				'placeholder' => 'Add short biography',
			)),
			array('core/button', array(
				'text' => 'Portfolio',
				'url'  => '#',
			)),
		),
		'template_lock'         => 'all',
	);
	register_post_type('student', $args);
}

add_action('init', 'register_student_post_type', 0);
