=== IvyCat AJAX Testimonials ===
Contributors: ivycat, sewmyheadon, jasonm4563, gehidore, dgilfoy, 
Tags: testimonial, recommendation, reference, referral, testimony, ajax, widget
Requires at least: 3.0
Tested up to: 4.2.2
Stable tag: 1.5.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add rotating or static testimonials to your website.  Testimonials can be categorized and rotated dynamically via AJAX or on page load.

== Description ==

IvyCat AJAX Testimonials adds a _Testimonials_ menu item to the WordPress Dashboard navigation.

You can enter Testimonials as easily as entering normal posts and you can even categorize testimonials so you can _pull_ testimonials into different areas of a site based on their group, if needed.

You can embed testimonials in your site using:

1. Easy shortcodes in the WordPress editor,
1. The built-in Testimonials widget, or
1. A PHP snippet that wraps a shortcode.

You can also list multiple testimonials out in a post or page using a shortcode or PHP.  

*Note*: the IvyCat Testimonials Widget does not support listing multiple testimonials yet, although you can embed testimonial lists using shortcodes.

= Features =

* Creates a *Testimonials* custom post type, so you, or your customers, can easily add new testimonials and testimonial groups.
* Use simple shortcodes to add testimonials to a page, post, or custom post type.
* Create multiple testimonial groups for categorization.
* Displays one testimonial at a time by default, which can be rotated via AJAX, or only on page refresh.
* The first testimonial displays as soon as the page loads and the rest are pulled in via AJAX, speeding up initial page load.
* Add images to testimonials.
* You set the testimonial order.
* Customize the plugin
* List all testimonials using a shortcode.  Great for creating a Testimonials page that displays all testimonials, or a list of testimonials from a specific group.
* Customize the output template for the testimonial list to suit your needs.

**Note:** Plugin depends upon your theme's styles and _does not_ contain native styles.  You may have to tweak the plugin output template, or your own CSS to make your tesimonial styles consistent with the rest of your site.

== Installation ==

You can install from within WordPress using the Plugin/Add New feature, or if you wish to manually install:

1. Download the plugin.
1. Upload the entire `ivycat-ajax-testimonials` directory to your plugins folder.
1. In the WordPress Dashboard under Plugins, activate the plugin.

= Overview =

*Here's the gist:* you add testimonials to WordPress, and assign them to testimonial groups, if necessary, so you can _pull_ testimonials into different areas of the site.  Then use simple shortcodes or a widget to embed a testimonial in a page or post.

= Create a Testimonial Group =

To create a testimonial group, go to *Admin > Testimonials > Testimonial Groups* and add a new group.  Groups aren't mandatory, but can make it easier to segment your testimonials later.

For example, if you wanted to have a specific testimonial that is shown in the _Services_ pages of your site, you might create a group called _Services_ so you can easily identify them in the future and add them to your shortcodes.

= Add Testimonials =

Adding testimonials is easy:

1. *Go to Testimonials > New Testimonial* - this will allow you to enter the testimonial, cite (where it comes from), and embed images, if necessary.
1. *Give your testimonial a title*; this is the *cite*, so if the testimonial is from _Joe Blow_, you'd enter "Joe Blow".
1. *Enter the testimonial content* (text or HTML) in the main editor window, which is the body of the testimonial.  Note: images, html and text are okay here.
1. *Assign the testimonial to a group*, if applicable.  If you haven't already created a group, click on the _Add New Category_ link in the testimonial Groups box and add one.
1. *Give this testimonial an order* in its group.  If you want it to show first in your _Services_ testimonial, set _Order_ to 1 under _Testimonial Data_.

= Embed a testimonial in a page or post using shortcodes: =

There are several shortcode variations listed below, and the shortcodes can be combined to pull only the testimonials you need, displayed how you'd like them.

