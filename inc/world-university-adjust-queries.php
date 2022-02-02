<?php

function world_university_adjust_queries($query)
{
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
}

add_action('pre_get_posts', 'world_university_adjust_queries');
