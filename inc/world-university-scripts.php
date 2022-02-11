<?php

function world_university_scripts() {
	wp_enqueue_style( 'world-university-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'world-university-style', 'rtl', 'replace' );

	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');


	wp_enqueue_script('main-university-js', get_template_directory_uri() .'/js/scripts-bundled.js', NULL, _S_VERSION, true);
	wp_enqueue_script( 'world-university-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'googleMap', 'https://maps.googleapis.com/maps/api/js', NULL, _S_VERSION, true );
	
	wp_localize_script('main-university-js', 'universityData', array(
		'root_url' => get_site_url(),
		'nonce' => wp_create_nonce('wp_rest')
	));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'world_university_scripts' );