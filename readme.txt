=== IvyCat AJAX Testimonials ===
Contributors: dgilfoy, ivycat, sewmyheadon
Donate link: http://www.ivycat.com/contribute/
Tags: testimonial, recommendation, reference, referral, testimony, ajax, widget
Requires at least: 3.0
Tested up to: 3.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add rotating testimonials to your website.  Testimonials can be categorized and rotated dynamically via AJAX or on page load.

== Description ==

This plugin is a light template/framework for developers to easily add rotating testimonials to a site. 

= Features =

* Use simple shortcodes to add a testimonial to a page.
* Create multiple testimonial groups.
* Supports one testimonial per page.
* The first testimonial loads when the page loads and the rest are pulled in via AJAX, speeding up initial page load.
* Uses a *Testimonials* custom post type, making it easy for you, or your customers, to add new testimonials and testimonial groups.
* Testimonials can contain images too.
* You set the testimonial order.

Plugin depends upon your theme's style and _does not_ contain native styles.  

This is a minimal plugin, preferring function over form.  If you would like to extend it, or would like us to extend it in later versions, feel free to post ideas in this [plugin's support forum](http://wordpress.org/extend/plugins/ivycat-ajax-testimonials/), or [contact us](http://www.ivycat.com/contact/).

== Installation ==

You can install from within WordPress using the Plugin/Add New feature, or if you wish to manually install:

1. Download the plugin.
1. Upload the entire `ivycat-ajax-testimonials` directory to your plugins folder.
1. Click Activate Plugin in your WordPress plugin page.

= Overview =

*Here's the gist:* you add testimonials to the system, and create testimonial groups if you need to categorize them so you can 'pull' them into different areas of the site.  Then use simple shortcodes to embed a testimonial in a page or post.

= Create a Testimonial Group =

To create a testimonial group, go to Testimonials/Testimonial Groups and add a new group category.  Groups aren't mandatory, but can make it easier to segment your testimonials later.

For example, if you wanted to have a specific testimonial that is shown in the _Services_ pages of your site, you might create a group called _Services_ so you can easily identify them in the future and add them to your shortcodes.

= Add Testimonials =

Adding testimonials is easy:

1. Go to Testimonials / New Testimonial - this will allow you to enter the testimonial, cite (where it comes from), and embed images, if necessary.
1. Give your testimonial a title; this is the *cite*, so if the testimonial is from _Joe Blow_, you'd enter "Joe Blow".
1. Enter the testimonial content (text or HTML) in the main editor window, which is the body of the testimonial.  Note: images, html and text are okay here.
1. Assign the testimonial to a group, if applicable.  If you haven't already created a group, click on the _Add New Category_ link in the testimonial Groups box and add one.
1. Give this testimonial an order in its group.  If you want it to show first in your _Services_ testimonial, set _Order_ to 1 under _Testimonial Data_.

= Embed a testimonial in a page or post using shortcodes: =

There are several shortcode variations listed below, and the shortcodes can be combined to pull only the testimonials you need, displayed how you'd like them.

* `[ic_do_testimonials]` - Adds a testimonial, Defaults to three testimonials.
* `[ic_do_testimonials group='my-created-group']` - Adds testimonials from a custom group.  Defaults to 3 testimonials
* `[ic_do_testimonials quantity='5']` - changes default quantity to 5.
* `[ic_do_testimonials num_words='55']` - Shows only the first x number of words, as defined by value given
* `[ic_do_testimonials num_words='55' read_more='[...]' ]` - When num_words is given, allows the text for the "read more" link to be changed
* `[ic_do_testimonials ajax_on='no']` - Adds the ability to turn off AJAX. If AJAX is disabled, a random testimonial will be shown on page load. (on by default)
* `[ic_do_testimonials link_testimonials=true]` - Adds the ability to link to individual testimonials. (off by default)
* `[ic_do_testimonials all_url='http://www.example.com/testimonials/']` - give a url to show all of the testimonials.  The page for this is not part of the plugin, so you'll want to add one.

= Changing timing on AJAX rotation: =

**Note:** All timing speeds below are listed in _milliseconds_.  

1000 milliseconds = 1 second
100 milliseconds = 1/10th of a second

* `[ic_do_testimonials speed='6000']` - change how long each slide is shown.
* `[ic_do_testimonials fadeIn='600']` - change timing for each slide to fade in.
* `[ic_do_testimonials fadeOut='700']` - change timing for each slide to fade out.

= Shortcode Examples =

If you wanted to pull in a total of three testimonials from the 'wordpress' category, but you don't want AJAX rotation, your shortcode might look like:

`[ic_do_testimonials group='wordpress' ajax_on='no']` 

Note: I didn't specify 3 testimonials because that's the default number, but I could have:

`[ic_do_testimonials group='wordpress' ajax_on='no' quantity='3']` 

Or, say you wanted to dynamically rotate between five testimonials in the group called 'licorice', but you only want to show the first 30 words, followed by a link that says "find out more . . ." your shortcode would look like this:

`[ic_do_testimonials group='licorice' quantity='5' num_words='30' read_more='find out more . . .']` 

= Embed a testimonial directly in your theme template =

You can drop the following WordPress function in your template files, replacing the `[shortcode]` part with your, custom shortcode.

`<?php echo do_shortcode("[shortcode]"); ?>`

== Screenshots ==

1. A testimonial showing on a site.
2. A list of testimonials.
3. Add / edit testimonials.

== Frequently Asked Questions ==

= What is the point of this plugin? =

We wanted a lighter weight testimonials plugin, that loads quickly.  Some of the other plugins load all the Testimonials at once, and use JavaScript to rotate through.  Some don't load at all if JavaScript is disabled.  

This plugin loads a single testimonial on page load and, once the page is loaded, makes an AJAX request to retrieve the rest of them.  It receives them in JSON format and the individual elements are switched rather than any hiding/showing going on. 

= What if I don't know CSS? =

We can certainly work with you, and later versions of this plugin might support automatic features and other tweaks. The point of this is an easy to get to template.  Fork it, incorporate it into a theme, have at it.  If you make changes to the core code, we recommend renaming, so future versions don't overwrite your code.


== Changelog ==

= 1.3.5 =
* Fixed a few embarrasing misspellings.

= 1.3.4 =
* Fixed a bug that could cause conflicts with the IvyCat AJAX Image Slider

= 1.3.3 =
* Fixed a couple notices in JS
* Fixed Testimonials Title issue with Widget
* Set link to individual testimonial off by default, with ability to turn it on in widget or shortcode

= 1.3.1 =
* Fixed minor bug having to do with output of testimonials that caused an output conflict with [Artiss Readme Parser](http://wordpress.org/extend/plugins/wp-readme-parser/).
* Switched from using output buffering to string concatenation.

= 1.3.0 =
* Added timing controls to widget
* Several bug fixes, mostly with widget presentation
* Updated widget styles
* Code cleanup

= 1.2.3 =
* Fixed bugs.
* Updated documentation.

= 1.2.2 =
* Fixed errors in pulling testimonials via AJAX.
* Adds shortcode features in the sidebar widget

= 1.2 =
* Added new shortcode Features

== Upgrade Notice ==

= 1.3.5 =
Minor update - cosmetic only.

= 1.3.4 =
Bug fixes and new features: please upgrade.

= 1.3.0 =
Bug fixes and new features: please upgrade.

= 1.2.3 =
Bug fixes: recommended upgrade.

Latest versions mean latest security, latest features and the best time!

== Road Map ==

1. Suggest a feature...
2. Contribute on [GitHub](https://github.com/ivycat/IvyCat-Ajax-Testimonials)