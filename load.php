<?php
require_once "vendor/autoload.php";


$injector = new Auryn\Injector;
$injector->define('APG\Fleet\Fleet', [
    ':airline' => 'AFA',
    ':path' => 'tests/test_files'
]);

$fleet = $injector->make('APG\Fleet\Fleet');
$fleet->getAllAircraft();

