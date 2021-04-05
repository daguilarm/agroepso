<?php

/**
 * route_exits: check if a route is correct
 *
 * @param  string $route
 * @param  string $section
 * @return string
 */
if (!function_exists('route_exits')) {
    function route_exits(string $route, string $section)
    {
        //Dropdown route
        if(Route::has('dashboard.' . $route)) {
            return route('dashboard.' . $route);
        }

        //Direct route
        if(Route::has('dashboard.' . $section . '.' . $route)) {
            return route('dashboard.' . $section . '.' . $route);
        }

        //No results
        return '#';
    }
}

/**
 * route_for_tools: Generate a route for tools or for a regular secction
 *
 * @param  string $route
 * @param  string $section
 * @return string
 */
if (!function_exists('route_for_tools')) {
    function route_for_tools(string $action = 'index', string $section)
    {
        //Dropdown route
        if(Route::has('dashboard.tools.' . $section . '.' . $action)) {
            return route('dashboard.tools.' . $section . '.' . $action);
        }

        return route('dashboard.' . $section . '.' . $action);
    }
}

/**
 * Get the url _key parametter
 *
 * @param  string $url
 * @return string
 */
if (!function_exists('url_integer')) {
    function url_integer($value)
    {
        $key = request($value);

        return (!empty($key) && is_numeric($key))
            ? request($value)
            : null;
    }
}

/**
 * Get the url _key parametter
 *
 * @param  string $url
 * @return string
 */
if (!function_exists('url_key')) {
    function url_key()
    {
        return url_integer('_key');
    }
}

/**
 * Get all the parametters from a url
 *
 * @param  string $url
 * @return string
 */
if (!function_exists('url_params')) {
    function url_params($url = '?')
    {
        foreach(request()->all() as $key => $value) {
            if(is_array($value)) {
                foreach($value as $key => $value) {
                    $url .= $key . '=' . $value . '&';
                }
            } else {
                $url .= $key . '=' . $value . '&';
            }
        }

        return $url;
    }
}

/**
 * Get the domain extension
 *
 * @return string
 */
if (!function_exists('domain_ext')) {
    function domain_ext()
    {
        return pathinfo($_SERVER['SERVER_NAME'])['extension'];
    }
}

/**
 * Get the domain extension
 *
 * @param string $catastro
 * @param string $region
 * @param string $city
 * @return string
 */
if (!function_exists('url_catastro')) {
    function url_catastro($catastro, $region, $city)
    {
        return sprintf(
            '//www1.sedecatastro.gob.es/CYCBienInmueble/OVCConCiud.aspx?del=%s&mun=%s&UrbRus=R&RefC=%s&Apenom=&esBice=&RCBice1=&RCBice2=&DenoBice=&from=OVCListaBieness',
            $region,
            $city,
            $catastro
        );
    }
}
