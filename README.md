# Laravel Database Profiler

[<img src="https://user-images.githubusercontent.com/1286821/43083932-4915853a-8ea0-11e8-8983-db9e0f04e772.png" alt="Become a Patron" width="160" />](https://patreon.com/dmitryivanov)

[![StyleCI](https://github.styleci.io/repos/68023936/shield?branch=6.x&style=flat)](https://github.styleci.io/repos/68023936?branch=6.x)
[![Build Status](https://img.shields.io/github/workflow/status/dmitry-ivanov/laravel-db-profiler/tests/6.x)](https://github.com/dmitry-ivanov/laravel-db-profiler/actions?query=workflow%3Atests+branch%3A6.x)
[![Coverage Status](https://img.shields.io/codecov/c/github/dmitry-ivanov/laravel-db-profiler/6.x)](https://app.codecov.io/gh/dmitry-ivanov/laravel-db-profiler/branch/6.x)

[![Latest Stable Version](https://poser.pugx.org/illuminated/db-profiler/v/stable)](https://packagist.org/packages/illuminated/db-profiler)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/db-profiler/v/unstable)](https://packagist.org/packages/illuminated/db-profiler)
[![Total Downloads](https://poser.pugx.org/illuminated/db-profiler/downloads)](https://packagist.org/packages/illuminated/db-profiler)
[![License](https://poser.pugx.org/illuminated/db-profiler/license)](https://packagist.org/packages/illuminated/db-profiler)

DB profiling for Laravel web and console applications.

| Laravel | Database Profiler                                                      |
| ------- | :--------------------------------------------------------------------: |
| 6.x     | [6.x](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/6.x)   |
| 5.8.*   | [5.8.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.8) |
| 5.7.*   | [5.7.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.7) |
| 5.6.*   | [5.6.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.6) |
| 5.5.*   | [5.5.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.5) |
| 5.4.*   | [5.4.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.4) |
| 5.3.*   | [5.3.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.3) |
| 5.2.*   | [5.2.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.2) |
| 5.1.*   | [5.1.*](https://github.com/dmitry-ivanov/laravel-db-profiler/tree/5.1) |

Enabled only for `local` environment, you don't need to bother about `production`.

> If you want to enable profiling on other environments, use `db-profiler.force` config variable.

## Usage

1. Install the package via Composer:

    ```shell
    composer require "illuminated/db-profiler:^6.0"
    ```

2. Use `vvv` request parameter or `-vvv` cli option to enable profiling.

## Web Profiling

Use `vvv` request parameter for web profiling:

![Web example](doc/img/example-web.gif)

## Console Profiling

Use `-vvv` option for console profiling:

![Console example](doc/img/example-console.gif)

## License

The MIT License. Please see [License File](LICENSE.md) for more information.

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://patreon.com/dmitryivanov)
