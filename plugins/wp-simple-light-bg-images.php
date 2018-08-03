<?php

/*
Plugin Name: Simple Light BG Images
Description: Creates a filter that lets you drop a background image on an HTML element like a class, and takes care of the work of displaying smaller versions first.
Version: 1.0
Author: Joseph Odom
*/

// == HOOKS ==

// Define the filter for adding the class to elements
add_filter('simple-bg','joFilterLightBgImage');

// Add the hook for defining the classes at the end of the page
add_action('wp_footer','joLightBgImageClasses');





// == DEFINE THE ARRAY OF CLASSES ==

$joClassesArray=[];





// == HOOK FUNCTIONS ==

function joFilterLightBgImage($get){
	// == GET CLASS NAME ==
	
	// We sanitize the title in the classname just in case, even though it should probably be sanitized already
	$className=sanitize_title($get);
	
	// The full class name is separate because it's not super efficient to have every index in the $joClassesArray start with the same prefix
	$classNameFull='jo-image-' . $className;
	
	// If this one has already been used before, just return the class name. It's already been logged so the page will load it
	if(!empty($GLOBALS['joClassesArray'][$className])){
		return $classNameFull;
	}
	
	
	
	
	
	// == GET THE ATTACHMENT POST ==
	
	// These parameters will stay the same regardless of the information entered into the filter
	$vars=[
		'post_type'=>'attachment',
		'posts_per_page'=>1
	];
	
	// If the filter information is numeric, assume it's an ID
	if(is_numeric($get)){
		$vars['post__in']=[$get];
	// Otherwise, assume it's the post name
	}else{
		$vars['name']=$get;
	}
	
	// Run the query with those parameters
	$attachment=get_posts($vars);
	
	// If the attachment doesn't exist (or somehow isn't an array), just return empty. You'll notice a problem when there isn't an image there!
	if(empty($attachment) || !is_array($attachment)){
		return;
	}
	
	// Since get_posts returns an array, let's just grab the first item out of the array
	// There should never be an issue here since we're limiting the results to one post
	$attachment=array_shift($attachment);
	
	
	
	
	
	// == GET THE ATTACHMENT URLS ==
	
	// $bigUrl is for the full size version of the image
	// $smallUrl is for the one that displays while the full size image is loading
	
	$bigUrl=wp_get_attachment_image_url($attachment->ID,'full');
	$smallUrl=wp_get_attachment_image_url($attachment->ID,'medium');
	
	/**
	 * Note: I was going to error-check these URLs and quit on failure, but decided against it. Here's why:
	 * wp_get_attachment_image_url returns false on failure to get an image. So if it fails, no image is shown.
	 * If I were to quit because it returned false, I would do essentially the same thing: just not show any image.
	 * But if I quit here, I would just be quitting right before I log the class, having no memory of ever checking for this image before.
	 * And so if this image is on the page multiple times, it'll query for the same attachment multiple times needlessly.
	 * "Why not just log the class as you quit?" Because the only thing left to do now is log the class lol.
	 * It's a small optimization, but an optimization nonetheless.
	 */
	
	
	
	
	
	// == LOG THE CLASS ==
	
	$GLOBALS['joClassesArray'][$className]=[
		'small'=>$smallUrl,
		'big'=>$bigUrl
	];
	
	
	
	
	
	// == RETURN THE CLASS ==
	
	return $classNameFull;
}



function joLightBgImageClasses(){
?>
<style type="text/css">
[class*="jo-image-"] {
	position: relative;
}

[class*="jo-image-"]::before {
	content: "";
	height: 100%;
	position: absolute;
	right: 0;
	top: 0;
	width: 100%;
}

[class*="jo-image-"] > * {
	position: relative;
	z-index: 1;
}

<?php foreach($GLOBALS['joClassesArray'] as $class=>$list): ?>
.jo-image-<?=$class?> {
	background-image: url('<?=$list['small']?>');
}
.jo-image-<?=$class?>::before {
	background: inherit;
	background-image: url('<?=$list['big']?>');
}
<?php endforeach; ?>
</style>
<?php
}

?>