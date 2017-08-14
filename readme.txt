=== Plugin Name ===
Contributors: brianhogg
Donate link: http://weeverapps.com/
Tags: AJAX, android, apple, blackberry, weever, weaver, HTML5, iphone, ipod, mac, mobile, smartphone, theme, mobile, web app
Requires at least: 3.1
Tested up to: 3.5
Stable tag: 1.5.9

Weever Apps: Turn your site into a true HTML5 'web app' for iPhone, Android and Blackberry - weeverapps.com

== Description ==

** DEPRECIATED ** - please use version 2 'appBuilder for Wordpress' for new apps - http://wordpress.org/extend/plugins/weever-apps-20-mobile-web-apps/

Weever is a new service that turns your WordPress site into a mobile web app for iPhone, Blackberry Touch, Android and iPad.

Weever functions and feels like a native iOS, Android, or Blackberry app, except with no App Store barriers!

This plugin enables you to build and manage your app entirely within WordPress' administrator backend, utilizing best practices to present your content for a mobile-specific context. App users will be able to quickly and easy find your latest news, follow your social network feeds, touch to make a phone call or email you, watch your videos, browse your photo feeds, and more.

Setting up a Weever App is extremely easy. All you do is:

- Sign up for an subscription key at http://weeverapps.com/pricing
- Install the plugin
- Paste in the API key
- Start adding content and branding to your app!

The plugin will forward the devices you specify to your app, and automatically provides the app with the most up-to-date info, so you do not have to manage both your app and your site.

Currently supports:

- Blog content from pages, categories, tags, and custom taxonomy
- Creation of a landing page or a slide-show using Wordpress page content
- Contact information
- Social: Twitter, Facebook, Identi.ca
- Video: Youtube, Vimeo
- Photo: Flickr, Picasa, Facebook Albums, Foursquare Venue Photos
- Events: Google Calendar, Facebook Events
- Forms through Wufoo
- Maps using geolocation stored in posts (using the Wordpress mobile apps for iPhone, Android and Blackberry, or the official Geolocation plugin)
- App works for iPhone/iPod/iPad, Android devices, Blackberry touch devices, with further compatibilities coming soon.

Additional Features:

- Staging Mode: allows developers to play around with new layouts or work on an app for a new version of a site without needing another API key and without affecting a Live app.
- QR Codes: This extension will generate QR codes both for quick previewing of your app as you're building it, and for promoting your app publicly.

== Installation ==

1. Install directly from the Wordpress admin (search for 'Weever Apps' from the Plugins / Add New page), or upload the entire contents of the zip to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin by entering your subscription key
1. Add the content you wish to appear in your mobile app from the 'App Features + Navigation' screen - simply click a tab, select the content you want to appear, and submit!
1. Scan the QR code with your phone to preview your app
1. Turn your app online by clicking the icon in the top-right corner in the 'Weever Apps' screen

You can obtain a subscription key at http://weeverapps.com/pricing

== Frequently Asked Questions ==

= How do I start creating my mobile app? =

1. Install the plugin
1. Sign up for a subscription key at http://weeverapps.com/pricing
1. Add the content you wish to appear in your mobile app from the 'App Features + Navigation' screen - simply click a tab, select the content you want to appear, and submit!
1. Scan the QR code with your phone to preview your app
1. Turn your app online by clicking the icon in the top-right corner in the 'Weever Apps' screen

That's it!

= Can I customize the look and feel of the mobile app? =

Yes!  You can customize your app in a number of ways:

1. Upload custom graphics for the load screen, logo, and other images for the app in the 'Logo, Images and Theme' tab in the Weever Apps Configuration screen
1. Copy templates/weever-content-single.php in the plugin folder to your current theme to customize the look of individual pages / posts, or rename to weever-content-single-{posttype}.php to override only for certain post types (standard or custom)
1. Add custom CSS in the 'Logo, Images and Theme' tab, under 'Advanced Theme Settings' or add a file named weever.css to your current Wordpress theme

You can determine the appropriate CSS classes to use by loading your private app URL in a Webkit browser such as Google Chrome or Safari, and inspecting the appropriate HTML elements.

Our support site - http://support.weeverapps.com/ - contains many more answers and our community forums.

== Screenshots ==

1. Select blog content by category, tag, search terms, and custom taxonomy
2. Sample page content
3. Easily add maps using standard Wordpress post geolocation data
4. Include social media feeds from Twitter, Identi.ca and Facebook
5. Event listing from Facebook or Google Calendar
6. Photos from Flickr, Facebook, Foursquare
7. Video streams from Youtube, Vimeo
8. Contact information
9. Forms generated using Wufoo
10. Add to launch screen ability with customizable icon

== Changelog ==

= 1.5.9 = 
* Ability to override the R3S feed
* Switching content wrapper from paragraph to div

= 1.5.8 =
* Added support for newer blackberry touch devices

= 1.5.6 =
* Easy way to change colors of the app to match your branding
* Icon image now saved when page added to app
* Use featured image of a post in a feed, if any
* Fixes for limit/offset when using geotagged data

