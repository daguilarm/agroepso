<?php

namespace App\Tables;

use Merkeleon\Table\Filter\SelectFilter;
use Cache;

trait _TableTrait {

    /**
     * Generate the table and prepare it for render in HTML
     *
     * @param string $section
     *
     * @return string/html
     */
    public static function create($section, $params = []) {
        $table = self::from(self::query($params))
            ->columns(self::columns())
            ->filters(self::search())
            ->totals(self::totals())
            ->filterCallback(function($model, $value = []) {
                return self::filterCallback($model, $value);
            })
            ->batchActions(self::checkbox())
            ->sortables(self::sortables())
            ->exporters(self::exportables())
            ->actions(self::actions($section))
            ->orderBy(self::orderBy()[0], self::orderBy()[1])
            ->paginate(self::pagination());

        return $table;
    }

    /**
     * Generate the model query
     *
     * For example: app(User::class)->with('client');
     *
     * @return object
     */
    public static function query($params = [])
    {
        return collect([]);
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
        return [];
    }

    /**
     * Search filter for table
     *
     * Search filters availables:
     *
     * 'fieldName' => 'string',
     * 'fieldName' => 'string|strict:true',
     * 'fieldName' => 'range|multiplier:10000',
     * 'fieldName' => 'date',
     * 'relationship' => self::filterOption([
     *     'select' => 'SelectName',
     *     'label' => trans('label'),
     *     'model' => MyModel::class,
     *     'fields' => ['id', 'fiedlName']
     * ]),
     *
     * @return object
     */
    public static function search()
    {
        return self::filterSearch([]);
    }

    /**
     * Generate total results for columns
     *
     * The allowed types are: 'sum' or 'count', for example: ['price' => 'sum', 'id' => 'count']
     *
     * @return integer
     */
    public static function totals()
    {
        return [];
    }

    /**
     * Generate a callback when you dont need to return an input.
     *
     * Example for listing users by role:
     *
     * if (auth()->user() && auth()->user()->hasRole($value)) {
     *     return $model->role($value);
     * }
     *
     * @return object
     */
    public static function filterCallback($model, $value)
    {
        return $model;
    }

    /**
     * Generate the checkbox fields
     *
     * @return string/html
     */
    public static function checkbox()
    {
        return [
            'checkbox' => false,
        ];
    }

    /**
     * Set the sortable columns
     *
     * Example for sortables fields:
     * return ['id', 'name', ...]
     *
     * @return array
     */
    public static function sortables()
    {
        return [];
    }

    /**
     * Set the exportable methods
     *
     * Example for exportable methods:
     * return ['csv']
     *
     * @return array
     */
    public static function exportables()
    {
        return [];
    }

    /**
     * Set the actions for the row
     *
     * Example for actions:
     * return ['route.to.action' => Form::action($icon = 'edit', $color = 'warning')]
     *
     * @param string $section
     * @param array $array
     *
     * @return array
     */
    public static function actions($section, array $array = [])
    {
        return [];
    }

    /**
     * Set orderBy for the model
     *
     * Default settings for 'orderBy id, asc'
     *
     * @return array
     */
    public static function orderBy()
    {
        return ['id', 'ASC'];
    }

    /**
     * Set the pagination results
     *
     * Default settings for 20 results per page
     *
     * @return integer
     */
    public static function pagination()
    {
        return 20;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Helper for filter option with relationship
     *
     * @return string/html
     */
    public static function filterOption(array $options, array $array = [])
    {
        //Return null if not pass a condition => Example: has a role...
        if(isset($options['conditional']) && $options['conditional'] === false) {
            return null;
        }

        //Create select
        $select = new SelectFilter($options['select']);

        //Filter for array or object
        if(is_array($options['model'])) {
            foreach($options['model'] as $key => $value) {
                if($value) {
                    $array[$key] = $value;
                }
            }
        } else {
            $array = app($options['model'])
                ->orderBy($options['fields'][1], 'asc')
                ->pluck($options['fields'][1], $options['fields'][0]);
        }

        return $select->options($array)->label($options['label']);
    }

    public static function filterSearch($array, $filter = [])
    {
        if(count($array) > 0) {
            foreach($array as $key => $value) {
                if($value) {
                    $filter[$key] = $value;
                }
            }
        }

        return $filter;
    }
}
