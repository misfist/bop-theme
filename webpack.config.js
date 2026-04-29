/**
 * WordPress dependencies
 */
const path = require( 'path' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

/**
 * Webpack config
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-scripts/#provide-your-own-webpack-config
 */
module.exports = {
	...defaultConfig,
	entry: {
		...defaultConfig.entry,
		style: path.resolve( process.cwd(), 'src/scss', 'index.scss' )
	},
	output: {
		...defaultConfig.output,
		path: path.resolve( __dirname, 'build' ),
	},
};
