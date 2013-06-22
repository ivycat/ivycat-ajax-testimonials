<!-- 

NOTE:	If you'd like to make changes to this file, copy it to your current theme's main
	directory so your changes won't be overwritten when the plugin is upgraded. 

	You can also rename this template, place it in your theme folder and point to
	it using the shortcode argument: template='my-custom-template.php'.
-->

<!-- Start of Testimonial Wrap -->
<div class="ivycat-testimonial testimonial-wrap post hentry ">

	<!-- This is the output of the testimonial excerpt -->
	<blockquote class="testimonial-content content entry-content">
		<?php the_excerpt(); ?>
	</blockquote>

	<!-- This is the output of the testimonial author -->
	<footer class="testimonial-source">
		<cite><?php the_title(); ?></cite>
	</footer>

</div>
<!-- // End of Testimonial Wrap -->
