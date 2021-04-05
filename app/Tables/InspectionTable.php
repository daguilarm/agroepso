<?php

namespace App\Tables;

use App\Models\Clients\Client;
use App\Models\Inspections\Inspection;
use App\Models\Plots\Plot;
use App\Models\Users\User;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class InspectionTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Inspection::class)
            ->filterByRole('inspections')
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
                'city.city_name' => trans_title('cities'),
                'user.name' => sections('inspections.surveyor'),
                'inspection_planing_date' => trans('dates.planing'),
                'inspection_date' => trans('dates.accomplished'),
                'inspection_time' => sections('inspections.time'),
                'inspection_type' => sections('inspections.type'),
                'inspection_status' => trans('system.status'),
                'inspection_result' => sections('inspections.result'),
            ],
            $roleFilter = Credentials::isAdmin(),
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
            'inspection_type' => self::filterOption([
                'select' => 'inspection_type',
                'label' => sections('inspections.type'),
                'model' => selectInspectionType()
            ]),
            'inspection_status' => self::filterOption([
                'select' => 'inspection_status',
                'label' => sections('inspections.status'),
                'model' => selectInspectionStatus()
            ]),
            'inspection_result' => self::filterOption([
                'select' => 'inspection_result',
                'label' => sections('inspections.result'),
                'model' => selectInspectionResult()
            ]),
            'inspection_date' => 'date',
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
        $edit = [[
            'route' => 'dashboard.' . $section . '.edit',
            'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
        ]];

        if(Gate::allows('edit inspection', auth()->user())) {
            $array = array_merge($array, $edit);
        }

        return $array;
    }
}
