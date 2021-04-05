<?php

namespace App\Tables;

use App\Tables\_TableTrait;
use Credentials, Form, Table;
use Spatie\Permission\Models\Role;

class RoleTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Role::class);
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
            'name' => trans('persona.contact.name'),
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
            'name' => 'string',
            'created_at' => 'date'
        ];
    }

    /**
     * Generate batch actions
     *
     * @param string $role
     * @param string $section
     *
     * @return string/html
     */
    public static function actions($section)
    {
        return [
            [
                'route' => 'dashboard.tools.' . $section . '.edit',
                'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
            ],
        ];
    }
}
