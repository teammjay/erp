const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const cssmin = require('gulp-cssmin');
const sourcemaps = require('gulp-sourcemaps');

gulp.task('styles', function () {
    return gulp.src('public/assets/scss/material-dashboard.scss') // Source folder containing SCSS files
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(sass().on('error', sass.logError)) // Compile SCSS to CSS and log errors
        .pipe(cssmin()) // Minify the concatenated CSS
        .pipe(sourcemaps.write('.')) // Concatenate all CSS files into one file
        .pipe(gulp.dest('public/assets/css/')); // Destination folder for the output file
});

gulp.task('default', gulp.series('styles'));
