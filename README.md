# Laravel Database Profiler

[![StyleCI](https://styleci.io/repos/68023936/shield?branch=5.6&style=flat)](https://styleci.io/repos/68023936)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-db-profiler.svg?branch=5.6)](https://travis-ci.org/dmitry-ivanov/laravel-db-profiler)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-db-profiler/badge.svg?branch=5.6)](https://coveralls.io/github/dmitry-ivanov/laravel-db-profiler?branch=5.6)

[![Latest Stable Version](https://poser.pugx.org/illuminated/db-profiler/v/stable)](https://packagist.org/packages/illuminated/db-profiler)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/db-profiler/v/unstable)](https://packagist.org/packages/illuminated/db-profiler)
[![Total Downloads](https://poser.pugx.org/illuminated/db-profiler/downloads)](https://packagist.org/packages/illuminated/db-profiler)
[![License](https://poser.pugx.org/illuminated/db-profiler/license)](https://packagist.org/packages/illuminated/db-profiler)

DB profiling for Laravel web and console applications.

| Laravel | Database Profiler                                                      |
| ------- | :--------------------------------------------------------------------: |
| 5.1.*   | [5.1.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.1) |
| 5.2.*   | [5.2.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.2) |
| 5.3.*   | [5.3.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.3) |
| 5.4.*   | [5.4.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.4) |
| 5.5.*   | [5.5.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.5) |
| 5.6.*   | [5.6.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.6) |

Enabled only for `local` environment, you don't need to bother about `production`.

> If you want to enable profiling on other environments, use `db-profiler.force` config variable.

## Usage

1. Install package through `composer`:

    ```shell
    composer require "illuminated/db-profiler:5.6.*"
    ```

2. Use `vvv` request parameter or `-vvv` cli option to enable profiling.

## Web Profiling

Use `vvv` request parameter for web profiling:

![Web example](doc/img/example-web.gif)

## Console Profiling

Use `-vvv` option for console profiling:

![Console example](doc/img/example-console.gif)
