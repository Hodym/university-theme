<?php
/**
 * World University functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package World_University
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function world_university_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on World University, use a find and replace
		* to change 'world-university' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'world-university', get_template_directory() . '/languages' );

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

	add_image_size('professorLandscape', 400, 260, true);
	add_image_size('professorPortrait', 480, 650, true);
	add_image_size('uniPageBanner', 1500, 350, true);

	// This theme uses wp_nav_menu() in one location.
	// register_nav_menus(
	// 	array(
	// 		'primaryMenu' => esc_html__( 'Primary Menu Location', 'world-university' ),
	// 		'footerMenuExplore' => esc_html__( 'Explore Footer Location', 'world-university' ),
	// 		'footerMenuLearn' => esc_html__( 'Learn Footer Location', 'world-university' )
	// 	)
	// );

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
			'world_university_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'world_university_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function world_university_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'world_university_content_width', 640 );
}
add_action( 'after_setup_theme', 'world_university_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function world_university_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'world-university' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'world-university' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'world_university_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/world-university-scripts.php';


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

/**
 * Taxonomy and custom types.
 */
require get_template_directory() . '/university-post-types.php';

/**
 * Query with page Events.
 */
require get_template_directory() . '/inc/world-university-adjust-queries.php';

/**
 * Others content
 */
require get_template_directory() . '/inc/world-university-page-banner.php';

/**
 * Maps JavaScript API
 */
require get_template_directory() . '/inc/uniGoogleMapApi.php';

/**
 * Custom Rest
 */
require get_template_directory() . '/inc/world-university-custom-rest.php';

/**
 * Search Route
 */
require get_template_directory() . '/inc/search-route.php';

/**
 * Like Route
 */
require get_template_directory() . '/inc/like-route.php';

// Redirect subscriber accounts out of admin and onto homepage
function redirectSubsToFrontend() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}
add_action('admin_init', 'redirectSubsToFrontend');

function noSubsAdminBar() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}
add_action('wp_loaded', 'noSubsAdminBar');

// Customize Login Screen
function ourHeaderUrl() {
  return esc_url(site_url('/'));
}
add_filter('login_headerurl', 'ourHeaderUrl');

function ourLoginCSS() {
  wp_enqueue_style('university_main_styles', get_stylesheet_uri());
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginTitle() {
  return get_bloginfo('name');
}
add_filter('login_headertitle', 'ourLoginTitle');

// Forse note posts to be private

function uniNotePrivate($data, $postarr) {
	if($data['post_type'] == 'note') {
		if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
			die("You have reached your note limit.");
		}

		$data['post_title'] = sanitize_text_field($data['post_title']);
		$data['post_content'] = sanitize_textarea_field($data['post_content']);
	}

	if($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
		$data['post_status'] = "private";
	}
	
	return $data;
}
add_filter('wp_insert_post_data', 'uniNotePrivate', 10, 2);

add_filter( 'private_title_format', function ( $format ) {
    return '%s';
} );

/**
 * Slider
 */
require get_template_directory() . '/inc/university-slider.php';
