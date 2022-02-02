<?php

function university_post_types() {

    // Event Post type
    register_post_type( 'event', array(
        'label'  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar',
        'supports' => array(
            'title',
            'editor',
            'excerpt'
        )
    ));

    // Program Post type
    register_post_type( 'program', array(
        'label'  => _x( 'Program', 'Post Type General Name', 'text_domain' ),
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-awards',
        'supports' => array(
            'title',
            'editor'
        )
    ));

}
add_action( 'init', 'university_post_types');
