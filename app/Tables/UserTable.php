<?php

namespace App\Tables;

use App\Models\Clients\Client;
use App\Models\Users\User;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class UserTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(User::class)
            ->filterByRole('users')
            ->when(Credentials::isAdmin(), function($query) {
                return $query->withTrashed();
            })
            ->with('client', 'profile', 'roles');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
        $default = filterColumnByRole([
                'user_ref' => trans('system.code'),
                'nif' => trans('persona.id.all'),
                'name' => trans('persona.contact.name'),
                'deputy_name' => trans('persona.contact.deputy'),
                'active' => trans('persona.contact.active'),
                'email' => trans('persona.contact.email'),
                'profile.profile_city' => trans('persona.contact.city'),
                'locale' => trans('persona.contact.locale'),
            ],
            $roleFilter = (Credentials::isAdmin() || Credentials::isDop() || Credentials::isAdminValencia()),
            $newColumns = ['role' => trans('persona.contact.role')],//Admits multiple arrays
            $addInPosition = 3
        );

        return filterColumnByRole($default,
            $roleFilter = (Credentials::isAdmin() || Credentials::isAdminValencia()),
            $newColumns = ['client.client_name' => trans_title('clients'),],//Admits multiple arrays
            $addInPosition = 1
        );
    }

    /**
     * Search filter for table
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
            'user_ref' => 'string',
            'name' => 'string',
            'nif' => 'string',
            'email' => 'string',
            'active' => self::filterOption([
                'select' => 'active',
                'label' => trans('persona.contact.active'),
                'model' => configuration('boolean')
            ]),
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
        return ['user_ref'];
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

        if(Gate::allows('delete user', auth()->user())) {
            $array = array_merge($array, $edit);
        }

        if(Gate::allows('edit user', auth()->user())) {
            $array = array_merge($array, $delete);
        }

        return $array;
    }
}
