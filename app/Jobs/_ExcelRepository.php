<?php

namespace App\Jobs;

abstract class _ExcelRepository {

    /*
    |--------------------------------------------------------------------------
    | Sanitize data
    |--------------------------------------------------------------------------
    */

   /**
    * Sanitize data
    *
    * @param string $data
    * @param string $field
    * @param string $type ['string', 'integer', 'date', 'email', 'url', 'float']
    * @param string $alternateResult [When the $result value is null whe offer an alternative]
    * @return void
    */
    protected function sanitize($data, $field, $type = 'string', $alternateResult = null)
    {
        $value = $data[$field] ?? null;

        if(empty($value)) {
            return $alternateResult;
        }

        return str_filter($value, $type);
    }

   /*
   |--------------------------------------------------------------------------
   | Filters
   |--------------------------------------------------------------------------
   */

   /**
    * Validate email is unique.
    *
    * @param array $data
    * @return void
    */
    protected function filterEmail($data, $model) : bool
    {
        $email = (string) $data['email'];

        //Valid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        //Already in database
        if(optional($model::email($email))->id) {
            return false;
        }

        return true;
    }

   /**
    * Validate name.
    *
    * @param array $data
    * @return void
    */
    protected function filterName($data) : bool
    {
        $name = (string) $data['nombre'];

        //Valid name
        if(!filter_var($name, FILTER_SANITIZE_STRING) || empty($name)) {
            return false;
        }

        return true;
    }

   /**
    * Validate plot name.
    *
    * @param array $data
    * @return void
    */
    protected function filterPlot($data) : bool
    {
        $plot = (string) $data['parcela'];

        if(!empty($plot)) {
            return true;
        }

        return false;
    }

    /**
    * Validate name.
    *
    * @param array $data
    * @return void
    */
    protected function filterKeys($data) : bool
    {
        if(array_keys($data) === $this->allowed) {
            return true;
        }

        return false;
    }

    /**
    * Get the boolean value ['yes', 'not'].
    *
    * @param string $value
    * @return void
    */
    protected function filterBoolean($value) : string
    {
        $value = (string) strtolower($value);

        if($value === 'si' || $value === 'sip'  || $value === 'yes' || starts_with($value, 's') || starts_with($value, 'y')) {
            return 'yes';
        }

        return 'not';
    }
}
