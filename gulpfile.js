var gulp = require( 'gulp'),
    browserSync = require( 'browser-sync'),
    sass = require('gulp-sass');

// Configure browserSync
gulp.task('browser-sync', function () {
  var files = [
    './*.css',
    './*.php',
    './**/*.js'
  ];

  // Initialize browserSync with PHP server
  browserSync.init(files, {
    proxy: 'http://localhost:8888/trucking/'
  });
});

// Configure Sass task
gulp.task('sass', function () {
  return gulp.src('scss/*.scss')
  .pipe(sass())
  // .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
  .on('error', function (err) {
    console.log(err.toString());
    this.emit('end');
    })
  .pipe(gulp.dest('stylesheets/'))
  .pipe(browserSync.reload({
    stream: true
    }));
});


// Create the default task that can be called using 'gulp'
// The task will process sass, run browserSync and start watching for changes
gulp.task('default', ['sass', 'browser-sync'], function() {
  gulp.watch('scss/*.scss', ['sass']);
});
