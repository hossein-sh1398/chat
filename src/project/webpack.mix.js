let mix = require('laravel-mix');

mix.setPublicPath('../public_html/');

mix.js('resources/js/app.js', 'js/app.js');
