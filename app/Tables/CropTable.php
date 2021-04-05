<?php

namespace App\Tables;

use App\Models\Crops\Crop;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class CropTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Crop::class)
            ->filterByRole('crops');
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
            'crop_name' => trans('persona.contact.name'),
            'crop_description' => trans('system.description'),
            'crop_key' => sections('crops.key'),
            'created_at' => trans('dates.created'),
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
            'crop_name' => 'string',
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
        return ['id'];
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
                'route' => 'dashboard.tools.crop_varieties.show',
                'button' => Form::actionButtons($icon = 'variety', $color = 'success'),
            ],
            [
                'route' => 'dashboard.tools.pests.show',
                'button' => Form::actionButtons($icon = 'pest', $color = 'danger'),
            ],
            [
                'route' => 'dashboard.tools.patterns.show',
                'button' => Form::actionButtons($icon = 'tree', $color = 'info'),
            ],
            [
                'route' => 'dashboard.tools.' . $section . '.edit',
                'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
            ],
        ];
    }
}
