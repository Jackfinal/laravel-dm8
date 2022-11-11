# DM DB driver for Laravel 4|5|6|7|8|9 via DM8

## Laravel-DM8

Laravel-DM8 is an Dm Database Driver package for [Laravel](http://laravel.com/). Laravel-DM8 is an extension of [Illuminate/Database](https://github.com/illuminate/database) that uses [DM8](https://eco.dameng.com/document/dm/zh-cn/faq/faq-php.html#PHP-Startup-Unable-to-load-dynamic-library) extension to communicate with Dm. Thanks to @yajra.

## Documentations

- You will find user-friendly and updated documentation here: [Laravel-DM8 Docs](https://github.com/jackfinal/laravel-DM8)
- All about dm and php:[The Underground PHP and Dm Manual](https://eco.dameng.com/document/dm/zh-cn/app-dev/php-php.html)

## Laravel Version Compatibility

 Laravel  | Package
:---------|:----------
 5.1.x    | 5.1.x
 5.2.x    | 5.2.x
 5.3.x    | 5.3.x
 5.4.x    | 5.4.x
 5.5.x    | 5.5.x
 5.6.x    | 5.6.x
 5.7.x    | 5.7.x
 5.8.x    | 5.8.x
 6.x.x    | 6.x.x
 7.x.x    | 7.x.x
 8.x.x    | 8.x.x
 9.x.x    | 9.x.x

## Quick Installation

```bash
composer require jackfinal/laravel-dm8
```

## Service Provider (Optional on Laravel 5.5+)

Once Composer has installed or updated your packages you need to register Laravel-DM8. Open up `config/app.php` and find the providers key and add:

```php
LaravelDm8\\Dm8\\Dm8ServiceProvider::class,
```

## Configuration (OPTIONAL)

Finally you can optionally publish a configuration file by running the following Artisan command.
If config file is not publish, the package will automatically use what is declared on your `.env` file database configuration.

```bash
php artisan vendor:publish --tag=dm
```

This will copy the configuration file to `config/dm.php`.

> Then, you can set connection data in your `.env` files:

```ini
DB_CONNECTION=dm
DB_HOST=dm.host
DB_PORT=5236
DB_DATABASE=xe
DB_USERNAME=hr
DB_PASSWORD=hr
```

Then run your laravel installation...

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/jackfinal
