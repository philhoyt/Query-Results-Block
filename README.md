# Query Results Block

[![CI](https://github.com/philhoyt/Query-Results-Block/actions/workflows/ci.yml/badge.svg)](https://github.com/philhoyt/Query-Results-Block/actions/workflows/ci.yml)

Adds a "Results" block for the Query Loop that shows its content only when the query has posts.

It is the counterpart of the core "Query No Results" block. The render callback mirrors that block's logic with the condition reversed: it reads the parent Query Loop's query and page number from block context (including queries that inherit from the current page), runs the query, and prints the inner blocks only when it finds posts.

## Requirements

- WordPress 6.6 or later (tested up to 7.1)
- PHP 7.4 or later

## Installation

1. Download `query-results-block.zip` from the [latest release](https://github.com/philhoyt/Query-Results-Block/releases/latest) and install it through Plugins > Add New Plugin > Upload Plugin, or copy the folder into `wp-content/plugins/`.
2. Activate the plugin. The "Results" block is then available inside Query Loop blocks.

Installed sites pick up later releases through Plugin Update Checker.

## Usage

1. Add a Query Loop block to a post, page, or template.
2. Inside the Query Loop, insert the "Results" block from the block inserter.
3. Put the blocks you want to show only when posts are found inside it.

Example layout:

```
Query Loop
├── Results
│   ├── Heading: "Latest Posts"
│   └── Paragraph: "Our most recent articles"
├── Post Template (your post layout)
└── Query No Results
    └── Paragraph: "No posts found"
```

Visitors see the "Latest Posts" heading only when there are posts to show.

The block (`qrb/results-if`) has no attributes or settings. It can only be inserted inside `core/query`, and it uses the `query` and `queryId` context from that parent.

## Development

```bash
npm install
composer install        # also copies Plugin Update Checker into lib/

npm start               # webpack watch
npm run build           # production build to build/
npm run lint:js
npm run lint:css
composer lint           # phpcs
composer analyse        # phpstan

npm run env:start       # wp-env
npm run test:php        # PHPUnit inside wp-env (tests/phpunit/)
npm run plugin-zip      # build query-results-block.zip
```

CI runs phpcs and phpstan on PHP 7.4 through 8.3, lints and builds the JS and CSS, and runs PHPUnit against wp-env.

## Releases

Bump the version in `query-results-block.php`, `src/block.json`, `package.json`, and `readme.txt` (Stable tag and a `= X.Y.Z =` changelog entry), then push a lowercase `v` tag:

```bash
git tag v1.1.1 && git push origin v1.1.1
```

The release workflow builds the assets, zips `query-results-block.php`, `readme.txt`, `README.md`, `build/`, and `lib/` into `query-results-block.zip`, pulls the matching changelog section out of `readme.txt` for the release notes, and attaches the zip, `readme.txt`, and `README.md` to the GitHub release.

## Limitations

- The block only works inside a Query Loop. It is not offered in the inserter anywhere else.
- It has no conditions of its own beyond "the query has posts". Minimum post counts or per-post-type rules are not supported.

## Changelog

### 1.1.2
- Fixed the update checker so it always installs the release zip, not whichever file GitHub lists first.
- Rewrote the readme files in plain English.

### 1.1.1
- Tested up to WordPress 7.1.

### 1.1.0
- Added update checks against GitHub releases, so new versions appear on the Plugins screen.
- Changed internal code to follow the WordPress coding standards. No change to behaviour.

### 1.0.0
- Initial release. Adds the Results block for the Query Loop, which shows its inner content only when the query returns posts.
