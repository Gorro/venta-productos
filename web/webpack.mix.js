let mix = require('laravel-mix');

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
    .scripts(['node_modules/backbone/backbone.js'], 'public/js/all.min.js')
    .js('resources/assets/js/app.js', 'public/js')
    .styles('resources/assets/css/app.css', 'public/css/all.css');

