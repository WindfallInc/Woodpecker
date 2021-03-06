![alt text](http://walshwebworks.com/woodpecker-logo.png)
# Woodpecker
Content Management System for Windfall laravel applications.


Automatically creates admin panel, databases, form logic (with invisible captcha), and page logic.


## Installation

Require this package with composer:

```shell
composer require windfallinc/woodpecker
```


Package auto discovers.

Publish woodpecker assets, and migrate databases:

```shell
php artisan vendor:publish --tag=woodpecker --force

php artisan migrate
```

If you have migration issues, see https://laravel-news.com/laravel-5-4-key-too-long-error.

Boom! Good to go!

Example templates included in views/examples.
Optional Helper functions to include in composer.json:
```shell
"autoload": {
"files": [
            "app/Http/Controllers/woodpecker-helpers.php"
        ],
```

If you are using Orca and Woodpecker, ensure your laravel mix file looks similar to:

```js
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

mix.js('resources/js/app.js', 'public/js')
   .less('resources/assets/less/app.less', 'public/css')
   .less('resources/assets/less//woodpecker/admin.less', 'public/css/woodpecker');
```

Setup .env captcha to enable forms

```shell
NOCAPTCHA_SECRET=<Your Secret Key>
NOCAPTCHA_SITEKEY=<Your Site Key>
```

## Customization

**Creating a new template**

Create template in views/templates/example-slug.blade.php

Add the newly created template to the database table 'templates'

The template will now appear in the backend, becoming available for any datatypes to use.

**Featured Image**
```php
$page->featimg()
```
**Title**
```php
$page->title
```
**Content**
```php
@include('dashboard.includes.body')
```
**Any Custom Fields**
```php
$page->get_the('field name')
```
**Meta Desc**
```php
$page->metadesc
```
**Meta Keywords**
```php
$page->keywords
```
**Creating a new component**

Views->components house all front end component code.

Views->dashboard->components house all backend component code.

Within the database, add a new 'component' and set its 'type' to template.

Edit Woodpeckers admin.less file to include your component css. For example: @import "../components/homepage-slider.less";

**Custom Routes**

Any route in the web.php file can override Woodpeckers routes. Ensure they are named and lead to your own custom controller
```php
Route::get('/anything', 'WebsiteController@index')->name('anything');
```

## Updating
After your composer update, to finalize your upgrade
``` shell
php artisan vendor:publish --tag=woodpeckerupdate --force
```

## Supports
Laravel 5.5 and up.
