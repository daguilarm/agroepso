<?php

namespace Tests\Browser\_Helpers;

use App\Models\Profiles\Profile;
use App\Models\Users\User;

trait CustomUsersTestCase
{
    /**
     * Creates the default user: ADMIN
     *
     * @return App\Models\Users\User
     */
    public function defaultAdmin()
    {
        if($this->defaultAdmin) {
            return $this->defaultAdmin;
        }

        return $this->defaultAdmin = User::role('admin')->first();
    }

    /**
     * Creates the default user: ADMIN VALENCIA
     *
     * @return App\Models\Users\User
     */
    public function defaultAdminValencia()
    {
        if($this->defaultAdminValencia) {
            return $this->defaultAdminValencia;
        }

        return $this->defaultAdminValencia = User::role('admin-gv')->first();
    }

    /**
     * Creates the default user: DOP
     *
     * @param string $client ['valencia', 'granada']
     * @return App\Models\Users\User
     */
    public function defaultDop($client = 'valencia')
    {
        if($this->defaultDop) {
            return $this->defaultDop;
        }

        return $this->defaultDop = User::whereClientId($this->getClientId($client))->role('dop')->first();
    }

    /**
     * Creates the default user: Surveyor
     *
     * @param string $client ['valencia', 'granada']
     * @return App\Models\Users\User
     */
    public function defaultInspector($client = 'valencia')
    {
        if($this->defaultInspector) {
            return $this->defaultInspector;
        }

        return $this->defaultInspector = User::whereClientId($this->getClientId($client))->role('inspector')->first();
    }

    /**
     * Creates the default user: COOP
     *
     * @param string $client ['valencia', 'granada']
     * @return App\Models\Users\User
     */
    public function defaultCoop($client = 'valencia')
    {
        if($this->defaultCoop) {
            return $this->defaultCoop;
        }

        return $this->defaultCoop = User::whereClientId($this->getClientId($client))->role('coop')->first();
    }

    /**
     * Creates the default user: USER
     *
     * @param string $client ['valencia', 'granada']
     * @return App\Models\Users\User
     */
    public function defaultUser($client = 'valencia')
    {
        if($this->defaultUser) {
            return $this->defaultUser;
        }

        return $this->defaultUser = User::whereClientId($this->getClientId($client))->role('user')->first();
    }

    /**
     * Creates the default user: COMERCIAL
     *
     * @param string $client ['valencia', 'granada']
     * @return App\Models\Users\User
     */
    public function defaultComercial($client = 'valencia')
    {
        if($this->defaultComercial) {
            return $this->defaultComercial;
        }

        return $this->defaultComercial = User::whereClientId($this->getClientId($client))->role('comercial')->first();
    }

    /**
     * Creates a custom user: USER
     *
     * @param int $id
     * @return App\Models\Users\User
     */
    public function customUser($id = 20)
    {
        if($this->customUser) {
            return $this->customUser;
        }

        return $this->customUser = User::findOrFail($id)->get();
    }
}
