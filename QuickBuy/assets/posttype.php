<?php  


/**
* Registers Opinions Post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function opinion() {

	$labels = array(
		'name'                => __( 'Opinions', 'text-domain' ),
		'singular_name'       => __( 'Opinion', 'text-domain' ),
		'add_new'             => _x( 'Add New Opinion', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Opinion', 'text-domain' ),
		'edit_item'           => __( 'Edit Opinion', 'text-domain' ),
		'new_item'            => __( 'New Opinion', 'text-domain' ),
		'view_item'           => __( 'View Opinion', 'text-domain' ),
		'search_items'        => __( 'Search Opinions', 'text-domain' ),
		'not_found'           => __( 'No Opinions found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Opinions found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Opinion:', 'text-domain' ),
		'menu_name'           => __( 'Opinions', 'text-domain' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'thumbnail',
			'excerpt','custom-fields'
			)
	);

	register_post_type( 'opinios', $args );
}

add_action( 'init', 'opinion' );


/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function blacklist() {

	$labels = array(
		'name'                => __( 'blacklist', 'text-domain' ),
		'singular_name'       => __( 'blacklist', 'text-domain' ),
		'add_new'             => _x( 'Add New blacklist', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New blacklist', 'text-domain' ),
		'edit_item'           => __( 'Edit blacklist', 'text-domain' ),
		'new_item'            => __( 'New blacklist', 'text-domain' ),
		'view_item'           => __( 'View blacklist', 'text-domain' ),
		'search_items'        => __( 'Search blacklist', 'text-domain' ),
		'not_found'           => __( 'No blacklist found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No blacklist found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent blacklist:', 'text-domain' ),
		'menu_name'           => __( 'blacklist', 'text-domain' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'author', 'thumbnail',
			'excerpt'
			)
	);
	register_post_type( 'blacklist', $args );
}

add_action( 'init', 'blacklist' );


/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function memes() {

	$labels = array(
		'name'                => __( 'Memes', 'text-domain' ),
		'singular_name'       => __( 'Memes', 'text-domain' ),
		'add_new'             => _x( 'Add New Memes', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Memes', 'text-domain' ),
		'edit_item'           => __( 'Edit Memes', 'text-domain' ),
		'new_item'            => __( 'New Memes', 'text-domain' ),
		'view_item'           => __( 'View Memes', 'text-domain' ),
		'search_items'        => __( 'Search Memes', 'text-domain' ),
		'not_found'           => __( 'No Memes found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Memes found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Memes:', 'text-domain' ),
		'menu_name'           => __( 'Memes', 'text-domain' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'author', 'thumbnail',
			'excerpt','custom-fields', 'trackbacks', 'comments',
			'revisions', 'page-attributes', 'post-formats'
			)
	);

	register_post_type( 'memes', $args );
}

add_action( 'init', 'memes' );
