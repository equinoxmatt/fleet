<?php namespace APG\Fleet\Collections;

/**
 * Class AircraftCollection
 * @package APG\Fleet\Collections
 */
/**
 * Class AircraftCollection
 * @package APG\Fleet\Collections
 */
class AircraftCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var array
     */
    private $aircraftList;

    /**
     * @return int
     */
    public function count()
    {
        return count($this->aircraftList);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->aircraftList);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->aircraftList;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->aircraftList[$key];
    }

    /**
     * @param $key
     * @param $value
     */
    public function add($key, $value)
    {
        $this->aircraftList[$key] = $value;
    }

    /**
     * @param $value
     */
    public function push($value)
    {
        $this->aircraftList[] = $value;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->aircraftList);
    }

    /**
     * @param $category
     * @return array
     */
    public function getByCategory($category)
    {
        $list = array();
        foreach ($this->aircraftList as $aircraft) {
            if (strpos($aircraft->path, 'cat' . $category) !== false) {
                $list[] = $aircraft;
            }
        }

        return $list;
    }
}
