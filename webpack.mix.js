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
    .copyDirectory('node_modules/mdbootstrap', 'public/mdbootstrap')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/css', 'public/font-awesome/css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/font-awesome/webfonts')
    .sass('resources/sass/main.scss', 'public/css');
