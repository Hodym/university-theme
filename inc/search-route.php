<?php

function university_register_search()
{
    register_rest_route('university/v1', 'search', array(
        'methods'  => WP_REST_Server::READABLE,
        'callback' => 'universitySearchResults'
    ));
}
add_action('rest_api_init', 'university_register_search');

function universitySearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
        'campuses' => array()
    );

    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();

        $args = array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink()
        );

        if (get_post_type() == 'post' or get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }

        if (get_post_type() == 'professor') {
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'thumbnail' => get_the_post_thumbnail_url(0, 'professorLandscape')
            ));
        }

        if (get_post_type() == 'program') {
            array_push($results['programs'], $args);
        }

        if (get_post_type() == 'campus') {
            array_push($results['campuses'], $args);
        }

        if (get_post_type() == 'event') {
            $evDate = strtotime(get_field('date_event'));
            has_excerpt() ? $evDesc = get_the_excerpt() : $evDesc = wp_trim_words(get_the_content(), 7);

            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => date_i18n("M", $evDate),
                'day' => date_i18n("d", $evDate),
                'description' => $evDesc
            ));
        }
    }

    return $results;
}
