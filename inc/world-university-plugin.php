<?php
/*
Plugin Name: World University Plugin
Description: This plugin change ...
*/

add_filter('the_content', 'amazingContentEdits');

function amazingContentEdits($content)
{
    $content = $content . '<p>All content belongs to World University</p>';
    $content = str_replace('Lorem', '*****', $content);
    return $content;
}

add_shortcode('programCount', 'programCountFunction');

function programCountFunction()
{
    $count_posts = wp_count_posts( 'program' )->publish;
    return $count_posts;
}
