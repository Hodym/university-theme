<?php

function world_university_adjust_queries($query){

  // Program Query page
  if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  // Event Query page
  if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
    $today = date_i18n('Y-m-d H:i:s');
    $query->set('posts_per_page', '5');
    $query->set('meta_key', 'date_event');
    $query->set('orderby', 'meta_value');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'date_event',
        'compare' => '>=',
        'value' => $today,
        'type' => 'datetime'
      )
    ));
  }

  // Campus Query page
  if (!is_admin() and is_post_type_archive('campus') and $query->is_main_query()) {
    $query->set('posts_per_page', -1);
  }

}

add_action('pre_get_posts', 'world_university_adjust_queries');
