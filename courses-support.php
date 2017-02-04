<?php
/**
 * Plugin Name: Online Course Support
 * Plugin URI:
 * Description: Adds custom types and taxonomy for online courses
 * Author: Jason G Taylor
 * Author URI: http://jasongtaylor.com
 * Versison: 1.0.0
 * License: GPLv2
 * GitHub Plugin URI: https://github.com/awesomejt/online-training-support
 * GitHub Branch: master
 */


//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function ocs_register_post_type() {

	$singular = 'Course';
	$plural = 'Courses';
	$slug = str_replace( ' ', '_', strtolower( $singular ) );
	$labels = array(
		'name' 			=> $plural,
		'singular_name' 	=> $singular,
		'add_new' 		=> 'Add New',
		'add_new_item'  	=> 'Add New ' . $singular,
		'edit'		        => 'Edit',
		'edit_item'	        => 'Edit ' . $singular,
		'new_item'	        => 'New ' . $singular,
		'view' 			=> 'View ' . $singular,
		'view_item' 		=> 'View ' . $singular,
		'search_term'   	=> 'Search ' . $plural,
		'parent' 		=> 'Parent ' . $singular,
		'not_found' 		=> 'No ' . $plural .' found',
		'not_found_in_trash' 	=> 'No ' . $plural .' in Trash'
		);
	$args = array(
		'labels'              => $labels,
	        'public'              => true,
	        'publicly_queryable'  => true,
	        'exclude_from_search' => false,
	        'show_in_nav_menus'   => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 10,
	        'menu_icon'           => 'dashicons-book',
	        'can_export'          => true,
	        'delete_with_user'    => false,
	        'hierarchical'        => false,
	        'has_archive'         => true,
	        'query_var'           => true,
	        'capability_type'     => 'post',
	        'map_meta_cap'        => true,
	        // 'capabilities' => array(),
	        'rewrite'             => array(
	        	'slug' => $slug,
	        	'with_front' => true,
	        	'pages' => true,
	        	'feeds' => true,
	        ),
	        'supports'            => array(
	        	'title',
	        	'editor',
	        	'author',
	        	'custom-fields',
            'wpcom-markdown'
	        )
	);
	register_post_type( $slug, $args );
}
add_action( 'init', 'ocs_register_post_type' );
