<?php


/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @author Freeshifter LLC
 * @since 1.0.0
 */
add_action( 'after_setup_theme', function () {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'wp-tailwind' ),
		'footer'  => __( 'Footer Menu', 'wp-tailwind' ),
	] );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	] );

    // Custom logo
  add_theme_support( 'custom-logo', array(
    //'height'      => 55,
    //'width'       => 240,
    'flex-height' 			=> true, 
    'flex-width'  			=> true,
	'header-text'          	=> array( 'site-title', 'site-description' ),
	'unlink-homepage-logo' 	=> true,
  ) );
	
} );

/*function MiyoVite_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'MiyoVite_custom_logo_setup' );*/

// Remove all default WP template redirects/lookups
remove_action( 'template_redirect', 'redirect_canonical' );

// Redirect all requests to index.php so the Vue app is loaded and 404s aren't thrown
function remove_redirects() {
	add_rewrite_rule( '^/(.+)/?', 'index.php', 'top' );
}
add_action( 'init', 'remove_redirects' );
// podstawowe pola do acf

function get_menu() {
    # Change 'menu' to your own navigation slug.
    return wp_get_nav_menu_items('główne');
}
add_action( 'rest_api_init', function () {
        register_rest_route( 'myroutes', '/menu', array(
        'methods' => 'GET',
        'callback' => 'get_menu',
    ) );
} );
function get_menu2() {
    # Change 'menu' to your own navigation slug.
    return wp_get_nav_menu_items('stopka');
}
add_action( 'rest_api_init', function () {
        register_rest_route( 'myroutes', '/menustopka', array(
        'methods' => 'GET',
        'callback' => 'get_menu2',
    ) );
} );


function get_front() {
    # Change 'menu' to your own navigation slug.
    return get_option('page_on_front');
}

add_action( 'rest_api_init', function () {
        register_rest_route( 'myroutes', '/front', array(
        'methods' => 'GET',
        'callback' => 'get_front',
    ) );
} );


/* Disable WordPress Admin Bar for all users but admins. */
show_admin_bar(false);

function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


function cptui_register_my_cpts() {	
	/**
	* Post Type: Opinions.
	*/
	$labels = [
		"name" => esc_html__( "Opinions", "miyovite" ),
		"singular_name" => esc_html__( "opinions", "miyovite" ),
	];	
	$args = [
		"label" => esc_html__( "Opinions", "miyovite" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "opinions", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-star-filled",
		"supports" => [ "title", "custom-fields" ],
		"show_in_graphql" => false,
	];	
	register_post_type( "opinions", $args );	
	/**
	* Post Type: Authors.
	*/
	$labels = [
		"name" => esc_html__( "Authors", "miyovite" ),
		"singular_name" => esc_html__( "Author", "miyovite" ),
	];
	$args = [
		"label" => esc_html__( "Authors", "miyovite" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "authors", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-admin-users",
		"supports" => [ "title", "custom-fields" ],
		"show_in_graphql" => false,
	];	
	register_post_type( "authors", $args );	
	/**
	* Post Type: Opinionsv2.
	*/
	$labels = [
		"name" => esc_html__( "Opinionsv2", "miyovite" ),
		"singular_name" => esc_html__( "Opinionsv2", "miyovite" ),
	];	
	$args = [
		"label" => esc_html__( "Opinionsv2", "miyovite" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "opinionsv2", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
		"show_in_graphql" => false,
	];
	register_post_type( "opinionsv2", $args );
}
add_action( 'init', 'cptui_register_my_cpts' );



add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
 .menu-icon-opinions  div.wp-menu-image:before{
    color:#BBF7D0 !important;
}
.menu-icon-opinions .wp-menu-name{
    color:#BBF7D0 !important;
}
  </style>';
  echo '<style>
  .menu-icon-authors  div.wp-menu-image:before{
     color:yellow !important;
 }
 .menu-icon-authors .wp-menu-name{
     color:yellow !important;
 }
   </style>';
   echo '<style>
   .menu-icon-opinionsv2  div.wp-menu-image:before{
      color:yellow !important;
  }
  .menu-icon-opinionsv2 .wp-menu-name{
      color:yellow !important;
  }
    </style>';
}