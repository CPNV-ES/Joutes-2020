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
    .js('resources/js/carousel.js', 'public/js')

    // js
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/lib/jquery')
    .copy('resources/js/tournamentView.js', 'public/js')
    .copy('resources/js/tournamentDuplication.js', 'public/js')
    .copy('resources/js/poolShow.js', 'public/js')
    .copy('resources/js/DropZone.js', 'public/js')
    .copy('resources/js/dataTableUserPerms.js', 'public/js')

    //Bootstrap
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/lib/bootstrap')
    .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/lib/bootstrap')

    //DataTable
    .copy('node_modules/datatables.net/js/jquery.dataTables.js', 'public/lib/datatables/min/jquery.dataTables.min.js')
    .copy('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'public/lib/datatables/js/dataTables.bootstrap4.min.js')
    .copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'public/lib/datatables/css/dataTables.bootstrap4.min.css')
    .copy('node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css', 'public/lib/datatables/css/dataTables.responsive.bootstrap4.min.css')
    .copy('node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js', 'public/lib/datatables/js/dataTables.responsive.bootstrap4.min.js')
    .copy('node_modules/datatables.net-responsive/js/dataTables.responsive.min.js', 'public/lib/datatables/js/dataTables.responsive.min.js')

    //font awesome
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/css', 'public/lib/font-awesome/css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/lib/font-awesome/webfonts')

    //sass
    .sass('resources/sass/main.scss', 'public/css');