* `[ic_do_testimonials]` - Adds a rotating testimonial (defaults to three testimonials in ID order).
* `[ic_do_testimonials group='my-created-group']` - Adds testimonials from a custom group using the group's slug, in this case `my-created-group`.  
* `[ic_do_testimonials quantity='5']` - changes default quantity of testimonials in rotation to 5. Defaults to 3 testimonials.
* `[ic_do_testimonials num_words='X']` - Shows only the first _X_ number of words.
* `[ic_do_testimonials num_words='55' more_tag='Read More...' ]` - When `num_words` is specified, the `more_tag` lets you specify the text for the "read more" link.
* `[ic_do_testimonials ajax_on='no']` - Turns off automatic AJAX rotation, so a random testimonial will be shown on page load. (AJAX is _on_ by default)
* `[ic_do_testimonials link_testimonials='yes']` - Adds the a link within the `<cite>` tag that points to the individual testimonial. **Note:** Pretty permalinks must be set to allow testimonial linking.  If you're using the default (ugly) permalinks, which include a query string, linking won't work. Not sure?  If your links look like `http://my-amazeballs-domain.com/?p=123` you're _not_ using Pretty Permalinks. (off by default)
* `[ic_do_testimonials all_url='http://www.example.com/testimonials/']` - specify a link to a page that lists all testimonials.  The plugin doesn't create this page, so you'll want to add a page and embed the list of testimonials using the example below.

= Changing timing on Testimonial rotation: =

**Note:** All timing speeds below are listed in _milliseconds_.  

1000 milliseconds = 1 second
100 milliseconds = 1/10th of a second

* `[ic_do_testimonials speed='6000']` - change how long each slide is shown.
* `[ic_do_testimonials fade_in='600']` - change timing for each slide to fade in.
* `[ic_do_testimonials fade_out='700']` - change timing for each slide to fade out.

= Display testimonials in a list, rather than one at a time. = 

Want to display your testimonials in a non-rotating _list_, instead of one at a time?  

* `[ic_do_testimonials display='list']` - Lists out testimonials, one after the other in a page or post.  **Note:** this shortcode honors the default quantity of posts set under *Admin > Settings > Reading*, but you can modify the number of displayed testimonials by using `quantity='x'` in your shortcode.
* `[ic_do_testimonials display='list' quantity='-1']` - Lists out _all_ testimonials, one after the other in a page or post.

= Customize testimonial list presentation =

**Want to tweak the layout of the testimonial list output?**  Great, you've got two choices and both will ensure that you don't lose your changes when you upgrade the plugin. *Note:* This does not work when using the widget.

1. **Copy the `testimonials-loop-template.php` file from the plugin's directory to your theme's main directory**  and you can customize it any way you like.  This works best if you're only showing testimonial lists in one place, or your testimonial lists always use the same styles. The plugin looks in your theme's directory for this file before using the file that comes with the plugin.
1. **Specify a custom template file** in your shortcode that points to a file in your theme directory like `[ic_do_testimonials template='my-custom-template.php']`  Note, it's best to start by copying the `testimonials-loop-template.php` file to your theme folder, rename, and edit as needed.

= Shortcode Examples =

If you wanted to pull in a total of three testimonials from the 'rubber-chicken' category, but you don't want AJAX rotation, your shortcode might look like:

`[ic_do_testimonials group='rubber-chicken' ajax_on='no']` 

Note: I didn't specify 3 testimonials because that's the default number, but I could have:

`[ic_do_testimonials group='rubber-chicken' ajax_on='no' quantity='3']` 

Or, say you wanted to dynamically rotate between five testimonials in the group called 'licorice', but you only want to show the first 30 words, followed by a link that says "find out more . . ." your shortcode would look like this:

`[ic_do_testimonials group='licorice' quantity='5' num_words='30' more_tag='find out more . . .']` 

= Embed a testimonial directly in your theme template =

You can drop the following WordPress function in your template files, replacing the `[shortcode]` part with your, custom shortcode.

`<?php echo do_shortcode("[shortcode]"); ?>`

== Screenshots ==

1. A testimonial showing on a site.
2. A list of testimonials.
3. Add / edit testimonials.

== Frequently Asked Questions ==

= Where are the instructions? =

Check the plugin's [Installation tab](http://wordpress.org/plugins/ivycat-ajax-testimonials/installation/).

In an upcoming version, we'll include a page within the WordPress Admin containing a shortcode cheat sheet.

= Why are the styles for the testimonials different than the other content on the page or widgets in my sidebar.  =

