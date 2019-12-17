const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .copyDirectory('node_modules/mdbootstrap/js', 'public/js/mdbootstrap')
    .copyDirectory('node_modules/font-awesome/css', 'public/font-awesome/css')
    .copyDirectory('node_modules/font-awesome/fonts', 'public/font-awesome/fonts')
    .sass('resources/sass/main.scss', 'public/css')
    .copy('node_modules/mdbootstrap/css/bootstrap.min.css', 'public/css')
    .copy('node_modules/mdbootstrap/css/mdb.min.css', 'public/css');
