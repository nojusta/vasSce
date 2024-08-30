=== WP Reset - Most Advanced WordPress Reset Tool ===
Tags: wordpress reset, reset database, reset wordpress, reset, advanced wordpress reset
Contributors: WebFactory
Requires at least: 4.0
Requires PHP: 5.2
Tested up to: 6.6
Stable tag: 2.03
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Reset resets the entire site or selected parts using advanced reset options to default values. 100% safe to use with built-in restore function.

== Description ==

<a href="https://wpreset.com/">WP Reset</a> quickly resets the site's database to the default installation values without modifying any files. It deletes all customizations and content, or just chosen parts like theme settings. WordPress Reset is fast and safe to use thanks to the built-in snapshots which provide 1-click restore functionality. It has multiple fail-safe mechanisms so you can never accidentally lose data. WP Reset is extremely helpful for plugin and theme developers. It **speeds up testing & debugging** by providing a quick way to reset settings and re-test code. It's the only WP development tool for non-developers that enables advanced reset.

https://youtu.be/qMnkCW2PFoI?rel=0

For support please use the <a href="https://wordpress.org/support/plugin/wp-reset">official forum</a>, and if you need more information visit <a href="https://wpreset.com/">wpreset.com</a> and be sure to check out the <a href="https://wpreset.com/">roadmap</a> for the list of upcoming features.

Access WP Reset admin page via the "Tools" menu.

**Please read carefully before proceeding to understand what WP Reset does, and remember to always create a snapshot**

#### Resetting will delete:

* all posts, pages, custom post types, comments, media entries, users
* all default WP database tables
* all custom database tables that have the same prefix table prefix as the one defined in _wp-config.php_ and used by default tables

#### Resetting will not delete or modify:

* media files - they remain in the _wp-uploads_ folder untouched but will no longer be listed under Media in admin
* no files are touched; plugins, themes, uploads - everything stays
* site title, WordPress address, site address, site language and search engine visibility settings
* currently logged in user will be restored with the current username and password

#### What happens when I click the Reset button?

* remember to always create a snapshot first or a full backup
* you will have to confirm the action one more time because there is NO UNDO
* everything will be reset; see bullets above for details
* site title, WordPress address, site address, site language, search engine visibility settings as well as the current user will be restored
* you will be logged out, automatically logged in and taken to the admin dashboard
* WP Reset plugin will be reactivated if that option is chosen in the post-reset options

#### Undoing a reset

Before doing a reset, create a snapshot. The button is located right next to the reset button and it takes less than 10 seconds to create a snapshot. After reset is done, if you need to undo it simply restore the snapshot and that's it.

#### WP-CLI support

WP Reset comes with full WP-CLI support. Help on our WP-CLI commands is available via _wp help reset_. By default the commands have to be confirmed but you can use the `--yes` option to skip confirmation. Instead of the active user, the first user with admin privileges found in the database will be restored after reset. Please be careful when using WP Reset with WP-CLI - as with using the GUI always make a snapshot or backup first.

Currently supported WP-CLI commands:

* `wp reset reset`
* `wp reset version`
* `wp reset delete`
* `wp reset snapshots`


#### Database Snapshots

Database snapshot is a copy of all WP database tables, standard and custom ones, saved in the currently used database (as set by _wp-config.php_). Files are not saved or included in snapshots in any way.
Snapshots are primarily a development tool. Although they can be used for backups (and downloaded as gzipped SQL dumps), we suggest finding a more suitable tool for doing backups of live sites. Use snapshots to find out what changes a plugin made to your database - what custom tables were created, modified, deleted or what changes were made to site's settings. Or use it to quickly restore the development environment after testing database related changes.
Restoring a snapshot does not affect other snapshots, or WP Reset settings. Snapshots can be compared to current database tables, restored (by overwriting current tables), exported ad gzipped SQL dumps, or deleted. Creating a snapshot on an average WordPress installation takes 1-2 seconds.

https://youtu.be/xBfMmS12vMY?rel=0

#### Multisite (WP-MU) Support

WP Reset has yet to be completely tested with multisite! Please be careful when using it with multisite enabled. We don't recommend to resetting the main site. Sub-sites should be OK. We're working on making WP Reset fully compatible with WP-MU. Till then please be careful. Thank you for understanding.

