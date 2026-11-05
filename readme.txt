=== Query Results Block ===
Contributors: philhoyt
Tags: query loop, block, conditional, posts, results
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.1.1
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds a Results block for the Query Loop that shows its content only when the query has posts

== Description ==

Query Results Block adds a "Results" block that you place inside a Query Loop block. Any blocks you put inside it are shown only when the Query Loop has posts to display. It is the counterpart of the "Query No Results" block that WordPress includes.

Use it for headings, text, buttons, or any other blocks that should appear only when the query finds posts.

The block has no settings. It reads the parent Query Loop's query and page number the same way the core Query No Results block does, including queries that inherit from the current page.

= How to use =

1. Add a Query Loop block to a post, page, or template.
2. Inside the Query Loop, insert the "Results" block from the block inserter.
3. Put the blocks you want to show only when posts are found inside the Results block.

Example layout:

* Query Loop
 * Results: heading "Latest Posts" and a short paragraph
 * Post Template: your post layout
 * Query No Results: paragraph "No posts found"

Visitors see the "Latest Posts" heading only when there are posts to show.

The plugin checks GitHub releases for updates and shows them on the Plugins screen.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/query-results-block/`, or install the zip from Plugins > Add New Plugin > Upload Plugin.
2. Activate the plugin through the Plugins screen. The "Results" block is then available inside Query Loop blocks.

== Changelog ==

= 1.1.1 =
* Tested up to WordPress 7.1.

= 1.1.0 =
* Added update checks against GitHub releases, so new versions appear on the Plugins screen.
* Changed internal code to follow the WordPress coding standards. No change to behaviour.

= 1.0.0 =
* Initial release. Adds the Results block for the Query Loop, which shows its inner content only when the query returns posts.
