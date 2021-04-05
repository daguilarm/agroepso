<?php

/**
 * Error: Not allowed access
 *
 * @return \Illuminate\Http\Response
 */
if (!function_exists('errorNotAllowedAccess')) {
    function errorNotAllowedAccess()
    {
        return redirect()
            ->route('dashboard')
            ->withErrors(trans('alerts.errors.notAllowed'));
    }
}

/**
 * Error: Database error
 *
 * @return \Illuminate\Http\Response
 */
if (!function_exists('errorDataBase')) {
    function errorDataBase($type = 'create')
    {
        return redirect()
            ->back()
            ->withErrors([trans('alerts.database.msg'), trans('alerts.database.type.' . $type)]);
    }
}

/**
 * Error: No data
 *
 * @return \Illuminate\Http\Response
 */
if (!function_exists('no_results')) {
    function no_results($default = '-')
    {
        return $default;
    }
}
