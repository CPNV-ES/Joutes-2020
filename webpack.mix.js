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

    //copy mdbootstrap files
    // css
    .copy('node_modules/mdbootstrap/css/bootstrap.min.css', 'public/lib/mdbootstrap/css')
    .copy('node_modules/mdbootstrap/css/mdb.min.css', 'public/lib/mdbootstrap/css')

    // js
    .copy('node_modules/mdbootstrap/js/jquery.min.js', 'public/lib/mdbootstrap/js')
    .copy('node_modules/mdbootstrap/js/popper.min.js', 'public/lib/mdbootstrap/js')
    .copy('node_modules/mdbootstrap/js/bootstrap.min.js', 'public/lib/mdbootstrap/js')
    .copy('node_modules/mdbootstrap/js/mdb.min.js', 'public/lib/mdbootstrap/js')

    //font awesome
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/css', 'public/lib/font-awesome/css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/lib/font-awesome/webfonts')

    //sass
    .sass('resources/sass/main.scss', 'public/css');

