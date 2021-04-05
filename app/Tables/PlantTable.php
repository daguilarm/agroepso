<?php

namespace App\Tables;

use App\Models\Clients\Client;
use App\Models\Plants\Plant;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class PlantTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Plant::class)
            ->filterByRole('plants')
            ->when(Credentials::isAdmin(), function($query) {
                return $query->withTrashed();
            })
            ->with('client');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
       return filterColumnByRole([
               'plant_ref' => trans('system.code'),
               'plant_name' => trans_title('plants'),
               'plant_company' => trans('system.company'),
               'plant_nif' => trans('persona.id.all'),
               'plant_region' => trans('persona.contact.region'),
               'plant_city' => trans('persona.contact.city'),
               'plant_email' => trans('persona.contact.email'),
               'plant_telephone' => trans('persona.contact.telephone'),
               'plant_contact' => trans('persona.contact.contact'),
           ],
           $roleFilter = (Credentials::isAdmin() || Credentials::isAdminValencia()),
           $newColumns = ['client.client_name' => trans_title('clients')],//Admits multiple arrays
           $addInPosition = 2
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
            'plant_company' => 'string',
            'plant_name' => 'string',
            'plant_region' => 'string',
            'plant_city' => 'string',
            'plant_ref' => 'string',
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
        return ['plant_ref', 'plant_name', 'plant_region', 'plant_city'];
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

        if(Gate::allows('delete plant', auth()->user())) {
            $array = array_merge($array, $edit);
        }

        if(Gate::allows('edit plant', auth()->user())) {
            $array = array_merge($array, $delete);
        }

        return $array;
    }
}
