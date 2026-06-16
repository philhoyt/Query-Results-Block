# Knowledge Base — Query Results Block

A per-project lookup table for API constraints, version-specific gotchas, and findings from external docs. Not prose — one line per entry.

Format: `topic — finding — source URL`

## WordPress

- query-no-results render — core does NOT call wp_reset_postdata() after its custom WP_Query; returns content only when post_count is 0 — https://raw.githubusercontent.com/WordPress/wordpress-develop/trunk/src/wp-includes/blocks/query-no-results.php

## Block editor

- block.json `render` field — expects a `file:./render.php` path; a bare function name is silently ignored. Use `render_callback` in register_block_type() for a PHP function instead.

## Third-party libraries

- (none yet)

## Local environment

- (none yet)
