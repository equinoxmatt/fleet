<?php

class AircraftColletionTest extends PHPUnit_Framework_TestCase
{
    protected $aircraftCollection;
    protected $fleet;

    public function setUp()
    {
        $this->fleet = new \APG\Fleet\Fleet(
            'AFA',
            new \APG\Fleet\Collections\AircraftCollection(),
            'tests\test_files',
            new \Stash\Pool(new \Stash\Driver\FileSystem(['path' => 'tmp/']))
        );

        $this->aircraftCollection = new \APG\Fleet\Collections\AircraftCollection();
    }
    public function testListStartsEmpty()
    {
        $this->assertTrue($this->aircraftCollection->isEmpty());
    }

    public function testPush()
    {
        $this->aircraftCollection->push(json_decode(json_encode('hello1')));
        $this->assertEquals('1', $this->aircraftCollection->count());

        $this->aircraftCollection->push(json_decode(json_encode('hello2')));
        $this->assertEquals('2', $this->aircraftCollection->count());
    }

    public function testAdd()
    {
        $this->aircraftCollection->add(610, 'test');
        $this->assertEquals('test', $this->aircraftCollection->get(610));

    }

    public function testAll()
    {
        $this->aircraftCollection->push(json_decode(json_encode('hello1')));
        $this->aircraftCollection->push(json_decode(json_encode('hello2')));
        $this->aircraftCollection->push(json_decode(json_encode('hello3')));
        $this->assertEquals(3, count($this->aircraftCollection->all()));
    }

    public function testGetByCategory()
    {
        $aircraftCollection = $this->fleet->getAllAircraft();
        $aircraftList = $aircraftCollection->getByCategory(1);
        $this->assertInternalType('array', $aircraftList);
        $this->assertNotEmpty($aircraftList);
    }
}