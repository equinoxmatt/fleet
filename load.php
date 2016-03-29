<?php
require_once "vendor/autoload.php";


$injector = new Auryn\Injector;
$injector->define('APG\Fleet\Fleet', [
    ':airline' => 'AFA',
    ':path' => 'downloads/fleet/standard/'
]);

$fleet = $injector->make('APG\Fleet\Fleet');

