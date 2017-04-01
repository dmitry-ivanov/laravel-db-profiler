# Laravel Database Profiler

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/8ec1928c-0727-427c-96e9-2a963eb6546b/big.png)](https://insight.sensiolabs.com/projects/8ec1928c-0727-427c-96e9-2a963eb6546b)

[![StyleCI](https://styleci.io/repos/68023936/shield?branch=master&style=flat)](https://styleci.io/repos/68023936)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-db-profiler.svg?branch=master)](https://travis-ci.org/dmitry-ivanov/laravel-db-profiler)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-db-profiler/badge.svg?branch=master)](https://coveralls.io/github/dmitry-ivanov/laravel-db-profiler?branch=master)

[![Latest Stable Version](https://poser.pugx.org/illuminated/db-profiler/v/stable)](https://packagist.org/packages/illuminated/db-profiler)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/db-profiler/v/unstable)](https://packagist.org/packages/illuminated/db-profiler)
[![Total Downloads](https://poser.pugx.org/illuminated/db-profiler/downloads)](https://packagist.org/packages/illuminated/db-profiler)
[![License](https://poser.pugx.org/illuminated/db-profiler/license)](https://packagist.org/packages/illuminated/db-profiler)

Provides database queries profiling for Laravel http and console applications.

## Requirements

- `PHP >=5.5.9`
- `Laravel >=5.1`

## Usage

1. Install package through `composer`:

    ```shell
    composer require illuminated/db-profiler
    ```

2. Add `DbProfilerServiceProvider` into `config/app.php`:

    ```php
    'providers' => [
        // ...
        Illuminated\Database\DbProfilerServiceProvider::class,
    ],
    ```

    Enabled only for `local` environment, you don't need to bother about `production`.

## HTTP Profiling

Use `vvv` request parameter for http profiling:

![Http example](doc/img/example-http.png)

## Console Profiling

Use `-vvv` option for console profiling:

![Console example](doc/img/example-console.png)
