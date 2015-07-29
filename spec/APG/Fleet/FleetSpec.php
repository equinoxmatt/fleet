<?php namespace spec\APG\Fleet;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FleetSpec extends ObjectBehavior
{
    function it_should_throw_exception_when_given_invalid_path()
    {
        $this->beConstructedWith('AFA', 'test');
        $this->shouldThrow('Exception')->during('__construct', ['AFA', 'test']);
    }

    function it_is_initializable()
    {
        $this->beConstructedWith('AFA', 'test');
        $this->shouldHaveType('APG\Fleet\Fleet');
    }

    function it_should_return_all_aircraft()
    {
        $allAircraft = $this->getAllAircraft();
        $allAircraft->shouldBeAnInstanceOf('AircraftCollection');
    }


}
