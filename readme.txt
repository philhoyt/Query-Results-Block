=== Query Results Block ===
Contributors: philhoyt
Tags: query loop, block, conditional, posts, results
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.1.1
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds a Results block for the Query Loop that shows its content only when the query has posts.

== Description ==

Query Results Block adds a "Results" block that you place inside a Query Loop block. Any blocks you put inside it are shown only when the Query Loop has posts to display. It is the counterpart of the "Query No Results" block that WordPress includes by default.

Use it for headings, text, buttons or any other blocks that should appear only when the query finds posts.

**How to use**

1. Add a Query Loop block to a post, page or template.
2. Inside the Query Loop, insert the "Results" block from the block inserter.
3. Place the blocks you want to show only when posts are found inside the Results block.

Example layout:

* Query Loop
 * Results: heading "Latest Posts" and a short paragraph
 * Post Template: your post layout
 * Query No Results: paragraph "No posts found"

Visitors see the "Latest Posts" heading only when there are posts to show.

**Updates**

The plugin checks GitHub releases for updates and shows them on the Plugins screen like any other plugin.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/query-results-block/`, or install the zip from Plugins > Add New > Upload Plugin.
2. Activate the plugin through the Plugins screen. The "Results" block is then available inside Query Loop blocks.

== Changelog ==

= 1.1.1 =
* Change: Tested up to WordPress 7.1.

= 1.1.0 =
* Add: Automatic updates delivered through GitHub releases. Update notifications appear in the WordPress dashboard.
* Fix: Internal code cleanup and WordPress coding standards compliance.

= 1.0.0 =
* Add: Initial release. Adds the Results block for the Query Loop, which shows its inner content only when the query returns posts.
