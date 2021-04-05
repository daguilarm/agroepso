<?php

namespace App\Models;

use Credentials, Image, Schema;

trait Helpers
{
    /*
    |--------------------------------------------------------------------------
    | Global scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Filter query by roles
     *
     * @param string $table
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeFilterByRole($query, $table)
    {
        return $query->when(Credentials::isAdmin(), function ($query) {
                return $query;
            })
            ->when(Credentials::isDop() || Credentials::isInspector() || Credentials::isCoop(), function ($query) use ($table) {
                if(Schema::hasColumn($table, 'client_id')) {
                    return $query->where($table . '.client_id', Credentials::client());
                }
            })
            ->when(Credentials::isUser(), function ($query) use ($table) {
                if(Schema::hasColumn($table, 'user_id')) {
                    return $query->where($table . '.user_id', Credentials::id());
                }
            });
    }

    /**
     * Get random results
     *
     * @param model $query
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeRandom($query)
    {
        return $query->inRandomOrder()->first();
    }

    /**
     * Get random id value from database
     *
     * @param model $query
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeRandomId($query)
    {
        return $query->random()->id;
    }


    /**
     * Get the last id inserted in a table
     *
     * @return array
     */
    public function scopeGetLastId()
    {
        return $this->latest()->first()->id;
    }

    /*
    |--------------------------------------------------------------------------
    | Global helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Create an pluck array from storage, with the blankOption.
     *
     * @param array $fields
     * @param bool $blankOption
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function selects($fields, $blankOption = true)
    {
        //No need to add the id field... its add by default
        //
        //selects('client_name') will return ['id', 'client_name']
        //selects(['client_name']) will return ['id', 'client_name']
        //selects(['id', 'client_name']) will return ['id', 'client_name']
        if(is_string($fields)) {
            list($key, $value) = ['id', $fields];
        } else {
            if(count($fields) <= 1) {
                list($key, $value) = ['id', $fields[0]];
            } else {
                list($key, $value) = [$fields[0], $fields[1]];
            }
        }

        return $blankOption
            ? ['' => ''] + $this->orderBy($value, 'asc')->pluck($value, $key)->toArray()
            : $this->orderBy($value, 'asc')->pluck($value, $key)->toArray();
    }

    /**
     * Get all the results from a model and return in json format.
     * Use for autocomplete...
     *
     * @param string    $term       [The search term]
     * @param string    $row        [DB row to be searched]
     * @param array     $columns    [DB columns to be returned]
     * @return array
     */
    public function ajax($term = null, $row = null, array $columns = [])
    {
        //Null response by default
        $response = null;

        //Search in DB
        if($term) {
            $columns = !empty($columns) ? $columns : ['id', $row . ' AS name'];

            //Numeric filter
            if(is_numeric($term)) {
                $response = $this->where($row, $term)->orderBy('name', 'asc')->select($columns[0], $columns[1])->get();

            //wildcard filter
            } else {
                $response = $this->where($row, 'LIKE', '%' . $term . '%')->orderBy('name', 'asc')->select($columns[0], $columns[1])->get();
            }
        }

        return response()->json($response);
    }

    /**
     * Restored a delete item
     *
     * @param integer $id [The search term]
     * @return array
     */
    public function restoredItem(int $id)
    {
        return $this->withTrashed()->whereId($id)->restore();
    }

    /**
     * Update a field by ID
     *
     * @param integer $id
     * @return array
     */
    public function updateId(int $id, $request)
    {
        return $this->find($id)->update($request->all()) ?? false;
    }

    /**
     * Create/Update a image
     *
     * @return  array
     */
    public function uploadImage($model, $modelId = null)
    {
         $file = request()->file('_image');
         $img = Image::make($file);
         response()->make($img->encode('jpeg'));

         //Create the image instance
         $image = [
           'model' => class_basename($model),
           'model_id' => $modelId ?? $model->id,//In the create case, we dont have the ID, so we get it from the model last created id
           'file' => $img
         ];

         //Save the image
         $model->image()->firstOrCreate($image);
    }
}
