<?php

namespace App\Models;

use App\Models\Dates;
use App\Models\Helpers;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model
{
    use Cachable, Dates, Helpers, SoftDeletes;
}
