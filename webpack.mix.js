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
    .js('resources/js/vaccine.js', 'public/js')
    .js('resources/js/chat.js', 'public/js')
    .js('resources/js/salachat.js', 'public/js')
    .js('resources/js/medicalappointment.js', 'public/js')
    .js('resources/js/citas.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/chat.scss', 'public/css')
    .sass('resources/sass/salachat.scss', 'public/css')
    .sass('resources/sass/medicalappointment.scss', 'public/css')
    .sourceMaps();
