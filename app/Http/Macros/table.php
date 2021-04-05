<?php

/**
 * Generate the url for the actions
 *
 * @param  string $route
 * @param  object $data
 * @param  string $name
 * @return string
 */
Html::macro('tableRow', function($data, $key)
{
    //Set Default values
    $value = array_get($data, $key);

    $container = '%s';

    //Deleted fields
    if(array_get($data, 'deleted_at')) {
        $container = '<del>%s</del>';
    }

    //filter for road
    if($key === 'plot_road') {
        list($value, $container) = table_color_filter($value, 'road');
    }

    //filter for inspection status
    if($key === 'inspection_status') {
        list($value, $container) = table_color_filter($value, 'inspection_status');
    }

    //Units
    if($key === 'agronomic_quantity_unit') {
        $value = configuration('units')[$value];
    }

    //filter for inspection type
    if($key === 'inspection_type') {
        $value = configurationValue('inspection_type', $value);
    }

    //filter for inspection result
    if($key === 'inspection_result') {
        list($value, $container) = table_color_filter($value, 'inspection_result');
    }

    //Set if the row has an email value
    $email = filter_var($value, FILTER_VALIDATE_EMAIL);

    //Set if the row has an url value
    $url = filter_var($value, FILTER_VALIDATE_URL);

    //Filter the value base on environment
    //Filter by email
    if(App::environment('local') || App::environment('production') || $email || $url) {
        if($email) {
            $value = sprintf('<a href="mail:%s">%s</a>', $value, $value);
        } elseif($url) {
            $value = sprintf('<a href="%s">%s</a>', $value, $value);
        } else {
            if($value == strip_tags($value)) {
                $value = format_text($value);
            }
        }
    }

    //Yes or not values
    if($value === 'yes') {
        $value = sprintf('<span class="alert table-success">%s</span>', selectBoolean('yes'));
    }
    if($value === 'not') {
        $value = sprintf('<span class="alert table-danger">%s</span>', selectBoolean('not'));
    }

    //Empty values
    if(is_null($value) || empty($value)) {
        $value = '-';
    }

    return sprintf($container, $value);
});

/**
 * Generate the action button constructor
 *
 * @param  string $route
 * @param  object $data
 * @param  string $name
 * @return string
 */
Html::macro('tableAction', function($route, $data, $name, $attributes = null)
{
    //External link
    if (isset($name['outclick']) && filter_var($data[$name['outclick']], FILTER_VALIDATE_URL)) {
        $route = $data[$name['outclick']];

    //Route with key
    } elseif(!empty($name['key'])) {
        $route = route($name['route'], [
            'id' => $data,
            '_key' => $name['key']
        ]);

    //Generate modal delete
    } elseif(!empty($name['modalDelete'])) {
        $attributes = ' data-toggle="modal" data-target="#modal-delete"';
        $route = route($name['route'], $data);

    //Generate modal info
    } elseif(!empty($name['modalInfo'])) {
        $attributes = ' data-title="' . $name['modalInfo']. '"';
        $route = route($name['route'], $data);

    //Default values
    } else {
        if(!empty($name['route'])) {
            $route = route($name['route'], $data);
        }
    }

    return $route
        ? sprintf('<a href="%s"%s>%s</a>', $route, $attributes, $name['button'])
        : null;
});

/**
 * Generate the action button
 *
 * @param  string $icon
 * @param  string $color
 * @return string
 */
Form::macro('actionButtons', function($icon, $color, $css = '')
{
    return sprintf('<button class="btn btn-action btn-%s m-1 %s" type="button">%s</button>', $color, $css, icon($icon));
});

/**
 * Generate the action button
 *
 * @param  string $icon
 * @param  string $color
 * @return string
 */
Form::macro('restoreButtons', function($data, $section)
{
    $route = route('dashboard.' . $section . '.restore', $data->id);

    return sprintf('<a href="%s"><button class="btn btn-action btn-danger m-1 button-restore" type="button">%s</button></a>', $route, icon('reset'));
});
