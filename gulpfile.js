const gulp         = require('gulp');
const rtlcss       = require('gulp-rtlcss');
const sass         = require('gulp-sass');
const sourcemaps   = require('gulp-sourcemaps');
const jshint       = require('gulp-jshint');
const concat       = require('gulp-concat');
const uglify       = require('gulp-uglify');
const sort         = require('gulp-sort');
const wppot        = require('gulp-wp-pot');
const gettext      = require('gulp-gettext');
const plumber      = require('gulp-plumber');
const autoprefixer = require('gulp-autoprefixer');
const gutil        = require('gulp-util');
const rename       = require('gulp-rename');
const minify       = require('gulp-minify-css');
const map          = require('map-stream');
const browserlist  = ['last 2 version', '> 1%'];

const errorreporter = map(function(file, cb) {
	if (file.jshint.success) {
		return cb(null, file);
	}

	console.log('JSHINT fail in', file.path);

	file.jshint.results.forEach(function (result) {
		if (!result.error) {
			return;
		}

		const err = result.error
		console.log(`  line ${err.line}, col ${err.character}, code ${err.code}, ${err.reason}`);
	});

	cb(null, file);
});

gulp.task('default', function() {
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-css    to compile the scss to css');
	console.log('gulp compile-js     to compile the js to min.js');
	console.log('gulp wordpress-lang to compile the nandotess-resume.pot, en_EN.po and en_EN.mo');
});

gulp.task('styles', function () {
	return gulp.src('assets/css/scss/nandotess-resume.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compact',
			includePaths: ['assets/css/scss']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(sourcemaps.write('maps'))
		.pipe(gulp.dest('assets/css'))
});

gulp.task('styles-rtl', function () {
	return gulp.src('assets/css/scss/nandotess-resume.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sass({
			outputStyle: 'compact',
			includePaths: ['assets/css/scss']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(rtlcss())
		.pipe(rename({
			suffix: '-rtl'
		}))
		.pipe(gulp.dest('assets/css'))
});

gulp.task('vendor-styles', function () {
	return gulp.src('assets/css/vendor/*.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sass({
			outputStyle: 'compact',
			includePaths: ['assets/css/vendor']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(gulp.dest('assets/css/vendor'))
});

gulp.task('vendor-styles-rtl', function () {
	return gulp.src('assets/css/vendor/*.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sass({
			outputStyle: 'compact',
			includePaths: ['assets/css/vendor']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(rtlcss())
		.pipe(rename({
			suffix: '-rtl'
		}))
		.pipe(gulp.dest('assets/css/vendor'))
});

gulp.task('compile-css', ['styles', 'styles-rtl', 'vendor-styles', 'vendor-styles-rtl']);

gulp.task('js', function() {
	return gulp.src('assets/js/src/**/*.js')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(jshint())
		//.pipe(errorreporter)
		.pipe(concat('nandotess-resume.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js'))
});

gulp.task('vendor-bootstrap-js', function() {
	return gulp.src('assets/js/vendor/bootstrap.js')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(jshint())
		//.pipe(errorreporter)
		.pipe(concat('bootstrap.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js/vendor'))
});

gulp.task('vendor-skip-link-focus-fix-js', function() {
	return gulp.src('assets/js/vendor/skip-link-focus-fix.js')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(jshint())
		//.pipe(errorreporter)
		.pipe(concat('skip-link-focus-fix.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js/vendor'))
});

gulp.task('compile-js', ['js', 'vendor-bootstrap-js', 'vendor-skip-link-focus-fix-js']);

gulp.task('wordpress-pot', function() {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'nandotess-resume',
			package: 'nandotess-resume',
			team: 'Fernando Tessmann <nandotess85@mail.com>'
		}))
		.pipe(gulp.dest('languages/nandotess-resume.pot'))
});

gulp.task('wordpress-po', function() {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'nandotess-resume',
			package: 'nandotess-resume',
			team: 'Fernando Tessmann <nandotess85@mail.com>'
		}))
		.pipe(gulp.dest('languages/en_EN.po'))
});

gulp.task('wordpress-po-mo', ['wordpress-po'], function() {
	return gulp.src('languages/en_EN.po')
		.pipe(gettext())
		.pipe(gulp.dest('languages'))
});

gulp.task('wordpress-lang', (['wordpress-pot', 'wordpress-po-mo']));
