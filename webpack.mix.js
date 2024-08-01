const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix
    .js("resources/js/app.js", "public/js")
    .vue({ version: 3 }) // Specify Vue 3
    .postCss("resources/css/app.css", "public/css", [
        //
    ])
    .js("resources/js/app.js", "public/js")
    .vue({ version: 3 }) // Specify Vue 3
    .vue({ version: 3 }); // Specify Vue 3

// Optionally, if you're using Sass/SCSS
// mix.sass('resources/sass/app.scss', 'public/css');

// If you're in production, you might want to version your files
if (mix.inProduction()) {
  mix.version();
}
