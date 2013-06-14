=== IvyCat AJAX Testimonials ===
Contributors: ivycat, sewmyheadon, gehidore, dgilfoy
Donate link: http://www.ivycat.com/contribute/
Tags: testimonial, recommendation, reference, referral, testimony, ajax, widget
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add rotating or static testimonials to your website.  Testimonials can be categorized and rotated dynamically via AJAX or on page load.

== Description ==

IvyCat AJAX Testimonials adds a _Testimonials_ menu item to the WordPress Dashboard navigation.

Testimonials can be entered as easily as a normal post and can be grouped or categorized, so you can _pull_ testimonials into different areas of a site based on group, if needed.

You can embed testimonials via an easy shortcode, or by using a widget.

You can also list multiple testimonials out in a post or page.

= Features =

* Uses a *Testimonials* custom post type, making it easy for you, or your customers, to add new testimonials and testimonial groups.
* Use simple shortcodes to add testimonials to a page or post.
* Create multiple testimonial groups for categorization.
* Supports showing one testimonial per page by default, which can be rotated via AJAX, or on page refresh.
* List all testimonials using a shortcode.  This is great if you want to create a Testimonials page that displays all testimonials.
* The first testimonial shows when the page loads and the rest are pulled in via AJAX, speeding up initial page load.
* Supports images in testimonials.
* You set the testimonial order.

Plugin depends upon your theme's styles and _does not_ contain native styles.  

