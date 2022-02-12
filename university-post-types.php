<?php

function university_post_types()
{

    // Event Post type
    register_post_type('event', array(
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'label'  => _x('Events', 'Post Type General Name', 'text_domain'),
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
    register_post_type('program', array(
        'label'  => _x('Program', 'Post Type General Name', 'text_domain'),
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
        'supports' => array('title')
    ));

    // Professor Post Type
    register_post_type('professor', array(
        'show_in_rest' => true,
        'rest_base' => 'professors',
        'label'  => _x('Professor', 'Post Type General Name', 'text_domain'),
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ),
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        )
    ));

    // Campus Post type
    register_post_type('campus', array(
        'capability_type' => 'campus',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'campuses'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt'
    ));

    // Notes Post Type
    register_post_type('note', array(
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'show_in_rest' => true,
        'label'  => _x('Note', 'Post Type General Name', 'text_domain'),
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Note',
            'singular_name' => 'Note'
        ),
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-welcome-write-blog',
        'supports' => array('title', 'editor')
    ));

}
add_action('init', 'university_post_types');
