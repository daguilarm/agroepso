<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\PlotsRequest;
use App\Jobs\CreatePlots;
use App\Models\Clients\Client;
use App\Models\Plants\Plant;
use App\Models\Plots\Plot;
use App\Models\Users\User;
use App\Tables\PlotTable;
use Gate;

class PlotsGeolocateController extends DashboardController
{
    /**
     * @var protected
     */
    protected $controller;
    protected $delete;
    protected $route;

    /**
     * @var protected
     * @return string
     */
    protected $section = 'plots';
    protected $msgTableField = 'plot_name';

    public function __construct(Plot $controller)
    {
        $this->controller = $controller;
        $this->route = 'dashboard.' . $this->section;

        //Sharing in the view
        $this->passVariablesToView();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        return view(dashboard_path($this->section . '.geolocate'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function geolocate()
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Get catastro
        $server = sprintf(
            'http://ovc.catastro.meh.es/Cartografia/WMS/ServidorWMS.aspx?REQUEST=GetFeatureInfo&SERVICE=WMS&VERSION=1.1.1&INFO_FORMAT=text/xml&SRS=EPSG:4326&CRS=EPSG:4326&BBOX=%s&WIDTH=%s&HEIGHT=%s&FORMAT=image/png&STYLES=DEFAULT&TRANSPARENT=FALSE&X=%s&Y=%s&FEATURE_COUNT=1&EXCEPTIONS=XML',
            request('geo_bbox'),
            request('frame_width'),
            request('frame_height'),
            request('geo_x'),
            request('geo_y')
        );

        //Make the connection to the server
        $connection = self::getFile($server);
        //Proccess information
        preg_match_all('/<a\shref=\"([^\"]*)\">(.*)<\/a>/siU', $connection, $reference);
        $catastro  = $reference[2][0] ?? null;

        //Catastro data
        $data = $this->toSigpac($catastro);

        return view(dashboard_path($this->section . '.geolocationData'), compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PlotsRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PlotsRequest $request)
    {
        //Auth validation
        if(Gate::denies('create ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }
        //Create plot
        $this->controller->toStore();

        return redirect()
            ->route($this->route . '.index')
            ->withSuccess(trans_title($this->section) . ': ' . request($this->msgTableField));
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
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //Get the results
        $result = curl_exec($ch);
        //Close the connection
        curl_close($ch);
            //Return the data
            return $result;
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
            'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
            'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
            'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko',
            'Mozilla/5.0 (compatible; MSIE 7.0; Windows 98; Win 9x 4.90; Trident/3.0)',
            'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16'
        ], 1);
    }

    /**
     * Get the SIGPAC reference values from the CATASTRO identification number
     * @param  object $reference
     * @return  SIGPAC reference values
     */
    public function toSigpac($reference)
    {
        //Convert the data to string
        $reference = is_object($reference)
            ? $reference->get('reference')
            : $reference;
        //
            return [
                'reference'  => $reference,
                'region'     => substr($reference, 0, 2),
                'city'       => substr($reference, 2, 3),
                'aggregate'  => '0',
                'zone'       => '0',
                'polygon'    => substr($reference, 6, 3),
                'plot'       => substr($reference, 9, 5),
            ];
    }
}