= 1.5.5 =
* Fixes issue with R3S name not saving for Pages tab

= 1.5.4 =
* Added a feature tour on first launch
* Preview of app within plugin (Webkit web browsers only)

= 1.5.3 =
* Add ability to change language and localization for the app

= 1.5.2 =
* Adds nearest tab, showing a proximity of map locations near you

= 1.5.1 =
* Fixes issue with quotes in tab names
* Removed author name and date from default template, copy templates/weever-content-single.php to your current theme folder to modify

= 1.5 =
* Adds support for flipping between the app and the full desktop site, when an internal link is clicked
* Fixes issue with Firefox and Advanced Settings
* Ability to override the R3S feed by copying templates/feed-r3s.php into your current Wordpress theme  

= 1.4.1 =
* Minor fixes

= 1.4 =
* Ability to prompt users to 'install' your app by adding a link to their homescreen
* Added new 'About App' tab for pro users
* Ability to take an [R3SFeed](http://support.weeverapps.com/entries/20786801-what-is-the-add-an-r3s-feed-url-option-for "R3S Feed") from another site and use it in your app
* Titles are now properly hidden on the Welcome tab

= 1.3.12 =
* Corrected an issue with limiting the length of the content feed

= 1.3.11 =
* Changing hook for content feed

= 1.3.10 =
* Improved handling for blogs with large amounts of content
* Improved support tab

= 1.3.8 =
* Additional photo feed options
* Ability to add photo to contact along with miscellaneous information (such as hours of operation)

= 1.3.7 =
* Adding new directory tab for trial and premium/pro
* Ability to specify KML data and a custom map marker for each post

= 1.3.6 =
* Fixed issue with saving map settings
* Added support for WP Geo
* Ability to customize the look of content by placing either weever-content-single.php or weever-content
* Custom taxonomies now save correctly for the Blogs tab
* More Wordpress-standard interface for editing tabs

= 1.3.4 =
* Ability to quickly add all published post content to the Blog tab

= 1.3.3 =
* Corrects issue when entering subscription key for the first time

= 1.3.2 =
* Small UI issue when uploading files

= 1.3.1 =
* Added query param to scripts and stylesheets to force reload on plugin update

= 1.3 =
* Added maps support
* Fixes various issues with the UI

= 1.2 =
* Ability to customize the app using Wordpress theme files (weever-content-single.php, weever.css)
* Additional 'landing page' tab
* Several plugin UI improvements

= 1.1.2 =
* Slight changes to interface
* Correct issue with feed filter

= 1.1 =
* Changes to interface
* Updated theme configuration loading
* Several minor fixes

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.5.6 =
* Easy way to change colors of the app to match your branding
* Icon image now saved when page added to app
* Use featured image of a post in a feed, if any
* Fixes for limit/offset when using geotagged data

= 1.5.5 =
* Fixes issue with R3S name not saving for Pages tab

= 1.5.4 =
* Added a feature tour on first launch
* Preview of app within plugin (Webkit web browsers only)

= 1.5.3 =
* Add ability to change language and localization for the app

= 1.5.2 =
* Adds nearest tab, showing a proximity of map locations near you

= 1.5.1 =
* Fixes issue with quotes in tab names

= 1.5 =
* Adds support for flipping between the app and the full desktop site, when an internal link is clicked
* Fixes issue with Firefox and Advanced Settings
* Ability to override the R3S feed by copying templates/feed-r3s.php into your current Wordpress theme  

= 1.4 =
* Ability to prompt users to 'install' your app by adding a link to their homescreen
* Added new 'About App' tab for pro users
* Ability to take an [R3SFeed](http://support.weeverapps.com/entries/20786801-what-is-the-add-an-r3s-feed-url-option-for "R3S Feed") from another site and use it in your app
* Titles are now properly hidden on the Welcome tab

= 1.3.12 =
* Corrected an issue with limiting the length of the content feed

= 1.3.11 =
* Changing hook for content feed

= 1.3.10 =
* Improved handling for blogs with large amounts of content
* Improved support tab

= 1.3.8 =
* Additional photo feed options
* Ability to add photo to contact along with miscellaneous information (such as hours of operation)

= 1.3.7 =
* Added Directory tab
* Ability to specify KML data and a custom map marker for each post

= 1.3.6 =
* Fixed issue with saving map settings
* Added support for WP Geo
* Custom taxonomies now save correctly for the Blogs tab
* More Wordpress-standard interface for editing tabs

= 1.3.4 =
* Ability to quickly add all published post content to the Blog tab

= 1.3.3 =
* Corrects layout issue that caused some users to not be able to enter their key

= 1.3.1 =
* Added query param to scripts and stylesheets to force reload on plugin update

= 1.3 =
Maps support and several UI issues fixed

= 1.2 =
Ability to customize the app using Wordpress themes, additional 'Welcome' tab, UI improvements

= 1.1.2 =
Corrects issue with feed filter, update recommended

= 1.1 =
Minor fixes and better support of theme configuration features

= 1.0 =
Initial version