<?php

/**
 * Option tree inclusion here
 */
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_show_pages', '__return_false' );
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
require( trailingslashit( get_template_directory() ) . 'components/meta-boxes.php' );
require( trailingslashit( get_template_directory() ) . 'components/theme-options.php' );

// New menu item
function theme_options_parent($parent){
	$parent = '';
	return $parent;
}
add_filter('ot_theme_options_parent_slug','theme_options_parent',20);

/**************************************************************************************/


function velcom_setup() {

	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'velcom' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

}
add_action( 'after_setup_theme', 'velcom_setup' );

function dfnd_reset_permalinks(){
	flush_rewrite_rules();
}
add_action('after_switch_theme', 'velcom_reset_permalinks');

function velcom_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'velcom' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'velcom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'velcom_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

// Enqueue different version of jquery
function my_jquery() {
    wp_deregister_script( 'jquery-core' );
    wp_register_script( 'jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js' /* 1 = last version */, false, null );
    wp_enqueue_script( 'jquery' );
}    
add_action( 'wp_enqueue_scripts', 'my_jquery' );

// Enqueue scripts
function velcom_scripts() {
	wp_enqueue_script('wow', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js', array('jquery'), '', true);
	wp_enqueue_script('tween', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js', array('jquery'), '', true);
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/styles/js/owl.carousel.min.js', array('jquery'), '', true);
	wp_enqueue_script('main-script', get_template_directory_uri() . '/styles/js/main.js', array('jquery'), '', true);
}
add_action( 'wp_enqueue_scripts', 'velcom_scripts' );

// Enqueue styles
function velcom_styles() {
	wp_enqueue_style( 'reset', get_template_directory_uri() . '/styles/css/reset.css');
	wp_enqueue_style( 'animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css');
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/styles/css/owl.carousel.min.css');
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/styles/css/owl.theme.default.min.css');
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/styles/css/index.css?'.time() );
}
add_action( 'wp_enqueue_scripts', 'velcom_styles' );

function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);