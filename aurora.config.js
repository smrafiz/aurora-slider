/**
 * Gulp Configuration File
 *
 * @package Aurora
 */

module.exports = {
	// Project options.
	projectName: 'aurora-slider',
	projectURL: 'http://localhost/wp-latest.test/', // Local project URL.
	productURL: './', // Project URL. Leave it like it is, since our gulpfile.js lives in the root folder.
	browserAutoOpen: false,
	injectChanges: true,

	// Style options.
	styleSRC: './src/scss/frontend.scss', // Path to main .scss file.
	styleAdminSRC: './src/scss/admin.scss', // Path to admin .scss file.
	styleDestination: './assets/css/', // Path to place the compiled CSS file.
	outputStyle: 'expanded', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
	errLogToConsole: true,
	precision: 10,

	// JS Custom options.
	jsCustomSRC: './src/js/*.js', // Path to JS custom scripts folder.
	jsCustomDestination: './assets/js/', // Path to place the compiled JS custom scripts file.
	jsCustomFile: 'frontend', // Compiled JS custom file name. Default set to custom i.e. custom.js.

	// Images options.
	imgSRC: './src/images/**/*.{png,jpg,gif}', // Source folder of images which should be optimized and watched.
	imgDST: './assets/images/', // Destination folder of optimized images. Must be different from the imagesSRC folder.

	// Build options
	build: './dist/',
	buildVendorSRC: 'vendor/**',
	buildVendorDest: './dist/vendor',
	buildInclude: [
		// include common file types
		'**/*.php',
		'**/*.html',
		'**/*.css',
		'**/*.scss',
		'**/*.js',
		'**/*.svg',
		'**/*.ttf',
		'**/*.otf',
		'**/*.eot',
		'**/*.woff',
		'**/*.woff2',
		'**/*.pot',

		// exclude files and folders
		'!node_modules/**/*',
		'!vendor/**/*',
		'!dist/**/*',
		'!aurora.config.js',
		'!webpack.config.js',
		'!gulpfile.js'
	],
	buildFinalZip: './dist/finalProduct/',

	// Watch files paths.
	watchStyles: './src/scss/**/*.scss', // Path to all *.scss files inside css folder and inside them.
	watchJsCustom: './src/js/**/*.js', // Path to all custom JS files.
	watchPhp: './**/*.php', // Path to all PHP files.

	// Translation options.
	textDomain: 'aurora-slider', // Your textdomain here.
	translationFile: 'aurora-slider.pot', // Name of the translation file.
	translationDestination: './languages', // Where to save the translation files.
	packageName: 'Aurora Slider', // Package name.
	bugReport: 'https://aurorathemes.net/contact-us/', // Where can users report bugs.
	lastTranslator: 'S.M. Rafiz <srafiz@aurorathemes.net>', // Last translator Email ID.
	team: 'Aurora Themes <support@aurorathemes.net>', // Team's Email ID.

	// Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
	BROWSERS_LIST: [
		'last 10 version',
		'> 1%',
		'ie >= 9',
		'last 4 Android versions',
		'last 10 ChromeAndroid versions',
		'last 10 Chrome versions',
		'last 10 Firefox versions',
		'last 10 Safari versions',
		'last 10 iOS versions',
		'last 10 Edge versions',
		'last 10 Opera versions'
	]
};
