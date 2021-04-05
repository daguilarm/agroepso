<?php

namespace App\Services\Geolocation\Servers;

interface GeolocationInterface {

    /**
    * Set the parameters to be use for the server
    *
    * @param string $value
    * @return this
    */
    public function params($value);

    /**
    * Generate the server response
    *
    * @param string $selector
    * @param string $format
    * @return mixed
    */
    public function getDataFromServer($format = null);

    /**
    * Get the parameters from the server
    *
    * @param string $param
    * @return this
    */
    public function get($param = null);
}
