<?php namespace APG\Fleet;
use APG\Fleet\Collections\AircraftCollection;
use Pimple\Container;

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
    public function __construct($airline, $path, Container $ioc)
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
        // TODO:  Implement writing to cache
        if ($this->isCached()) {
            $aircraftCollection = $this->readCache();
            return $aircraftCollection;
        }

        $fileObjects = $this->ioc['RecursiveIterator'];
        $aircraftCollection = $this->ioc['AircraftCollection'];

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

        return $aircraftCollection;
    }

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