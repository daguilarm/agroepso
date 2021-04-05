<?php
//Example: Geolocation::server('geonames')->params(['37.874182', '-0.80210111'])->get()
//Get the height for a latLng

namespace App\Services\Geolocation\Servers;

use App\Services\Geolocation\GeolocationRepository;
use App\Services\Geolocation\Servers\GeolocationInterface;

class Geonames extends GeolocationRepository implements GeolocationInterface {

    protected $server = 'http://api.geonames.org/astergdem';

    /**
    * Set the parameters to be use for the server
    *
    * @param string $value
    * @return this
    */
    public function params($value) {
        $this->serverWithParams = sprintf('%s?lat=%s&lng=%s&username=%s', $this->server, $value[0], $value[1], getenv('API_KEY_GEONAMES'));

        return $this;
    }

    /**
    * Generate the server response
    *
    * @param string $format
    * @return mixed
    */
    public function getDataFromServer($format = null)
    {
        return parent::getFile($this->serverWithParams);
    }

    /**
    * Get the parameters from the server
    *
    * @param string $param
    * @return this
    */
    public function get($param = null)
    {
        return (integer) self::getDataFromServer();
    }
}
