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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('Modules/Users/Resources/assets/js/app.js', 'js/users.js')
    .js('Modules/Courses/Resources/assets/js/app.js', 'js/courses.js')
    .js('Modules/Support/Resources/assets/js/app.js', 'js/support.js')
    .sass('resources/assets/sass/style.scss', 'public/css')
    .sass('resources/assets/sass/app.scss', 'public/css');
