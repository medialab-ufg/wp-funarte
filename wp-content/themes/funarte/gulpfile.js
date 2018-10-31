'use strict';

/**
 * Defining base paths
 *
 */
var basePaths = {
	node: './node_modules/',                    // Path to node packages
	projectStylesheetFiles: './assets/css/',    // Path to all *.scss files inside css folder and inside them.
	projectJSFiles: './assets/js/'              // Path to all custom JS files.
};

/**
 * Defining requirements
 *
 */
var gulp            = require('gulp'),
	uglify          = require('gulp-uglify'),
	sass            = require('gulp-sass'),
	concat          = require('gulp-concat'),
	cleanCSS        = require('gulp-clean-css'),
	notify          = require('gulp-notify'),
	plumber         = require('gulp-plumber'),
	watch           = require('gulp-watch'),
	browserSync     = require('browser-sync').create(),
	livereload      = require('gulp-livereload');

/**
 * Configure the stylesheet bundle for the application
 *
 */
gulp.task('sass', function () {
	return gulp.src([
		basePaths.projectStylesheetFiles + 'base.scss',
	])
		.pipe(plumber())
		.pipe(sass())
		.pipe(concat('base.min.css'))
		.pipe(cleanCSS())
		.pipe(gulp.dest('./assets/css/'))
		.pipe(notify('Task SASS finished!'))
		.pipe(livereload());
});

/**
 * Configure the javascript bundle for the application
 *
 */
gulp.task('scripts', function () {
	return gulp.src([
		basePaths.projectJSFiles + 'base.js',
	])
		.pipe(plumber())
		.pipe(concat('base.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('./assets/js/'))
		.pipe(notify('Task JS finished!'))
		.pipe(livereload());
});

/**
 * Synchronised browser testing
 *
 */
gulp.task('browser-sync', function() {
	browserSync.init([
		basePaths.projectStylesheetFiles,
		basePaths.projectJSFiles
	]);
});

/**
 * Watch for changes
 *
 */
gulp.task('watch', function () {
	livereload.listen();
	gulp.watch( './assets/css/base.scss', ['sass']);
	gulp.watch( './assets/js/base.js', ['scripts']);
});

/**
 * Default task
 *
 */
gulp.task('default', ['sass', 'scripts','watch']);