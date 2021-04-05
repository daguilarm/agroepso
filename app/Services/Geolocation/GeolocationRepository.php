<?php

namespace App\Services\Geolocation;

use Parser;

abstract class GeolocationRepository {

    /**
    * Default WMS variables
    */
    protected $crs          = 'EPSG:4326';
    protected $format       = 'text/xml';
    protected $imageFormat  = 'image/png';
    protected $pointZ       = 15.5;         // Zoom for thumbnails
    protected $request      = 'GetFeatureInfo';
    protected $service      = 'WMS';
    protected $spherical    = 20037508.34;  //Spherical curvature
    protected $timeout      = 5;
    protected $version      = '1.1.1';

    /**
    * Bbox variables
    */
    protected $bbox;
    protected $height;
    protected $layers;
    protected $pointX;
    protected $pointY;
    protected $width;

    /**
    * Parser variables
    */
    protected $selector = '#dataGridParcela tr td';

    /**
    * Server variables
    */
    protected $server;
    protected $serverWithParams;

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

     /**
     * Generate the server connection URL
     *
     * @param   string    $server
     *
     * @return  String.
     */
    protected function getServer()
    {
        //Built the server URL
        return sprintf('%s?REQUEST=%s&SERVICE=%s&QUERY_LAYERS=%s&VERSION=%s&INFO_FORMAT=%s&LAYERS=%s&SRS=%s&CRS=%s&BBOX=%s&WIDTH=%s&HEIGHT=%s&FORMAT=%s&STYLES=DEFAULT&TRANSPARENT=FALSE&X=%s&Y=%s&FEATURE_COUNT=1&EXCEPTIONS=XML',
            $this->server,
            $this->request,
            $this->service,
            $this->layers,
            $this->version,
            $this->format,
            $this->layers,
            $this->crs,
            $this->crs,
            $this->bbox,
            $this->width,
            $this->height,
            $this->imageFormat,
            $this->pointX,
            $this->pointY
        );
    }

    /**
    * Html5 parser
    *
    * @param string $selector
    * @return  String.
    */
    protected function getParser($selector)
    {
        //Get the file from server in html5 format
        $html = self::getFile($this->serverWithParams);

        //Get the html5 Crawler
        return $html
            ? collect(Parser::str_get_html($html)->find($selector))
            : null;
    }


     /**
     * Load external files
     * We need to send the headers correctly to the wms server, because It can think that we are attacking the server
     *
     * @param file $file
     * @return  String.
     */
    protected function getFile($file)
    {
        //Open the connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, self::userAgent());
        curl_setopt($ch, CURLOPT_URL, $file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        //Get the results
        $result = curl_exec($ch);
        //Close the connection
        curl_close($ch);
            //Return the data
            return $result ?? null;
    }

     /**
     * Renerate an user agent to emulate an human user
     *
     * @return  String.
     */
    protected function userAgent()
    {
        return array_rand([
            'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
            'Mozilla/5.0 (Windows CE) AppleWebKit/5350 (KHTML, like Gecko) Chrome/13.0.888.0 Safari/5350',
            'Mozilla/5.0 (Macintosh; PPC Mac OS X 10_6_5) AppleWebKit/5312 (KHTML, like Gecko) Chrome/14.0.894.0 Safari/5312',
            'Mozilla/5.0 (X11; Linuxi686; rv:7.0) Gecko/20101231 Firefox/3.6',
            'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_7_1 rv:3.0; en-US) AppleWebKit/534.11.3 (KHTML, like Gecko) Version/4.0 Safari/534.11.3',
            'Opera/8.25 (Windows NT 5.1; en-US) Presto/2.9.188 Version/10.00',
            'Mozilla/5.0 (Windows NT 6.2; rv:20.0) Gecko/20121202 Firefox/20.0',
            'Mozilla/5.0 (X11; U; OpenBSD i386; en-US) AppleWebKit/533.3 (KHTML, like Gecko) Chrome/5.0.359.0 Safari/533.3',
            'Mozilla/5.0 (Linux; U; Android 1.1; en-gb; dream) AppleWebKit/525.10  (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2',
            'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20120422 Firefox/12.0 SeaMonkey/2.9',
            'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0',
            'Mozilla/5.0 (Linux U; en-US)  AppleWebKit/528.5  (KHTML, like Gecko, Safari/528.5 ) Version/4.0 Kindle/3.0 (screen 600x800; rotate)',
            'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; KFTT Build/IML74K) AppleWebKit/535.19 (KHTML, like Gecko) Silk/2.1 Mobile Safari/535.19 Silk-Accelerated=true',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:9.0) Gecko/20100101 Firefox/9.0',
            'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0',
            'Mozilla/5.0 (Windows NT 6.0; rv:14.0) Gecko/20100101 Firefox/14.0.1',
            'DoCoMo/2.0 N905i(c100;TB;W24H16) (compatible; Googlebot-Mobile/2.1;  http://www.google.com/bot.html)',
            'Mozilla/5.0 (X11; U; Linux arm7tdmi; rv:1.8.1.11) Gecko/20071130 Minimo/0.025',
            'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.3 (KHTML, like Gecko) Chrome/19.0.1061.1 Safari/536.3',
            'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420  (KHTML, like Gecko) Version/3.0 Mobile/1A543a Safari/419.3',
            'Mozilla/5.0 (iPad; CPU OS 7_1_2 like Mac OS X) AppleWebKit/537.51.2 (KHTML, like Gecko) Version/7.0 Mobile/11D257 Safari/9537.53',
            'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
            'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
            'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko',
            'Mozilla/5.0 (compatible; MSIE 7.0; Windows 98; Win 9x 4.90; Trident/3.0)',
            'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16'
        ], 1);
    }

    /**
    * Set variable bbox
    *
    * @param string $bbox
    * @return object.
    */
    public function bbox($bbox)
    {
        $this->bbox = $bbox;

        return $this;
    }

    /**
    * Set variable crs
    *
    * @param string $crs
    * @return object.
    */
    public function crs($crs)
    {
        $this->crs = $crs;

        return $this;
    }

    /**
    * Set variable format
    *
    * @param string $format
    * @return object.
    */
    public function format($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
    * Set variable height
    *
    * @param string $height
    * @return object.
    */
    public function height($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
    * Set variable imageFormat
    *
    * @param string $imageFormat
    * @return object.
    */
    public function imageFormat($imageFormat)
    {
        $this->imageFormat = $imageFormat;

        return $this;
    }

    /**
    * Set variable layers
    *
    * @param string $layers
    * @return object.
    */
    public function layers($layers)
    {
        $this->layers = $layers;

        return $this;
    }

    /**
    * Set variable pointY
    *
    * @param string $pointX
    * @return object.
    */
    public function pointX($pointX)
    {
        $this->pointX = $pointX;

        return $this;
    }

    /**
    * Set variable pointY
    *
    * @param string $pointY
    * @return object.
    */
    public function pointY($pointY)
    {
        $this->pointY = $pointY;

        return $this;
    }

    /**
    * Set variable version
    *
    * @param string $version
    * @return object.
    */
    public function version($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
    * Set variable width
    *
    * @param string $width
    * @return object.
    */
    public function width($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
    * Set variable selector
    *
    * @param string $selector
    * @return object.
    */
    public function selector($selector)
    {
        $this->selector = $selector;

        return $this;
    }
}
