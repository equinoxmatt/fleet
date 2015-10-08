<?php namespace APG\Fleet\Collections;

/**
 * Class AircraftCollection
 * @package APG\Fleet\Collections
 */
class AircraftCollection implements \Countable, \IteratorAggregate
{
    private $aircraftList;

    public function count()
    {
        return count($this->aircraftList);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->aircraftList);
    }

    public function all()
    {
        return $this->aircraftList;
    }

    public function get($key)
    {
        return $this->aircraftList[$key];
    }

    public function add($key, $value)
    {
        $this->aircraftList[$key] = $value;
    }

    public function push($value)
    {
        $this->aircraftList[] = $value;
    }

    public function isEmpty()
    {
        return empty($this->aircraftList);
    }

    public function getByCategory($category)
    {
        $list = array();
        foreach ($this->aircraftList as $aircraft) {
            if(strpos($aircraft->path, 'cat' . $category) !== false) {
                $list[] = $aircraft;
            }
        }

        return $list;
    }
}
