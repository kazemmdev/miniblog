const mix = require('laravel-mix');

mix.vue()

mix.js('resources/js/app.js', 'public/js')

mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss')
])

if (mix.inProduction()) {
    mix.version()
}
