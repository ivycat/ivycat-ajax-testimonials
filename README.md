=== IvyCat AJAX Testimonials ===
Contributors: ivycat, dgilfoy, sewmyheadon, bradyvercher
Donate link: http://www.ivycat.com/contribute/
Tags: testimonial, testimonials, commendation, recommendation, widget, custom post type, shortcode, ajax
Requires at least: 3.0
Tested up to: 3.4
Stable tag: trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple plugin for adding dynamic testimonials to your site.

==Description==

This plugin is a light template/framework aimed primarily at developers that allows you to easily add rotating testimonials to a page.  Testimonials are a custom post type.

You can add testimonials to a page using a shortcode, widget, or PHP function.

Supports one rotating Testimonial slot per page.  Loads up the first Testimonial directly from the database and pulls in the rest of them via AJAX, speeding up initial page load.  

Also contains testimonial categories, or groups, so you can call in testimonials based on their category.

== Notes ==

Plugin has no native styles; it's meant to use the styles of your existing theme.

This is a minimal plugin, placing function over form.  If you would like to extend it, or would like us to extend it in later versions, feel free to [contact us](http://www.iyvcat.com/contact/), or post feedback in [this plugin's support forum](http://wordpress.org/support/plugin/ivycat-ajax-testimonials).

== Installation ==

You can install from within WordPress using the Plugin/Add New feature, or if you wish to manually install:

1. Download the plugin
2. Upload the entire `ivycat_testimonials` directory to your plugins folder 
3. Click Activate Plugin in your WordPress plugin page.
4. Visit the Testimonials menu item in the sidebar to enter testimonials.

== Usage ==

To actually pull testimonials into your site, you can use:

1. widgets
1. shortcodes
1. PHP functions

#### Use a widget:

In your WordPress Dashboard, go to Appearance/Widgets and use the IvyCat Testimonial Widget.

#### Using shortcodes:

* `[ic_do_testimonials]` - Adds a testimonial, Defaults to three testimonials.
* `[ic_do_testimonials group='my-created-group']` - Adds testimonials from a custom group.  Defaults to three testimonials.
* `[ic_do_testimonials quantity='5']` - changes default quantity to 5. 

#### Using PHP functions:

If you'd like to embed your testimonials into a template file rather than a widget or editor, you can use shortcodes within a PHP function like so:

`<?php echo do_shortcode("[ic_do_testimonials]"); ?>`

== Screenshots ==

1. The plugin in action.
2. The admin screens.

== Frequently Asked Questions ==

= What is the point of this plugin? =

We wanted a testimonials plugin that was lightweight and easy to fit within any theme.  

Some similar plugins load all the Testimonials at once, hiding the others and using JavaScript to switch which testimonial is visible or doesn't load at all if JavaScript is disabled.  

This plugin loads a single testimonial and, once the page is loaded, retrieves the rest of the testimonials via AJAX request.  It receives them in JSON format and the individual elements are switched rather than any hiding/showing going on. 

If the user doesn't have JavaScript enabled, it simply shows the testimonial that loaded with the page.

= This plugin looks so plain, where's my style switcher? =

This plugin is currently geared more for developers or designers.  

It doesn't take much to use, but it does require you to do your own styling.  Eventually, we may incorporate templating (so you can alter the markup without fear of future versions overwriting them). 

= What if I don't know CSS? =

We can certainly work with you, and later versions of this plugin might support automatic features and other tweaks. 

= Why haven't you added feature x? =

We built this plugin to scratch our own itch and, while we plan to add more features, we thought it helpful to release to the community right away.

Please feel free to fork it, incorporate it into a theme; have at it.  

If you make changes to the core code, we recommend renaming, so future versions don't overwrite your code.

If you have suggestions for features that could help everyone, please feel free to post in in [this plugin's support forum](http://wordpress.org/support/plugin/ivycat-ajax-testimonials).

== Changelog ==

= 1.2.1 =
* *New Feature:* Pause testimonial rotation on mouse hover.
* Cleaned up debug notices.
* Limited the javascript to the pages that it's needed on.
* Added taxonomy labels.
* Add testimonial post update messages.
* Escaped data for security.
* Added a nonce for security and to verify intention when saving data.
* Wrapped all strings in the proper i18n functions for translation.
* Updated the widget to allow changing the title.

= 1.2 =
* Fixed loading error bug for non-logged in users.
* Fixed slow loading of testimonials without a group.

= 1.11 =
* Bug fixes - minor PHP errors.
* Updated documentation.

= 1.1 =
* Initial commit

== Upgrade Notice ==

= 1.2.1 =
Important security and feature updates; please upgrade.

= 1.2 =
Added new  serious loading error bug for non-logged in users.

= 1.2 =
Fixed serious loading error bug for non-logged in users.

= 1.11 =

Upgrade fixes a few minor PHP issues and improves basic documentation.

== Road Map ==

1. Suggest a feature in [this plugin's support forum](http://wordpress.org/support/plugin/ivycat-ajax-testimonials).