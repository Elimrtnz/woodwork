<?php
/**
 * woodwork functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package woodwork
 */

if ( ! function_exists( 'woodwork_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function woodwork_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on woodwork, use a find and replace
		 * to change 'woodwork' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'woodwork', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'woodwork' ),
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
		add_theme_support( 'custom-background', apply_filters( 'woodwork_custom_background_args', array(
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
add_action( 'after_setup_theme', 'woodwork_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function woodwork_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'woodwork_content_width', 640 );
}
add_action( 'after_setup_theme', 'woodwork_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function woodwork_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'woodwork' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'woodwork' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'woodwork_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function woodwork_scripts() {
	wp_enqueue_style( 'woodwork-style', get_stylesheet_uri() );

	wp_enqueue_script( 'woodwork-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'woodwork-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'woodwork_scripts' );

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

/*
  Enques jQuery from Google CDN. 
  Uses the currently registred WordPress jQuery version.
*/
  function appglobe_jquery_enqueue() { 

  /* 
     Probably not necessary if called with the 'wp_enqueue_scripts' action.
  */
     if (is_admin()) return; 

     global $wp_scripts; 

  /*
    Change  this flag to have the CDN script  
    triggered by wp_footer instead of wp_head.
    If Google CDN is unavailable for some reason the flag 
    will be ignored and the local WordPress 
    jQuery gets enqueued and included in the head
    by the wp_head function.
  */
    $cdn_script_in_footer = false; 
  /*
    Register jQuery from Google CDN.
  */
    if (is_a($wp_scripts, 'WP_Scripts') && isset($wp_scripts->registered['jquery'])) {
    /* 
       The WordPress jQuery version. 
    */
       $registered_jquery_version = $wp_scripts -> registered[jquery] -> ver; 

       if($registered_jquery_version) {
      /* 
	 The jQuery Google CDN URL. 
	 Makes a check for HTTP on top of SSL/TLS (HTTPS) 
	 to make sure the URL is correct.
      */
  $google_jquery_url = ($_SERVER['SERVER_PORT'] == 443 ? "https" : "http") . 
  "://ajax.googleapis.com/ajax/libs/jquery/$registered_jquery_version/jquery.min.js";

      /* 
	 Get the HTTP header response for the this URL, and check that its ok. 
	 If ok, include jQuery from Google CDN. 
      */
 //  if(200 === wp_remote_retrieve_response_code(wp_remote_head($google_jquery_url))) {
 //   wp_deregister_script('jquery');
 //   wp_register_script('jquery', $google_jquery_url , false, null, $cdn_script_in_footer);
 // }
}
}
  /* 
     Enqueue jQuery from Google if available. 
     Fall back to the local WordPress default.
     If the local WordPress jQuery is called, it will get 
     included in the header no matter what the 
     $cdn_script_in_footer flag above is set to.
  */
     wp_enqueue_script('jquery'); 
   }
   add_action('wp_enqueue_scripts', 'appglobe_jquery_enqueue', 11);

/* 
   add our scripts here instead, and use wp_footer to load most scripts
*/


function load_scripts() {
  // register your script location, dependencies and version
    wp_register_script('modernizer',get_template_directory_uri() . '/js/libs/modernizr-2.8.3.min.js',  '2.8.3',false );	 

    // wp_register_script('plugins',get_template_directory_uri() . '/js/plugins.js',  array('jquery'),   '1.0' , true );	   
    wp_register_script('scripts',get_template_directory_uri() . '/js/script.js',  array('jquery'),   '1.0', true );	   

    wp_enqueue_script('modernizer');
    // wp_enqueue_script('plugins');
    wp_enqueue_script('scripts');

  }
  add_action('wp_enqueue_scripts', 'load_scripts');

// custom post types here


add_action('init', 'slider_images');
function slider_images () {
  $args = array(
    'label' => __('Slider Images' ),
    'singular_label' => __('Slider Image' ),
    'public' => false,
    'show_ui' => true,
    'capability_type' => 'page',
    'hierarchical' => false,
    'rewrite' => false,		
    'supports' => array('title','thumbnail' , 'page-attributes')
    );
  register_post_type('slider_images',$args);
}