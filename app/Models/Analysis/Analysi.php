<?php 

namespace App\Models\Analysis;

use App\Models\Dates;
use App\Models\Helpers;
// use App\Models\Analysis\AnalysisEvents;
// use App\Models\Clients\AnalysisHelpers;
// use App\Models\Analysis\AnalysisPresenters;
// use App\Models\Analysis\AnalysisRelationships;
// use App\Models\Analysis\AnalysisScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Analysi extends Model  {

    use Dates, Helpers, SoftDeletes;
    //use AnalysisEvents, AnalysisPresenters, AnalysisRelationships, AnalysisScopes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'analysis';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'user_id',
        // 'client_id',
        // 'plot_id',
        // 'crop_id',
        // 'agronomic_date',
        // 'agronomic_quantity',
        // 'agronomic_quantity_unit',
        // 'agronomic_observations',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'is_god'    => 'boolean',
    // ];
}