const {
  src,
  dest,
  series,
  parallel,
  watch
} = require('gulp');

// 第一個任務 console 
function tasks(cb){
console.log('gulp 第一個任務');
cb();
}

exports.do = tasks;

//第二個任務 搬家
function move(){
 return src('style.css').pipe(dest('css/'));
}

exports.copy = move; 


// sass編譯
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps'); // 在瀏覽器開發者工具可追蹤 sass 引用檔案來源

function sassstyle(){
 return src('src/sass/*.scss') // 
 .pipe(sourcemaps.init()) 
 .pipe(sass().on('error', sass.logError))
 .pipe(sourcemaps.write())
 .pipe(autoprefixer({ // 注意順序
          cascade: false
      })) // 解決 css 跨瀏覽器問題
 .pipe(dest('dist/css/' , 'src/sass/')) // 目的地路徑
}

exports.style =sassstyle;

// html template

const fileinclude = require('gulp-file-include');

function html(){
 return src('src/*.html') // 來源路徑
 .pipe(fileinclude({
  prefix: '@@',
  basepath: '@file'
   }))
 .pipe(dest('./dist')); // 目的地路徑
}

exports.template = html;


// babel：將 ES6 轉譯成 ES5，加入以下 jsmini

const babel = require('gulp-babel');

function babel5() {
  return src('dev/js/*.js')
      .pipe(babel({
          presets: ['@babel/env']
      }))
      .pipe(dest('js'));
}

// js uglify

const uglify = require('gulp-uglify');

function jsmini(){
 return src('src/js/*.js')
 .pipe(babel({
          presets: ['@babel/env']
      })) // ES6 轉譯成 ES5："use strict"; const -> var
 .pipe(uglify())
 .pipe(dest('dist/js'))
}

exports.js =jsmini;


//壓縮圖片
const imagemin = require('gulp-imagemin');

function min_images(){
  return src('src/images/**/*.*')
  .pipe(imagemin([
      imagemin.mozjpeg({quality: 70, progressive: true}) // 壓縮品質      quality越低 -> 壓縮越大 -> 品質越差 
  ]))
  .pipe(dest('dist/images'))
}

exports.img =min_images;


//php搬運

//frontend
function move_frontend_php(){
  return src("src/Frontend/*.php").pipe(dest("dist/Frontend"));
}
exports.frontend_php = move_frontend_php;

//backend
function move_backend_php(){
  return src("src/backend/*.php").pipe(dest("dist/backend"));
}
exports.backend_php = move_backend_php;

//Lib
function move_Lib_php(){
  return src("src/Lib/*.php").pipe(dest("dist/Lib"));
}
exports.Lib_php = move_Lib_php;



// watch
function watchall(){
 watch(['src/*.html' , 'src/layout/*.html'] , html);
 watch(['src/sass/*.scss' , 'src/sass/**/*.scss'] , sassstyle)
 watch('src/js/*.js' , jsmini)
 watch('src/Frontend/*.php' , move_frontend_php)
 watch('src/backend/*.php' , move_backend_php)
 watch('src/Lib/*.php' , move_Lib_php)
}

exports.w = watchall;


// 刪除舊檔案：會用在打包的第一個步驟
const clean = require('gulp-clean');

function clear() {
return src('dist' ,{ read: false ,allowEmpty: true })//不去讀檔案結構，增加刪除效率  / allowEmpty : 允許刪除空的檔案
.pipe(clean({force: true})); //強制刪除檔案 
}

exports.c = clear;

// 瀏覽器整合
const browserSync = require('browser-sync');
const reload = browserSync.reload;


function browser(done) {
  browserSync.init({
      server: {
          baseDir: "./dist",
          index: "index.html"
      },
      port: 3000
  });
  watch(['src/*.html' , 'src/layout/*.html'] , html).on("change", reload)
  watch(['src/sass/*.scss' , 'src/sass/**/*.scss'] , sassstyle).on("change", reload)
  watch(['src/js/*.js'] , jsmini).on("change", reload);
  watch(['src/Frontend/*.php'] , move_frontend_php).on("change", reload);
  watch(['src/backend/*.php'] , move_backend_php).on("change", reload);
  watch(['src/Lib/*.php'] , move_Lib_php).on("change", reload);
  done();
}

exports.default = browser;


// 打包上線

sassstyle | html | jsmini | min_images | move_frontend_php | move_backend_php | move_Lib_php
// 執行順序用, 隔開，同時執行用 parallel() 包起來
exports.package = series(clear, parallel(sassstyle, html, jsmini, move_frontend_php, move_backend_php, move_Lib_php), min_images);