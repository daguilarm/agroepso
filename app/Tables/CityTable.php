<?php

namespace App\Tables;

use App\Models\Cities\City;
use App\Models\Regions\Region;
use App\Models\States\State;
use App\Tables\_TableTrait;
use Credentials, Form, Table;

class CityTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(City::class)
            ->filterByRole('countries')
            ->with('country', 'state', 'region');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
        return [
            'id' => trans('persona.id.id'),
            'city_name' => trans_title('cities'),
            'city_lat' => trans('geolocation.lat'),
            'city_lng' => trans('geolocation.lng'),
            'country.country_name' => trans('persona.contact.country'),
            'state.state_name' => trans('persona.contact.state'),
            'region.region_name' => trans('persona.contact.region'),
            'ine_id' => trans('geolocation.ine'),
        ];
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
        return [
          'state.state_name' => self::filterOption([
              'select' => 'state_id',
              'label' => trans('persona.contact.state'),
              'model' => State::class,
              'fields' => ['id', 'state_name']
          ]),
          'region.region_name' => self::filterOption([
              'select' => 'region_id',
              'label' => trans('persona.contact.region'),
              'model' => Region::class,
              'fields' => ['id', 'region_name']
          ]),
            'city_name' => 'string',
            'ine_id' => 'string',
        ];
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
        return ['id', 'city_name'];
    }

    /**
     * Generate batch actions
     *
     * @param string $section
     * @param array $array
     * @return string/html
     */
    public static function actions($section, array $array = [])
    {
        return [
            [
                'route' => 'dashboard.tools.' . $section . '.edit',
                'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
            ],
        ];
    }
}
