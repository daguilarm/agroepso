<?php

namespace App\Tables;

use App\Models\Clients\Client;
use App\Models\Warehouses\Warehouse;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class WarehouseTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Warehouse::class)
            ->filterByRole('warehouses')
            ->when(Credentials::isAdmin(), function($query) {
                return $query->withTrashed();
            })
            ->with('client', 'plant');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
       return filterColumnByRole([
               'warehouse_ref' => trans('system.code'),
               'plant.plant_name' => trans_title('plants'),
               'warehouse_name' => trans_title('warehouses'),
               'warehouse_company' => trans('system.company'),
               'warehouse_address' => trans('persona.contact.address'),
               'warehouse_region' => trans('persona.contact.region'),
               'warehouse_city' => trans('persona.contact.city'),
               'warehouse_zip' => trans('persona.contact.zip'),
               'warehouse_telephone' => trans('persona.contact.telephone'),
               'warehouse_contact' => trans('persona.contact.contact'),
           ],
           $roleFilter = (Credentials::isAdmin() || Credentials::isAdminValencia()),
           $newColumns = ['client.client_name' => trans_title('clients')],//Admits multiple arrays
           $addInPosition = 1
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
            'warehouse_company' => 'string',
            'warehouse_region' => 'string',
            'warehouse_city' => 'string',
            'warehouse_zip' => 'string',
            'warehouse_ref' => 'string',
            'client.client_name' => self::filterOption([
                'conditional' => Credentials::hasRoles(['admin', 'admin-gv']),
                'select' => 'client_id',
                'label' => trans_title('clients', 'plural'),
                'model' => Client::class,
                'fields' => ['id', 'client_name']
            ])
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
        return ['warehouse_ref'];
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
            'modalDelete' => $section,
            'route' => 'dashboard.' . $section . '.destroy',
            'button' => Form::actionButtons($icon = 'delete', $color = 'danger', $css = 'modal-delete'),
        ]];

        $edit = [[
            'route' => 'dashboard.' . $section . '.edit',
            'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
        ]];

        $array = [[
            'modalInfo' => sections($section . '.forms.label'),
            'route' => 'dashboard.' . $section . '.show',
            'button' => Form::actionButtons($icon = 'info', $color = 'terciary', $css = 'modal-info'),
        ]];

        if(Gate::allows('delete warehouse', auth()->user())) {
            $array = array_merge($array, $edit);
        }

        if(Gate::allows('edit warehouse', auth()->user())) {
            $array = array_merge($array, $delete);
        }

        return $array;
    }
}
