<?php

// getValuesFromEloquent(array $models = [])
// deleteItem($model, $id = null, $fieldName = null)
// filterColumnByRole($columns, $condition = false, $extraColumns = null, $position = null)
// getReferenceFromClient($tableField, $clientId = null)
// getUserReference()
// getPlotReference()
// getInspectionReference()
// getPlantReference()
// getWarehouseReference()

use App\Models\Clients\Client;
use App\Models\Plants\Plant;

/**
 * Generate the item confirm texts
 *
 * @param  object $model
 * @param  integer $id
 * @param  string $fieldName
 * @return mixed
 */
if (!function_exists('getValuesFromEloquent')) {
    function getValuesFromEloquent(array $models = [])
    {
        //Default values
        $clients = $plants = $warehouses = [];
        $clientId = Credentials::client();

        //Get parametters
        if(Credentials::isAdmin() || Credentials::isAdminValencia()) {
            if(in_array('clients', $models)) {
                $clients = app(Client::class)->selectByName();
            }
        } else {
            if(in_array('plants', $models)) {
                $plants = app(Plant::class)->selectsByData($clientId);
            }
        }

        return [$clients, $plants, $warehouses];
    }
}

/**
 * Generate the item confirm texts
 *
 * @param  object $model
 * @param  integer $id
 * @param  string $fieldName
 * @return mixed
 */
if (!function_exists('deleteItem')) {
    function deleteItem($model, $id = null, $fieldName = null)
    {
        //Delete items
        if($id && $fieldName) {
            return [$id, $model->findOrFail($id)->{$fieldName}];
        }
        return false;
    }
}

/**
 * Generate the item confirm texts
 *
 * @param  object $model
 * @param  integer $id
 * @param  string $fieldName
 * @return mixed
 */
if (!function_exists('filterColumnByRole')) {
    function filterColumnByRole($columns, $condition = false, $extraColumns = null, $position = null)
    {
        if($condition) {
            $start = array_slice($columns, 0, $position);
            $end = array_slice($columns, $position);
            $columns = array_merge($start, $extraColumns, $end);
        }
        return $columns;
    }
}

/**
 * Generate the item confirm texts
 *
 * @param  string $tableField
 * @param  string $clientId
 * @return mixed
 */
if (!function_exists('getReferenceFromClient')) {
    function getReferenceFromClient($tableField, $clientId = null)
    {
        if(is_null($clientId)) {
            return null;
        }

        $field = $tableField . '_total';
        $next = app(Client::class)->find($clientId)->{$field};

        return format_ref($next + 1);
    }
}

/**
 * Shorthand for user reference
 *
 * @return mixed
 */
if (!function_exists('getUserReference')) {
    function getUserReference()
    {
        return getReferenceFromClient('user', request()->client_id);
    }
}

/**
 * Shorthand for plot reference
 *
 * @return mixed
 */
if (!function_exists('getPlotReference')) {
    function getPlotReference()
    {
        return getReferenceFromClient('plot', request()->client_id);
    }
}

/**
 * Shorthand for inspection reference
 *
 * @return mixed
 */
if (!function_exists('getInspectionReference')) {
    function getInspectionReference()
    {
        return getReferenceFromClient('inspection', request()->client_id);
    }
}

/**
 * Shorthand for plant reference
 *
 * @return mixed
 */
if (!function_exists('getPlantReference')) {
    function getPlantReference()
    {
        return getReferenceFromClient('plant', request()->client_id);
    }
}

/**
 * Shorthand for warehouse reference
 *
 * @return mixed
 */
if (!function_exists('getWarehouseReference')) {
    function getWarehouseReference()
    {
        return getReferenceFromClient('warehouse', request()->client_id);
    }
}
