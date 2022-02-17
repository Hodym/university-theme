<?php

/**
 * pageSlider()
 * 
 * Display slider.
 *
 * @type    function
 * 
 * @param int $postsPer Optional.The number of slides in the slider. Default null.
 *
 */

function pageSlider($postsPer = null) {

    if ($postsPer) {

        $uniSliderPost = new WP_Query(array(
            'post_type' => 'slider',
            'posts_per_page' => $postsPer
        )); ?>

        <div class="hero-slider">
            <?php
            while ($uniSliderPost->have_posts()) {
                $uniSliderPost->the_post(); ?>

                <div class="hero-slider__slide" style="background-image: url(<?php the_field('slider_image'); ?>);">
                    <div class="hero-slider__interior container">
                        <div class="hero-slider__overlay">
                            <h2 class="headline headline--medium t-center"><?php the_title(); ?></h2>
                            <p class="t-center"><?php the_field('slider_subtitle') ?></p>
                            <p class="t-center no-margin"><a href="<?php the_field('link_button') ?>" class="btn btn--blue"><?php the_field('button_text') ?></a></p>
                        </div>
                    </div>
                </div>

            <?php
            }
            wp_reset_postdata();
            ?>
        </div>

    <?php
    } else {
        return false;
    }
}
?>
