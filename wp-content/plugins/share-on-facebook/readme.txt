=== Plugin Name ===
Contributors: David Goldstein
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3396118
Tags: facebook
Requires at least: 2.0
Tested up to: 3.1.3
Stable tag: 1.7

This plugin adds a footer link to add the current post or page as a Facebook link.

== Description ==
This plugin adds a footer link to add the current post or page as a Facebook link.  While the plugin is activated a link will appear after the content of each post/page with the text "Share on Facebook", the Facebook icon, both or the familiar Facebook share button. Clicking the link will bring the user to the Facebook site to add the link to their profile.  If the user isn't logged in they will be prompted to do so.

== Installation ==
1. Add a directory called 'share-on-facebook' (without the quotes) to your '/wp-content/plugins/' directory.
1. Upload shareonfacebook.php to '/wp-content/plugins/share-on-facebook/' directory.
1. Activate the plugin through the 'Plugins' page in WordPress.
1. Go to 'Settings->Share on Facebook' in your admin interface to select your options.

== Changelog ==
= 1.7 =
* Fixed the "You do not have sufficient permissions to access this page." message some users were getting when saving options.

= 1.6 =
* Added comment tags around JavaScript to address errors.
* Changed a $_SERVER['PHP_SELF'] call to $_SERVER['REQUEST_URI'] to address possible security issue.

= 1.5 =
* Added compatibility with PHP 4.x.

= 1.4 =
* Added option to choose to have the Facebook link appear on Posts, Pages or both (Posts and Pages).

= 1.3 =
* Facebook's "Post to Profile" page now appears in a popup for all posts on the index page of a blog.

= 1.2 =
* Reworked with valid XHTML.
* Consolidated redundant code.
* Updated styles for the button.

= 1.1 =
* Fixed bug in template tag implementation.

= 1.0 =
* First public release.

== Options ==
There are three options on the options page: Link Type, Insertion Type and Page Type.

Link Type - This option sets if you want your Facebook link to be text, icon, both or share button.

Insertion Type - This option sets how you want to insert the link into your posts/pages.  There are two choices: auto or template.

* Auto - When insertion type is set to auto the Facebook link will automatically be inserted right after the post.
* Template - When insertion type is set to template the Facebook link will appear wherever the template tag for the plugin is added to your theme. This option requires a template tag to be added to your theme.

Page Type - This option sets whether you want you Facebook link to appear on Posts, Pages or both (Posts and Pages).

== Template Tag ==
When Insertion Type is set to Template the following template tag must be added to your theme in the location you want the link to appear:

`<?php if(function_exists(shareonfacebook)) : shareonfacebook(); endif; ?>`