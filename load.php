<?php
require_once "vendor/autoload.php";

$ioc = new \Pimple\Container();
$ioc['AircraftCollection'] = $ioc->factory(function ($c) {
    return new \APG\Fleet\Collections\AircraftCollection();
});
$ioc['RecursiveIterator'] = $ioc->factory(function ($c) {
    return new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($c['basePath']));
});
$fleet = new APG\Fleet\Fleet('AFA', $path, $ioc);

