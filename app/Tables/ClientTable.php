<?php

namespace App\Tables;

use App\Models\Clients\Client;
use App\Models\Crops\Crop;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class ClientTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Client::class)
            ->filterByRole('clients')
            ->when(Credentials::isAdmin(), function($query) {
                return $query->withTrashed();
            })
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
            'client_name' => trans_title('clients'),
            'client_contact' => trans('persona.contact.contact'),
            'client_email' => trans('persona.contact.email'),
            'client_telephone' => trans('persona.contact.telephone'),
            'client_nif' => trans('persona.id.all'),
            'client_region' => trans('persona.contact.region'),
            'client_city' => trans('persona.contact.city'),
            'client_zip' => trans('persona.contact.zip'),
            'crop.crop_name'  => trans_title('crops'),
            'plot_total' => trans_title('plots', 'plural'),
            'plant_total' => trans_title('plants', 'plural'),
            'warehouse_total' => trans_title('warehouses', 'plural'),
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
            'client_name' => 'string',
            'client_contact' => 'string',
            'crop.crop_name' => self::filterOption([
                'select' => 'crop_id',
                'label' => trans_title('crops', 'plural'),
                'model' => Crop::class,
                'fields' => ['id', 'crop_name']
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
        return ['id'];
    }

    /**
     * Generate batch actions
     *
     * @param string $section
     *
     * @return string/html
     */
    public static function actions($section)
    {
        $array = [[
            'outclick' => 'client_web',
            'button' => Form::actionButtons($icon = 'world', $color = 'primary')
        ]];

        $delete = [[
            'modalDelete' => $section,
            'route' => 'dashboard.' . $section . '.destroy',
            'button' => Form::actionButtons($icon = 'delete', $color = 'danger', $css = 'modal-delete'),
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
