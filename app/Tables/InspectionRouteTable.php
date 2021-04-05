<?php

namespace App\Tables;

use App\Models\Plots\Plot;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class InspectionRouteTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Plot::class)
            ->filterByRole('inspection_routes')
            ->when(Credentials::isAdmin(), function($query) {
                return $query->withTrashed();
            })
            ->with('city', 'client', 'geolocation', 'user');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
        return filterColumnByRole([
                'plot_ref' => trans('system.code'),
                'plot_name' => trans_title('plots'),
                'last_inspection.inspection_date' => sections('inspections.last'),
                'user.name' => trans_title('users'),
                'city.city_name' => trans_title('cities'),
                'plot_real_area' => sections('plots.real_area'),
                'plot_active' => trans('persona.contact.active'),
                'plot_road' => sections('plots.road'),
                'geolocation.geo_lat' => trans('geolocation.lat'),
                'geolocation.geo_lng' => trans('geolocation.lng'),
                'geolocation.geo_x' => trans('geolocation.x'),
                'geolocation.geo_y' => trans('geolocation.y'),
                'geolocation.zone' => trans('geolocation.zone'),
            ],
            $roleFilter = Credentials::isAdmin(),
            $newColumns = ['client.client_name' => trans_title('clients')],//Admits multiple arrays
            $addInPosition = 3
        );
    }

    /**
     * Search filter for table
     *
     * Search filters availables: 'string', 'range', 'date', 'filterOption'
     *
     * @return object
     */
    public static function search()
    {
        return self::filterSearch([
            // 'name' => 'string',
            // 'email' => 'string',
            // 'client.client_name' => self::filterOption([
            //     'select' => 'client_id',
            //     'label' => trans_title('clients', 'plural'),
            //     'model' => Client::class,
            //     'fields' => ['id', 'client_name']
            // ]),
            // 'crop_variety_type' => self::filterOption([
            //     'select' => 'crop_variety_type',
            //     'label' => trans_title('crop_variety_types'),
            //     'model' => sections('crop_variety_types.types')
            // ]),
            // 'client.client_name' => self::filterOption([
            //     'conditional' => Credentials::hasRoles(['admin', 'admin-gv']),
            //     'select' => 'client_id',
            //     'label' => trans_title('clients', 'plural'),
            //     'model' => Client::class,
            //     'fields' => ['id', 'client_name']
            // ]),
            'created_at' => 'date',
        ]);
    }

    /**
     * Set the sortable columns
     *
     * Example for sortables fields:
     * return ['id', 'name', ...]
     * @return array
     */
    public static function sortables()
    {
        return ['id'];
    }

    /**
     * Generate the checkbox fields
     *
     * @return string/html
     */
    public static function checkbox()
    {
        return [
            'checkbox' => true,
        ];
    }
}
