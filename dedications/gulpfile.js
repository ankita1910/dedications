var gulp = require('gulp'),
	uglify = require('gulp-uglify'),
	less = require('gulp-less'),
	plumber = require('gulp-plumber');

gulp.task('minifyJS', function(){
	gulp.src('JavaScript/*.js')
		.pipe(plumber())
		.pipe(uglify())
		.pipe(gulp.dest('JavaScript/min.js'))
});

gulp.task('less-to-css', function(){
    return gulp.src('JavaScript/Home.less')
    	.pipe(plumber())
        .pipe(less())
        .pipe(gulp.dest('source/css'));
});

gulp.task('watch', function(){
	gulp.watch('JavaScript/*.js', ['minifyJS','less-to-css'])
});

gulp.task('default', ['watch']);