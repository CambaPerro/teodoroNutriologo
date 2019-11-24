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

mix.js('resources/js/app.js', 'public/js/app.js')
   .sass('resources/sass/app.scss', 'public/css/app.css')
   .scripts(['resources/lib/js/pace.min.js',
   'resources/lib/js/popper.min.js',
   // 'resources/lib/js/jquery.min.js',
  //  'resources/lib/js/bootstrap.min.js',
    'resources/lib/js/perfect-scrollbar.min.js',
    'resources/lib/js/coreui.min.js',
    'resources/lib/js/custom-tooltips.min.js',
   //  'resources/lib/js/sweetalert2.all.min.js'
  ],'public/js/lib.js')
  .styles([
   'resources/lib/css/coreui-icons.min.css',
   'resources/lib/css/flag-icon.min.css',
   'resources/lib/css/font-awesome.min.css',
   'resources/lib/css/simple-line-icons.css',
   'resources/lib/css/style.css',
   'resources/lib/css/pace.min.css'
  ],'public/css/lib.css');
