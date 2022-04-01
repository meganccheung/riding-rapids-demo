<?php
function rrc_register_custom_post_types() {
    
    // Register Team
    $labels = array(
        'name'                  => _x( 'Team', 'post type general name' ),
        'singular_name'         => _x( 'Tour Guide', 'post type singular name'),
        'menu_name'             => _x( 'Team', 'admin menu' ),
        'name_admin_bar'        => _x( 'Tour Guide', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'tour guide' ),
        'add_new_item'          => __( 'Add New Tour Guide' ),
        'new_item'              => __( 'New Tour Guide' ),
        'edit_item'             => __( 'Edit Tour Guide' ),
        'view_item'             => __( 'View Tour Guide' ),
        'all_items'             => __( 'All Tour Guides' ),
        'search_items'          => __( 'Search Team' ),
        'parent_item_colon'     => __( 'Parent Team:' ),
        'not_found'             => __( 'No tour guides found.' ),
        'not_found_in_trash'    => __( 'No tour guides found in Trash.' ),
        'archives'              => __( 'Tour Guide Archives'),
        'insert_into_item'      => __( 'Insert into tour guide'),
        'uploaded_to_this_item' => __( 'Uploaded to this tour guide'),
        'filter_item_list'      => __( 'Filter tour guides list'),
        'items_list_navigation' => __( 'Team list navigation'),
        'items_list'            => __( 'Team list'),
        'featured_image'        => __( 'Tour Guide featured image'),
        'set_featured_image'    => __( 'Set tour guide featured image'),
        'remove_featured_image' => __( 'Remove tour guide featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
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
        'rewrite'            => array( 'slug' => 'team' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'thumbnail' ),
        'template_lock'      => 'all'
    );

    register_post_type( 'rrc-team', $args );

        // Register Testimonials
        $labels = array(
            'name'                  => _x( 'Testimonials', 'post type general name' ),
            'singular_name'         => _x( 'Testimonial', 'post type singular name'),
            'menu_name'             => _x( 'Testimonials', 'admin menu' ),
            'name_admin_bar'        => _x( 'Testimonial', 'add new on admin bar' ),
            'add_new'               => _x( 'Add New', 'testimonial' ),
            'add_new_item'          => __( 'Add New Testimonial' ),
            'new_item'              => __( 'New Testimonial' ),
            'edit_item'             => __( 'Edit Testimonial' ),
            'view_item'             => __( 'View Testimonial' ),
            'all_items'             => __( 'All Testimonials' ),
            'search_items'          => __( 'Search Testimonials' ),
            'parent_item_colon'     => __( 'Parent Testimonials:' ),
            'not_found'             => __( 'No testimonials found.' ),
            'not_found_in_trash'    => __( 'No testimonials found in Trash.' ),
            'archives'              => __( 'Testimonial Archives'),
            'insert_into_item'      => __( 'Insert into tour guide'),
            'uploaded_to_this_item' => __( 'Uploaded to this tour guide'),
            'filter_item_list'      => __( 'Filter testimonials list'),
            'items_list_navigation' => __( 'Testimonials list navigation'),
            'items_list'            => __( 'Testimonials list'),
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
            'rewrite'            => array( 'slug' => 'testimonials' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-testimonial',
            'supports'           => array( 'title', 'editor' ),
            'template'           => array( 
                array( 'core/quote'), 
            ),
            'template_lock'      => 'all'
        );
    
        register_post_type( 'rrc-testimonials', $args );

}
add_action( 'init', 'rrc_register_custom_post_types' );
?>