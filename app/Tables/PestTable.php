<?php

namespace App\Tables;

use App\Models\Pests\Pest;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class PestTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query($params)
    {
        return app(Pest::class)
            ->filterByRole('pests')
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
            'pest_name' => trans_title('pests'),
            'pest_description' => trans('system.description'),
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
            'pest_name' => 'string',
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
        return ['id', 'pest_name'];
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
                'key' => request('pest'),
                'route' => 'dashboard.tools.' . $section . '.edit',
                'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
            ],
        ];
    }
}
