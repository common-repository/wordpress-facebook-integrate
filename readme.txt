=== Plugin Name ===
Contributors: dgreen987
Tags: facebook, social networking
Tested up to: 3.0
Stable tag: trunk

Integrate wordpress with facebook, utilizing open graph and social plugins.

== Description ==

Use Facebook social plugins and open graph to integrate Facebook into your wordpress site.

COMPONENTS

** Login Button
	You need to place this widget somewhere for the user to login to facebook and utilize other components.

** Like Button
	Places a thumbs up option at the bottom of every post.

** Comments
	Adds Facebook comments to each post, this DOES NOT disable Wordpress default comment system, you must do that manually if you want only facebook comments.

WIDGET COMPONENTS - Widgets must be placed from the widgets menu in WP-admin (descriptions copied from facebook)

** Recommendations
	The Recommendations plugin shows personalized recommendations to your users. Since the content is hosted by Facebook, the plugin can display personalized recommendations whether or not the user has logged into your site. To generate the recommendations, the plugin considers all the social interactions with URLs from your site. For a logged in Facebook user, the plugin will give preference to and highlight objects her friends have interacted with.

** Activity Feed
	The Activity Feed plugin displays the most interesting recent activity taking place on your site. Since the content is hosted by Facebook, the plugin can display personalized content whether or not the user has logged into your site. The activity feed displays stories both when users like  content on your site and when users share content from your site back to Facebook. If a user is logged into Facebook, the plugin will be personalized to highlight content from their friends. If the user is logged out, the activity feed will show recommendations from your site, and give the user the option to log in to Facebook.
	The plugin is filled with activity from the user's friends. If there isn't enough friend activity to fill the plugin, it is backfilled with recommendations. If you set the recommendations param to true, the plugin is split in half, showing friends activity in the top half, and recommendations in the bottom half. If there is not enough friends activity to fill half of the plugin, it will include more recommendations.

**Like Box
	The Like Box is a social plugin that enables Facebook Page owners to attract and gain Likes from their own website. The Like Box enables users to:
  	  * See how many users already like this page, and which of their friends like it too
  	  * Read recent posts from the page
   	  * Like the page with one click, without needing to visit the page

**Facepile
	The Facepile plugin shows profile pictures of the user's friends who have already signed up for your site.
	You can specify the maximum number of rows of faces to display. The plugin dynamically sizes its height; for example, if you specify a maximum of four rows of faces, and there are only enough friends to fill two rows, the height of the plugin will be only what is needed for two rows of faces. The plugin doesn't render if the user is logged out of Facebook or doesn't have friends who have signed up for your site using Facebook.

**Live Stream
	The Live Stream plugin lets users visiting your site or application share activity and comments in real time. The Live Stream Box works best when you are running a real-time event, like live streaming video for concerts, speeches, or webcasts, live Web chats, webinars, massively multiplayer games.

== Installation ==

1. extract contents of zip folder into WP-contents/plugins folder.
2. On facebook, setup a facebook application for your website
3. In WP-admin navigate to settings->WPFBI settings you must specify: App ID, API key and App secret from your facebook application.

== Frequently Asked Questions ==

= How do I disable wordpress default comments? =

in Settings : discussion uncheck "Allow people to post comments on new articles"

= Where can I create a facebook application? =

http://www.facebook.com/developers/createapp.php

= Nothing appears on my blog =

Make sure you add the widgets you want in the widgets menu.

The login widget is highly recommended to allow users to login and authorize your application.

== Changelog ==

= 0.3 =
* Fixed setting default option values on activation.
* Fixed a bug that broke like box.

= 0.2 =
* Various bug fixes.

== Upgrade Notice ==

