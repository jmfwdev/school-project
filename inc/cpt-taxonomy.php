<?php
// register custom post types
function fwd_register_custom_post_types() {
    $labels = array(
        'name'                  => _x( 'Staffs', 'post type general name' ),
        'singular_name'         => _x( 'Staff', 'post type singular name'),
        'menu_name'             => _x( 'Staffs', 'admin menu' ),
        'name_admin_bar'        => _x( 'Staff', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'staff' ),
        'add_new_item'          => __( 'Add New Staff' ),
        'new_item'              => __( 'New Staff' ),
        'edit_item'             => __( 'Edit Staff' ),
        'view_item'             => __( 'View Staff' ),
        'all_items'             => __( 'All Staffs' ),
        'not_found'             => __( 'No staffs found.' ),
        'not_found_in_trash'    => __( 'No staffs found in Trash.' ),
        'archives'              => __( 'Staff Archives'),
        'insert_into_item'      => __( 'Insert into staff'),
        'uploaded_to_this_item' => __( 'Uploaded to this staff'),
        'filter_item_list'      => __( 'Filter staffs list'),
        'items_list_navigation' => __( 'Staffs list navigation'),
        'items_list'            => __( 'Staffs list'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staffs' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title'),
    );

    register_post_type( 'fwd-staff', $args );
}
add_action( 'init', 'fwd_register_custom_post_types' );

// register taxonomies

function fwd_register_taxonomies() {
    // Add Faculty taxonomy
    $labels = array(
        'name'              => _x( 'Roles', 'taxonomy general name' ),
        'singular_name'     => _x( 'Role', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Roles' ),
        'all_items'         => __( 'All Roles' ),
        'parent_item'       => __( 'Parent Role' ),
        'parent_item_colon' => __( 'Parent Role:' ),
        'edit_item'         => __( 'Edit Role' ),
        'update_item'       => __( 'Update Role' ),
        'add_new_item'      => __( 'Add New Role' ),
        'new_item_name'     => __( 'New Work Role' ),
        'menu_name'         => __( 'Roles' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'roles' ),
    );

    register_taxonomy( 'fwd-roles', array( 'fwd-staff' ), $args );
}
add_action( 'init', 'fwd_register_taxonomies');

//flush permalinks
function fwd_rewrite_flush() {
    fwd_register_custom_post_types();
    fwd_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fwd_rewrite_flush' );