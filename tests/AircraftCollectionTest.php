<?php

class AircraftColletionTest extends PHPUnit_Framework_TestCase
{
    protected $aircraftCollection;
    protected $ioc;

    public function setUp()
    {
        $this->aircraftCollection = new \APG\Fleet\Collections\AircraftCollection();

        $this->ioc = new \Pimple\Container();
        $this->ioc['AircraftCollection'] = $this->ioc->factory(function () {
            return new \APG\Fleet\Collections\AircraftCollection();
        });
        $this->ioc['RecursiveIterator'] = $this->ioc->factory(function ($c) {
            return new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($c['basePath']));
        });
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

    public function testGetByCategory(){

        $fleet = new \APG\Fleet\Fleet('AFA', 'tests\test_files', $this->ioc);
        $aircraftCollection = $fleet->getAllAircraft();
        $aircraftList = $aircraftCollection->getByCategory(1);
        $this->assertInternalType('array', $aircraftList);
        $this->assertNotEmpty($aircraftList);

    }
}