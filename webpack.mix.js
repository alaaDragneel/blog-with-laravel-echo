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

// mix.styles([
//     // BEGIN GLOBAL MANDATORY STYLES
//     'public/backend/assets/global/plugins/font-awesome/css/font-awesome.min.css',
//     'public/backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
//     'public/backend/assets/global/plugins/bootstrap/css/bootstrap.min.css',
//     'public/backend/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
//     // END GLOBAL MANDATORY STYLES
//
//     // BEGIN THEME GLOBAL STYLES
//     'public/backend/assets/global/css/components.min.css',
//     'public/backend/assets/global/css/plugins.min.css',
//     // END THEME GLOBAL STYLES
//
//     // BEGIN THEME LAYOUT STYLES
//     'public/backend/assets/layouts/layout4/css/layout.min.css',
//     'public/backend/assets/layouts/layout4/css/themes/default.min.css',
//     'public/backend/assets/layouts/layout4/css/custom.min.css',
//     // END THEME LAYOUT STYLES
//
// ], 'public/backend/base/css/main.min.css');
//
// mix.scripts([
//     // BEGIN CORE PLUGINS
//     'public/backend/assets/global/plugins/jquery.min.js',
//     'public/backend/assets/global/plugins/bootstrap/js/bootstrap.min.js',
//     'public/backend/assets/global/plugins/js.cookie.min.js',
//     'public/backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
//     'public/backend/assets/global/plugins/jquery.blockui.min.js',
//     'public/backend/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
//      // END CORE PLUGINS
//
//      // BEGIN THEME GLOBAL SCRIPTS
//     'public/backend/assets/global/scripts/app.min.js',
//     // END THEME GLOBAL SCRIPTS
//
//     // BEGIN THEME LAYOUT SCRIPTS
//     'public/backend/assets/layouts/layout4/scripts/layout.min.js',
//     'public/backend/assets/layouts/layout4/scripts/demo.min.js',
//     'public/backend/assets/layouts/global/scripts/quick-sidebar.min.js',
//     'public/backend/assets/layouts/global/scripts/quick-nav.min.js',
//     // END THEME LAYOUT SCRIPTS
//
// ], 'public/backend/base/js/main.min.js');
//
// // DataTables
// mix.styles([
//     'public/backend/datatables/dataTables.bootstrap.css',
// ], 'public/backend/datatables/dataTables.bootstrap.min.css');
//
// mix.scripts([
//     'public/backend/datatables/jquery.dataTables.min.js',
//     'public/backend/datatables/dataTables.bootstrap.min.js',
//     'public/backend/datatables/dataTables.buttons.min.js',
//     'public/backend/datatables/buttons.server-side.js',
// ], 'public/backend/datatables/dataTables.min.js');




// // frontend
// mix.scripts([
//     'public/frontend/js/jquery-3.1.1.min.js',
//     'public/frontend/js/flickity.min.js',
//     'public/frontend/js/easypiechart.min.js',
//     'public/frontend/js/parallax.js',
//     'public/frontend/js/typed.min.js',
//     'public/frontend/js/datepicker.js',
//     'public/frontend/js/isotope.min.js',
//     'public/frontend/js/ytplayer.min.js',
//     'public/frontend/js/lightbox.min.js',
//     'public/frontend/js/granim.min.js',
//     'public/frontend/js/jquery.steps.min.js',
//     'public/frontend/js/countdown.min.js',
//     'public/frontend/js/twitterfetcher.min.js',
//     'public/frontend/js/spectragram.min.js',
//     'public/frontend/js/smooth-scroll.min.js',
//     'public/frontend/js/scripts.js',
// ], 'public/frontend/js/main.min.js');
//
// mix.styles([
//     'public/frontend/css/bootstrap.css',
//     'public/frontend/css/stack-interface.css',
//     'public/frontend/css/socicon.css',
//     'public/frontend/css/lightbox.min.css',
//     'public/frontend/css/flickity.css',
//     'public/frontend/css/iconsmind.css',
//     'public/frontend/css/jquery.steps.css',
//     'public/frontend/css/theme.css',
//     'public/frontend/css/custom.css',
// ], 'public/frontend/css/main.min.css');

mix.js([
    'resources/assets/js/app.js',
], 'public/frontend/js/app.min.js');
