# Laravel database profiler

[![StyleCI](https://styleci.io/repos/68023936/shield?style=flat)](https://styleci.io/repos/68023936)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/8ec1928c-0727-427c-96e9-2a963eb6546b/mini.png)](https://insight.sensiolabs.com/projects/8ec1928c-0727-427c-96e9-2a963eb6546b)

[![Latest Stable Version](https://poser.pugx.org/illuminated/db-profiler/v/stable)](https://packagist.org/packages/illuminated/db-profiler)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/db-profiler/v/unstable)](https://packagist.org/packages/illuminated/db-profiler)
[![Total Downloads](https://poser.pugx.org/illuminated/db-profiler/downloads)](https://packagist.org/packages/illuminated/db-profiler)
[![License](https://poser.pugx.org/illuminated/db-profiler/license)](https://packagist.org/packages/illuminated/db-profiler)

Provides database queries profiling for Laravel http and console applications.

## Requirements
- `PHP >=5.6.4`
- `Laravel >=5.2`

## Usage

1. Install package through `composer`:
    ```shell
    composer require illuminated/db-profiler
    ```

2. Add `ServiceProvider` into `config/app.php`:
    ```php
    'providers' => [
        // ...
        Illuminated\Database\Profiler\ServiceProvider::class,
    ],
    ```

3. Now you can use profiler (**only for `local` environment**)!

    Use `vvv` request parameter for http profiling:
    
    ![Http example](doc/img/example-http.png)
    
    Or `-vvv` option for console profiling:
    
    ![Console example](doc/img/example-console.png)
