/**
 * Modules
 */
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

mix
    /**
     * CSS Files
     */
    .styles(
        [
            'resources/assets/css/argon-dashboard.min.css',
            'resources/assets/css/nucleo-svg.css',
            'resources/assets/css/nucleo.css'
        ],
        'public/assets/css/index.css'
    )
    /**
     * JS Files
     */
    .scripts(
        [
            'resources/assets/js/jquery.min.js',
            'resources/assets/js/all.min.js',
            'resources/assets/js/argon-dashboard.min.js',
            'resources/assets/js/bootstrap.bundle.min.js',
            'resources/assets/js/bootstrap.min.js',
            'resources/assets/js/fontawesome.min.js',
        ],
        'public/assets/js/index.js'
    )
    .options({ processCssUrls: false })
