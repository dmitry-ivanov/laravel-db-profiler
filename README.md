![Database Profiler for Laravel Web and Console Applications](art/1380x575-optimized.jpg)

# Laravel Database Profiler

[<img src="https://user-images.githubusercontent.com/1286821/181085373-12eee197-187a-4438-90fe-571ac6d68900.png" alt="Buy me a coffee" width="200" />](https://buymeacoffee.com/dmitry.ivanov)

[![StyleCI](https://github.styleci.io/repos/68023936/shield?branch=12.x&style=flat)](https://github.styleci.io/repos/68023936?branch=12.x)
[![Build Status](https://img.shields.io/github/actions/workflow/status/dmitry-ivanov/laravel-db-profiler/tests.yml?branch=12.x)](https://github.com/dmitry-ivanov/laravel-db-profiler/actions?query=workflow%3Atests+branch%3A12.x)
[![Coverage Status](https://img.shields.io/codecov/c/github/dmitry-ivanov/laravel-db-profiler/12.x)](https://app.codecov.io/gh/dmitry-ivanov/laravel-db-profiler/tree/12.x)

![Packagist Version](https://img.shields.io/packagist/v/illuminated/db-profiler)
![Packagist Stars](https://img.shields.io/packagist/stars/illuminated/db-profiler)
![Packagist Downloads](https://img.shields.io/packagist/dt/illuminated/db-profiler)
![Packagist License](https://img.shields.io/packagist/l/illuminated/db-profiler)

Database Profiler for Laravel Web and Console Applications.

> A simple tool that works correctly even with `dd()` in your code.

| Laravel | Database Profiler                                                      |
|---------|------------------------------------------------------------------------|
| 12.x    | [12.x](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/12.x) |
| 11.x    | [11.x](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/11.x) |
| 10.x    | [10.x](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/10.x) |
| 9.x     | [9.x](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/9.x)   |
| 8.x     | [8.x](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/8.x)   |
| 7.x     | [7.x](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/7.x)   |
| 6.x     | [6.x](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/6.x)   |
| 5.8.*   | [5.8.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.8) |
| 5.7.*   | [5.7.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.7) |
| 5.6.*   | [5.6.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.6) |
| 5.5.*   | [5.5.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.5) |
| 5.4.*   | [5.4.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.4) |
| 5.3.*   | [5.3.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.3) |
| 5.2.*   | [5.2.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.2) |
| 5.1.*   | [5.1.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.1) |

## Usage

1. Install the package via Composer:

    ```shell script
    composer require "illuminated/db-profiler:^12.0"
    ```

2. Use the `vvv` parameter for Web:

    ![Laravel Database Profiler - Demo - Web](doc/img/demo-web-c.gif)

3. Use the `-vvv` option for Console:

    ![Laravel Database Profiler - Demo - Console](doc/img/demo-console.gif)

## Local by default

Enabled only for the `local` environment, so you don't have to worry about `production`.

If you want to force profiling for non-local environments - specify it explicitly in your `.env` file:

> DB_PROFILER_FORCE=true

## Sponsors

[![Laravel Idea](art/sponsor-laravel-idea.png)](https://laravel-idea.com)<br>
[![Material Theme UI Plugin](art/sponsor-material-theme.png)](https://material-theme.com)<br>

## License

Laravel Database Profiler is open-sourced software licensed under the [MIT license](LICENSE.md).

[<img src="https://user-images.githubusercontent.com/1286821/181085373-12eee197-187a-4438-90fe-571ac6d68900.png" alt="Buy me a coffee" width="200" />](https://buymeacoffee.com/dmitry.ivanov)&nbsp;
