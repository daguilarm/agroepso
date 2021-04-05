<?php

namespace App\Services\Tables;

use App\Services\Tables\TableBuilder;
use App\Services\Tables\_Traits\ButtonsTrait;
use Credentials;

class TableClass extends TableBuilder {

    use ButtonsTrait;

    /**
     * Render Table
     *
     * @param object $data
     * @param string $section
     * @param string $description
     * @return string
     */
    public function buttons($data, $section, $description = null, $output = '')
    {
        // Print button
        if(in_array('print', $data)) {
            $output .= $this->buttonPrint($data, $description, $section);
        }

        // Create button
        if(in_array('create', $data)  && (auth()->user()->can('create ' . str_singular($section)))) {
            $output .= $this->buttonCreate($data, $section);
        }

        // Create button with params (key)
        if(array_has($data, 'createWithKey')  && (auth()->user()->can('create ' . str_singular($section)))) {
            $output .= $this->buttonCreateWithKey($data, $section);
        }

        // Submit button: When we need to submit a form inside the table
        if(!empty($data['submit'])  && (auth()->user()->can('create ' . str_singular($section)) || Credentials::isAdmin())) {
            $output .= $this->buttonSubmit($data, $section);
        }

        // Create excel
        if(in_array('excel', $data)  && auth()->user()->can('upload excel')) {
            $output .= $this->buttonExcel($data, $section);
        }

        // Create a customized button
        if(array_key_exists('custom', $data)) {
            $output .= $this->buttonCustom($data);
        }

        // Create a customized button
        if(array_key_exists('dropdown', $data)) {
            $output .= $this->buttonDropdown($data);
        }

        return $output;
    }
}
