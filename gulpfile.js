var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('admin.less', 'public/assets/css/admin.css')
        .less('styles.less', 'public/assets/css/styles.css')
        .less('styles_old.less', 'public/assets/css/styles_old.css')
        .scripts('website/jquery.js', 'public/assets/js/jquery.js')
        .scripts('website/jquery.event.move.js', 'public/assets/js/jquery.event.move.js')
        .scripts('website/bootstrap.js', 'public/assets/js/bootstrap.js')
        .scripts('website/theme.js', 'public/assets/js/theme.js')        
        .scripts('website/responsive-slider.js', 'public/assets/js/responsive-slider.js')
        .scripts('website/bootstrap-slider.js', 'public/assets/js/bootstrap-slider.js')
        .scripts(['website/markerwithlabel.js',
            'website/jquery.jscroll.js',
            'website/select2.js',
            'website/scripts.js'], 'public/assets/js/scripts.js')
        .scripts([
        'admin/scripts.js',
        'admin/ajax.js',
        'admin/monolog.js',
        'admin/ui.js',
        'admin/redactor.js'
    ], 'public/assets/js/admin/scripts.js');
});
