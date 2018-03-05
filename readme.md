# Laravel Full Calendar

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

## Setting application
1. Install the dependencies for the proper functioning of laravel 
```php
$ composer install
```
2. Copy the .env.example file to .env 
in Linux Os
```
$ cp .env.example .env
```
or in Microsoft Windows
```
c:\ copy .env.example .env
```

3. In the root path of the project run the following command

```php
$ php artisan key:generate
```

4. Edit to file .env with setting of Database

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=username
DB_PASSWORD=password
```

5. execute next command

```
$ php artisan migrate --seed
```

6. If environment is a local, open browser in http://localhost:8000 or open in the web server http://0.0.0.0:port/app

```
$ php artisan serve
```