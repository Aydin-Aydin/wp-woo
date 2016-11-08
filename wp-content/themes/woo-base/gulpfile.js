var gulp = require('gulp');
var livereload = require('gulp-livereload')
var uglify = require('gulp-uglifyjs');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');




gulp.task('imagemin', function () {
    return gulp.src('./wp-content/themes/woo-base/images/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('./wp-content/themes/woo-base/images'));
});


gulp.task('sass', function () {
  gulp.src('./wp-content/themes/woo-base/sass/**/*.scss')
    .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./wp-content/themes/woo-base'));
});


gulp.task('uglify', function() {
  gulp.src('./wp-content/themes/woo-base/lib/*.js')
    .pipe(uglify('woo-base.min.js'))
    .pipe(gulp.dest('./wp-content/themes/woo-base/js'))
});

gulp.task('watch', function(){
    livereload.listen();

    gulp.watch('./wp-content/themes/woo-base/sass/**/*.scss', ['sass']);
    gulp.watch('./wp-content/themes/woo-base/lib/*.js', ['uglify']);
    gulp.watch(['./wp-content/themes/woo-base/style.css', './wp-content/themes/woo-base/*.php', './wp-content/themes/woo-base/js/*.js', './wp-content/themes/woo-base/parts/**/*.php'], function (files){
        livereload.changed(files)
    });
});