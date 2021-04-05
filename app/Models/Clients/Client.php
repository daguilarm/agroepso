<?php

namespace App\Models\Clients;

use App\Models\BaseModel;
use App\Models\Clients\ClientsEvents;
use App\Models\Clients\ClientsHelpers;
use App\Models\Clients\ClientsRelationships;
use App\Models\Clients\ClientsScopes;

class Client extends BaseModel {

    use ClientsEvents, ClientsHelpers, ClientsRelationships, ClientsScopes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plot_total' => 'integer',
        'plant_total' => 'integer',
        'warehouse_total' => 'integer',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crop_id',
        'client_address',
        'client_city',
        'client_contact',
        'client_country',
        'client_email',
        'client_name',
        'client_nif',
        'client_region',
        'client_state',
        'client_telephone',
        'client_web',
        'client_zip',
    ];
}
