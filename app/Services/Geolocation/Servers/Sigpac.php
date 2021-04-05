<?php
//Example: Geolocation::server('sigpac')->params('3,107,0,0,6,104')->get() ['catastro', 'area', 'all' || 'null']

namespace App\Services\Geolocation\Servers;

use App\Services\Geolocation\GeolocationRepository;

class Sigpac extends GeolocationRepository {

    protected $server = 'http://sigpac.mapama.gob.es/fega/serviciosvisorsigpac/';

    /**
    * Set the parameters to be use for the server
    *
    * @param string $value
    * @return this
    */
    public function params($value) {
        $this->serverWithParams = sprintf('%sLayerInfo.aspx?layer=parcela&id=%s', $this->server, $value);

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
        //Get the data from the table
        //We can use Geolocation::server()->  selector('table > td')  ->params()->get() for customize
        return collect(parent::getParser($this->selector))
            ->map(function($value) {
                return $value->plaintext;
            });
    }

    /**
    * Get the parameters from the server
    *
    * @param string $param
    * @return this
    */
    public function get($param = null)
    {
        $data = self::getDataFromServer();

        if($data) {

            //Get catastro
            //Default selector: '#dataGridParcela tr td'
            if($param === 'catastro') {
                return self::getValueCatastro($data);
            }

            //Get area
            //Default selector: '#dataGridParcela tr td'
            if($param === 'area') {
                return self::getValueArea($data);
            }

            //Get all data
            return self::getValueAll($data);
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
    * Get the catastro value
    *
    * @param string $value
    * @return string
    */
    private function getValueCatastro($value)
    {
        return is_object($value)
            //The catastro has 14 chars, so we want only the 14 firsts
            ? substr($value->last(), 0, 14)
            : null;
    }

    /**
    * Get the area value
    *
    * @param string $value
    * @return string
    */
    private function getValueArea($value)
    {
        if(is_object($value)) {
            //Delete the catastro value, and now, the area is the last one
            $value->pop();

            return $value
                //Format the separation char
                ? str_replace(',', '.', $value->last())
                : null;
        }

        return null;
    }

    /**
    * Get all the available data
    *
    * @param string $value
    * @return string
    */
    private function getValueAll($value)
    {
        return [self::getValueCatastro($value), self::getValueArea($value)];
    }
}
