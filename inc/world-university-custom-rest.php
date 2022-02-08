<?php

function world_university_custom_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function () {return get_the_author();}
    ));

}

add_action( 'rest_api_init', 'world_university_custom_rest' );