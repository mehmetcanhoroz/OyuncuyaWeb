<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Codes

Laravel 

- $this->publishes([
            app_path('../vendor/ckeditor/ckeditor') => public_path('assets/backend/vendor/ckeditor'),
        ], 'assets');
- php artisan vendor:publish --tag=assets --force
- public/ckeditor/config.js have to be edited after publish
- INFO: https://laravel.com/docs/5.7/packages#package-assets