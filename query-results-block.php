<?php
/**
 * Plugin Name: Query Results Block
 * Description: Adds an inner block for core/query that shows content only when the parent Query has posts.
 *  * Plugin URI:        https://github.com/philhoyt/CPT-Taxonomy-Syncer
 * Version: 1.0.0
 * Author:            Phil Hoyt
 * Author URI:        https://philhoyt.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: query-results-block
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initialize the plugin.
 */
function qrb_init() {
	// Register the block with explicit render callback.
	register_block_type( __DIR__ . '/build', array(
		'render_callback' => 'qrb_render_results_block',
	) );
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
	$page     = empty( $_GET[ $page_key ] ) ? 1 : (int) $_GET[ $page_key ];

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
	if ( $query->post_count === 0 ) {
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
