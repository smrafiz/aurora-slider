<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  AuroraPlugin
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Clear Database stored data
$slides = get_posts(
	[
		'post_type' => 'aurora_slider',
		'posts_per_page' => -1,
		'post_status' => 'any'
	]
);

foreach( $slides as $slide ) {
	wp_delete_post( $slide->ID, true );
}
