<?php

namespace App\Models;

use Carbon\Carbon;

trait Dates
{
    /**
     * Sanitize the date 'value'. Ready for DB!!!!
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    public function setDate($date, $format = 'd/m/Y')
    {
        if (strlen($date)) {
            $current = Carbon::createFromFormat($format, $date);
            //
            return $current->gte($this->min())
                ? $current
                : $minDate;
        }
        //
        return null;
    }

    /**
     * Get the date from the DB with its format
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    public function getDate($date, $format = 'd/m/Y')
    {
        return strlen($date)
            ? Carbon::parse($date)->format($format)
            : null;
    }

    /**
     * Set the correct format for a date value (base on Localization)
     *
     * @return string
     */
    private function format()
    {
        return config('app.locale') != 'en' ? 'd/m/Y' : 'm/d/Y';
    }

    /**
     * Set the minimal date value to be stored
     *
     * @return string
     */
    private function min()
    {
        return Carbon::create(1, 1, 1, 0, 0, 0);
    }
}
