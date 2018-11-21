# Laravel MultiAuth Service for any Laravel App




## Installation

- [Laravel](#laravel)

### Laravel

This package can be used in Laravel 5.4 or higher. If you are using an older version of Laravel, take a look at [the v1 branch of this package].

You can install the package via composer:

``` bash
composer require tariqul/multiauth
```

In Laravel 5.5 the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers' => [
    // ...
    Tariqul\Multiauth\MultiauthServiceProvider::class,
];
```

You can publish [the migration] with:

```bash
php artisan vendor:publish --tag="migration"
```
You can publish [the migration][spaite laravel permission migration ] with:
```bash
php artisan vendor:publish --tag="migrations"
```
assets for multiauth 
```bash
php artisan vendor:publish --tag="multiauth_assets"
```

make auth
```bash
php artisan make:auth
```


After the migration has been published you can create the admins- tables by running the migrations:

```bash
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="config"
```

You can seed database with:

```bash
php artisan multiauth:seed
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
