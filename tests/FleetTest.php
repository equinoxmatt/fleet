<?php

class FleetTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {

    }
    public function testCanGetAllAircraft()
    {
        $fleet = new \APG\Fleet\Fleet('AFA', new \APG\Fleet\Collections\AircraftCollection(), 'tests\test_files');
        $result = $fleet->getAllAircraft();
        $this->assertInstanceOf('APG\Fleet\Collections\AircraftCollection', $result);
    }

}