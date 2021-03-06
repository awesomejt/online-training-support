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

function ocs_taxonomy_config( $singular, $plural, $hierarchical ) {
  // set up labels
	$labels = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'search_items'      => 'Search ' . $plural,
		'all_items'         => 'All ' . $plural,
		'edit_item'         => 'Edit ' . $singular,
		'update_item'       => 'Update ' . $singular,
		'add_new_item'      => 'Add New ' . $singular,
		'new_item_name'     => 'New ' . $singular,
		'menu_name'         => $plural
	);

  // register taxonomy
	return array(
		'hierarchical' => $hierarchical,
		'labels' => $labels,
		'query_var' => true,
		'show_admin_column' => true
	);
}

function ocs_register_post_type( $singular, $plural, $icon ) {
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
          'menu_icon'           => $icon,
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
						'thumbnail',
            'author',
						'excerpt',
            'custom-fields',
            'wpcom-markdown'
          )
  );
  register_post_type( $slug, $args );
}

// Register Custom Post Types
function ocs_register_post_types() {
  ocs_register_post_type( 'Course', 'Courses', 'dashicons-book' );
  ocs_register_post_type( 'Question', 'Questions', 'dashicons-format-chat' );
  ocs_register_post_type( 'Tutorial', 'Tutorials', 'dashicons-book-alt' );
  ocs_register_post_type( 'Tip', 'Tips', 'dashicons-lightbulb' );
}
add_action( 'init', 'ocs_register_post_types' );

// Register Custom taxonomies
function ocs_register_taxonomies() {
  register_taxonomy( 'questioncat', 'question',
    ocs_taxonomy_config('Question Category', 'Question Categories', true)
  );
  register_taxonomy( 'association', array('question','tip','tutorial'),
    ocs_taxonomy_config('Association', 'Associations', false)
  );
  register_taxonomy( 'tutcat', 'tutorial',
    ocs_taxonomy_config('Tutorial Category', 'Tutorial Categories', true)
  );
  register_taxonomy( 'tipcat', 'tip',
    ocs_taxonomy_config('Tip Category', 'Tip Categories', true)
  );
  register_taxonomy( 'topic', array('course', 'tip', 'question', 'tutorial'),
    ocs_taxonomy_config('Topic', 'Topics', false)
  );
}
add_action( 'init', 'ocs_register_taxonomies' );
