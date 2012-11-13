=== IvyCat Ajax Testimonials ===
Contributors: dgilfoy, ivycat
Tags: shortcode, ajax, testimonial, custom post type
Requires at least: 3.0
Tested up to: 3.4
Stable tag: 1.2.2

==Short Description ==

Simple Ajax loading Testimonial Plugin.

==Description==
This plugin is a light template/framework for developers to easily add rotating Testimonials to a page. Use a shortcode to add Testimonials to a page.  Supports one rotating Testimonial per page.  Loads up the first Testimonial and pulls in the rest of them via ajax, speeding up page load.  Incorporates a custom post type for the Testimonial.

== Notes ==

Plugin is dependent upon theme styling.  This version of this plugin does not contain native styles.  If you are curious as to the reasoning behind this, check out:  

http://nimbu.in/p/wordcampseattle/

This is a minimal plugin, function over form.  If you would like to extend it, or would like us to extend it in later versions, feel free to contact us at admins@ivycat.com.  We do custom plugins as well as upgrades and features for existing plugins.

== Installation ==

1. Upload the entire ivycat_testimonials directory to your plugins folder 
2. Click Install Plugin in your WordPress plugin page
3. ??? Profit ???

== Usage ==

Shortcode usage:
    *[ic_do_testimonials] - Adds a testimonial, Defaults to three testimonials.

    *[ic_do_testimonials group='my-created-group'] - Adds slides from a custom group.  Defaults to 3 testimonials

    *[ic_do_testimonials quantity='5'] - changes default quantity to 5.
	
	*[ic_do_testimonials num_words='55'] - Shows only the first x number of words, as defined by value given
	
	*[ic_do_testimonials num_words='55' read_more='[...]' ] - When num_words is given, allows the text for the "read more" link to be changed
	
	*[ic_do_testimonials ajax_on='no'] - Adds the ability to turn off Ajax. If ajax is disabled, a random testimonial will be shown on page load. (on by default)
	
	*[ic_do_testimonials all_url='http://www.example.com/testimonials/'] - give a url to show all of the testimonials.  The page for this is not part of the plugin.

== Screenshots ==


== Frequently Asked Questions ==

Q: What is the point of this plugin?.  
A: Well, we don't like the "heft and weight" of some of the other plugins out there.  Often they load all the Testimonials at once, hiding the others and using JS to switch which one is visible or doesn't load at all if JS is disabled.  This plugin is different.  It loads a single testimonial and once the page is loaded, makes an AJAX request to retrieve the rest of them.  It recieves them in JSON format and the individual elements are switched rather than any hiding/showing going on. 
Q: What?
A: Well, this plugin is more for developers or designers.  It doesn't take much to use, but it does require you to do your own styling and eventually we'll incorporate templating (so you can alter the markup without fear of future versions overwriting them). 
Q: What if I don't know CSS?
A: We can certainly work with you, and later versions of this plugin might support automatic features and other tweaks. The point of this is an easy to get to template.  Fork it, incorporate it into a theme, have at it.  If you make changes to the core code, I'd recommend renaming and whatnot, so future versions don't overwrite your code.


== Changelog ==

= 1.2.2 =
* Fixed errors in pulling testimonials via Ajax.
* Addes shortcode features in the sidebar widget

= 1.2 =
* Added new shortcode Features

== Upgrade Notice ==

Latest versions mean latest security, latest features and the best time!

== Road Map ==

1. Suggest a feature...


