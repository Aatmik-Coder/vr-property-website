let mix = require('laravel-mix');

// common
mix.styles([
    'public/assets/common/css/fontawesome-all.min.css',
    'public/assets/common/css/bootstrap.min.css',
    'public/assets/common/css/select2.min.css',
    'public/assets/common/css/jquery-ui.min.css',
    'public/assets/common/css/toastr.min.css',
    'public/assets/common/css/jquery-impromptu.css',
    'public/assets/common/css/jquery.dataTables.min.css',
], 'public/assets/common/css/all.css');

mix.scripts([
    'public/assets/common/js/jquery.min.js',
    'public/assets/common/js/jquery-ui.min.js',
    'public/assets/common/js/jquery.validate.min.js',
    'public/assets/common/js/moment.min.js',
    'public/assets/common/js/moment-timezone-with-data-10-year-range.min.js',
    'public/assets/common/js/bootstrap.min.js',
    'public/assets/common/js/toastr.min.js',
    'public/assets/common/js/jquery-impromptu.js',
    'public/assets/common/js/jquery.mask.min.js',
    'public/assets/common/js/jquery.dataTables.min.js',
    'public/assets/common/js/select2.min.js',
], 'public/assets/common/js/all.js');
