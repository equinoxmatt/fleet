<?php
require_once "vendor/autoload.php";

$cacheFactory = function() {
    $cacheDriver = new \Stash\Driver\FileSystem();
    return new \Stash\Pool($cacheDriver);
};

$injector = new Auryn\Injector;
$injector->delegate('Pool', $cacheFactory);
$injector->define('APG\Fleet\Fleet', [
    ':airline' => 'AFA',
    ':path' => 'downloads/fleet/standard/'
]);

$fleet = $injector->make('APG\Fleet\Fleet');
