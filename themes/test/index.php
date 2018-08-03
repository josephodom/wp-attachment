<?php
get_header();
?>





<section class="hero background parallax <?=apply_filters('simple-bg','nature-and-creek-scenery-in-great-smoky-mountains-national-park-tennessee')?>">
	<div class="container">
		<div class="card">
			<h1>
				What does it do?
			</h1>
			
			<p>
				It lets you tell your code what image you want with one function,
				and it does a few things behind the scenes for you to make your
				image load fast, then pretty.
			</p>
		</div>
	</div>
</section>





<section>
	<div class="container">
		<h1>
			How does it work?
		</h1>
		
		<p>
			<strong>First,</strong>
			upload your desired image to the media library.
		</p>
		
		<p>
			<img src="<?=wp_get_attachment_image_url(8, 'full')?>" alt="Screenshot of an image in the media library">
		</p>
		
		<p>
			<strong>Then,</strong>
			just add this bit of code to the desired element's class list, and you're done!
		</p>
		
		<p>
			<code><pre><?=htmlentities("<?=apply_filters('simple-bg','text from the attachment's Title field')?>")?></pre></code>
		</p>
	</div>
</section>





<section class="hero background parallax <?=apply_filters('simple-bg','steps-on-the-appalachian-trail-leading-to-clingmans-dome-in-great-smoky-mountains-national-park-tennessee')?>">
	<div class="container">
		<div class="card">
			<h1>
				What is it doing behind the scenes?
			</h1>
			
			<p>
				It gets the attachment associated with that title, and grabs its full size version and its medium size version.
				WordPress automatically creates multiple sizes of each image you upload; we're just simplifying that functionality.
			</p>
			
			<p>
				Then, it creates a CSS class for each image and tells it to load the small one as the main background image, and the big
				one as a secondary background image. The CSS is printed at the bottom of the page; it utilizes the <code>wp_footer</code> hook.
			</p>
		</div>
	</div>
</section>





<section>
	<div class="container">
		<h1>
			How does it load two background images?
		</h1>
		
		<p>
			The first, smaller image is loaded by simply defining the element's <code>background-image</code>.
			The second, however, is a little more complicated. It uses the <code>::before</code> pseudoelement
			to load in another background image on top of the first one.
		</p>
		
		<p>
			It inherits everything except the <code>background-image</code> rule from the main element, so they
			should always line up perfectly. It gives the main element a <code>position: relative</code> rule
			so that the pseudoelement can have <code>position: absolute</code> and be positioned relative to it.
			It has a <code>100%</code> width and height.
		</p>
		
		<p>
			Lastly, any direct children of the main element have been given <code>position: relative</code> and
			<code>z-index: 1</code> to make sure they're on top of the larger background image.
		</p>
	</div>
</section>





<?php
get_footer();
?>