<?php

namespace App\Services\Info;

use App\Services\Info\InfoBuilder;
use App\Services\Info\InfoRender;

class InfoClass extends InfoBuilder {

    use InfoRender;

    /**
     * Render Table
     *
     * @param object $data The database results
     * @param string $result The output value
     * @param int $total The total values
     * @return mixed|string
     */
    public function render($data, $result = '', $total = 0, $script = [])
    {
        foreach($this->parseColumns() as $key => $title) {
            //Default the values
            $extra_text = '';
            $value = optional($data)->{$key} ?? null;

            //If value is an array
            if(is_array($title)) {
                list($extra_text, $title, $value, $javascript) = self::isArray($title, $data, $key);

                //Generate the javascript item
                if(!empty($javascript)) {
                    $script[] = array_values($javascript);
                }
            }

            //Set the values
            list($result, $total) = self::setRow($data, $extra_text, $key, $result, $title, $total, $value);
        }

        return ($total > 0)
            ? sprintf('%s<table id="table-info" class="table %s">%s%s</table>', $this->renderToScript($script), $this->class, $this->legend, $result)
            : null;
    }

    /**
     * Calculate if the table has results or not
     * We only show the content if not empty
     *
     * @param string $table The table name
     * @param object $data The database results
     * @param string $search The search value => 'prefix' or 'subfix'
     * @param string $prefix The default value
     * @param string $subfix The default value
     * @param int $total The total values
     * @return mixed|string
     */
    public function total($table, $data = null, $search = '', $prefix = '', $subfix = '', $total = 0)
    {
        //Get the columns
        $columns = self::getColumns($table);

        //Return the column number
        if(empty($data)) {
            return count($columns);
        }

        //Add the prefix and the subfix to the keys
        if($search) {
            $string_parts = explode(':', $search);
            if($string_parts[0] === 'prefix') {
                $prefix = $string_parts[1];
            }
            if($string_parts[0] === 'subfix') {
                $subfix = $string_parts[1];
            }
        }

        //Search for the results (base on the keys)
        foreach($columns as $key => $column) {
            if($data->{$prefix.$key.$subfix}) {
                $total++;
            }
        }

        return $total;
    }

    /**
     * Parse columns
     *
     * @return mixed|string
     */
    private function parseColumns()
    {
        $columns = parent::getColumns();

        //Added prefix or subfix if needed
        foreach($columns as $key => $column) {
            $result[$this->prefix . $key . $this->subfix] = $column;
        }

        return $result;
    }

    /**
     * Verify if the item is an array
     * If is an array, we need to parse the values base on the array key
     * Array values allowed: 'title', 'extra_title', 'setValue'
     *
     * @param array $title
     * @param string $data [The current value]
     * @param string $key [Don't forget we are in the middle of a bucle. This is the array $key]
     * @return array
     */
    private function isArray($title, $data, $key, array $javascript = [])
    {
        //Not autorized
        if(isset($title['authorized']) && !$title['authorized']) {
            return [null, 'not-authorized', null, null];
        }

        //Default value
        $value = optional($data)->{$key} ?? null;

        //If is a map
        if(is_null($value) && $key == 'map') {
            $value = $title['view'];
        }

        //setValue: when the value must be transform using a _config.php (or other) localization file
        if(!empty($title['setValue'])) {
            $value = $title['setValue'][$value] ?? $value;
        }

        //Javascript
        if(!empty($title['javascript'])) {

            //Default value
            $value = optional($data)->{$key} ?? null;

            //Check for a relationship
            $relationship = explode('.', $key);

            //If there is a relationship
            if(count($relationship) > 1) {
                //Set new value
                $value = optional($data->{$relationship[0]})->{$relationship[1]};
            }

            $javascript = [
                'varName' => $title['javascript'],
                'value' => $value
            ];
        }

        //Return the values
        return [$title['extra_text'] ?? null, $title['title'], $value, $javascript];
    }

    /**
     * Generate a new table row in html5 from:
     * function render($data, $result = '', $total = 0)
     *
     * @param array $data
     * @param string $extra_text [For example a text addon]
     * @param string $key [Don't forget we are in the middle of a bucle. This is the array $key]
     * @param string $result [The output results, at this point must be an empty value]
     * @param string $title [The title value for the row]
     * @param integer $total [Don't forget we are in the middle of a bucle. This is the current loop]
     * @param string $value [The current value]
     *
     * @return mixed|string
     */
    private function setRow($data, $extra_text, $key, $result, $title, $total, $value)
    {
        //Check for a relationship
        $relationship = explode('.', $key);

        //If there is a relationship
        if(count($relationship) > 1) {
            //Set new value
            $value = optional($data->{$relationship[0]})->{$relationship[1]};

            //Verify value exists
            if(!empty($value) || is_integer($value)) {
                //Return the table row
                list($result, $total) = self::renderRow($extra_text, $result, $title, $total, $value);
            }

        //Without relationship
        } else {
            //Verify value exists
            if($value) {
                //Return the table row
                list($result, $total) = self::renderRow($extra_text, $result, $title, $total, $value);
            }
        }

        return [$result, $total];
    }
}
