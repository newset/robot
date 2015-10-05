<?php

define('LARAVEL_START', microtime(true));

define('A', '');
define('DOT', '.');
define('LK', 1);
define('SLASH', '/');
define('LIB_PATH', 'node_modules');
define('HASH_SEED', '6rysjhhrhl');
define('API_NAME', 'api');
define('API_VERSION', 1);
define('CAPTCHA_PATH', A . SLASH . 'img' . SLASH . 'captcha' . SLASH );
define('CAPTCHA_EXPIRED_TIME', 1); // minute(s)
define('CAPTCHA_EXTENSION', 'jpg');

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = __DIR__.'/cache/compiled.php';

if (file_exists($compiledPath)) {
    require $compiledPath;
}
