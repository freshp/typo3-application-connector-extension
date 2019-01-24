'use strict';

let autoprefixer = require( 'gulp-autoprefixer' );
let del = require( 'del' );
let gulp = require( 'gulp' );
let runSequence = require( 'run-sequence' );
let sass = require( 'gulp-sass' );
let concat = require( 'gulp-concat' );
let cleanCSS = require( 'gulp-clean-css' );

const AUTOPREFIXER_BROWSERS = [
	'ie >= 10',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4.4',
	'bb >= 10'
];

gulp.task( 'styles', function() {
	return gulp.src( [
		'./node_modules/bootstrap/dist/css/bootstrap.css',
		'./Resources/Private/Scss/styles.scss'
	] )
		.pipe( sass( {
			outputStyle: 'nested',
			precision: 10,
			includePaths: [ '.' ],
			onError: console.error.bind( console, 'Sass error:' )
		} ) )
		.pipe( autoprefixer( { browsers: AUTOPREFIXER_BROWSERS } ) )
		.pipe( cleanCSS( { compatibility: 'ie8' } ) )
		.pipe( concat( 'styles.css' ) )
		.pipe( gulp.dest( './Resources/Public/Css' ) )
} );

gulp.task( 'external-scripts', function() {
	return gulp.src( [
		'./node_modules/bootstrap/dist/js/bootstrap.min.js',
		'./node_modules/jquery/dist/jquery.min.js',
	] )
		.pipe( gulp.dest( './Resources/Public/Javascript' ) )
} );

gulp.task( 'clean', () => del( [ './Resources/Public/Css', './Resources/Public/Javascript' ] ) );
gulp.task( 'default', [ 'clean' ], function() {
	runSequence(
		'styles',
		'external-scripts',
	);
} );
