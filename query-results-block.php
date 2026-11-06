<?php
/**
 * Plugin Name:       Query Results Block
 * Description:       Adds an inner block for core/query that shows content only when the parent Query has posts.
 * Plugin URI:        https://github.com/philhoyt/Query-Results-Block
 * Version:           1.1.1
 * Requires at least: 6.6
 * Requires PHP:      7.4
 * Tested up to:      7.1
 * Author:            Phil Hoyt
 * Author URI:        https://philhoyt.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       query-results-block
 *
 * @package Query_Results_Block
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Self-hosted update checks via GitHub releases.
if ( file_exists( __DIR__ . '/lib/plugin-update-checker/plugin-update-checker.php' ) ) {
	require_once __DIR__ . '/lib/plugin-update-checker/plugin-update-checker.php';

	$qrb_update_checker = YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
		'https://github.com/philhoyt/Query-Results-Block/',
		__FILE__,
		'query-results-block'
	);

	// Install updates from the zip attached to each GitHub release (GitHub API only).
	$qrb_vcs_api = $qrb_update_checker->getVcsApi();
	if ( method_exists( $qrb_vcs_api, 'enableReleaseAssets' ) ) {
		// Only a .zip asset counts, and a release without one is skipped. The
		// default PREFER_RELEASE_ASSETS falls back to GitHub's source archive,
		// which installs as <Repo>-<tag>/ and breaks the plugin directory.
		// Without the filter the first asset wins, GitHub lists assets by name,
		// so an asset named ahead of query-results-block.zip would be installed (PCLZIP_ERR_BAD_FORMAT).
		$qrb_vcs_api->enableReleaseAssets( '/\.zip$/', $qrb_vcs_api::REQUIRE_RELEASE_ASSETS );
	}
}

/**
 * Initialize the plugin.
 */
function qrb_init() {
	// Register the block with explicit render callback.
	register_block_type(
		__DIR__ . '/build',
		array(
			'render_callback' => 'qrb_render_results_block',
		)
	);
}
add_action( 'init', 'qrb_init' );

/**
 * Render callback for the Results block.
 *
 * Mirrors the core/query-no-results implementation but with opposite logic.
 *
 * @since 1.0.0
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block content.
 * @param WP_Block $block      Block instance.
 * @return string Rendered block content.
 */
function qrb_render_results_block( $attributes, $content, $block ) {
	// Get page number from query parameters, mirroring core implementation.
	$page_key = isset( $block->context['queryId'] ) ? 'query-' . $block->context['queryId'] . '-page' : 'query-page';
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only pagination param, cast to int; mirrors core/query-no-results.
	$page = empty( $_GET[ $page_key ] ) ? 1 : (int) $_GET[ $page_key ];

	// Override the custom query with the global query if needed.
	$use_global_query = ( isset( $block->context['query']['inherit'] ) && $block->context['query']['inherit'] );
	if ( $use_global_query ) {
		global $wp_query;
		$query = $wp_query;
	} else {
		// Guard: Check if we have query context for custom queries.
		if ( empty( $block->context['query'] ) ) {
			return '';
		}

		$query_args = build_query_vars_from_query_block( $block, $page );
		$query      = new WP_Query( $query_args );
	}

	// Opposite of core/query-no-results: return empty if NO posts.
	if ( 0 === $query->post_count ) {
		return '';
	}

	// Return content when there ARE posts (opposite of no-results block).
	// Wrap in a div with block wrapper attributes for proper styling.
	$wrapper_attributes = get_block_wrapper_attributes();
	return sprintf(
		'<div %1$s>%2$s</div>',
		$wrapper_attributes,
		$content
	);
}
