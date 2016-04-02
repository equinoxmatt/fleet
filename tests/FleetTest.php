<?php

class FleetTest extends PHPUnit_Framework_TestCase
{
    /** @var  APG\Fleet\Fleet */
    protected $fleet;

    public function setUp()
    {
        $cacheFactory = function () {
            $cacheDriver = new \Stash\Driver\FileSystem();
            return new \Stash\Pool($cacheDriver);
        };

        $injector = new Auryn\Injector;
        $injector->delegate('Pool', $cacheFactory);
        $injector->define('APG\Fleet\Fleet', [
            ':airline' => 'AFA',
            ':path' => 'tests/test_files'
        ]);

        $this->fleet = $injector->make('APG\Fleet\Fleet');
        $this->fleet->clearCache();
    }

    public function testCanGetAllAircraftWithoutCache()
    {
        $result = $this->fleet->getAllAircraft();
        $this->assertInstanceOf('APG\Fleet\Collections\AircraftCollection', $result);
    }

    public function testCanGetAllAircraftWithCache()
    {
        $this->fleet->setCacheEnabled(true);
        $this->fleet->getAllAircraft();
        $cacheResult = $this->fleet->getAllAircraft();
        $this->assertInstanceOf('APG\Fleet\Collections\AircraftCollection', $cacheResult);
    }

    public function testInvalidDirectory()
    {
        $this->setExpectedException('InvalidArgumentException');
        new \APG\Fleet\Fleet(
            'AFA',
            new \APG\Fleet\Collections\AircraftCollection(),
            'thisdirectorydoesnotexist',
            new \Stash\Pool(
                new \Stash\Driver\FileSystem()
            )
        );
    }

}