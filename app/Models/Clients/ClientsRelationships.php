<?php

namespace App\Models\Clients;

use App\Models\Crops\Crop;
use App\Models\Images\Image;
use App\Models\Irrigations\Irrigation;
use App\Models\Modules\Module;
use App\Models\Options\Option;
use App\Models\Plots\Plot;
use App\Models\Regions\Region;
use App\Models\Trainings\Training;
use App\Models\Users\User;

trait ClientsRelationships {

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
   public function crop()
   {
       return $this->belongsTo(Crop::class);
   }

   public function image()
   {
       return $this->belongsTo(Image::class);
   }

   public function irrigation()
   {
       return $this->belongsToMany(Irrigation::class);
   }

   public function module()
   {
       return $this->belongsToMany(Module::class);
   }

   public function region()
   {
       return $this->belongsToMany(Region::class);
   }

    public function option()
    {
        return $this->belongsToMany(Option::class);
    }

    public function plot()
    {
        return $this->belongsToMany(Plot::class);
    }

    public function training()
    {
        return $this->belongsToMany(Training::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships helpers
    |--------------------------------------------------------------------------
    */
   public function irrigationIdList()
   {
       return $this->belongsToMany(Irrigation::class)->pluck('id')->flatten();
   }

   public function moduleIdList()
   {
       return $this->belongsToMany(Module::class)->pluck('id')->flatten();
   }

   public function optionIdList()
   {
       return $this->belongsToMany(Option::class)->pluck('id')->flatten();
   }

   public function regionIdList()
   {
       return $this->belongsToMany(Region::class)->pluck('id')->flatten();
   }

   public function trainingIdList()
   {
       return $this->belongsToMany(Training::class)->pluck('id')->flatten();
   }
}
