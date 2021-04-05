<?php

namespace App\Tables;

use App\Models\Clients\Client;
use App\Models\Harvests\Harvest;
use App\Models\Plots\Plot;
use App\Models\Users\User;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class HarvestTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Harvest::class)
            ->filterByRole('harvests')
            ->when(Credentials::isAdmin(), function($query) {
                return $query->withTrashed();
            })
            ->with('client', 'plot', 'user');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
        $default = filterColumnByRole([
                'plot.plot_name' => trans_title('plots'),
                'agronomic_date' => sections('harvests.date'),
                'agronomic_quantity' => trans('system.quantity'),
                'agronomic_quantity_unit' => trans('system.units'),
                'agronomic_observations' => trans('system.observations'),
            ],
            $roleFilter = (Credentials::isAdmin() || Credentials::isDop() || Credentials::isAdminValencia()),
            $newColumns = ['user.name' => trans_title('users')],//Admits multiple arrays
            $addInPosition = 0
        );

        return filterColumnByRole($default,
            $roleFilter = (Credentials::isAdmin() || Credentials::isAdminValencia()),
            $newColumns = ['client.client_name' => trans_title('clients'),],//Admits multiple arrays
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
            'client.client_name' => self::filterOption([
                'conditional' => Credentials::hasRoles(['admin', 'admin-gv']),
                'select' => 'client_id',
                'label' => trans_title('clients', 'plural'),
                'model' => Client::class,
                'fields' => ['id', 'client_name']
            ]),
            'user.name' => self::filterOption([
                'select' => 'id',
                'label' => trans_title('users', 'plural'),
                'fields' => ['id', 'name'],
                //ComboBox user list base on the current client
                //See in App\Models\Users\UsersScopes
                'model' => app(User::class)->bySearch(),
            ]),
            'plot.plot_name' => self::filterOption([
                'select' => 'id',
                'label' => trans_title('plots', 'plural'),
                'fields' => ['id', 'plot_name'],
                //ComboBox user list base on the current client
                //See in App\Models\Users\UsersScopes
                'model' => app(Plot::class)->bySearch(),
            ]),
            'agronomic_date' => 'date',
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

        $show = [[
            'route' => 'dashboard.' . $section . '.show',
            'button' => Form::actionButtons($icon = 'info', $color = 'info'),
        ]];

        if(Gate::allows('view harvest', auth()->user())) {
            $array = array_merge($array, $show);
        }

        if(Gate::allows('delete harvest', auth()->user())) {
            $array = array_merge($array, $delete);
        }

        if(Gate::allows('edit harvest', auth()->user())) {
            $array = array_merge($array, $edit);
        }

        return $array;
    }
}
