<?php namespace APG\Fleet;

use APG\Fleet\Collections\AircraftCollection;
use Stash\Pool;

/**
 * Class Fleet
 * @package APG\Fleet
 */
class Fleet
{
    protected $airline;
    protected $basePath;
    protected $aircraftCollection;
    protected $recursiveIterator;
    protected $cacheEnabled = false;
    /** @var Pool  */
    protected $cachePool;

    /**
     * @param $airline
     * @param AircraftCollection $aircraftCollection
     * @param $path
     * @param Pool $cachePool
     */
    public function __construct($airline, AircraftCollection $aircraftCollection, $path, Pool $cachePool)
    {
        if (!is_dir($path)) {
            throw new \InvalidArgumentException('Directory does not exist.');
        }

        $this->cachePool = $cachePool;

        $this->airline = $airline;
        $this->basePath = $path;
        $this->aircraftCollection = $aircraftCollection;
        $this->recursiveIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
    }

    /**
     * @return AircraftCollection
     */
    public function getAllAircraft()
    {
        if ($this->cacheEnabled) {
            $cacheItem = $this->cachePool->getItem('aircraftCollection');
            $aircraftCollection = $cacheItem->get();
            if ($cacheItem->isHit()) {
                return $aircraftCollection;
            }
        }

        $fileObjects = $this->recursiveIterator;
        $aircraftCollection = $this->aircraftCollection;

        foreach ($fileObjects as $file) {
            if ($file->getFilename() === 'aircraft.json') {
                $json = file_get_contents($file->getPathName());
                if ($json) {
                    $aircraftConfig = json_decode($json);
                    $aircraftConfig->path = $file->getPath();
                    $aircraftCollection->push($aircraftConfig);
                }
            }
        }

        if ($this->cacheEnabled) {
            $this->cachePool->save($cacheItem->set($aircraftCollection));
        }

        return $aircraftCollection;
    }

    /**
     * @param $filename
     * @return bool
     */
    public function downloadAircraft($filename)
    {
        $aircraftCollection = $this->getAllAircraft();
        foreach ($aircraftCollection as $aircraft) {
            foreach ($aircraft->files as $file) {
                if ($file[0]->file_name === $filename) {
                    if (file_exists($aircraft->path . '/files/' . $filename)) {
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header("Content-length: " . filesize($aircraft->path . '/files/' . $filename));
                        readfile($aircraft->path . '/files/' . $filename);
                        exit;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param bool $cacheStatus
     */
    public function setCacheEnabled($cacheStatus)
    {
        $this->cacheEnabled = $cacheStatus;
    }

    public function clearCache()
    {
        $this->cachePool->clear();
    }
}
