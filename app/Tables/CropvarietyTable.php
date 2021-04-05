<?php

namespace App\Tables;

use App\Models\CropVarieties\CropVariety;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class CropVarietyTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query($params)
    {
        return app(CropVariety::class)
            ->filterByRole('crop_varieties')
            ->where('crop_id', $params['id'])
            ->with('crop');
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
            'crop.crop_name' => trans_title('crops'),
            'crop_variety_name' => trans_title('crop_varieties'),
            'crop_variety_type_text' => sections('crop_varieties.types'),
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
            'crop_variety_name' => 'string',
            'crop_variety_type' => self::filterOption([
                'select' => 'crop_variety_type',
                'label' => sections('crop_varieties.types'),
                'model' => configuration('crop_variety_types')
            ]),
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
        return ['id', 'crop_variety_name'];
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
                'key' => request('crop_variety'),
                'route' => 'dashboard.tools.' . $section . '.edit',
                'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
            ],
        ];
    }
}
