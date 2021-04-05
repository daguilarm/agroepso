<?php

namespace App\Tables;

use App\Models\Clients\Client;
use App\Models\Plots\Plot;
use App\Models\Users\User;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class PlotTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Plot::class)
            ->filterByRole('plots')
            ->when(Credentials::isAdmin(), function($query) {
                return $query->withTrashed();
            })
            ->with('city', 'client', 'user');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
       return filterColumnByRole([
               'plot_ref' => trans('system.code'),
               'plot_name' => trans_title('plots'),
               'user.name' => trans_title('users'),
               'city.city_name' => trans_title('cities'),
               'plot_percent_cultivated_land' => sections('plots.cultivated_land'),
               'plot_real_area' => sections('plots.real_area'),
               'plot_start_date' => sections('plots.start_date'),
               'plot_active' => trans('persona.contact.active'),
               'plot_green_cover' => sections('plots.green_cover'),
               'plot_pond' => sections('plots.pond'),
               'plot_road' => sections('plots.road'),
           ],
           $roleFilter = Credentials::isAdmin(),
           $newColumns = ['client.client_name' => trans_title('clients')],//Admits multiple arrays
           $addInPosition = 3
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
            'plot_ref' => 'string',
            'plot_name' => 'string',
            'plot_start_date' => 'string',
            'user.name' => self::filterOption([
                'select' => 'id',
                'label' => trans_title('users', 'plural'),
                'fields' => ['id', 'name'],
                //ComboBox user list base on the current client
                //See in App\Models\Users\UsersScopes
                'model' => app(User::class)->bySearch(),
            ]),
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
        return ['plot_ref', 'plot_active', 'plot_percent_cultivated_land', 'plot_real_area', 'plot_start_date'];
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

        if(Gate::allows('delete plot', auth()->user())) {
            $array = array_merge($array, $edit);
        }

        if(Gate::allows('edit plot', auth()->user())) {
            $array = array_merge($array, $delete);
        }

        return $array;
    }
}
