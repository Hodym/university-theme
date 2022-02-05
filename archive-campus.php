<?php
get_header();
pageBanner(array(
    'title' => 'Our Campuses',
    'subtitle' => 'Campuses animi facilis iste id alias eum, ullam amet modi doloribus provident!'
));
?>

<div class="container container--narrow page-section">

    <div class="acf-map" data-zoom="14">

        <?php
        while (have_posts()) {
            the_post();
            $uniMapLocation = get_field('map_location');
        ?>

            <div class="marker" data-lat="<?php echo esc_attr($uniMapLocation['lat']); ?>" data-lng="<?php echo esc_attr($uniMapLocation['lng']); ?>">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php echo esc_attr($uniMapLocation['address']); ?>
            </div>

        <?php } ?>

    </div>

</div>

<?php get_footer();

?>