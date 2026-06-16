<?php
/**
 * Tests for the Results block render callback.
 *
 * @package Query_Results_Block
 */

/**
 * @covers ::qrb_render_results_block
 */
class Test_QRB_Render extends WP_UnitTestCase {

	/**
	 * Block markup for a custom Query Loop wrapping the Results block.
	 *
	 * @param array $query Query attributes for the core/query block.
	 * @return string Serialized block markup.
	 */
	private function query_markup( array $query ): string {
		$attrs = wp_json_encode(
			array(
				'queryId' => 1,
				'query'   => $query,
			)
		);

		return '<!-- wp:query ' . $attrs . ' -->'
			. '<div class="wp-block-query">'
			. '<!-- wp:qrb/results-if -->'
			. '<!-- wp:paragraph --><p>RESULTS_MARKER</p><!-- /wp:paragraph -->'
			. '<!-- /wp:qrb/results-if -->'
			. '</div>'
			. '<!-- /wp:query -->';
	}

	/**
	 * The block registers on init with a render callback.
	 */
	public function test_block_is_registered_with_render_callback(): void {
		$block = WP_Block_Type_Registry::get_instance()->get_registered( 'qrb/results-if' );

		$this->assertNotNull( $block, 'Block qrb/results-if should be registered.' );
		$this->assertTrue( is_callable( $block->render_callback ), 'Block should have a callable render callback.' );
	}

	/**
	 * Inner content is shown when the custom query has matching posts.
	 */
	public function test_shows_content_when_query_has_posts(): void {
		self::factory()->post->create_many( 3 );

		$output = do_blocks(
			$this->query_markup(
				array(
					'perPage'  => 3,
					'postType' => 'post',
					'inherit'  => false,
				)
			)
		);

		$this->assertStringContainsString( 'RESULTS_MARKER', $output, 'Content should render when posts exist.' );
	}

	/**
	 * Inner content is hidden when the custom query returns no posts.
	 */
	public function test_hides_content_when_query_has_no_posts(): void {
		// No posts created; an impossible search guarantees zero results even if other tests seeded data.
		$output = do_blocks(
			$this->query_markup(
				array(
					'perPage'  => 3,
					'postType' => 'post',
					'inherit'  => false,
					'search'   => 'zzz_no_such_post_zzz_99999',
				)
			)
		);

		$this->assertStringNotContainsString( 'RESULTS_MARKER', $output, 'Content should be hidden when no posts match.' );
	}

	/**
	 * The callback returns an empty string when no query context is present.
	 */
	public function test_returns_empty_without_query_context(): void {
		$block          = new stdClass();
		$block->context = array();

		$result = qrb_render_results_block( array(), '<p>RESULTS_MARKER</p>', $block );

		$this->assertSame( '', $result, 'Callback should return empty string without query context.' );
	}
}
