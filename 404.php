<?php

get_header();
pageBanner(array(
  'title' => 'Oops! That page can&rsquo;t be found.',
  'subtitle' => 'It looks like nothing was found at this location. Maybe try one of the links below or a search?'
));
?>

	<div class="container container--narrow page-section">

			<div class="page-content">

					<?php
					get_search_form();

					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'world-university' ); ?></h2>
						<ul>
							<?php
							wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
							?>
						</ul>
					</div><!-- .widget -->

					<?php
					/* translators: %1$s: smiley */
					$world_university_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'world-university' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$world_university_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

			</div><!-- .page-content -->

	</div>

<?php
get_footer();
