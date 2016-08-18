<?php
/*
Plugin Name: SJI service showcase
Description: Create service showcase
Version: 1.0
Author: Cleto Barbosa
Author URI: http://sjinnovation.com/
Plugin URI: http://authorsite.com/services
*/

// Hook a function to the WordPress action that generates the Hello World menu item in admin menu
add_action( 'admin_menu', 'sji_create_admin_menu' );

// This function creates the Hello World menu item in admin menu through WPDK
function sji_create_admin_menu()
{
	add_submenu_page('edit.php?post_type=sji-service', 'Settings', 'Settings', 'manage_options','settings','call_back');
}

// Do after plugin activated
function sji_services_activation() {
	sji_services();
	sji_service_positions();
}
register_activation_hook(__FILE__, 'sji_services_activation');

// Do after plugin de-activated
function sji_services_deactivation() {
}
register_deactivation_hook(__FILE__, 'sji_services_deactivation');

// Register service post type
function sji_services() {
 
    $labels = array(
            'name' => _x( 'Services', 'sji-services' ),
            'singular_name' => _x( 'Services Member', 'sji-services' ),
            'add_new' => _x( 'Add New', 'sji-services' ),
            'add_new_item' => __( 'Add New Service', 'sji-services' ),
            'edit_item' => __( 'Edit Service', 'sji-services' ),
            'new_item' => __( 'New Service', 'sji-services' ),
            'all_items' => __( 'All Services', 'sji-services' ),
            'view_item' => __( 'View Services', 'sji-services' ),
            'search_items' => __( 'Search Services', 'sji-services' ),
            'not_found' => __( 'No service found', 'sji-services' ),
            'not_found_in_trash' => __( 'No service found in the Trash', 'sji-services' ),
            'parent_item_colon' => '',
            'menu_name' => 'Services'
        );
        $args = array(
            'labels' => $labels,
            'description' => __( 'Holds our services specific data', 'sji-services' ),
            'public' => true,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'has_archive' => false,
        );
        register_post_type( 'sji-service', $args );
        flush_rewrite_rules();
}
add_action( 'init', 'sji_services' );

// Register service groups taxanomy
function sji_service_groups() {
    $labels = array(
        'name' => _x( 'Groups', 'our-services' ),
        'singular_name' => _x( 'Group', 'our-services' ),
        'search_items' => __( 'Search Groups' ),
        'all_items' => __( 'All Groups' ),
        'parent_item' => __( 'Parent Group' ),
        'parent_item_colon' => __( 'Parent Group:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Group' ),
        'new_item_name' => __( 'New Service Group' ),
        'menu_name' => __( 'Groups' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );
    register_taxonomy( 'sji-service-group', 'sji-service', $args );
}
add_action( 'init', 'sji_service_groups' );

?>