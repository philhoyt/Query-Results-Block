import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import metadata from './block.json';

registerBlockType( metadata.name, {
	...metadata,
	edit: () => {
		return (
			<div>
				<InnerBlocks />
			</div>
		);
	},
	save: () => {
		return <InnerBlocks.Content />;
	}
} );
