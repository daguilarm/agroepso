<?php

namespace App\Models\Plots;

use Carbon\Carbon;

trait PlotsPresenters {

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    public function setPlotPercentCultivatedLandAttribute($value)
    {
        $this->attributes['plot_percent_cultivated_land'] = is_null($value)
            ? 0
            : $value;
    }

    public function setPlotNameAttribute($value)
    {
        $this->attributes['plot_name'] = is_null($value)
            ? sections('plots.name') . ' ' . $this->attributes['plot_ref']
            : $value;
    }
}
