<?php

namespace App\Services\Geolocation\Servers;

use App\Services\Geolocation\GeolocationInterface;
use App\Services\Geolocation\GeolocationRepository;

class CatastroReverse extends GeolocationRepository implements GeolocationInterface {

    protected $server = 'http://ovc.catastro.meh.es/Cartografia/WMS/ServidorWMS.aspx';

    /**
    * Generate the server address
    *
    * @param object $request data
    * @return  string
    */
    public function server($request) {
        return $this
            ->bbox($request->geo_bbox)
            ->width($request->frame_width)
            ->height($request->frame_height)
            ->pointX($request->geo_x)
            ->pointY($request->geo_y)
            ->getServer($this->server);
    }

    /**
    * Conect with the server
    *
    * @param object $request data
    * @return  mixed response.
    */
    public function getValueCatastro($request)
    {
        //Get the server url
        $server = self::server($request);

        //Make the connection to the server
        $connection = parent::getFile($server);

        //Proccess information
        preg_match_all('/<a\shref=\"([^\"]*)\">(.*)<\/a>/siU', $connection, $reference);
        preg_match_all('/<a href="(.*?)"/s', $connection, $url);

        //The data
        $url = $url[1][0] ?? null;
        $reference = $reference[2][0] ?? null;

        return [
            'reference' => $reference,
            'url' => $url
        ];
    }

    /**
     * Get the SIGPAC reference values from the CATASTRO identification number
     *
     * @param  mixed $reference
     * @return  array
     */
    public function toSigpac($reference)
    {
        //Convert the data to string
        if(is_object($reference)) {
            $reference = $reference->get('reference') ?? $reference;
        }
        if (is_array($reference)) {
            $reference = $reference['reference'] ?? $reference;
        }

        return [
            'region'     => substr($reference, 0, 2),
            'city'       => substr($reference, 2, 3),
            'aggregate'  => '0',
            'zone'       => '0',
            'polygon'    => substr($reference, 6, 3),
            'plot'       => substr($reference, 9, 5),
        ];
    }
}