This is a minimal plugin, preferring function over form.  If you have ideas for feature requests, please post them in this [plugin's support forum](http://wordpress.org/extend/plugins/ivycat-ajax-testimonials/).

== Installation ==

You can install from within WordPress using the Plugin/Add New feature, or if you wish to manually install:

1. Download the plugin.
1. Upload the entire `ivycat-ajax-testimonials` directory to your plugins folder.
1. In the WordPress Dashboard under Plugins, activate the plugin.

= Overview =

*Here's the gist:* you add testimonials to the system, and create testimonial groups if you need to categorize them so you can 'pull' them into different areas of the site.  Then use simple shortcodes or a widget to embed a testimonial in a page or post.

= Create a Testimonial Group =

To create a testimonial group, go to Testimonials/Testimonial Groups and add a new group category.  Groups aren't mandatory, but can make it easier to segment your testimonials later.

For example, if you wanted to have a specific testimonial that is shown in the _Services_ pages of your site, you might create a group called _Services_ so you can easily identify them in the future and add them to your shortcodes.

= Add Testimonials =

Adding testimonials is easy:

1. *Go to Testimonials / New Testimonial* - this will allow you to enter the testimonial, cite (where it comes from), and embed images, if necessary.
1. *Give your testimonial a title*; this is the *cite*, so if the testimonial is from _Joe Blow_, you'd enter "Joe Blow".
1. *Enter the testimonial content* (text or HTML) in the main editor window, which is the body of the testimonial.  Note: images, html and text are okay here.
1. *Assign the testimonial to a group*, if applicable.  If you haven't already created a group, click on the _Add New Category_ link in the testimonial Groups box and add one.
1. *Give this testimonial an order* in its group.  If you want it to show first in your _Services_ testimonial, set _Order_ to 1 under _Testimonial Data_.

= Embed a testimonial in a page or post using shortcodes: =

There are several shortcode variations listed below, and the shortcodes can be combined to pull only the testimonials you need, displayed how you'd like them.

* `[ic_do_testimonials]` - Adds a testimonial, Defaults to three testimonials.
* `[ic_do_testimonials group='my-created-group']` - Adds testimonials from a custom group.  
* `[ic_do_testimonials quantity='5']` - changes default quantity of testimonials in rotation to 5. Defaults to 3 testimonials
* `[ic_do_testimonials num_words='55']` - Shows only the first x number of words.
* `[ic_do_testimonials num_words='55' more_tag='Read More...' ]` - When num_words is given, allows the text for the "read more" link to be changed
* `[ic_do_testimonials ajax_on='no']` - Adds the ability to turn off AJAX. When AJAX is disabled, a random testimonial will be shown on page load. (on by default)
* `[ic_do_testimonials link_testimonials='yes']` - Adds the a link within the `<cite>` that points to the individual testimonial. (off by default)
* `[ic_do_testimonials all_url='http://www.example.com/testimonials/']` - give a url to show all of the testimonials.  The page for this is not part of the plugin, so you'll want to add one.

= List testimonials on a page or post using a shortcode: = 

Want to display your testimonials in a _list_, instead of one at a time?  

* `[ic_do_testimonials display='list']` - Lists out testimonials, one after the other in a page or post.  Note: this shortcode honors the default quantity of 3 posts, but you can modify the number of testimonials that display in your list by using `quantity='x' ` in your shortcode.
* `[ic_do_testimonials display='list' quantity='-1']` - Lists out _all_ testimonials, one after the other in a page or post.

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

`[ic_do_testimonials group='licorice' quantity='5' num_words='30' more_tag='find out more . . .']` 



= Change the format of testimonial lists and keep changes after plugin updates =

Prefer to tweak the layout of the testimonial list output?  Great, you've got two choices:

1. If you're only showing testimonial lists in one place, or your testimonial lists always use the same styles, you can simply copy the `testimonials-loop-template.php` file to your theme's main directory and customize it any way you like. 
1. Specify a custom template file in your shortcode that points to a file in your theme directory like `[ic_do_testimonials template='my-custom-template.php']`  Note, it's probably best to start by copying the `testimonials-loop-template.php` file to your theme folder, rename, and edit as needed.

= Embed a testimonial directly in your theme template =

You can drop the following WordPress function in your template files, replacing the `[shortcode]` part with your, custom shortcode.

`<?php echo do_shortcode("[shortcode]"); ?>`

== Screenshots ==

1. A testimonial showing on a site.
2. A list of testimonials.
3. Add / edit testimonials.

== Frequently Asked Questions ==

= What is the point of this plugin? =

We wanted a lightweight testimonials plugin that loads quickly.  Some of the other plugins load all the testimonials at once, and use JavaScript to rotate through.  Some other plugins require JavaScript to work at all.

By default, this plugin loads a single testimonial on page load and, after the page is loaded, makes an AJAX request to retrieve the rest of them.  It receives them in JSON format and the individual elements are switched rather than any hiding/showing going on. 

= What if I don't know CSS? =

We can certainly work with you, and later versions of this plugin might support automatic features and other tweaks. The point of this is an easy to get to template.  Fork it, incorporate it into a theme, have at it.  If you make changes to the core code, we recommend renaming, so future versions don't overwrite your code.

= The testimonials on my site aren't matching my theme - how do I change your styles? =

We don't have any built-in styles, but it's not uncommon for things to look a bit awkward in some themes, depending on the theme's CSS.  We recommend using a tool like Firebug or Chrome's dev tools to identify what styles are used in your site and modify the output template or your stylesheet to fit.

= I have 25 testimonials in the system, so why are only 10 are showing per page? =

This plugin respects the _Blog pages show at most x posts_ setting in the WordPress Dashboard unders Settings/Reading.  

You can change this setting in WordPress, but that may affect all posts on your site; not just testimonials).  A better way to control number of testimonials shown in a list is to modify your shortcode to add `quantity='x'` like so: 

* `[ic_do_testimonials display='list' quantity='7']` - shows 7 posts per page
* `[ic_do_testimonials display='list' quantity='-1']` - shows all posts

== Changelog ==

= 1.4.0 =
* New Feature: List testimonials out in a post or page, instead of rotating one-by-one.  Great if you have a Testimonials page where you list all testimonials.
* Bug fixes for widget - formatting for before/after title & widget


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

= 1.4.0 = 
New features & bug fixes - please update.

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
