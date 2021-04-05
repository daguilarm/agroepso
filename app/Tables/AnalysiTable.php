<?php

namespace App\Tables;

use App\Models\Analysis\Analysi;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class AnalysiTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Analysi::class)
            ->filterByRole('analysis');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
       return filterColumnByRole([
               'id' => trans('persona.id.id'),
               // 'name' => trans('persona.contact.name'),
               //'description' => trans('system.description'),
               // 'profile.profile_city' => trans('persona.contact.city'),
               // 'client.client_name' => trans_title('clients'),
               // 'locale' => trans('persona.contact.locale'),
               'created_at' => trans('dates.created'),
           ]//,
           // $roleFilter = Credentials::isAdmin(),
           // $newColumns = ['role' => trans('persona.contact.role')],//Admits multiple arrays
           // $addInPosition = 3
       );

        return [
            'id' => trans('persona.id.id'),
            // 'name' => trans('persona.contact.name'),
            // 'email' => trans('persona.contact.email'),
            // 'role' => trans('persona.contact.role'),
            // 'profile.profile_city' => trans('persona.contact.city'),
            // 'client.client_name' => trans_title('clients'),
            'created_at' => 'date',
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
            // 'name' => 'string',
            // 'email' => 'string',
            // 'client.client_name' => self::filterOption([
            //     'select' => 'client_id',
            //     'label' => trans_title('clients', 'plural'),
            //     'model' => Client::class,
            //     'fields' => ['id', 'client_name']
            // ]),
            'created_at' => 'date',
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
        $delete = [[
            'route' => 'dashboard.' . $section . '.delete',
            'button' => Form::actionButtons($icon = 'delete', $color = 'danger'),
        ]];

        $edit = [[
            'route' => 'dashboard.' . $section . '.edit',
            'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
        ]];

        if(Gate::allows('delete user', auth()->user())) {
            $array = array_merge($array, $edit);
        }

        if(Gate::allows('edit user', auth()->user())) {
            $array = array_merge($array, $delete);
        }

        return $array;
    }
}
