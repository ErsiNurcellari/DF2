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

mix.setPublicPath('./assets');
mix.options({ processCssUrls: false });

/**
 * Backend
 */

mix.copy('node_modules/dropzone/dist/min/dropzone.min.js',              'assets/backend/js/vendors/dropzone.min.js');
mix.copyDirectory('node_modules/font-awesome/fonts',                    'assets/backend/fonts');
mix.copyDirectory('node_modules/bootstrap/fonts',                       'assets/backend/fonts/');
mix.copyDirectory('node_modules/ionicons/dist/fonts',                   'assets/backend/fonts/');
mix.copy('node_modules/morris.js/morris.min.js',                        'assets/backend/js/vendors/morris.min.js');
mix.copy('node_modules/raphael/raphael.min.js',                         'assets/backend/js/vendors/raphael.min.js');
mix.copy('node_modules/formBuilder/dist/form-builder.min.js',           'assets/backend/js/vendors/form-builder.min.js');
mix.copy('node_modules/formBuilder/dist/form-render.min.js',            'assets/backend/js/vendors/form-render.min.js');
mix.copy('node_modules/html5shiv/dist/html5shiv.min.js',                'assets/backend/js/html5shiv.min.js');
mix.copy('node_modules/respond.js/dest/respond.min.js',                 'assets/backend/js/respond.min.js');
mix.copy('resources/assets/vendors/jquery-migrate-3.0.0.min.js',        'assets/backend/js/jquery-migrate-3.0.0.min.js');
mix.copy('resources/assets/vendors/jquery.min.js',                      'assets/backend/js/jquery.min.js');
mix.copy('resources/assets/backend/js/media.js',                        'assets/backend/js/media.js');

mix.styles([
    'node_modules/jquery-ui-dist/jquery-ui.min.css',
    'node_modules/jquery-ui/themes/base/autocomplete.css',
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/font-awesome/css/font-awesome.min.css',
    'node_modules/select2/dist/css/select2.min.css',
    'node_modules/ionicons/css/ionicons.min.css',
    'node_modules/codemirror/lib/codemirror.css',
    'node_modules/admin-lte/dist/css/AdminLTE.min.css',
    'node_modules/admin-lte/dist/css/skins/_all-skins.min.css'
], 'assets/backend/css/main.css');

mix.scripts([
    'node_modules/jquery-ui-dist/jquery-ui.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/jquery-slimscroll/jquery.slimscroll.min.js',
    'node_modules/fastclick/lib/fastclick.js',
    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/admin-lte/dist/js/adminlte.min.js',
    'node_modules/admin-lte/dist/js/demo.js',
    'node_modules/cloneya/dist/jquery-cloneya.min.js',
    'node_modules/handlebars/dist/handlebars.min.js',
    'node_modules/codemirror/lib/codemirror.js',
    'resources/assets/backend/js/main.js'
], 'assets/backend/js/all.js');

mix.sass('resources/assets/backend/css/app.scss', 'assets/backend/css/');

/**
 * Frontend
 */
mix.copy('resources/assets/vendors/jquery.min.js',                      'assets/themes/default/js/jquery-3.3.1.min.js');
mix.copyDirectory('node_modules/font-awesome/fonts',                    'assets/themes/default/fonts');
mix.copy('node_modules/bootstrap/fonts',                                'assets/themes/default/fonts');
mix.copy('node_modules/axios/dist/axios.min.js',                        'assets/themes/default/js/axios.min.js');
mix.copy('resources/assets/frontend/default/js/cart.js',                'assets/themes/default/js/cart.js');
mix.copy('node_modules/vue/dist/vue.min.js',                            'assets/themes/default/js/vue.min.js');
mix.copy('resources/assets/frontend/img/facebook.png',                  'assets/themes/default/img/facebook.png');
mix.copy('resources/assets/frontend/img/flags.png',                     'assets/themes/default/img/flags.png');
mix.copy('resources/assets/frontend/img/thumb.png',                     'assets/img/thumb.png');

mix.sass('resources/assets/frontend/default/sass/app.scss', 'assets/themes/default/css')
    .scripts([
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'node_modules/handlebars/dist/handlebars.js',
        'node_modules/jquery-bar-rating/dist/jquery.barrating.min.js',
        'resources/assets/frontend/default/js/main.js'
    ], 'assets/themes/default/js/app.js');

mix.styles([
    'node_modules/dropzone/dist/min/dropzone.min.css',
    'node_modules/font-awesome/css/font-awesome.min.css',
    'resources/assets/vendors/flags.css',
    'assets/themes/default/css/app.css',
], 'assets/themes/default/css/app.css');

if (mix.inProduction()) {
    mix.version();
}