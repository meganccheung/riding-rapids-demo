<?php
/**
 * Riding Rapids functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Riding_Rapids
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
function riding_rapids_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Riding Rapids, use a find and replace
		* to change 'riding-rapids' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'riding-rapids', get_template_directory() . '/languages' );

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

	//custom size
	add_image_size ( 'new-portrait-blog', 600, 600, true );
	add_image_size ( 'company-photo', 300, 400, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__( 'Header Menu Location', 'riding-rapids' ),
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
			'riding_rapids_custom_background_args',
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
add_action( 'after_setup_theme', 'riding_rapids_setup' );

/**
 * SVG Favicon
 */
function be_svg_favicon() {
	echo '<link rel="icon" href="' . esc_url( get_stylesheet_directory_uri() . '/images/rr-favicon.svg' ) . '" type="image/svg+xml">';
}
add_action( 'wp_head', 'be_svg_favicon', 100 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function riding_rapids_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'riding_rapids_content_width', 640 );
}
add_action( 'after_setup_theme', 'riding_rapids_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function riding_rapids_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'riding-rapids' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'riding-rapids' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'riding_rapids_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function riding_rapids_scripts() {
	
	//Custom Google Fonts
	wp_enqueue_style( 'riding-rapids-fonts', 
	'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap',
		array(), 
		null
		);

	wp_enqueue_style( 'riding-rapids-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'riding-rapids-style', 'rtl', 'replace' );

	wp_enqueue_script( 'scroll-change', get_template_directory_uri() . '/js/scrollchange.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'faq-accordion', get_template_directory_uri() . '/js/accordion.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'riding-rapids-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'google-map', get_template_directory_uri() . '/js/googlemap.js', array('jquery', 'google-map-api'), _S_VERSION, true );
	wp_enqueue_script( 'google-map-api', "https://maps.googleapis.com/maps/api/js?key=AIzaSyDQPOXk7odlzOM0n0t-qs_gBDlUGM2YcYE", array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//this will only run in homepage
if (is_front_page() ) {
	wp_enqueue_script( 'swiper-scripts', get_template_directory_uri() .'/js/swiper-bundle.min.js', array(), '7.4.1', true );
	wp_enqueue_script( 'swiper-settings', get_template_directory_uri() .'/js/swiper-settings.js', array( 'swiper-scripts' ), _S_VERSION, true );
}

}
add_action( 'wp_enqueue_scripts', 'riding_rapids_scripts' );


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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Google Map API
 */
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyDQPOXk7odlzOM0n0t-qs_gBDlUGM2YcYE';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


// Add an ACF Options Menu to store CTA ACF Fields

if (function_exists('acf_add_options_page')){

	acf_add_options_page(

		array(

			'page_title' => 'ACF Options',
			'menu_title' => 'ACF Options',
			'menu_slug'  => 'acf-settings',
			'capability' => 'edit_posts',
			'icon_url'   => 'dashicons-superhero-alt',
			'position'	 => 55,
			'redirect'   => true

		)

	);

	acf_add_options_sub_page(

		array(

			'page_title' => 'FAQ CTA',
			'menu_title' => 'FAQ CTA',
			'parent_slug' => 'acf-settings'

		)

	);

	acf_add_options_sub_page(

		array(

			'page_title' => 'Book Now CTA',
			'menu_title' => 'Book Now CTA',
			'parent_slug' => 'acf-settings'

		)

	);

}

// Turn off the block editor on specific pages
function rrc_post_filter( $use_block_editor, $post ) {
    $page_ids = array( 42, 28, 14, 30 );
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'rrc_post_filter', 10, 2);

// Set Yoast to low priority - show below ACF fields instead of on top
function move_yoast_below_acf() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'move_yoast_below_acf');


//Wysiwyg Editor
add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{

	$toolbars['Riding Rapids Basic Toolbar' ] = array();
	$toolbars['Riding Rapids Basic Toolbar' ][1] = array('bold' , 'italic' , 'underline', 'bullist', 'numlist', 'alignleft', 'aligncenter', 'alignright', 'link', 'spellchecker', 'fullscreen', 'undo', 'redo' );

	return $toolbars;
}

// Remove admin menu links for non-Administrator accounts
function rrc_remove_admin_links() {
	if ( !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'edit.php' );           // Remove Posts link
    	remove_menu_page( 'edit-comments.php' );  // Remove Comments link
    	remove_menu_page( 'wpseo_workouts' );  // Remove Yoast SEO Workouts link
	}
}
add_action( 'admin_menu', 'rrc_remove_admin_links' );

/**
 * Login Styles.
 */
require get_template_directory() . '/inc/login-styles.php';

/**
 * Dashboard Customization.
 */
require get_template_directory() . '/inc/dashboard-customization.php';
