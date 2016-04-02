<?php

class AircraftColletionTest extends PHPUnit_Framework_TestCase
{
    /** @var  \APG\Fleet\Collections\AircraftCollection */
    protected $aircraftCollection;
    /** @var  \APG\Fleet\Fleet */
    protected $fleet;

    public function setUp()
    {
/*        $cacheFactory = function () {
            $cacheDriver = new \Stash\Driver\FileSystem();
            return new \Stash\Pool($cacheDriver);
        };

        $injector = new Auryn\Injector;
        $injector->delegate('Pool', $cacheFactory);
        $injector->define('APG\Fleet\Fleet', [
            ':airline' => 'AFA',
            ':path' => 'tests/test_files'
        ]);*/


        $this->aircraftCollection = new \APG\Fleet\Collections\AircraftCollection();
        $this->fleet = new \APG\Fleet\Fleet('AFA', $this->aircraftCollection, 'tests/test_files', new \Stash\Pool(new \Stash\Driver\FileSystem()));
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