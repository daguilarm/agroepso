<?php 

/**
 * Generate the action path
 * @param  string $file 
 * @return string
 */
if (!function_exists('action_path')) {
    function action_path($file = 'default')
    {
        return component_path('actions.') . $file;
    }
}

/**
 * Generate the dashboard path
 * @return string
 */
if (!function_exists('dashboard_path')) {
    function dashboard_path(string $file)
    {
        return 'dashboard.' . $file;
    }
}

/**
 * Generate the component path
 * @param  string $file 
 * @return string
 */
if (!function_exists('component_path')) {
    function component_path($file)
    {
        return dashboard_path('_components.') . $file;
    }
}

/**
 * Generate the forms path
 * @param  string $file 
 * @return string
 */
if (!function_exists('form_path')) {
    function form_path(string $section, $formName = '_form')
    {
        return dashboard_path($section . '.forms.') . $formName;
    }
}

/**
 * Generate the legends path
 * @param  string $file 
 * @return string
 */
if (!function_exists('legend_path')) {
    function legend_path($file = null)
    {
        return dashboard_path('_components.legends.') . ($file ?? 'default');
    }
}

/**
 * Generate the modals path
 * @param  string $file 
 * @return string
 */
if (!function_exists('modal_path')) {
    function modal_path(string $file)
    {
        return dashboard_path('_components.modals.') . $file;
    }
}