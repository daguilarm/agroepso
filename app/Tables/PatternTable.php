<?php

namespace App\Tables;

use App\Models\Patterns\Pattern;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class PatternTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query($params)
    {
        return app(Pattern::class)
            ->filterByRole('patterns')
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
            'pattern_name' => trans_title('patterns'),
            'pattern_reference' => trans('system.reference'),
            'pattern_description' => trans('system.description'),
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
            'pattern_name' => 'string',
            'pattern_reference' => 'string',
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
                'key' => request('pattern'),
                'route' => 'dashboard.tools.' . $section . '.edit',
                'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
            ],
        ];
    }
}
