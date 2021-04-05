<?php
/**
 * Available methods:
    * role()
    * isGod()
    * isAdmin()
    * isAdminValencia()
    * isDop()
    * isInspector()
    * isCoop()
    * isUser()
    * isOnlyRole()
    * isComercial()
 */

namespace App\Services\Credentials\Traits;

trait Helpers
{
    /**
     * Verify is the user has the role: Comercial
     * @return boolean
     */
    private function hasRoles(array $roles)  : bool
    {
        return $this->user->hasAnyRole($roles);
    }

    /**
     * Return the role
     * @return boolean
     */
    private function role()  : string
    {
        return $this->user->getRoleNames()->first();
    }

    /**
     * Verify is the user has the role: Admin
     * @return boolean
     */
    private function isGod()  : bool
    {
        return $this->user->id === 1;
    }

    /**
     * Verify is the user has the role: Admin
     * @return boolean
     */
    private function isAdmin()  : bool
    {
        return $this->user->hasRole('admin');
    }

    /**
     * Verify is the user has the role: Admin-gv
     * @return boolean
     */
    private function isAdminValencia()  : bool
    {
        return $this->user->hasRole('admin-gv');
    }

    /**
     * Verify is the user has the role: Dop
     * @return boolean
     */
    private function isDop()  : bool
    {
        return $this->user->hasRole('dop');
    }

    /**
     * Verify is the user has the role: Inspector
     * @return boolean
     */
    private function isInspector()  : bool
    {
        return $this->user->hasRole('inspector');
    }

    /**
     * Verify is the user has the role: Cooperative
     * @return boolean
     */
    private function isCoop()  : bool
    {
        return $this->user->hasRole('coop');
    }

    /**
     * Verify is the user has the role: User
     * @return boolean
     */
    private function isUser($role = 'user')  : bool
    {
        return $this->user->hasRole('user');
    }

    /**
     * Verify is the user has the role: Comercial
     * @return boolean
     */
    private function isComercial($role = 'comercial')  : bool
    {
        return $this->user->hasRole('comercial');
    }
}
