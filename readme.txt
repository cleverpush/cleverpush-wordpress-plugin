=== CleverPush ===
Contributors: CleverPush
Plugin Name: CleverPush
Plugin URI: https://cleverpush.com
Tags: push notifications, web push, browser notifications, woocommerce
Requires at least: 2.7
Tested up to: 5.9.3
Stable tag: 1.7.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

CleverPush lets you send browser push notifications to your users in the simplest way possible.

== Description ==
Installing the CleverPush plugin will automatically insert the CleverPush code into your WordPress site. It will also give you the possibility to create a notification when publishing a new post.

What is CleverPush?
CleverPush lets you send browser push notifications to your users in the simplest way possible.

AMP Support:
If you are using the classic / reader mode with a custom theme, please make sure your theme supports the following AMP hooks:
* amp_post_template_body_open
* amp_post_template_footer
* amp_post_template_css


== Installation ==
Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from the Plugins page.

== Frequently Asked Questions ==
= I have activated the plugin but the confirmation prompt is now shown =
Please enter your API keys in the plugin's settings and select a channel. If no channel is available, you need to create one at cleverpush.com
If you are using any cache plugin, also be sure, to empty your cache.

== ChangeLog ==

= 1.7.0 =
* Add ability to optionally disable feed pushes for each post

= 1.6.6 =
* Append channel ID to worker file to make it work for some WordPress frameworks

= 1.6.5 =
* Fixed service worker file path for some WordPress frameworks

= 1.6.4 =
* Supported custom static endpoints

= 1.6.3 =
* Added ability to optionally disable the CleverPush script output

= 1.6.2 =
* Styling fixes for AMP

= 1.6.1 =
* Hotfix for AMP

= 1.6.0 =
* Support for AMP

= 1.5.3 =
* Fixed a warning when saving a post

= 1.5.2 =
* Fixed error in plugin settings

= 1.5.1 =
* Added plugin version to loader JS

= 1.5.0 =
* Added ability to replace domains in Notification URLs automatically
* Added cleverpush_send and cleverpush_settings capabilities

= 1.4.0 =
* Added ability that CleverPush can optionally access unpublished posts to load metadata like and title, image

= 1.3.1 =
* Added the ability to include cleverpush-worker.js.php from non-default directory setups

= 1.3.0 =
* Support custom post types
* Hide CP Stories by default, can be enabled in CleverPush settings
* Add "Custom headline required" option

= 1.2.0 =
* Hide Topics/Segments if disabled in CleverPush backend

= 1.1.0 =
* Cache Topics/Segments

= 1.0.12 =
* CleverPush Story fixes (6)

= 1.0.11 =
* CleverPush Story fixes (5)

= 1.0.10 =
* CleverPush Story fixes (4)

= 1.0.9 =
* CleverPush Story fixes (3)

= 1.0.8 =
* CleverPush Story fixes (2)

= 1.0.7 =
* CleverPush Story fixes

= 1.0.6 =
* Check if wp.data.select is available before using it (3)

= 1.0.5 =
* Check if wp.data.select is available before using it (2)

= 1.0.4 =
* Check if wp.data.select is available before using it

= 1.0.3 =
* Add loading animation

= 1.0.2 =
* Flush rewrite rules on plugin activation & deactivation

= 1.0.1 =
* Fix for Classic Editor

= 1.0.0 =
* Added Segments & Topics required checks
* Added CleverPush Stories

= 0.9.0 =
* load topics and segments asynchronously

= 0.8.1 =
* remove Public API Key setting (not used)

= 0.8.0 =
* save entered headline + text for draft posts

= 0.7.8 =
* do not show falsy "notification was sent" message, when saving a draft post

= 0.7.7 =
* remove checkbox after sending notification - hotfix

= 0.7.6 =
* remove checkbox after sending notification, show notice in gutenberg editor

= 0.7.5 =
* gutenberg editor fixes

= 0.7.4 =
* better error logs

= 0.7.3 =
* change default headline + text
* allow one notification per post per minute

= 0.7.2 =
* minor fix

= 0.7.1 =
* added post thumbnails to notifications
* allow for every post to send a notification only once
* multi topic & segment selection

= 0.7.0 =
* added ability to set custom headline and text when sending new notifications

= 0.6.4 =
* minor fix

= 0.6.3 =
* added assets/cleverpush-worker.js.php for usage on HTTPS sites

= 0.6.2 =
* fixed bug where notification was sent every time post was saved

= 0.6.1 =
* fix publish_post handler

= 0.6.0 =
* breaking: no direct WooCommerce integration anymore (should be used with follow-up campaigns now)
* fixed: don't triggerOptIn directly after first page view. Considering opt-in channel settings now.

= 0.5.1 =
* Bug fixes

= 0.5 =
* Added new JavaScript SDK code

= 0.4.1 =
* Hotfix for WooCommerce integration

= 0.4 =
* WooCommerce integration with automatic retargeting notifications.

= 0.3 =
* Ability to notifications directly in WordPress

= 0.2 =
* Multi language
* Simplify settings

= 0.1 =
* Initial release

== Configuration ==

Enter your CleverPush API keys in the given fields. You can find your API keys in the CleverPush backoffice under Settings > API.

