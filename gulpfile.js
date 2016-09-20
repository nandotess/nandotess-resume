'use strict';

var config = {
		slug: 'nandotess-resume',
		bowerDir: './bower_components' ,
		sassPath: './assets/css/scss',
		cssPath: './assets/css',
		jsPath: './assets/js',
		fontsPath: './assets/fonts',
		langDir: './languages' 
	},
	gulp = require('gulp'),
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
	jshint = require('gulp-jshint'),
	jshintStylish = require('jshint-stylish');

// DEFAULT

gulp.task('default', function() {
	console.log('use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-bower to compile bower files');
	console.log('gulp compile-css   to compile style files');
	console.log('gulp compile-js    to compile script files');
	console.log('gulp compile-pot   to compile language files');
	console.log('gulp deploy        to compile style, script and language files');
});

// BOWER

gulp.task('bower-bootstrap', function() { 
	return gulp.src(config.bowerDir + '/bootstrap-sass/assets/fonts/**/*') 
		.pipe(gulp.dest(config.fontsPath)); 
});

gulp.task('bower-font-awesome', function() { 
	return gulp.src(config.bowerDir + '/font-awesome-sass/assets/fonts/**/*') 
		.pipe(gulp.dest(config.fontsPath)); 
});

gulp.task('compile-bower', function() {
	gulp.start('bower-font-awesome', 'bower-bootstrap');
});

// CSS

gulp.task('compile-css', function() {
	return sass(config.sassPath + '/'+ config.slug +'.scss', {
			style: 'compact',
			loadPath: [
				config.sassPath,
				config.bowerDir + '/bootstrap-sass/assets/stylesheets',
				config.bowerDir + '/font-awesome-sass/assets/stylesheets'
			]
		})
		.pipe(gulp.dest(config.cssPath))
		.pipe(rename({suffix:'.min'}))
		.pipe(cssnano())
		.pipe(gulp.dest(config.cssPath));
});

// JS

gulp.task('compile-js', function() {
	return gulp.src(config.jsPath +'/src/'+ config.slug +'.js')
		.pipe(jshint())
		.pipe(jshint.reporter(jshintStylish))
		.pipe(foreach(function(stream, file) {
			return stream
				.pipe(resolveDependencies({
					pattern: /\* @requires [\s-]*(.*\.js)/g
				}))
				.pipe(concat(path.basename(file.path)));
		}))
		.pipe(gulp.dest(config.jsPath))
		.pipe(rename({ suffix: '.min' }))
		.pipe(uglify())
		.pipe(gulp.dest(config.jsPath));
});

// POT

gulp.task('compile-pot', function () {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: config.slug,
			destFile: config.slug +'.pot',
			package: config.slug,
			bugReport: 'https://github.com/nandotess/'+ config.slug +'/issues',
			team: 'Fernando Tessmann <nandotess85@mail.com>'
		}))
		.pipe(gulp.dest(config.langDir));
});

// DEPLOY

gulp.task('deploy', function() {
	gulp.start('compile-bower', 'compile-css', 'compile-js', 'compile-pot');
});
