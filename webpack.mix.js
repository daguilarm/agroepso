let mix = require('laravel-mix');
require('laravel-mix-purgecss');
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

mix
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/maps/map-thumbnail.js', 'public/js/maps')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/print.scss', 'public/css')
    .version()
    .purgeCss();

mix.version('public/img/');
