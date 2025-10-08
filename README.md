# Query Results Block

A WordPress plugin that adds a "Results" block for the Query Loop. This block shows its content only when the Query Loop has posts to display - the perfect complement to WordPress's built-in "Query No Results" block.

## What It Does

The Results block acts as a container that only appears when your Query Loop finds posts. Think of it as the opposite of the "Query No Results" block that WordPress includes by default.

## Installation

1. Download and upload the plugin files to `/wp-content/plugins/query-results-block/`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. The "Results" block will now be available inside Query Loop blocks

## How to Use

1. **Add a Query Loop block** to your post, page, or template
2. **Inside the Query Loop**, look for the "Results" block in the block inserter
3. **Add the Results block** and place any content inside it that you want to show only when posts are found
4. **Add your conditional content** - headings, text, buttons, or any other blocks

The Results block content will automatically show or hide based on whether the Query Loop has posts.

## Example Usage

```
Query Loop Block
├── Results Block
│   ├── Heading: "Latest Posts"
│   └── Paragraph: "Check out our most recent articles"
├── Post Template (your post layout)
└── Query No Results Block
    └── Paragraph: "No posts found"
```

This way, visitors only see the "Latest Posts" heading when there are actually posts to show.
