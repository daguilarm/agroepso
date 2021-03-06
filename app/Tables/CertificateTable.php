<?php

namespace App\Tables;

use App\Models\Certificates\Certificate;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class CertificateTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Certificate::class)
            ->filterByRole('certificates')
            ->when(Credentials::isAdmin(), function($query) {
                return $query->withTrashed();
            });
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

    // /**
    //  * Generate the checkbox fields
    //  *
    //  * @return string/html
    //  */
    // public static function checkbox()
    // {
    //     return [
    //         'checkbox' => true,
    //     ];
    // }

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
            'modalDelete' => $section,
            'route' => 'dashboard.' . $section . '.destroy',
            'button' => Form::actionButtons($icon = 'delete', $color = 'danger', $css = 'modal-delete'),
        ]];

        $edit = [[
            'route' => 'dashboard.' . $section . '.edit',
            'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
        ]];

        if(Gate::allows('delete certificate', auth()->user())) {
            $array = array_merge($array, $delete);
        }

        if(Gate::allows('edit certificate', auth()->user())) {
            $array = array_merge($array, $edit);
        }

        return $array;
    }
}
