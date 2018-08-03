<?php

/**
 * Set up our actions here
 */

add_action('wp_enqueue_scripts','enqueueScripts');





/**
 * Define our hook functions here
 */

function enqueueScripts(){
	wp_enqueue_style(
		'test-css',
		get_stylesheet_uri()
	);
}

?>