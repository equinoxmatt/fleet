<?php namespace APG\Fleet;
use APG\Fleet\Models\Aircraft;

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
     * @throws \Exception
     */
    public function __construct($airline, $path)
    {
        if (!is_dir($path)) {
            throw new \Exception('Directory does not exist.');
        }

        $this->airline = $airline;
        $this->basePath = $path;
    }

    public function getAllAircraft()
    {
        $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->basePath));

        foreach ($objects as $object) {
            if ($object->getFileName === 'aircraft.json') {
                $json = file_get_contents($object->getPathName);
                
            }
        }
    }

}