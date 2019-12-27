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
     * SCSS
     */
    .sass(
        'resources/assets/scss/index.scss',
        'public/assets/css/style.css'
    )
    /**
     * Directories
     */
    .copyDirectory(
        'resources/assets/css',
        'public/assets/css'
    )
    .copyDirectory(
        'resources/assets/js',
        'public/assets/js'
    )
    .options({ processCssUrls: false })
