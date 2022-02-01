<?php

add_action( 'init', 'university_post_types', 0 );
function university_post_types() {
    $args = array(
        'label'  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
            ),
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar',
    );
    register_post_type( 'event', $args );
}