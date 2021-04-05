<?php

namespace App\Tables;

use App\Models\Modules\Module;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class ModuleTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Module::class)
            ->filterByRole('modules');
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
            'module_name' => trans_title('modules'),
            'module_key' => sections('modules.key'),
            'module_description' => trans('system.description'),
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
            'module_name' => 'string',
            'module_key' => 'string',
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
        return ['id', 'module_name'];
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
