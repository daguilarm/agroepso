<?php
/**
 * Available methods:
    * address()
    * avatar()
    * email()
    * id()
    * locale()
    * name()
    * url()
    * crop()
    * cropName()
    * cropKey()
    * client()
    * clientName()
    * plant()
    * warehouse()
 */

namespace App\Services\Credentials\Traits;

use App\Models\Crops\Crop;

trait Users
{
    /**
     * Get the user address
     * @return string
     */
    private function address()
    {
        return $this->user->profile->profile_address ?? null;
    }

    private function agreement()
    {
        return filter_var($this->user->agreement, FILTER_VALIDATE_IP);
    }

    /**
     * Get the user email
     * @return string
     */
    private function email()
    {
        return $this->user->email ?? null;
    }

    /**
     * Get the user id
     * @return string
     */
    private function id()
    {
        return $this->user->id ?? null;
    }

    /**
     * Get the user locale language
     * @return string
     */
    private function locale()
    {
        return $this->user->locale ?? null;
    }

    /**
     * Get the user name
     * @return string
     */
    private function name()
    {
        return $this->user->name ?? null;
    }

    /**
     * Get the user website
     * @return string
     */
    private function url()
    {
        return $this->user->profile->profile_url ?? null;
    }

    /**
     * Get the client id
     * @return string
     */
    private function client()
    {
        return $this->user->client_id ?? null;
    }

    /**
     * Get the client id
     * @return string
     */
    private function clientName()
    {
        return $this->user->client->client_name ?? null;
    }

    /**
     * Get the crop_id
     * @return string
     */
    private function crop()
    {
        return $this->user->client->crop_id ?? null;
    }

    /**
     * Get the crop_name
     * @return string
     */
    private function cropName()
    {
        return Crop::find(self::crop())->crop_name ?? null;
    }

    /**
     * Get the crop_name
     * @return string
     */
    private function cropKey()
    {
        return Crop::find(self::crop())->crop_key ?? null;
    }

    /**
     * Get the plant id
     * @return string
     */
    private function plant()
    {
        return $this->user->plant_id ?? null;
    }

    /**
     * Get the warehouse id
     * @return string
     */
    private function warehouse()
    {
        return $this->user->warehouse_id ?? null;
    }
}
