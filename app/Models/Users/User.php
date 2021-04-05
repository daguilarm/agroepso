<?php

namespace App\Models\Users;

use App\Models\Dates;
use App\Models\Helpers;
use App\Models\Users\UsersEvents;
use App\Models\Users\UsersPresenters;
use App\Models\Users\UsersRelationships;
use App\Models\Users\UsersScopes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Dates, HasRoles, Helpers, Notifiable, SoftDeletes, SoftCascadeTrait;
    use UsersEvents, UsersHelpers, UsersPresenters, UsersRelationships, UsersScopes;

    /**
     * The attributes for the permissions
     *
     * @var array
     */
    protected $with = ['roles', 'permissions'];

    /**
     * The attributes for the cascade soft-deleting
     *
     * @var array
     */
    protected $softCascade = ['plot', 'profile'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_ref',
        'name',
        'deputy_name',
        'nif',
        'active',
        'email',
        'password',
        'locale',
        'client_id',
        'agreement',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'active',
    ];
}
