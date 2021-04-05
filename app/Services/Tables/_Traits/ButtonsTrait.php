<?php

// function buttonPrint($data, $description, $section)
// function buttonCreate($data, $section)
// function buttonCreateWithKey($data, $section)
// function buttonSubmit($data, $section)
// function buttonExcel($data, $section)
// function buttonCustom($data)
// function buttonDropdown($data, $links = '')

namespace App\Services\Tables\_Traits;

use Html, Route;

trait ButtonsTrait {

    /**
     * Render Table button: print
     *
     * @param object $data
     * @param string $section
     * @param string $description [Sometime we need an accurate description for the printing...]
     * @return string
     */
    public function buttonPrint($data, $description, $section)
    {
        return sprintf(
            '<a class="btn btn-info btn-search ml-2" href="#" id="button-print" data-title="%s">%s</a>',
            $description ?? trans_description($section),
            icon('print')
        );
    }

    /**
     * Render Table button: create
     *
     * @param object $data
     * @param string $section
     * @return string
     */
    public function buttonCreate($data, $section)
    {
        return sprintf(
            '<a class="btn btn-terciary btn-search ml-2" href="%s" id="button-create">%s</a>',
            Html::urlToCreate($section),
            icon('new')
        );
    }

    /**
     * Render Table button: create with params (key)
     *
     * @param object $data
     * @param string $section
     * @return string
     */
    public function buttonCreateWithKey($data, $section)
    {
        return sprintf(
            '<a class="btn btn-terciary btn-search ml-2" href="%s" id="button-create">%s</a>',
            Html::urlToCreateWithKey($section, $data['createWithKey']),
            icon('new')
        );
    }

    /**
     * Render Table button: use a button to submit a form inside the table
     *
     * @param object $data
     * @param string $section
     * @return string
     */
    public function buttonSubmit($data, $section)
    {
        return sprintf(
            '<button id="button-submit" class="btn btn-danger btn-search ml-2 pt-1 pl-3 pb-3">%s</button>',
            icon('refresh')
        );
    }

    /**
     * Render Table button: upload files from excel
     *
     * @param object $data
     * @param string $section
     * @return string
     */
    public function buttonExcel($data, $section)
    {
        $url = Route::has('dashboard.tools.' . $section . '.excel')
            ? route('dashboard.tools.' . $section . '.excel')
            : route('dashboard.' . $section . '.excel');

        return sprintf(
            '<a class="btn btn-warning btn-search ml-2" href="%s" id="button-excel">%s</a>',
            $url,
            icon('upload')
        );
    }

    /**
     * Render Table button: create a customize button
     *
     * @param object $data
     * @return string
     */
    public function buttonCustom($data)
    {
        return $data['custom'];
    }

    /**
     * Render Table button: create a customize button
     *
     * @param object $data
     * @return string
     */
    public function buttonDropdown($data, $links = '')
    {
        $links = collect($data['dropdown'])->map(function($link) {
            return $link[0];
        })->implode('');

        //Dropdown button
        $button = sprintf('<button class="btn btn-terciary dropdown-toggle btn-margin-search" type="button" id="dropdown-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">%s</button>', icon('config', trans('system.options')));

        //Options container
        $options = sprintf('<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">%s</div>', $links);

        return sprintf('<div class="dropdown">%s%s</div>', $button, $options);
    }
}
