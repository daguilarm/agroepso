<?php

namespace App\Services\Credentials;

use App\Repositories\Clients\ClientsRepository;
use App\Services\Credentials\Traits\Authorize;
use App\Services\Credentials\Traits\Helpers;
use App\Services\Credentials\Traits\Users;

class CredentialsClass {

    use Authorize, Helpers, Users;

    /**
     * @var user
     */
    private $user;

    /**
     * @var Allowed methods for the Facade
     */
    private $allowed = [
        //Has roles
        'hasRoles',
        'role',
        'isGod',
        'isAdmin',
        'isAdminValencia',
        'isDop',
        'isInspector',
        'isCoop',
        'isUser',
        'isComercial',

        //Users
        'address',
        'agreement',
        'email',
        'id',
        'locale',
        'name',
        'url',
        'crop',
        'cropName',
        'cropKey',
        'client',
        'clientName',
        'tools',

        //Authorize
        'authorize',
        'accessError',
    ];

    /**
     * Create the constructor
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Generate the methods
     *
     * @param  string $method
     * @param  string $parameters
     *
     * @return Boolean
     */
    public function __call($method, $parameters)
    {
        if (isset($this->user) && in_array($method, $this->allowed)) {
            return call_user_func_array([$this, $method], $parameters);
        }
        return __('Method not allowed');
    }
}
