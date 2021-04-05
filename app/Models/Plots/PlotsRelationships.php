<?php

namespace App\Models\Plots;

use App\Models\Cities\City;
use App\Models\Clients\Client;
use App\Models\CropVarieties\CropVariety;
use App\Models\Crops\Crop;
use App\Models\Harvests\Harvest;
use App\Models\Inspections\Inspection;
use App\Models\Patterns\Pattern;
use App\Models\Plants\Plant;
use App\Models\PlotCrops\PlotCrop;
use App\Models\PlotGeolocations\PlotGeolocation;
use App\Models\Regions\Region;
use App\Models\States\State;
use App\Models\Users\User;
use App\Models\Warehouses\Warehouse;

trait PlotsRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function crop_variety()
    {
        return $this->belongsTo(CropVariety::class);
    }

    public function harvest()
    {
        return $this->belongsTo(Harvest::class);
    }

    public function geolocation()
    {
        return $this->hasOne(PlotGeolocation::class);
    }

    public function last_inspection()
    {
        return $this->hasOne(Inspection::class)->orderBy('inspection_date', 'desc');
    }

    public function inspection()
    {
        return $this->hasMany(Inspection::class)->orderBy('inspection_date', 'desc');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function pattern()
    {
        return $this->belongsTo(Pattern::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
