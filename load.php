<?php
require_once "vendor/autoload.php";

$cacheFactory = function() {
    $cacheDriver = new \Stash\Driver\FileSystem();
    return new \Stash\Pool($cacheDriver);
};

$injector = new Auryn\Injector;
$injector->define('APG\Fleet\Fleet', [
    ':airline' => 'AFA',
    ':path' => 'downloads/fleet/standard/'
]);
$injector->delegate('Pool', $cacheFactory);

$fleet = $injector->make('APG\Fleet\Fleet');