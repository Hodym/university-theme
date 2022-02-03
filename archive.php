<?php
	get_header();
	pageBanner(array(
		'title' => get_the_archive_title(),
		'subtitle' => get_the_archive_description()
	));
?>

<?php if (have_posts()) :

	while (have_posts()) :
		the_post();

		/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
		get_template_part('template-parts/content', get_post_type());

	endwhile; ?>

	<div class="container container--narrow page-section">
		<?php echo paginate_links(); ?>
	</div>

<?php else :

	get_template_part('template-parts/content', 'none');

endif; ?>

<?php get_footer();
