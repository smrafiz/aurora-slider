/**
 * Gulpfile.
 *
 * @author S.M. Rafiz <https://github.com/smrafiz>
 * @version 1.0.0
 */

/**
 * Load Gulp Configuration.
 *
 */
const config = require('./aurora.config.js');

/**
 * Load Plugins.
 *
 * Load gulp plugins and passing them semantic names.
 */
const gulp = require('gulp'); // Gulp of-course.

// CSS related plugins.
const sass = require('gulp-sass'); // Gulp plugin for Sass compilation.
const minifycss = require('gulp-uglifycss'); // Minifies CSS files.
const autoprefixer = require('gulp-autoprefixer'); // Autoprefixing magic.
const mmq = require('gulp-merge-media-queries'); // Combine matching media queries into one.
var beautify = require('gulp-cssbeautify'); // Generates beautiful CSS

// JS related plugins.
const concat = require('gulp-concat'); // Concatenates JS files.
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const webpackConfig = require('./webpack.config.js');

// Image related plugins.
const imagemin = require('gulp-imagemin'); // Minify PNG, JPEG, GIF and SVG images with imagemin.

// Utility related plugins.
const rename = require('gulp-rename'); // Renames files E.g. style.css -> style.min.css.
const lineec = require('gulp-line-ending-corrector'); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings).
const filter = require('gulp-filter'); // Enables you to work on a subset of the original files by filtering them using a glob.
const sourcemaps = require('gulp-sourcemaps'); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css).
const notify = require('gulp-notify'); // Sends message notification to you.
const browserSync = require('browser-sync').create(); // Reloads browser and injects CSS. Time-saving synchronized browser testing.
const wpPot = require('gulp-wp-pot'); // For generating the .pot file.
const sort = require('gulp-sort'); // Recommended to prevent unnecessary changes in pot-file.
const cache = require('gulp-cache'); // Cache files in stream for later use.
const remember = require('gulp-remember'); //  Adds all the files it has ever seen back into the stream.
const plumber = require('gulp-plumber'); // Prevent pipe breaking caused by errors from gulp plugins.
const newer = require('gulp-newer'); // Passing through only those source files that are newer than corresponding destination files.
const del = require('del'); // Deletes files and folders.
const beep = require('beepbeep');

// Build related plugins
const zip = require('gulp-zip');

/**
 * Custom Error Handler.
 *
 * @param Mixed err
 */
const errorHandler = (r) => {
	notify.onError('❌  ===> ERROR: <%= error.message %>')(r);
	beep();
};

/**
 * Task: `browser-sync`.
 *
 * Live Reloads, CSS injections, Localhost tunneling.
 * @link http://www.browsersync.io/docs/options/
 *
 * @param {Mixed} done Done.
 */
const browsersync = (done) => {
	browserSync.init({
		proxy: config.projectURL,
		open: config.browserAutoOpen,
		injectChanges: config.injectChanges,
		watchEvents: [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ]
	});
	done();
};

// Helper function to allow browser reload with Gulp 4.
const reload = (done) => {
	browserSync.reload();
	done();
};

/**
 * Task: `styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 */
gulp.task('styles', () => {
	return gulp
		.src([ config.styleSRC, config.styleAdminSRC ], { allowEmpty: true })
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on('error', sass.logError)
		.pipe(autoprefixer(config.BROWSERS_LIST))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(sourcemaps.write({ includeContent: true }))
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(config.styleDestination))
		.pipe(filter('**/*.css')) // Filtering stream to only css files.
		.pipe(browserSync.stream()) // Reloads style.css if that is enqueued.
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifycss({ maxLineLen: 10 }))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(config.styleDestination))
		.pipe(filter('**/*.css')) // Filtering stream to only css files.
		.pipe(browserSync.stream()) // Reloads style.min.css if that is enqueued.
		.pipe(notify({ message: '✅  \n===> STYLES — completed!', onLast: true }));
});

/**
 * Task: `customJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 */
gulp.task('customJS', () => {
	return gulp
		.src(config.jsCustomSRC, { since: gulp.lastRun('customJS') }) // Only run on changed files.
		.pipe(plumber(errorHandler))
		.pipe(remember(config.jsCustomSRC)) // Bring all files back to stream.
		.pipe(concat(config.jsCustomFile + '.js'))
		.pipe(webpackStream(webpackConfig), webpack)
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(config.jsCustomDestination))
		.pipe(notify({ message: '✅  \n===> CUSTOM JS — completed!', onLast: true }));
});

/**
 * Task: `images`.
 *
 * Minifies PNG, JPEG, GIF and SVG images.
 *
 * This task does the following:
 *     1. Gets the source of images raw folder
 *     2. Minifies PNG, JPEG, GIF and SVG images
 *     3. Generates and saves the optimized images
 *
 * This task will run only once, if you want to run it
 * again, do it with the command `gulp images`.
 *
 * Read the following to change these options.
 * @link https://github.com/sindresorhus/gulp-imagemin
 */