#### Partial Reset Tools

* Delete transients - deletes all transient related database entries. Including expired and non-expired transients, and orphaned timeout entries.
* Delete uploads - delete all files and folder in the /uploads/ folder.
* Delete plugins - deletes all plugins except WP Reset which remains active.
* Reset theme options - resets all options for all themes that use the WP theme mods API.
* Delete themes - deletes all themes.
* Empty or delete custom tables - empties (truncates) or deletes (drops) all custom database tables.
* Delete .htaccess file - deletes the .htaccess file. If you need to edit .htaccess without FTP use our free <a href="https://wordpress.org/plugins/wp-htaccess-editor/">WP Htaccess Editor</a> plugin.

#### GDPR compatibility
We are not lawyers. Please do not take any of the following as legal advice.
WP Reset does not track, collect or process any user data on the front end. Nothing is logged or pushed to any 3rd parties. We also don't use any 3rd party services or CDNs. All actions are performed in the admin and started exclusively on users' request. If you opt to activate your PRO license in the plugin, some data will be shared with WebFactory Ltd; that's clearly noted below the license activation form. Based on that, we feel it's GDPR compatible, but again, please, don't take this as legal advice.

#### Friends who helped us translate WP Reset

* French - <a href="https://www.infrenchtranslation.com/">Jeff Inho</a>

If you're having problems with SSL or HTTPS try our free <a href="https://wordpress.org/plugins/wp-force-ssl/">WP Force SSL</a> plugin. It's a great plugin to enable SSL or install SSL.

== Installation ==

Follow the usual routine;

1. Open WordPress admin, go to Plugins, click Add New
2. Enter "wp reset" in search and hit Enter
3. Plugin will show up as the first on the list (look for our black&red round logo), click "Install Now"
4. Activate & open plugin's settings page located under the Tools menu

Or if needed, upload manually;

1. Download the latest stable version from from <a href="https://downloads.wordpress.org/plugin/wp-reset.latest-stable.zip">downloads.wordpress.org/plugin/wp-reset.latest-stable.zip</a>
2. Unzip it and upload to _/wp-content/plugins/_
3. Open WordPress admin - Plugins and click "Activate" next to "WP Reset"
4. Open plugin's admin page located under the Tools menu


== Screenshots ==

1. WP Reset - main reset page
2. All reset actions have to be confirmed
3. Additional tools for resetting and deleting various WordPress objects
4. Database Snapshots enable 1-click restoring and testing
5. Use our 1-click backup feature before running any reset tools

== Changelog ==

= v2.03 =
* 2024/06/04
* Adjusted HTML escaping on translatable strings
* Fixed some unescaped HTML output

= v2.02 =
* 2024/05/13
* Fixed license ajax security issue

= v2.01 =
* 2024/04/16
* Completely unnecessary update we were forced to do

= v2.00 =
* 2024/03/25
* More secure snapshot export filename

= v1.99 =
* 2024/03/13
* PHP 8.2 compatibility fix

= v1.98 =
* 2023/09/24
* RTL GUI fix

= v1.97 =
* 2023/01/10
* minor GUI changes
* new prices

= v1.96 =
* 2022/11/18
* security fixes

= v1.95 =
* 2022/01/06
* security fixes
* fixed a CLI bug
* added ad for our WP Force SSL plugin

= v1.93 =
* 2021/08/01
* reactivate plugins fix

= v1.92 =
* 2021/07/28
* more fixes for the password issue when resetting on WP 5.8

= v1.91 =
* 2021/07/24
* fixed password issue when resetting on WP 5.8

= v1.90 =
* 2021/06/01
* security fixes
* cleaned up unused code

= v1.86 =
* 2021/02/20
* fixed a small but nasty translation bug that prevented some users from resetting

= v1.85 =
* 2021/01/30
* code clean-up

= v1.84 =
* 2021/01/21
* added quick links button
* fixed some tooltips
* removed support for WP Webhooks

= v1.82 =
* 2020/10/27
* removed auto activation for PRO version

= v1.81 =
* 2020/10/07
* started adding better tooltips to all objects
* added promo campaign for WP 301 Redirects

