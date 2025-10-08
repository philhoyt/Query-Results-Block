import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import metadata from './block.json';

const TEMPLATE = [
	[
		'core/paragraph',
		{
			placeholder: __( 'Add text or blocks that will display when a query returns results.', 'query-results-block' ),
		},
	],
];

registerBlockType( metadata.name, {
	...metadata,
	edit: () => {
		return (
			<div>
				<InnerBlocks template={ TEMPLATE } />
			</div>
		);
	},
	save: () => {
		return <InnerBlocks.Content />;
	}
} );