gulp.task('images', () => {
	return (
		del('./assets/images/**/*.db'),
		gulp
			.src(config.imgSRC)
			.pipe(newer(config.imgSRC))
			.pipe(
				cache(
					imagemin(
						[
							imagemin.gifsicle({ interlaced: true }),
							imagemin.jpegtran({ progressive: true }),
							imagemin.optipng({ optimizationLevel: 3 }), // 0-7 low-high.
							imagemin.svgo({
								plugins: [ { removeViewBox: true }, { cleanupIDs: false } ]
							})
						],
						{
							verbose: true
						}
					)
				)
			)
			.pipe(gulp.dest(config.imgDST))
			.pipe(notify({ message: '✅  ===> IMAGES — completed!', onLast: true }))
	);
});

/**
 * Task: `clear-images-cache`.
 *
 * Deletes the images cache. By running the next "images" task,
 * each image will be regenerated.
 */
gulp.task('clearCache', function(done) {
	return cache.clearAll(done);
});

/**
 * WP POT Translation File Generator.
 *
 * This task does the following:
 * 1. Gets the source of all the PHP files
 * 2. Sort files in stream by path or any custom sort comparator
 * 3. Applies wpPot with the variable set at the top of this file
 * 4. Generate a .pot file of i18n that can be used for l10n to build .mo file
 */
gulp.task('translate', () => {
	return gulp
		.src(config.watchPhp)
		.pipe(sort())
		.pipe(
			wpPot({
				domain: config.textDomain,
				package: config.packageName,
				bugReport: config.bugReport,
				lastTranslator: config.lastTranslator,
				team: config.team
			})
		)
		.pipe(gulp.dest(config.translationDestination + '/' + config.translationFile))
		.pipe(notify({ message: '✅  \n===> TRANSLATE — completed!', onLast: true }));
});

/**
 * Clean Task.
 *
 * Delete files and folders
 */
gulp.task('clean', () => {
	return del(config.build + '**/*'), del(config.buildFinalZip + '**/*'), del('./assets/images/**/*.db');
});

/**
 * Build files Task.
 *
 * Build files and folders in the Build directory
 */
gulp.task('buildVendor', () => {
	return gulp
		.src(config.buildVendorSRC, {
			base: 'vendor',
			dot: true
		})
		.pipe(gulp.dest(config.buildVendorDest))
		.pipe(notify({ message: '✅  Copy from buildVendor complete', onLast: true }));
});

/**
 * Build files Task.
 *
 * Build files and folders in the Build directory
 */
gulp.task('buildFiles', () => {
	return gulp
		.src(config.buildInclude)
		.pipe(gulp.dest(config.build))
		.pipe(notify({ message: '✅  Copy from buildFiles complete', onLast: true }));
});

/**
 * Build images Task.
 *
 * Build images in the Build directory
 */
gulp.task('buildImages', () => {
	return gulp
		.src([ 'assets/images/**/*', '!assets/images/raw/**' ])
		.pipe(gulp.dest(config.build + 'assets/images/'))
		.pipe(notify({ message: '✅  Images copied to dist folder', onLast: true }));
});

/**
 * Build Zip Task.
 *
 * Build Zip from the Build directory in root
 */
gulp.task('buildZip', () => {
	return gulp
		.src(config.build + '/**/*', {
			dot: true
		})
		.pipe(zip(config.projectName + '.zip'))
		.pipe(gulp.dest(config.buildFinalZip))
		.pipe(notify({ message: '✅  Zip task complete', onLast: true }));
});

/**
 * Build files from scratch Task.
 *
 * Build final Zip file from the Build directory in root
 */
gulp.task(
	'build',
	gulp.series('clean', 'styles', 'customJS', 'translate', 'buildVendor', 'buildFiles', 'buildImages', function(done) {
		done();
	})
);

/**
 * Build Zip from scratch Task.
 *
 * Build final Zip file from the Build directory in root
 */
gulp.task(
	'buildAll',
	gulp.series(
		'clean',
		'styles',
		'customJS',
		'translate',
		'buildVendor',
		'buildFiles',
		'buildImages',
		'buildZip',
		function(done) {
			done();
		}
	)
);

/**
 * Watch Tasks.
 *
 * Watches for file changes and runs specific tasks.
 */
gulp.task(
	'run',
	gulp.parallel('styles', 'customJS', 'images', browsersync, () => {
		gulp.watch(config.watchStyles, gulp.parallel('styles')); // Reload on SCSS file changes.
		gulp.watch(config.watchJsCustom, gulp.series('customJS', reload)); // Reload on customJS file changes.
		gulp.watch(config.imgSRC, gulp.series('images', reload)); // Reload on customJS file changes.
	})
);
