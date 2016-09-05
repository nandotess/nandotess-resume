'use strict';

var gulp = require('gulp'),
	sass = require('gulp-ruby-sass'),
	cssnano = require('gulp-cssnano'),
	uglify = require('gulp-uglify'),
	rename = require('gulp-rename'),
	resolveDependencies = require('gulp-resolve-dependencies'),
	concat = require('gulp-concat'),
	foreach = require('gulp-foreach'),
	path = require('path'),
	sort = require('gulp-sort'),
	wppot = require('gulp-wp-pot'),
	gettext = require('gulp-gettext'),
	jshint = require('gulp-jshint');

// DEFAULT

gulp.task('default', function() {
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-css   to compile style files');
	console.log('gulp compile-js    to compile script files');
	console.log('gulp compile-pot   to compile language files');
	console.log('gulp deploy        to compile style, script and language files');
});

// CSS

gulp.task('compile-css', function() {
	return sass('assets/css/scss/nandotess-resume.scss', { style: 'compact' })
		.pipe(gulp.dest('assets/css'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(cssnano())
		.pipe(gulp.dest('assets/css'));
});

// JS

gulp.task('compile-js', function() {
	return gulp.src('assets/js/src/**/*')
		.pipe(foreach(function(stream, file) {
			return stream
				.pipe(resolveDependencies({
					pattern: /\* @requires [\s-]*(.*\.js)/g
				}))
				.pipe(concat(path.basename(file.path)));
		}))
		.pipe(jshint())
		.pipe(jshint.reporter('fail'))
		.pipe(gulp.dest('assets/js'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js'));
});

// POT

gulp.task('compile-pot', function () {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'nandotess-resume',
			destFile: 'nandotess-resume.pot',
			package: 'nandotess-resume',
			bugReport: 'https://github.com/nandotess/nandotess-resume/issues',
			team: 'Fernando Tessmann <nandotess85@mail.com>'
		}))
		.pipe(gulp.dest('languages'));
});

// DEPLOY

gulp.task('deploy', function() {
	gulp.start('compile-css', 'compile-js', 'compile-pot');
});
