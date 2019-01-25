//发布的目录
var assets = '../../public/assets_default';
var gulp = require('gulp');
var less = require('gulp-less');

// less解析
gulp.task('less', function(){
    gulp.src('src/less/*.less')
        .pipe(less())
        .pipe(gulp.dest(assets + '/css/'))
})

gulp.task('images', function(){
    gulp.src('src/images/**/*')
        .pipe(gulp.dest(assets + '/images'))
})

// 自动更新变化
gulp.task('watch',function(){
    gulp.watch('src/less/*.less', ['less']);
    gulp.watch('src/images/**/*', ['images']);
});

gulp.task('default', ['less', 'images']);


//dev、test、prod各环境的配置,publish中使用,可根据不同情况做差异配置
gulp.task('prod', ['default']);
gulp.task('test', ['default']);
gulp.task('dev', ['default']);
