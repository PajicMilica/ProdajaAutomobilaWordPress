=== WP Mailster ===
Contributors: brandtoss, svelon
Tags: mailing list, listserv, discussion list, group communication
Requires at least: 4.3
Tested up to: 5.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Mailster allows your users to be part of a group and communicate by email without having to log into a website.

== Description ==

WP Mailster allows your users to be part of a group and communicate by email without having to log into a website.
Similar to programs like Mailman or Listserv this plugin allows you to run a discussion mailing list.

That means that every email sent to a central email address is forwarded to the rest of the members of the list.
When members reply to such emails WP Mailster again forwards them to the other list recipients.
Unlike newsletter plugins this allows true two-way communication via email.

Features include:

*   group communication through email
*   usable with any POP3/IMAP email account
*   recipients can be managed in the WordPress admin area
*   users can subscribe/unsubscribe through widgets on the website
*   all WP users can be chosen as recipients, additional recipients can be stored (without having to create them as WP users)
*   users can be organized in groups
*   single users or whole groups can be added as recipients of a mailing list
*   replies to mailing list messages can be forwarded to all recipients (or only the sender)
*   email archive for browsing the mails
*   full support of HTML emails and attachments
*   custom headers and footers
*   subject prefixes
*   many more features

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/wp-mailster` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the WP Mailster screen to configure the plugin

== Frequently Asked Questions ==

= How do I send an email? =
When you want to use WP Mailster you don't need to browse to a website, login and do something to send the message there - you just use your favorite mail client.
Simply write an email to the mailing list's address - and nothing else. So use Gmail, Outlook, Thunderbird, a Webmailer, any way you like - just send it to the mailing list address you have setup in WP Mailster.

= Why take the emails so long to be delivered? How can I speed up sending?  =
WP Mailster is a part of WordPress which is a PHP based web application. That means: it can not act/run without being triggered and it can not run forever when triggered. This is a technical limitation coming from PHP, not from WP Mailster or WordPress.
Triggering means that somebody accesses the site. During the page load WP Mailster is handling the jobs to do (mail retrieving/sending). Thus mails can only be send/retrieved when somebody is browsing your site, otherwise the delivery is delayed or never done. As your site might not be browsed every few minutes 24×7 we recommend you to use a cronjob that opens the site periodically. We have a guide on our website on how to set that up.

= What are send errors?  =
The send errors are messages your email server is giving back to WP Mailster basically saying "I will not forward this message". Then WP Mailster sending for some time but eventually stops which is what you see happening.
The cause can be a lot of things, e.g. hitting send limits (per hour/day) or sending email with content that the server does not like.
You need to find out what your email servers are telling WP Mailster. Please follow our troubleshooting guide on our site.

== Changelog ==

= 1.6.16 =
*Release Date - December 1st, 2020*

*   [Feature] Pro editions: registration plugin for adding new users automatically to list and/or groups
*   [Improvement] Show profile shortcode dialog also if only unsubscription is allowed
*   [Bug Fix] CSV duplicate check based on email address needs to be case insensitive
*   [Bug Fix] Count failed sending attempts towards the throttling quota

= 1.6.15 =
*Release Date - September 7th, 2020*

*   [Bug Fix] Adding mailing lists works again in the correct tabbed layout
*   [Bug Fix] Adding users/groups from/to mailing lists works again
*   [Bug Fix] Fix WordPress 5.5 incompatibilities (more specific problems with jQuery 1.9 version)
*   [Bug Fix] Add missing UI icons
*   [Bug Fix] Fix PHP warnings

= 1.6.14 =
*Release Date - August 27th, 2020*

*   [Improvement] For sender control checking consider @GMAIL.COM and @GOOGLEMAIL.COM the same
*   [Bug Fix] Fix WordPress 5.5. incompatibilities (adding/removing recipients possible, dropdown filter in archive working)

= 1.6.13 =
*Release Date - August 12th, 2020*

*   [Bug Fix] Make plugin compatible with WordPress 5.5

= 1.6.12 =
*Release Date - August 3rd, 2020*

*   [Improvement] Support long passwords (limit is now 255 characters, and not 45 as it was)
*   [Bug Fix] No shortcode execution in admin area (broke editing experience with Gutenberg editor)

= 1.6.11 =
*Release Date - July 9th, 2020*

*   [Bug Fix] Avoid PHP warnings

= 1.6.10 =
*Release Date - July 8th, 2020*

*   [Feature] Filters for modifying the welcome and goodbye email subject and contents (wpmailster_subsr_welcome_email_subject, wpmailster_subsr_welcome_email_body_html, wpmailster_subsr_welcome_email_body_alt, wpmailster_subsr_goodbye_email_subject, wpmailster_subsr_goodbye_email_body_html, wpmailster_subsr_goodbye_email_body_alt)
*   [Feature] Introduce new text variables {orig_to} and {orig_cc} to include original TO and CC addressees in the email content (header or footer text)
*   [Improvement] Do not execute plugin background actions during REST API requests (wp-json/wp/v2 endpoint)
*   [Bug Fix] Send welcome message (when enabled) to all new users added through admin
*   [Bug Fix] Display host name (and port) for server names in lists and dropdowns
*   [Bug Fix] User name and description is pulled reliable for WP users
*   [Bug Fix] Use display name instead of nice name

= 1.6.9 =
*Release Date - April 17th, 2020*

*   [Improvement] For WP users, use user's "nice name" if available
*   [Bug Fix] Digest queue is emptied after successful digest sending

= 1.6.8 =
*Release Date - March 24th, 2020*

*   [Improvement] Compatibility with WordPress 5.4
*   [Bug Fix] Remove unneeded PHP warnings

= 1.6.7 =
*Release Date - February 17th, 2020*

*   [Improvement] Warn user if unsupported special character is used for the email password
*   [Improvement] CSS classes for unsubscribe button added
*   [Bug Fix] Fix incompatibilities in admin area (styles and scripts are not loaded on other screens), e.g. other plugins' tabs user interfaces looked funny or stopped working
*   [Bug Fix] In frontend mailing list view: show list email instead of admin email
*   [Bug Fix] Hide emails in moderation from list of shortcode [mst_emails]
*   [Bug Fix] Performance optimizations by avoiding unnecessary DB update checks
*   [Bug Fix] Remove unneeded PHP notices

= 1.6.6 =
*Release Date - November 14th, 2019*

*   [Feature] Pro editions: define email retention period for archive or disable email archiving

= 1.6.5 =
*Release Date - October 5th, 2019*

*   [Improvement] Better logging for hard to analyze DB query issues

= 1.6.4 =
*Release Date - October 4th, 2019*

*   [Bug Fix] Compatibility with MySQL running with NO_ZERO_DATE setting

= 1.6.3 =
*Release Date - October 4th, 2019*

*   [Bug Fix] User edit screen (to change a user's group and list membership) works for WP users
*   [Bug Fix] Avoid queue from filling up with garbage (shorten too long mail references)

= 1.6.2 =
*Release Date - September 4th, 2019*

*   [Bug Fix] Fix stored cross-site scripting vulnerabilities
*   [Bug Fix] Bulk resending of messages from the email archive works
*   [Bug Fix] Remove unnecessary PHP warnings

= 1.6.1 =
*Release Date - August 12th, 2019*

*   [Bug Fix] Avoid "Specified key was too long" database error message

= 1.6.0 =
*Release Date - August 4th, 2019*

*   [Feature] Society & Enterprise edition: Moderation Mode
*   [Bug Fix] Attachment download in frontend works
*   [Bug Fix] Do not display title twice in subscribe widgets
*   [Bug Fix] Allow customization of the list label in subscribe widgets
*   [Bug Fix] Allow special characters in mailbox password fields
*   [Bug Fix] Avoid PHP warnings
*   [Bug Fix] Do not display upgrade link in Enterprise edition

= 1.5.15 =
*Release Date - June 18th, 2019*

*   [Bug Fix] Lists created as duplicates where never checked for new emails
*   [Bug Fix] Subscribe widget's "add to group" functionality
*   [Bug Fix] Design choice in subscribe widget are saved correctly
*   [Bug Fix] Do not send <> as the sender of notification emails

= 1.5.14 =
*Release Date - May 17th, 2019*

*   [Improvement] Pro versions' throttle setting: enable to only sleep 0.1 or 0.5 seconds between the sending of each email
*   [Improvement] Workaround for missing PHP charset conversion functions (iconv, mb_convert_encoding). If no workaround can be applied, warnings are displayed that the functionality is limited.
*   [Improvement] Updated German translation
*   [Bug Fix] Notifications are stored correctly (are not assigned to a different mailing list)

= 1.5.13 =
*Release Date - April 18th, 2019*

*   [Bug Fix] When an email gets deleted from the archive, also remove related queue entries, attachments, etc

= 1.5.12 =
*Release Date - February 20th, 2019*

*   [Bug Fix] Correctly record the original send timestamp (no timezone difference issue)

= 1.5.11 =
*Release Date - February 2nd, 2019*

*   [Improvement] Cronjob optimization for the "all" execution mode to avoid sending delays for installations with many lists
*   [Bug Fix] Do not send out "your email is no forwarded" notifications when the sender does have an empty email address
*   [Bug Fix] Fix for "keep original header" setting for multiple CC addresses - put all of them in one header, not multiple CC headers

= 1.5.10 =
*Release Date - December 29th, 2018*

*   [Improvement] Pull user name from database to fill for user name placeholder variable in case original header was empty
*   [Improvement] Pro versions license information is showing within settings and system diagnosis
*   [Bug Fix] Attachment with UTF-8 filenames are handled correctly (e.g. ä,ö,ü characters)
*   [Bug Fix] No plugin email retrieval/sending activtiy during plugin installs/updates/activations/deactivations/hearbeat requests
*   [Bug Fix] Fix for raw cases where email headers cannot be retrieved in first try

= 1.5.9 =
*Release Date - May 12th, 2018*

*   [Improvement] Auto-detect CSV file format on import
*   [Improvement] Language settings fixed to make translation possible
*   [Improvement] Added German translation, thanks Jörg Knörchen
*   [Improvement] Digests can be managed by the admin (Society and Enterprise only)
*   [Bug Fix] Fix counter display for adding/removing list members

= 1.5.8 =
*Release Date - March 22nd, 2018*

*   [Improvement] User interface improvements with more in-app help texts + quick links
*   [Improvement] Remove CC addressing mode because of known negative implications
*   [Bug Fix] Club/Society/Enterprise: Valid licenses are recognized more reliable

= 1.5.7 =
*Release Date - February 26th, 2018*

*   [Bug Fix] Society/Enterprise: Digest frequency can be changed in Profile shortcode
*   [Bug Fix] Fixed typos

= 1.5.6 =
*Release Date - February 10th, 2018*

*   [Improvement] Improve [mst_mailing_lists] and [mst_emails] shortcodes content
*   [Bug Fix] Double Opt-In Subscription through Profile shortcode works
*   [Bug Fix] Fix and remove "log to database" feature

= 1.5.5 =
*Release Date - December 5th, 2017*

*   [Bug Fix] Security Fix XSS (Cross Site Scripting) issue in unsubscribe handler (thank you for your help, Ricardo Sanchez)

= 1.5.3 / 1.5.4 =
*Release Date - November 19th, 2017*

*   [Improvement] Make plugin work in Multiuser / Network site context
*   [Improvement] Recipients names from WP users are coming from first name / last name instead of login names
*   [Improvement] Queue entries can be deleted
*   [Improvement] The shortcode [mst_emails] has new parameter to control the order the messages are dispalyed, e.g. [mst_emails lid=1 order=oldfirst] or [mst_emails lid=1 order=newfirst]
*   [Improvement] Various interface improvements to show #users per list/group and for better navigation
*   [Bug Fix] All list members (recipients) can be removed
*   [Bug Fix] Make unsubscribe (with and without double-opt-out) work
*   [Bug Fix] Subject prefixes can have a blank character at the end
*   [Bug Fix] Unsubscribe URL placeholder (for custom header/footer) works in typcial situations where a text editor adds unneeded http/https before the {unsubscribe} placeholder
*   [Bug Fix] Catch runtime exception in case log file cannot be generated
*   [Bug Fix] Improved logo naming so that browser caching will not prevent correct logo to be displayed after upgrade


= 1.5.0 =
*Release Date - September 26th, 2017*

*   [Feature] Shortcode mst_emails allows to only select a specific mailing list by it's ID, e.g. [mst_emails lid=2]
*   [Feature] Mailing lists can be duplicated
*   [Improvement] Subscribe / unsubscribe forms work without page reload
*   [Improvement] Introduce reCAPTCHA v2, remove v1
*   [Improvement] PHP 5.3 and PHP 5.4 are supported
*   [Bug Fix] Resolve PHP 7.0 compatibility issue
*   [Bug Fix] Pagination fix for admin lists
*   [Bug Fix] Log file of installation is not written to the root directory
*   [Bug Fix] Fixed typos


= 1.4.19 =
*Release Date - June 13th, 2017*

*   [Improvement] Speed optimization (remove unneeded DB schema checks)
*   [Improvement] Plugin Update Checker updated to latest version
*   [Bug Fix] Pagination fix for threads shortcode
*   [Bug Fix] Added default page size for mails in mails shortcode
*   [Bug Fix] CSV Import: check on PHP's max_input_vars setting to detect when too much entries would be present to inform the user (and skip the ones too much)


= 1.4.18 =
*Release Date - May 4th, 2017*

*   [Bug Fix] Fix error when mailing lists are saved
*   [Bug Fix] Remove unnecessary "Show User description" setting
*   [Bug Fix] No whitespace in front of text-area settings


= 1.4.17 =
*Release Date - April 20th, 2017*

*   [Improvement] Set date/time format displayed in email header/footer according to the WordPress installation's settings
*   [Bug Fix] Only show mailing list settings available in the respective product edition
*   [Bug Fix] Trigger Source setting can be saved
*   [Bug Fix] Language fixes


= 1.4.13 - 1.4.16 (April 9th, 2017) =
*   [Bug Fix] Fixed Profile shortcode


= 1.4.12 =
*Release Date - April 8th, 2017*

*   [Improvement] Email archive in admin has now buttons to removing remaining queue entries and resetting send error count
*   [Bug Fix] Captcha and "add to group" selections can be made in the subscribe widget
*   [Bug Fix] Fixed Profile shortcode in Free edition (Users can subscribe and unsubscribe from lists)


= 1.4.11 =
*Release Date - March 7th, 2017*

*   [Feature] CSV import and export of users/email addresses
*   [Bug Fix] Fix some warning messages


= 1.4.10 =
*Release Date - February 19th, 2017*

*   [Feature] Introduce shortcodes to display email archives, mailing list and subscription profile
*   [Feature] Add duplicate bulk action to mailing list screen for copying lists
*   [Improvement] Show available shortcodes in dashboard
*   [Bug Fix] Don't remove white spaces in subject prefix, and plain header/footer
*   [Bug Fix] Remove CSS styling from site area and unneeded styling


= 1.4.9 =
*Release Date - February 2nd, 2017*

*   [Bug Fix] Make inline images show up in the email archive message view
*   [Bug Fix] Attachment download in the backend email archive works again


= 1.4.8 =
*Release Date - January 31th, 2017*

*   [Bug Fix] Automatically fix remaining DB collation differences


= 1.4.7 =
*Release Date - January 31th, 2017*

*   [Bug Fix] Make some important options (e.g. max run time, minimum time between retrieving/sending, ...) available in the admin settings GUI


= 1.4.6 =
*Release Date - January 30th, 2017*

*   [Improvement] Add search functionality to all admin area lists/tables
*   [Improvement] Improve some GUI elements on the edit mailing list screen
*   [Bug Fix] Existing log file is not overwritten during plugin updates


= 1.4.5 =
*Release Date - January 25th, 2017*

*   [Improvement] Show recipient count used in mailing list VS max recipients
*   [Improvement] Better show active GUI elements in edit mailing list screen
*   [Bug Fix] Various small fixes


= 1.4.4 =
*Release Date - January 24th, 2017*

*   [Bug Fix] Saving of multiple mailing list settings fixed
*   [Bug Fix] Emails can be deleted in the email archive


= 1.4.3 =
*Release Date - January 23rd, 2017*

*   [Improvement] GUI improvements in the mailing list management
*   [Bug Fix] Automatically fixes DB collation differences
*   [Bug Fix] Log file works when WP is installed in subdirectory
*   [Bug Fix] Fixed wrong textual file size representations (KB VS MB)


= 1.4.0 =
*Release Date - January 3rd, 2017*

*   Initial release


== Upgrade Notice ==
= 1.6.16 =
Pro editions: registration plugin, improved profile shortcode, fix for CSV duplicate check, fix for send throttling

= 1.6.15 =
Fix for several WordPress 5.5 incompatibilities

= 1.6.14 =
Sender control check considers @GMAIL.COM and @GOOGLEMAIL.COM domains the same, Fix for WordPress 5.5 compatibility issues

= 1.6.13 =
Compatibility with WordPress 5.5

= 1.6.12 =
Support long passwords, Fix editing pages with shortcode (in Gutenberg)



