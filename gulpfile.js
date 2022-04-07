'use strict';

var gulp = require('gulp');
var browserSync = require('browser-sync').create();

gulp.task('css', function () {
    var sass = require('gulp-sass')(require('sass'));
    var postcss = require('gulp-postcss');
    var autoprefixer = require('autoprefixer');

    return gulp.src('./asset/sass/*.scss')
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['node_modules/susy/sass']
        }).on('error', sass.logError))
        .pipe(postcss([
            autoprefixer()
        ]))
        .pipe(gulp.dest('./asset/css'))
        .pipe(browserSync.stream());
});

gulp.task('css:watch', function () {
    browserSync.init({
        proxy: "localhost:8080"
    });

    gulp.watch('./asset/sass/*.scss', gulp.series('css'));
});
