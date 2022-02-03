<?php
get_header();
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events.'
));
?>

<div class="container container--narrow page-section">
  <?php

  $today = date_i18n('Y-m-d H:i:s');
  $uniPastEvents = new WP_Query(array(
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'meta_key'  => 'date_event',
    'orderby'   => 'meta_value',
    'order'     => 'DESC',
    'meta_query' => array(
      array(
        'key'     => 'date_event',
        'compare' => '<',
        'value'   => $today,
        'type' => 'datetime'
      )
    )
  ));

  while ($uniPastEvents->have_posts()) {
    $uniPastEvents->the_post();

    get_template_part('template-parts/content', 'event');
  }
  echo paginate_links(array(
    'total' => $uniPastEvents->max_num_pages
  ));
  ?>

</div>

<?php get_footer(); ?>