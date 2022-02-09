<?php

get_header();

while (have_posts()) {
  the_post();
  pageBanner();
  ?>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i>All Programs</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>

    <div class="generic-content"><?php the_field('main_body_content'); ?></div>

    <?php

    $uniProfessorPost = new WP_Query(array(
      'posts_per_page' => -1,
      'post_type' => 'professor',
      'orderby'   => 'title',
      'order'     => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
        )
      )

    ));

    if ($uniProfessorPost->have_posts()) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';

      echo '<ul class="professor-cards">';
      while ($uniProfessorPost->have_posts()) {
        $uniProfessorPost->the_post(); ?>

        <li class="professor-card__list-item">
          <a class="professor-card" href="<?php the_permalink(); ?>">
            <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
            <span class="professor-card__name"><?php the_title(); ?></span>
          </a>
        </li>

      <?php }
      echo '</ul>';
    }
    
    wp_reset_postdata();

    $today = date_i18n('Y-m-d H:i:s');
    $uniEventPost = new WP_Query(array(
      'posts_per_page' => 2,
      'post_type' => 'event',
      'meta_key'  => 'date_event',
      'orderby'   => 'meta_value',
      'order'     => 'ASC',
      'meta_query' => array(
        array(
          'key'     => 'date_event',
          'compare' => '>',
          'value'   => $today,
          'type' => 'datetime'
        ),
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
        )
      )

    ));

    if ($uniEventPost->have_posts()) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';

      while ($uniEventPost->have_posts()) {
        $uniEventPost->the_post();
        
        get_template_part('template-parts/content', 'event');

      }
    }
    wp_reset_postdata();

    $uniRelatedCampuses = get_field('related_campus');

    if ($uniRelatedCampuses) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">' . get_the_title() . ' is Available At These Campuses:</h2>';

      echo '<ul class="min-list link-list">';
      foreach($uniRelatedCampuses as $campus) {
        ?> <li><a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus) ?></a></li> <?php
      }
      echo '</ul>';

    }
    ?>

  </div>

<?php }

get_footer();

?>