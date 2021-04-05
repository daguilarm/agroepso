<?php

namespace App\Services\Info;

trait InfoRender {

    /**
     * @var protected
     */
    protected $icon = 'link';
    protected $sigpacUrl = 'http://sigpac.mapama.gob.es/fega/serviciosvisorsigpac/LayerInfo.aspx?layer=parcela&id=';

    /**
     * Render the row html5 from:
     * function setRow($data, $extra_text, $key, $result, $title, $total, $value)
     * If is an array, we need to parse the values base on the array key
     *
     * @param string $extra_text [For example a text addon]
     * @param string $result [The output results, at this point must be an empty value]
     * @param string $title [The title value for the row]
     * @param integer $total [Don't forget we are in the middle of a bucle. This is the current loop]
     * @param string $value [The current value]
     * @return array
     */
    private function renderRow($extra_text, $result, $title, $total, $value)
    {
        //Not autorized
        if($title === 'not-authorized') {
            return [$result, $total];
        }

        //Print sigpac
        if($title === 'sigpac') {
            $result .= self::renderToSigpac($value);

        //If catastro
        } else if($title === 'catastro') {
            $value = sprintf('<a href="%s" target="_blank">%s</a>', $value, str_limit($value, 35));
            $result .= sprintf('<tr><td>%s</td><td>%s</td></tr>', trans('geolocation.catastro_url'), $value);

        //Default value
        } else {
            $result .= sprintf('<tr><td>%s</td><td>%s %s</td></tr>', $title, $value, $extra_text);
        }

        //Add item to the list
        $total++;

        //Return the values
        return [$result, $total];
    }

    /**
     * Render a list of javascript variables
     *
     * @param array $array [List of javascript variables to render]
     * @return array
     */
    private function renderToScript($array) {
        $output = collect($array)
            ->filter(function(){
                return empty($array);
            })
            ->filter(function ($value) {
                return $value[0] === 'geo_lat' || $value[0] === 'geo_lng' || $value[0] === 'geo_x' || $value[0] === 'geo_y' || $value[0] === 'geo_z';
            })
            ->map(function($value) {
                return sprintf('window.%s=%s;', $value[0], $value[1]);
            })
            ->implode('');

        return sprintf('<script>%s</script>', $output);
    }

    /**
     * Render a sigpac table
     *
     * @param array $array [List of sigpac variables to render]
     * @param string $output
     * @return array
     */
    private function renderToSigpac($array, $output = '', $count = 0, $sigpac = '', $sigpactURL = '') {
        if(!empty($array)) {
            foreach($array as $key => $value) {
                if(is_numeric($value) || !empty($value)) {
                    $output .= sprintf('<td>%s: %s</td>', trans('geolocation.sigpac.' . $key), $value);
                    $sigpac .= sprintf('%s,',  $value);
                    //Remove precint from the sigpac url, because it will generate an error
                    if($count <= 5) {
                        $sigpactURL .= sprintf('%s,',  $value);
                    }
                    $count++;
                }
            }
        }

        //Generate the Sigpac link
        $link = $sigpac
            ? sprintf('SIGPAC <a href="%s%s" target="_blank" class="ml-2">%s</a>', $this->sigpacUrl, $sigpactURL, icon($this->icon))
            : null;

        return ($count > 0)
            ? sprintf('<table class="table %s"><tr><td colspan="%s" class="text-left font-weight-bold">%s</td></tr><tr>%s</tr></table>', $this->class, $count, $link, $output)
            : null;
    }
}
