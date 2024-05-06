import gulp from 'gulp'
import concat from 'gulp-concat'
import autoprefixer from 'gulp-autoprefixer'
import uglify from 'gulp-uglify'
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);

gulp.task('taskPHP', async function() {
  return gulp
    .src('dev/**/*.php')
    .pipe(gulp.dest('dist/'))
})

gulp.task('taskHTML', async function() {
  return gulp
    .src('dev/**/*.php')
    .pipe(gulp.dest('dist/'))
})

gulp.task('taskAssets', async function() {
  return gulp
    .src('dev/assets/**/*.*')
    .pipe(gulp.dest('dist/assets/'))
})

gulp.task('taskCSS', async function() {
  return gulp
		.src("dev/scss/**/*.scss")
		.pipe(
			sass({
				outputStyle: "expanded",
			})
		)
		.pipe(
			autoprefixer({
				overrideBrowserslist: ["last 3 versions"],
				cascade: false,
			})
		)
		.pipe(gulp.dest("dist/css/"))
})

gulp.task('taskJS', async function() {
  return gulp
    .src('dev/js/**/*.js')
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest('dist/js/'))
})

gulp.task('watch', async function() {
  gulp.watch('dev/scss/**/*.scss', gulp.series('taskCSS'))
  gulp.watch('dev/js/**/*.js', gulp.series('taskJS'))
  gulp.watch('dev/**/*.php', gulp.series('taskPHP'))
  gulp.watch('dev/**/*.html', gulp.series('taskHTML'))
  gulp.watch('dev/assets/**/*.*', gulp.series('taskAssets'))
})

gulp.task(
	"default",
	gulp.parallel(
		"taskCSS",
		"taskJS",
    "taskPHP",
    "taskHTML",
    "taskAssets",
    "watch",
	)
)
