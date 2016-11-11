var gulp = require('gulp');
var livereload = require('gulp-livereload')
var uglify = require('gulp-uglifyjs');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');




gulp.task('imagemin', function() {
  return gulp.src('./images/*')
    .pipe(imagemin({
      progressive: true,
      svgoPlugins: [{
        removeViewBox: false
      }],
      use: [pngquant()]
    }))
    .pipe(gulp.dest('./images'));
});


gulp.task('sass', function() {
  gulp.src('./sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compressed',
      includePaths: [
        'node_modules/bourbon/app/assets/stylesheets/',
        'node_modules/bourbon-neat/app/assets/stylesheets/',
        'node_modules/normalize.css/'
      ]
    }).on('error', sass.logError))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(sourcemaps.write('./css'))
    .pipe(gulp.dest('./css'));
});


gulp.task('uglify', function() {
  gulp.src(['./lib/*.js', './node_modules/masonry-layout/dist/*.js'])
  .pipe(uglify('woo-base.min.js'))
  .pipe(gulp.dest('./js'))
});

gulp.task('watch', function() {
  livereload.listen();

  gulp.watch('./sass/**/*.scss', ['sass']);
  gulp.watch('./lib/*.js', ['uglify']);
  gulp.watch(['./style.css', './*.php', './js/*.js', './parts/**/*.php'], function(files) {
    livereload.changed(files)
  });
});