<?php namespace APG\Fleet;

use APG\Fleet\Collections\AircraftCollection;

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
    protected $cacheLocation = 'cache/aircraft.cache';

    /**
     * @param $airline
     * @param AircraftCollection $aircraftCollection
     * @param $path
     * @throws \Exception
     */
    public function __construct($airline, AircraftCollection $aircraftCollection, $path)
    {
        if (!is_dir($path)) {
            throw new \Exception('Directory does not exist.');
        }

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
        if ($this->isCached()) {
            $aircraftCollection = $this->readCache();
            return $aircraftCollection;
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

        $this->writeCache($aircraftCollection);
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
					if (file_exists($aircraft->path . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $filename)) {

						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename="'.basename($filename).'"');
						header('Expires: 0');
						header('Cache-Control: must-revalidate');
						header('Pragma: public');
						header("Content-length: " . filesize($aircraft->path . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $filename));
						readfile($aircraft->path . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $filename);
						exit;						
					}
                }
            }
        }

        return false;
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
     */
    protected function writeCache(AircraftCollection $aircraftCollection)
    {
        file_put_contents($this->cacheLocation, serialize($aircraftCollection));
    }

}