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
php artisan vendor:publish --force

php artisan migrate
```

If you have migration issues, see https://laravel-news.com/laravel-5-4-key-too-long-error.

Boom! Good to go!

Example templates included in views/examples.
Optional Helper functions to include in composer.json:
```shell
"autoload": {
"files": [
            "app/Http/Controllers/jaunt-helpers.php"
        ],
```

## Customization

**Creating a new template**

Create template in views/templates/example-slug.blade.php

Add the newly created template to the database table 'templates'

The template will now appear in the backend, becoming available for any datatypes, menus, or pages to use.

**Featured Image**
```shell
$page->featimg()
```
**Title**
```shell
$page->title
```
**Content**
```shell
@include('includes.content-loop')
```
**Any Custom Fields**
```shell
$page->get_the('field name')
```
**Meta Desc**
```shell
$page->metadesc
```
**Meta Keywords**
```shell
$page->keywords
```
**Creating a new component**

Views->components house all front end component code.

Views->dashboard->components house all backend component code.

Within the database, add a new 'component' and set its 'type' to template.

## Updating
After your composer update, to finalize your upgrade
``` shell
php artisan vendor:publish --tag=update --force
```

## Supports
Laravel 5.5 and up.
