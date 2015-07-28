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
     * @param $path Path to fleet folder
     * @throws \Exception Directory does not exist
     */
    public function __construct($airline, $path)
    {
        if (!is_dir($path)) {
            throw new \Exception('Directory does not exist.');
        }

        $this->airline = $airline;
        $this->basePath = $path;
    }


}