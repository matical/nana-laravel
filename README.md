# nana-laravel
Laravel package for [ksmz/nana](https://github.com/matical/nana). Documentation is still incomplete.

## Install
* `composer require ksmz/nana-laravel`
* `artisan vendor:publish --provider "ksmz\NanaLaravel\NanaServiceProvider"`

## Differences
This package provides a more appropriate integration with regards to manging the *Sink*. 

Make sure you're bringing in the right facades/classes. The underlying package also provides a facade-like static proxy and basic *sink* support.

ksmz\Nana    | ksmz\Nana-Laravel  
---          | ---  
Fetch        | LaravelFetch  
Consume      | LaravelConsume
Sink         | NanaManager (Typehintable, Registered in container)
Nana         | Facades/Nana (Actual facade, aliased to \Nana as well)

Of course, if you have stuff registered in the sink through the config file (config/nana.php), you can't use `Sink` since it doesn't belong to *this* package.

That being said, nothing is stopping you from using the base package. If you're making super simple requests, use `ksmz\Nana\Nana.php`.

## Features
* Sinks can be pre-configured in `config/`.
* Save responses directly to your existing Laravel/Flysystem's storage drivers

## Configuration
You should see a `nana.php` in your configuration directory. These are where you should configure your sinks. They are functionally identical to the *Sink* found in the base package.

As said in the base package's [Sink documentation](https://github.com/matical/nana/wiki/Sink), the Sink API + configuration is inspired by Laravel's *filesystems*.

#### Example Configuration
```php
return [
    'default' => env('NANA_FAUCET', 'default'),
    'faucets' => [

        /*
        |--------------------------------------------------------------------------
        | Guzzle Options
        |--------------------------------------------------------------------------
        |
        | Here you may configure as many faucets as you wish. <guzzle_config> is
        | passed directly to Guzzle's Request Options.
        |
        | See http://docs.guzzlephp.org/en/stable/request-options.html for more info.
        */
        'default' => [

            'default_disk'  => env('FILESYSTEM_DRIVER', 'local'),
            'guzzle_config' => [
                'http_errors' => false,
                'headers'     => [
                    'User-Agent' => 'nana/1.0',
                    'Accept'     => 'application/json',
                ],
            ],
            ...
];
```

### Examples
```php

```
