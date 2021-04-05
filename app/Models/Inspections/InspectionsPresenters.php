<?php

namespace App\Models\Inspections;

trait InspectionsPresenters {

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    public function setInspectionDateAttribute($value)
    {
        $this->attributes['inspection_date'] = $this->setDate($value);
    }

    public function getInspectionDateAttribute($value)
    {
        return $this->getDate($value);
    }

    public function setInspectionPlaningDateAttribute($value)
    {
        $this->attributes['inspection_planing_date'] = $this->setDate($value);
    }

    public function getInspectionPlaningDateAttribute($value)
    {
        return $this->getDate($value);
    }

    public function getInspectionTimeAttribute($value)
    {
        return format_minutes($this->attributes['inspection_total_time']);
    }
}