This plugin depends upon *your theme's* styles and _does not_ contain native styles.  

= The testimonials on my site aren't matching my theme - how do I change your styles? =

We don't have any built-in styles, so it's not uncommon for things to look a bit awkward in some themes, depending on the theme's CSS.  Usually, with some quick poking around, you can change markup, CSS or both so the testimonials will display exactly as you'd like. *Screencast coming soon . . .*

We recommend using a tool like [Firebug](https://getfirebug.com/) or Google [Chrome DevTools](https://developers.google.com/chrome-developer-tools/) to identify what styles are used in your site so you can modify the output template or your stylesheet to fit.

**Styling Testimonials Embedded Using Shortcodes?**

If you're using a shortcode to display testimonials in a list, rather than individually, you can customize the `testimonials-loop-template.php` file to suit your site.

**Styling Testimonials Embedded Using Widgets?** 

You may need to a tool like [Firebug](https://getfirebug.com/) or Google [Chrome DevTools](https://developers.google.com/chrome-developer-tools/) to inspect the markup and CSS in your theme and adjust as needed accordingly.

= What if I don't know CSS? =

You might be okay, but if you need style tweaks, you can either:

* Find a friend with some CSS chops that can help out. Or,
* Post your questions in this [plugin's support forum](http://wordpress.org/extend/plugins/ivycat-ajax-testimonials/) and we'll try to help out when we get time.

= Hey guys, why don't you add a feature that _________? =

This is a minimal plugin that prefers function over form.  When you have ideas for new features, please post them in this [plugin's support forum](http://wordpress.org/extend/plugins/ivycat-ajax-testimonials/) and we'll respond ASAP.

Since this plugin is released _at no charge_ and was originally created to scratch our own itch, we consider all feature requests closely to see if they will save _us_ time and money.  If so, we'll usually implement the feature as soon as it makes sense.

If you request a feature that we don't need, but think is really cool, we might add it to the roadmap.

If you've got an idea for a feature that we wouldn't use, we'll look at creating a hook or filter so you can tie in and implement it yourself.  Or, you can fork our [GitHub repository](https://github.com/ivycat/IvyCat-Ajax-Testimonials), create a patch, and submit a pull request.

= How Can I Help Out? =

**If you're a developer**, we'd love your help reviewing code, submitting bug reports or patches, testing, and participating over in the [GitHub repository](https://github.com/ivycat/IvyCat-Ajax-Testimonials).

**If you're _not_ a developer**, but you can follow instructions and take notes, we'd love to have your help beta testing new releases.  If you're interested in beta testing, please let us know by posting in the [plugin's support forum](http://wordpress.org/extend/plugins/ivycat-ajax-testimonials/).

[GitHub](https://github.com/ivycat/IvyCat-Ajax-Testimonials)

= I have 25 testimonials in the system, so why are only 10 are showing per page? =

This plugin respects the _Blog pages show at most x posts_ setting in WordPress under **Admin > Settings > Reading**.  

Of course, you can change this setting in the WordPress Admin, but that will likely affect *all posts* on your site; not just testimonials.  A better way to control number of testimonials shown in a list is to modify your shortcode to add `quantity='x'` like so: 

* `[ic_do_testimonials display='list' quantity='7']` - shows 7 posts per page
* `[ic_do_testimonials display='list' quantity='-1']` - shows all posts

== Changelog ==

= 1.5.1 =
* Add Featured Image support

= 1.5.0 =
* Add internationalization support
* Fix browser detection issue by adding jquery-migrate dependency
* Fix Scrutinizer code sniffer issues
* Update PHP5 object constructors in WP Widget API 
* Add jasonm4563 as a contributor - thanks AJ!

= 1.4.2 =
* Improve markup in testimonials-loop-template.php

= 1.4.1 =
* AJAX rotation timing fixed.
* Documentation improvements.
* Bug fix: changed `read_more` tag to `more_tag` to avoid conflicts within WordPress.

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

= 1.4.2 =
Updated new testimonial list template. No security updates.

= 1.4.1 =
Important bug fixes.  Please upgrade after reading Changelog.

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
