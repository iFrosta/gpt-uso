const {src, dest, watch, series, parallel} = require('gulp')

const sourcemaps = require('gulp-sourcemaps')
const sass = require('gulp-sass')
const concat = require('gulp-concat')
const uglify = require('gulp-uglify-es').default
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const cssnano = require('cssnano')
const imagemin = require('gulp-imagemin')
const babel = require("gulp-babel")
// let browserSync = require("browser-sync").create()

// Global Destination
const dist = './' // Tasks destination
const dev = './' // Dev of project

const files = {
  scssPath: dev + 'css/**/*.scss',
  jsPath: dev + 'js/**/*.js',
  imgPath: dev + 'img/**'
}

function scssTask() {
  return src(files.scssPath)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(dist + 'css/')
    )
}

function jsTask() {
  return src([dist + 'js/changePassSlide.js', dist + 'js/custom.js',])
    .pipe(concat('script.js'))
    .pipe(babel())
    .pipe(uglify())
    .pipe(dest(dist + 'js/'))
}

function imgTask() {
  return src(files.imgPath)
    .pipe(imagemin([
      imagemin.gifsicle({interlaced: true}),
      imagemin.jpegtran({progressive: true}),
      imagemin.optipng({optimizationLevel: 5}),
      imagemin.svgo({
        plugins: [
          {removeViewBox: true},
          {cleanupIDs: false}
        ]
      })
    ]))
    .pipe(dest(dist + '/imgO/'))
}

let cbString = new Date().getTime()

function cacheBustTask() {
  return src([dist + 'index.html'])
    .pipe(replace(/cb=\d+/g, 'cb=' + cbString))
    .pipe(dest(dev))
}


// A simple task to reload the page
function reload() {
  browserSync.reload()
}

// Add browsersync initialization at the start of the watch task
function liveReload() {
  browserSync.init({
    // You can tell browserSync to use this directory and serve it as a mini-server
    server: {
      baseDir: "./src"
    }
    // If you are already serving your website locally using something like apache
    // You can use the proxy setting to proxy that instead
    // proxy: "yourlocal.dev"
  })
  // We should tell gulp which files to watch to trigger the reload
  // This can be html or whatever you're using to develop your website
  // Note -- you can obviously add the path to the Paths object
  watch("src/*.html", reload)
}

// function watchTask() {
//   watch([files.scssPath, dist + '/js/script.js'],
//     parallel(scssTask, jsTask))
// }

function watchTask() {
  watch([dist + 'css/*.scss'],
    parallel(scssTask))
  watch([dist + 'js/custom.js'],
    parallel(jsTask))
}

exports.default = series(
  parallel(scssTask, jsTask),
  // cacheBustTask,
  watchTask
)
