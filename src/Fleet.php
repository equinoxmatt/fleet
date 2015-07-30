<?php namespace APG\Fleet;

/**
 * Class Fleet
 * @package APG\Fleet
 */
class Fleet
{
    protected $airline;
    protected $basePath;
    protected $cacheLocation = 'cache/aircraft.cache';

    /**
     * @param $airline
     * @param $path
     * @param \Pimple\Container $ioc
     * @throws \Exception
     */
    public function __construct($airline, $path, \Pimple\Container $ioc)
    {
        if (!is_dir($path)) {
            throw new \Exception('Directory does not exist.');
        }

        $this->airline = $airline;
        $this->ioc = $ioc;
        $this->ioc['basePath'] = $path;
    }

    public function getAllAircraft()
    {
        if ($this->isCached()) {
            $aircraftCollection = $this->readCache();
            return $aircraftCollection;
        }

        $fileObjects = $this->ioc['RecursiveIterator'];
        $aircraftCollection = $this->ioc['AircraftCollection'];

        foreach ($fileObjects as $file) {
            if ($file->getFileName() === 'aircraft.json') {
                $json = file_get_contents($file->getPathName());
                if ($json) {
                    $aircraftConfig = json_decode($json);
                    $aircraftCollection->push($aircraftConfig);
                }
            }
        }
        $this->writeCache($aircraftCollection->all());

        return $aircraftCollection->all();
    }

    /**
     * @return bool
     */
    protected function isCached()
    {
        return file_exists($this->cacheLocation);
    }

    /**
     * @return mixed
     */
    protected function readCache()
    {
        return unserialize(file_get_contents($this->cacheLocation));
    }

    /**
     * @param AircraftCollection $aircraftCollection
     * @return void
     */
    protected function writeCache(array $aircraftCollection)
    {
        file_put_contents($this->cacheLocation, serialize($aircraftCollection));
    }

}