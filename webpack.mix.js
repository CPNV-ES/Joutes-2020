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

    // js
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/lib/jquery')
    .copy('resources/js/tournamentView.js', 'public/js')
    .copy('resources/js/tournamentDuplication.js', 'public/js')
    .copy('resources/js/poolShow.js', 'public/js')
    .copy('resources/js/DropZone.js', 'public/js')

    //Bootstrap
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/lib/bootstrap')
    .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/lib/bootstrap')

    //font awesome
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/css', 'public/lib/font-awesome/css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/lib/font-awesome/webfonts')

    //sass
    .sass('resources/sass/main.scss', 'public/css');

