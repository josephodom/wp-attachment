<?php

/*
Plugin Name: Simple Light BG Images
Description: Creates a filter that lets you drop a background image on an HTML element like a class, and takes care of the work of displaying smaller versions first.
Version: 1.0
Author: Joseph Odom
*/

// filter

add_filter('simple-bg','joFilterLightBgImage');





// function

function joFilterLightBgImage(){
	return 'something else';
}

?>