= v1.80 =
* 2020/04/17
* new tool: Purge Cache
* new tool: Delete Local Data
* fixed "Delete all plugins" tool
* other minor bug fixes
* started selling WP Reset PRO
* 200,000 installs hit on 2020-03-07 with 1,560,000 downloads


= v1.77 =
* 2019/12/25
* minor bug fixes

= v1.75 =
* 2019/11/12
* bug fixes
* more GUI improvements
* updates for WP v5.3
* removed the 1-click backup tool in favor of snapshots - less confusing & same end result
* two huge bug fixes thanks to @markwill
* 1,241,470 downloads

= v1.70 =
* 2019/09/27
* bug fixes
* completely new GUI
* added .htaccess file to protect snapshots and backups folder
* added 1-click backup feature

= v1.65 =
* 2019/07/15
* bug fixes

= v1.60 =
* 2019/04/15
* bug fixes
* new tool: Reset theme options
* added Product Hunt banner
* added actions (hooks) to all tools and snapshot actions; all action names start with "wp-reset-"
* removed features survey
* announced plugin & theme collections

= v1.55 =
* 2019/03/25
* 100k users hit on 2019/01/15 with 560,300 downloads; 34 days for +10k & 71k downloads
* bug fixes
* support for WP Webhooks
* added features survey

= v1.50 =
* 2019/01/08
* new tool: delete .htaccess file
* new WP-CLI command: wp reset delete htaccess
* 90k users hit on 2018/12/12 with 489,100 downloads; 27 days for +10k & 58k downloads

= v1.45 =
* 2018/11/27
* new tool: truncate or drop custom DB tables
* truncate / drop tables tool added to WP-CLI
* all snapshot tools added to WP-CLI
* 80k users hit on 2018/11/15 with 430,800 downloads; 30 days for +10k & 57k downloads

= v1.40 =
* 2018/10/24
* new tool: DB Snapshots
* rewrote code documentation for most functions
* some parts of Snapshots need refactoring
* 70k users hit on 2018/10/16 with 373,300 downloads; 30 days for +10k & 50k downloads

= v1.35 =
* 2018/09/18
* sponsorship by IP Geolocation
* 60k users hit on 2018/09/16 with 323,300 downloads; 35 days for +10k
* added all tools to WP-CLI
* new tool: delete all files in uploads folder

= v1.30 =
* 2018/08/27
* more code clean-up
* added new reset params to WP-CLI
* big GUI changes
* started adding various tools; delete transients, delete all plugins, delete all themes
* we hit 50,000 installations on 2018/08/11 with 274,000 downloads

= v1.25 =
* 2018/07/30
* code clean-up
* post-reset options - reactivate plugin, themes & WP Reset
* added WP-MU warning till we make WP Reset fully compatible with it
* Tidy Repo notice
* added option to collapse boxes
* modified rating notice

= v1.20 =
* 2018/07/09
* we hit 40k installations on 2018/06/26
* WP-CLI support via "wp reset" command
* new logo
* ask for rating notice
* GUI improvements
* code clean up
* preparations for further development and new features

= v1.10 =
* 2018/05/09
* WebFactory took over development
* numerous bug fixes and improvements
* 30,000 installations; 199,000 downloads

= v1.0 =
* 2016/05/16
* Initial release

== Frequently Asked Questions ==

= Does WP Reset make backups? =

Automatically no, it does not. But we have "download backup" links besides every tool in the plugin so make sure you download a backup before running them. Backups only contain the database, no files!

= How can I log in after resetting? =

Use the same username and password you used while doing the reset. Only one user will be restored after resetting. The one you used at that time.

= Will any files be deleted or modified when I reset the site? =

No. All files are left untouched if you do a full reset. However, there are tool like "delete themes" that do delete files.

= Will I have to reconfigure wp-config.php? =

Absolutely not. No reconfiguration is needed. No files are modified.

= Do you support WP-CLI? =

We sure do! Just type "wp reset" in your shell to see the list of available commands and options.

= How long does it take for the reset operation to complete? =

On most installations a second or two. If you have a huge amounts of data in tables then up to ten seconds.

= How can I report security bugs? =

You can report security bugs through the Patchstack Vulnerability Disclosure Program. The Patchstack team help validate, triage and handle any security vulnerabilities. [Report a security vulnerability.](https://patchstack.com/database/vdp/wp-reset)
