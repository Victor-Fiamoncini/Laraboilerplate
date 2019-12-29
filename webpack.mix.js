/**
 * Modules
 */
const mix = require('laravel-mix')

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
    .copyDirectory(
        'resources/assets/images',
        'public/assets/images'
    )
    .options({ processCssUrls: false })
