<?php
//Example: Geolocation::server('catastro')->params('03107A00600104')->get() ['latLng', 'pc', 'all' || 'null']

namespace App\Services\Geolocation\Servers;

use App\Services\Geolocation\GeolocationRepository;
use App\Services\Geolocation\Servers\GeolocationInterface;

class Catastro extends GeolocationRepository implements GeolocationInterface {

    protected $server = 'http://ovc.catastro.meh.es/ovcservweb/ovcswlocalizacionrc/ovccoordenadas.asmx/Consulta_CPMRC';
    protected $crs = 'EPSG:4326';

    /**
    * Set the parameters to be use for the server
    *
    * @param string $value
    * @return this
    */
    public function params($value) {
        $this->serverWithParams = sprintf('%s?Provincia=&Municipio=&SRS=%s&RC=%s', $this->server, $this->crs, $value);

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
        return new \SimpleXMLElement(parent::getFile($this->serverWithParams));
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

        if($param === 'latLng') {
            return self::getValueLatLng($data);
        }

        if($param === 'pc') {
            return self::getValuePc($data);
        }

        return self::getValueAll($data);
    }

    /**
     * Get the SIGPAC reference values from the CATASTRO identification number
     * @param  object $reference
     * @return  SIGPAC reference values
     */
    public function toSigpac($lat, $lng)
    {
        //Convert the data to string
        $reference = is_object($reference)
            ? $reference->get('reference')
            : $reference;
        //
            return [
                'region'     => substr($reference, 0, 2),
                'city'       => substr($reference, 2, 3),
                'aggregate'  => '0',
                'zone'       => '0',
                'polygon'    => substr($reference, 6, 3),
                'plot'       => substr($reference, 9, 5),
            ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

   /**
   * Get the LatLng values
   *
   * @param string $value
   * @return string
   */
   private function getValueLatLng($value)
   {
       $coordenates = $value->coordenadas->coord->geo ?? null;

       $lat = $coordenates->ycen ?? null;
       $lng = $coordenates->xcen ?? null;
       $srs = $coordenates->srs ?? null;

       return [$lat, $lng, $srs];
   }

   /**
   * Get the Catastro PC values
   *
   * @param string $value
   * @return string
   */
   private function getValuePc($value)
   {
       $coordenates = $value->coordenadas->coord->pc ?? null;

       $pc1 = $coordenates->pc1 ?? null;
       $pc2 = $coordenates->pc2 ?? null;

       return [$pc1, $pc2];
   }

   /**
   * Get all the values
   *
   * @param string $value
   * @return string
   */
   private function getValueAll($value)
   {
       $coordenates = $value->coordenadas->coord ?? null;

       $pc1 = $coordenates->pc->pc1 ?? null;
       $pc2 = $coordenates->pc->pc2 ?? null;
       $lat = $coordenates->geo->ycen ?? null;
       $lng = $coordenates->geo->xcen ?? null;
       $srs = $coordenates->geo->srs ?? null;

       return [$pc1, $pc2, $lat, $lng, $srs];
   }
}
