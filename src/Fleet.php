<?php namespace APG\Fleet;

/**
 * Class Fleet
 * @package APG\Fleet
 */
class Fleet
{
    protected $airline;
    protected $basePath;

    /**
     * @param $airline
     * @param $path
     * @param \Pimple\Container $ioc
     * @throws \Exception
     */
    public function __construct($airline, $path)
    public function __construct($airline, $path, \Pimple\Container $ioc)
    {
        if (!is_dir($path)) {
            throw new \Exception('Directory does not exist.');
        }

        $this->airline = $airline;
        $this->basePath = $path;
        $this->ioc = $ioc;
        $this->ioc['basePath'] = $path;
    }

    public function getAllAircraft()
    {
        $fileObjects = $this->ioc['RecursiveIterator'];
        $aircraftCollection = $this->ioc['AircraftCollection'];

        foreach ($objects as $object) {
            if ($object->getFileName === 'aircraft.json') {
                $json = file_get_contents($object->getPathName);
                
            }
        }
    }

}