<?php

namespace App\Jobs;

use App\Jobs\_ExcelRepository;
use App\Models\Cities\City;
use App\Models\Clients\Client;
use App\Models\Plants\Plant;
use App\Models\Plots\Plot;
use App\Models\Users\User;
use App\Models\Warehouses\Warehouse;
use DB, Geolocation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreatePlotsFromExcel extends _ExcelRepository implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $item;
    protected $request;
    protected $similar = 80;

    protected $default =[
        'city_id' => null,
        'region_id' => null,
        'state_id' => null,
        'user_id' => null,
        'plant_id' => null,
        'warehouse_id' => null,
        'plot_ref' => null,
        'plot_name' => null,
        'plot_area' => null,
        'plot_percent_cultivated_land' => 100,
        'plot_real_area' => null,
        'plot_last_production' => null,
        'plot_framework_x' => null,
        'plot_framework_y' => null,
        'plot_green_cover' => null,
        'plot_pond' => null,
        'plot_road' => null,
        'plot_start_date' => null,
        'geo_sigpac_region' => null,
        'geo_sigpac_city' => null,
        'geo_sigpac_aggregate' => null,
        'geo_sigpac_zone' => null,
        'geo_sigpac_polygon' => null,
        'geo_sigpac_plot' => null,
        'geo_sigpac_precinct' => null,
        'geo_catastro' => null,
        'geo_catastro_url' => null,
        'geo_lat' => null,
        'geo_lng' => null,
        'geo_x' => null,
        'geo_y' => null,
        'geo_srs' => null,
        'geo_height' => null,
        'plot_crop_quantity' => null,
        'plot_crop_training' => null,
        'crop_id' => null,
        'crop_variety_id' => null,
        'crop_variety_type' => null,
    ];

    public function __construct($item, $request)
    {
        $this->item = $item;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->createItem($this->item);
    }

    /**
     * Execute the query.
     *
     * @param array $data
     * @return void
     */
    protected function createItem($data)
    {
        return DB::transaction(function () use ($data) {

            //Validate data
            // if(!$this->validate($data)){
            //     return false;
            // }

            //Set all the values
            self::setValues($data);

            //Create plot
            $plot = Plot::firstOrCreate([
                //Plot parametters
                'plot_ref' => $this->default['plot_ref'],
                'client_id' => $this->default['client_id'],
                'user_id' => $this->default['user_id'],
                'plant_id' => $this->default['plant_id'],
                'warehouse_id' => $this->default['warehouse_id'],
                'city_id' => $this->default['city_id'],
                'region_id' => $this->default['region_id'],
                'state_id' => $this->default['state_id'],
                'plot_name' => $this->default['plot_name'],
                'plot_start_date' => $this->default['plot_start_date'],
                'plot_framework_x' => $this->default['plot_framework_x'],
                'plot_framework_y' => $this->default['plot_framework_y'],
                'plot_area' => $this->default['plot_area'],
                'plot_last_production' => $this->default['plot_last_production'],
                'plot_real_area' => $this->default['plot_real_area'],
                'plot_percent_cultivated_land' => $this->default['plot_percent_cultivated_land'],
                'plot_green_cover' => $this->default['plot_green_cover'],
                'plot_pond' => $this->default['plot_pond'],
                'plot_road' => $this->default['plot_road'],
                //Crops parametters
                'crop_id' => $this->default['crop_id'],
                'crop_variety_id' => $this->default['crop_variety_id'],
                'crop_variety_type' => $this->default['crop_variety_type'],
                'plot_crop_quantity' => $this->default['plot_crop_quantity'],
                'plot_crop_training' => $this->default['plot_crop_training'],
            ]);

            if(!is_null($plot->id)) {
                //Create profile
                $plot->geolocation()->create([
                    'geo_sigpac_region' => $this->default['geo_sigpac_region'],
                    'geo_sigpac_city' => $this->default['geo_sigpac_city'],
                    'geo_sigpac_aggregate' => $this->default['geo_sigpac_aggregate'],
                    'geo_sigpac_zone' => $this->default['geo_sigpac_zone'],
                    'geo_sigpac_polygon' => $this->default['geo_sigpac_polygon'],
                    'geo_sigpac_plot' => $this->default['geo_sigpac_plot'],
                    'geo_sigpac_precinct' => $this->default['geo_sigpac_precinct'],
                    'geo_height' => $this->default['geo_height'],
                    'geo_catastro' => $this->default['geo_catastro'],
                    'geo_catastro_url' => $this->default['geo_catastro_url'],
                    'geo_lat' => $this->default['geo_lat'],
                    'geo_lng' => $this->default['geo_lng'],
                    'geo_x' => $this->default['geo_x'],
                    'geo_y' => $this->default['geo_y'],
                    'geo_srs' => $this->default['geo_srs'],
                ]);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Validate data
     *
     * @param array $data
     * @return void
     */
    protected function validate($data) : bool
    {
        //Validate keys
        // foreach(array_keys($data) as $key) {
        //     if(is_null($key) || is_numeric($key)) {
        //         unset($data[$key]);
        //     }
        // }

        // //Validate sigpac
        // if(empty($data['region']) || empty($data['ciudad']) || empty($data['poligono']) || empty($data['parcela'])) {
        //     return false;
        // }

        return true;
    }

    /**
     * Generate all the values
     *
     * @param array $data
     * @return string
     */
    protected function setValues($data)
    {
        //Default values
        self::setPlotDefaults($data);

        //Set general plot values
        self::setPlotGeneralValues($data);

        //Set general optional plot values
        self::setPlotOptionalValues($data);

        //Set sigpac values
        self::setSigpac($data);

        //Set crop values
        self::setPlotCrops($data);

        //Calculate City from INE
        self::setPlotLocalization($data['ciudad'], $data['region']);

        //Calculate geolocation
        self::setGeolocation();

        //Set user id
        self::setPlotUser($data);

        //Calculate plot height
        self::setHeight();

        return $this;
    }

    /**
     * Generate the user ID
     *
     * @param array $data
     * @return string
     */
    protected function setPlotDefaults($data)
    {
        if(!empty($data['area'])) {
            $area = calc_number($data['area']);
        }
        $this->default['plot_area'] = $this->default['plot_real_area'] = $area;
        $this->default['plot_last_production'] = parent::sanitize($data, 'produccion', 'float');
        $this->default['client_id'] = $this->request['client_id'];
        $this->default['plot_ref'] = parent::sanitize($data, 'referencia', 'string', getReferenceFromClient('plot', $this->default['client_id']));

        return null;
    }

    /**
     * Generate the general plot values
     *
     * @param array $data
     * @return string
     */
    protected function setPlotGeneralValues($data)
    {
        //Set plot values
        //$this->default['plot_name'] = parent::sanitize($data, 'nombre_parcela', 'string', sections('plots.name') . ' ' . $this->default['plot_ref']);
        $this->default['plot_name'] = $data['nombre'] . ' ' . $data['apellidos'];
        $this->default['plot_framework_x'] = parent::sanitize($data, 'marco_x', 'float');
        $this->default['plot_framework_y'] = parent::sanitize($data, 'marco_y', 'float');
        $this->default['plot_start_date'] = parent::sanitize($data, 'fecha', 'integer');

        //Storage values
        $this->default['plant_id'] = self::setPlant($data);
        $this->default['warehouse_id'] = self::setWarehouse($data);

        return $this;
    }

    /**
     * Generate the optional plot values
     *
     * @param array $data
     * @return string
     */
    protected function setPlotOptionalValues($data)
    {
        //Set plot values
        if(isset($data['cubierta'])) {
            $this->default['plot_green_cover'] = self::filterBoolean($data['cubierta']);
        }
        if(isset($data['balsa'])) {
            $this->default['plot_pond'] = self::filterBoolean($data['balsa']);
        }
        $this->default['plot_road'] = self::setPlotRoad($data);

        return $this;
    }

    /**
     * Generate the crops values
     *
     * @param array $data
     * @return string
     */
    protected function setPlotCrops($data)
    {
        //Calculate total trees or crops in the area
        self::setPlotQuantity($data);

        //Crops values
        $this->default['plot_crop_training'] = self::setPlotTraining($data);
        $this->default['crop_id'] = isset($this->request['crop_id']) ? ((integer) $this->request['crop_id']) : null;
        $this->default['crop_variety_id'] = isset($this->request['crop_variety_id']) ? ((integer) $this->request['crop_variety_id']) : null;
        $this->default['crop_variety_type'] = isset($this->request['crop_variety_type']) ? ((integer) $this->request['crop_variety_type']) : null;

        return null;
    }

    /**
     * Generate the user ID
     *
     * @param array $data
     * @return string
     */
    protected function setPlotUser($data)
    {
        //Get values
        $client = $this->default['client_id'];
        $user = $data['usuario'] ?? null;

        if($user) {
            if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
                $user = User::whereClientId( $client )->whereEmail( $user )->first();
            } else {
                $user = User::whereClientId( $client )->whereUserRef( $user )->first();
            }
        }

        $this->default['user_id'] = optional($user)->id;

        return $this;
    }

    /**
     * Generate the road value
     *
     * @param array $data
     * @return string
     */
    protected function setPlotRoad($data) : int
    {
        $value = strtolower(parent::sanitize($data, 'carretera'));

        if($value === 'camino' || $value === 'tierra' || starts_with($value, 'cam') || starts_with($value, 'tie')) {
            return 2;
        }

        if($value === 'carretera' || $value === 'asfalto' || starts_with($value, 'carr') || starts_with($value, 'asf')) {
            return 3;
        }

        return 1;
    }

    /**
     * Generate the training value
     *
     * @param array $data
     * @return string
     */
    protected function setPlotTraining($data)
    {
        $item = strtolower(parent::sanitize($data, 'conduccion'));
        $percent = 80;
        $trainings = trans('_config.training_types');

        foreach($trainings as $key => $value) {
            $value = strtolower($value);

            //Check for similar text
            similar_text($value, $item, $percent);

            if($value === $item || $percent > $this->similar) {
                return $key;
            }
        }

        return null;
    }

    /**
     * Calculate the total trees or crop in the plot area
     *
     * @return string
     */
    protected function setPlotQuantity($data)
    {
        //If send value form excel
        if($data['total']) {
            $this->default['plot_crop_quantity'] = parent::sanitize($data, 'total', 'integer');
        //Calculate from framework and area
        } else {
            if($this->default['plot_area'] && $this->default['plot_framework_x'] && $this->default['plot_framework_y']) {
                $this->default['plot_crop_quantity'] = calc_framework(
                    $this->default['plot_area'] * 10000,//For this calculation we need the area in meters
                    $this->default['plot_framework_x'],
                    $this->default['plot_framework_y']
                );
            }
        }

        return $this;
    }

    /**
     * Calculate the city, state, region,...
     *
     * @param integer $cityID
     * @return string
     */
    protected function setPlotLocalization($cityID = null, $regionID = null)
    {
        if(is_numeric($cityID) && is_numeric($regionID)) {
            //Calculate City from INE
            $city = City::whereRegionId($regionID)->whereSigpac($cityID)->first();

            //Set values
            $this->default['city_id'] = optional($city)->id;
            $this->default['state_id'] = optional($city)->state_id;
            $this->default['region_id'] = optional($city)->region_id;
        }

        return $this;
    }

    /**
     * Calculate the sigpac values
     *
     * @param array $data
     * @return string
     */
    protected function setSigpac($data)
    {
        //Set sigpac values
        $this->default['geo_sigpac_region'] = parent::sanitize($data, 'region', 'integer');
        $this->default['geo_sigpac_city'] = parent::sanitize($data, 'ciudad', 'integer');
        $this->default['geo_sigpac_aggregate'] = parent::sanitize($data, 'agregado', 'integer', 0);
        $this->default['geo_sigpac_zone'] = parent::sanitize($data, 'zona', 'integer', 0);
        $this->default['geo_sigpac_polygon'] = parent::sanitize($data, 'poligono');
        $this->default['geo_sigpac_plot'] = parent::sanitize($data, 'parcela');
        $this->default['geo_sigpac_precinct'] = parent::sanitize($data, 'recinto');

        //Default values - This is the normal way...
        if(is_numeric($data['region']) && is_numeric($data['ciudad']) && is_numeric($data['poligono']) && is_numeric($data['parcela'])) {

            //Get sigpac values from wms
            $sigpac = implode(',', [$this->default['geo_sigpac_region'], $this->default['geo_sigpac_city'], $this->default['geo_sigpac_aggregate'], $this->default['geo_sigpac_zone'], $this->default['geo_sigpac_polygon'], $this->default['geo_sigpac_plot']]);
            $geolocation = Geolocation::server('sigpac')->params($sigpac)->get();

            //Set values
            $this->default['geo_catastro'] = $geolocation[0] ?? null;
            $this->default['geo_catastro_url'] = url_catastro($this->default['geo_catastro'], $this->default['geo_sigpac_region'], $this->default['geo_sigpac_city']);
            //Add area if is 0
            if($this->default['plot_area'] <= 0) {
                $this->default['plot_area'] = $this->default['plot_real_area'] = $geolocation[1] ? calc_number($geolocation[1]) : null;
            }
        }

        return $this;
    }

    /**
     * Calculate the city, state, region,...
     *
     * @return string
     */
    protected function setGeolocation()
    {
        //Calculate latLng from catastro
        $coordenates = Geolocation::server('catastro')->params( $this->default['geo_catastro'] )->get();

        if($coordenates) {
            $this->default['geo_lat'] = optional( $coordenates[2] )->__toString();
            $this->default['geo_lng'] = optional( $coordenates[3] )->__toString();

            //Convert values
            $coordenatesConverter = Geolocation::gpsToUtm( $this->default['geo_lat'], $this->default['geo_lng'] );

            //Set values
            $this->default['geo_x'] = $coordenatesConverter[0];
            $this->default['geo_y'] = $coordenatesConverter[1];
            $this->default['geo_srs'] = $coordenatesConverter[2];

        }

        return $this;
    }

    /**
     * Calculate the plot height
     *
     * @return string
     */
    protected function setHeight()
    {
        if($this->default['geo_lat'] && $this->default['geo_lng']) {
            //Calculate City from INE
            $this->default['geo_height'] = Geolocation::server('geonames')
                ->params([$this->default['geo_lat'], $this->default['geo_lng']])
                ->get();
        }

        return $this;
    }

    /**
     * Calculate the plant id
     *
     * @param string $data
     * @return string
     */
    protected function setPlant($data)
    {
        if(!$this->default['client_id']) {
            return null;
        }

        $id = parent::sanitize($data, 'planta', 'integer');

        $plant = Plant::whereClientId($this->default['client_id'])
            ->wherePlantRef($id)
            ->first();

        return optional($plant)->id ?? null;
    }

    /**
     * Calculate the warehouse id
     *
     * @param string $data
     * @return string
     */
    protected function setWarehouse($data)
    {
        if(!$this->default['client_id']) {
            return null;
        }

        $id = parent::sanitize($data, 'almacen', 'integer');

        $warehouse = Warehouse::whereClientId($this->default['client_id'])
            ->whereWarehouseRef($id)
            ->first();

        return optional($warehouse)->id ?? null;
    }

}
