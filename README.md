# Query Results Block

A WordPress plugin that adds a dynamic inner block for the core/query block. The "Results" block shows its inner blocks only when the parent Query has posts.

## Features

- **Conditional Rendering**: Shows content only when the parent Query block has posts
- **WordPress 6.5+ Compatible**: Built for modern WordPress installations
- **Context Aware**: Uses WordPress block context to access query data
- **Pagination Support**: Works seamlessly with query pagination
- **Clean Integration**: Follows WordPress coding standards and best practices

## Installation

1. Upload the plugin files to `/wp-content/plugins/query-results-block/`
2. Run `npm install` to install dependencies
3. Run `npm run build` to build the JavaScript assets
4. Activate the plugin through the 'Plugins' screen in WordPress

## Usage

1. Add a Query block to your post or page
2. Inside the Query block, add the "Results" block (`qrb/results-if`)
3. Add any blocks inside the Results block that you want to show only when there are posts
4. The Results block content will only render when the query has posts

## Block Details

- **Block Name**: `qrb/results-if`
- **Title**: Results
- **Parent**: `core/query`
- **Context**: Uses `query` and `queryId` from parent Query block

## Development

### Build Commands

- `npm run build` - Build for production
- `npm run dev` - Start development mode with file watching
- `npm run lint:js` - Lint JavaScript files
- `npm run lint:css` - Lint CSS files

### Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js and npm for building assets

## Behavior

- **With Results**: When the parent Query block has posts, the Results block renders its inner content
- **No Results**: When the parent Query block has no posts, the Results block renders nothing
- **Outside Query**: When used outside a Query block, the block renders nothing (no errors)
- **Pagination**: Works correctly with paginated queries using the query context

## Use Cases

Perfect for creating conditional content that should only appear when a query has results:

- Custom headers or introductory text above post listings
- Special styling or containers for post results
- Call-to-action buttons that should only appear with results
- Any content that should be hidden when no posts are found

Use WordPress's built-in "Query No Results" block for displaying content when there are no results.
