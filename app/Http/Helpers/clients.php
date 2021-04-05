<?php

use App\Models\Clients\Client;

/**
 * Get clients configuration
 *
 * @param string $value [dot notation]
 * @return bool
 */
if (!function_exists('getClient')) {
    function getClient(string $value)
    {
        //Get the fields
        $keys = explode('.', $value);

        //We need all the fields to be correct
        if(count($keys) > 1) {

            //Set values
            $type = $keys[0];
            $value = $keys[1];
            $field = ($type === 'module')
                ? 'module_key'
                : 'option_key';

            //Get configuration from client
            $configuration = Cache::rememberForever('clients-configuration-' . $type .'-' . md5(Credentials::client()), function() use ($type) {
                return Client::find(Credentials::client())->{$type};
            });

            //Get the values
            foreach($configuration as $item) {
                if($item->$field === $value) {
                    return true;
                }
            }
        }

        return false;
    }
}
