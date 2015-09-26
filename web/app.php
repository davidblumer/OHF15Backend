<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

defined('SYMFONY_ENV') || define('SYMFONY_ENV', getenv('SYMFONY_ENV') ?: 'prod');
defined('SYMFONY_DEBUG') ||
define('SYMFONY_DEBUG', filter_var(getenv('SYMFONY_DEBUG') ?: SYMFONY_ENV === 'dev', FILTER_VALIDATE_BOOLEAN));

if (SYMFONY_DEBUG) {
    $loader = require_once __DIR__ . '/../app/autoload.php';
    Debug::enable();
} else {
    $loader = require_once __DIR__ . '/../app/bootstrap.php.cache';
}

require_once __DIR__ . '/../app/AppKernel.php';

$kernel = new AppKernel(SYMFONY_ENV, SYMFONY_DEBUG);

if (!SYMFONY_DEBUG) {
    $kernel->loadClassCache();
}

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
