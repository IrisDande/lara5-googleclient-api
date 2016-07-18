Google Api Client Wrapper
=========

> Google api php client wrapper with Cloud Platform and Laravel 4 & 5 support

[![Build Status](http://img.shields.io/travis/irisdande/google-apiclient.svg?style=flat-square)](https://travis-ci.org/irisdande/google-apiclient)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/irisdande/google-apiclient/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/irisdande/google-apiclient/)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/irisdande/google-apiclient/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/irisdande/google-apiclient/code-structure/master)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](http://www.opensource.org/licenses/MIT)
[![Latest Version](http://img.shields.io/packagist/v/irisdande/google-apiclient.svg?style=flat-square)](https://packagist.org/packages/irisdande/google-apiclient)
[![Total Downloads](https://img.shields.io/packagist/dt/irisdande/google-apiclient.svg?style=flat-square)](https://packagist.org/packages/irisdande/google-apiclient)

## Requirements

This package requires PHP >=5.4

## Installation

Install via composer - edit your `composer.json` to require the package.

```js
"require": {
    "irisdande/google-apiclient": "2.*"
}
```

Then run `composer update` in your terminal to pull it in.

Or use `composer require irisdande/google-apiclient`

## Laravel

To use in laravel add the following to the `providers` array in your `config/app.php`

```php
irisdande\Google\GoogleServiceProvider::class
```

Next add the following to the `aliases` array in your `config/app.php`

```php
'Google' => irisdande\Google\Facades\Google::class
```

Finally run `php artisan vendor:publish --provider="irisdande\Google\GoogleServiceProvider" --tag="config"` to publish the config file.

#### Looking for a Laravel 4 compatible version?

Checkout the [1.0 branch](https://github.com/irisdande/google-apiclient/tree/1.0)

## Usage

The `Client` class takes an array as the first parameter, see example of config file below:

```php
return [
    /*
    |----------------------------------------------------------------------------
    | Google application name
    |----------------------------------------------------------------------------
    */
    'application_name' => '',

    /*
    |----------------------------------------------------------------------------
    | Google OAuth 2.0 access
    |----------------------------------------------------------------------------
    |
    | Keys for OAuth 2.0 access, see the API console at
    | https://developers.google.com/console
    |
    */
    'client_id' => '',
    'client_secret' => '',
    'redirect_uri' => '',
    'scopes' => [],
    'access_type' => 'online',
    'approval_prompt' => 'auto',

    /*
    |----------------------------------------------------------------------------
    | Google developer key
    |----------------------------------------------------------------------------
    |
    | Simple API access key, also from the API console. Ensure you get
    | a Server key, and not a Browser key.
    |
    */
    'developer_key' => '',

    /*
    |----------------------------------------------------------------------------
    | Google service account
    |----------------------------------------------------------------------------
    |
    | Set the information below to use assert credentials
    | Leave blank to use app engine or compute engine.
    |
    */
    'service' => [
        /*
        | Example xxx@developer.gserviceaccount.com
        */
        'account' => '',

        /*
        | Example ['https://www.googleapis.com/auth/cloud-platform']
        */
        'scopes' => [],

        /*
        | Path to key file
        | Example storage_path().'/key/google.p12'
        */
        'key' => '',
    ]
];
```

To use the Google Cloud Platform Services you can either set the information in the config file under `service`, or if running under compute engine (or app engine) leave it blank.

`NOTE: service => ['account'] is the service Email Address and not the Client ID!`

Get `Google_Client`
```php
$client = new irisdande\Google\Client($config);
$googleClient = $client->getClient();
```

Laravel Example:
```php
$googleClient = Google::getClient();
```

Get a service
```php
$client = new irisdande\Google\Client($config);

// returns instance of \Google_Service_Storage
$storage = $client->make('storage');

// list buckets example
$storage->buckets->listBuckets('project id');

// get object example
$storage->objects->get('bucket', 'object');
```
