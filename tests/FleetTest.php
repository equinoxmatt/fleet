<?php

class FleetTest extends PHPUnit_Framework_TestCase
{
    protected $ioc;

    public function setUp()
    {
        $this->ioc = new \Pimple\Container();
        $this->ioc['AircraftCollection'] = $this->ioc->factory(function () {
            return new \APG\Fleet\Collections\AircraftCollection();
        });
        $this->ioc['RecursiveIterator'] = $this->ioc->factory(function ($c) {
            return new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($c['basePath']));
        });
    }
    public function testCanGetAllAircraft()
    {
        $fleet = new \APG\Fleet\Fleet('AFA', 'tests\test_files', $this->ioc);
        $result = $fleet->getAllAircraft();
        $this->assertInstanceOf('APG\Fleet\Collections\AircraftCollection', $result);
    }

}