# Laravel Database Profiler

[<img src="https://user-images.githubusercontent.com/1286821/43083932-4915853a-8ea0-11e8-8983-db9e0f04e772.png" alt="Become a Patron" width="160" />](https://patreon.com/dmitryivanov)

[![StyleCI](https://styleci.io/repos/68023936/shield?branch=master&style=flat)](https://styleci.io/repos/68023936)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-db-profiler.svg?branch=master)](https://travis-ci.org/dmitry-ivanov/laravel-db-profiler)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-db-profiler/badge.svg?branch=master)](https://coveralls.io/github/dmitry-ivanov/laravel-db-profiler?branch=master)

[![Latest Stable Version](https://poser.pugx.org/illuminated/db-profiler/v/stable)](https://packagist.org/packages/illuminated/db-profiler)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/db-profiler/v/unstable)](https://packagist.org/packages/illuminated/db-profiler)
[![Total Downloads](https://poser.pugx.org/illuminated/db-profiler/downloads)](https://packagist.org/packages/illuminated/db-profiler)
[![License](https://poser.pugx.org/illuminated/db-profiler/license)](https://packagist.org/packages/illuminated/db-profiler)

Database Profiler for Laravel Web and Console Applications.

| Laravel | Database Profiler                                                      |
| ------- | :--------------------------------------------------------------------: |
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
    composer require illuminated/db-profiler
    ```

2. Use the `vvv` parameter for Web:

    ![Web Application Profiling](doc/img/example-web.gif)

3. Use the `-vvv` option for Console:

    ![Console Application Profiling](doc/img/example-console.gif)

## Local by default

Profiling is enabled only for the `local` environment, so you don't have to worry about `production`.

If you want to force profiling for non-local environments - specify it explicitly in your `.env` file:

> DB_PROFILER_FORCE=true

## License

Laravel Database Profiler is open-sourced software licensed under the [MIT license](LICENSE.md).

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://patreon.com/dmitryivanov)
