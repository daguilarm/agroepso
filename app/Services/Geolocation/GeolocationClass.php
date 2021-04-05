<?php
//Example: Geolocation::gpsToUtm('37.874182', '-0.80210111')
//Example: Geolocation::server('catastro')

namespace App\Services\Geolocation;

class GeolocationClass {

    /**
     * @var Allowed methods for the Facade
     */
    private $namespace = '\\App\\Services\\Geolocation\\';
    private $path;

    public function __construct()
    {
        $this->path = $this->namespace . 'Servers\\';
    }

    /**
     * Generate the methods
     *
     * @param  string $class
     * @return Boolean
     */
    public function server($class)
    {
        return app($this->path . ucfirst($class));
    }

    /**
     * Generate the methods
     *
     * @param  string $class
     * @return Boolean
     */
    public function gpsToUtm($lat, $lng)
    {
        return app($this->namespace . 'GeolocationPoint')->convertLatLngToUtm($lat, $lng);
    }
}
