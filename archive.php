<?php get_header(); ?>

<div class="page-banner">
	<div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
	<div class="page-banner__content container container--narrow">
		<?php the_archive_title('<h1 class="page-banner__title">', '</h1>'); ?>
		<?php the_archive_description('<div class="page-banner__intro"><p>', '</p></div>'); ?>
	</div>
</div>

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
