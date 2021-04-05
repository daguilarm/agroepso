<?php

namespace App\Models\Clients;

use App\Models\Modules\Module;
use App\Models\Options\Option;
use App\Models\Regions\Region;

trait ClientsHelpers {

    /*
    |--------------------------------------------------------------------------
    | Data base Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Create clients and images
     *
     * @param object $request
     * @var string
     */
    public function toCreate($request)
    {
        //Update
        $create = $this->create($request->all());
        self::syncRelationships($create);

        //Create/Update image
        if (request()->has('_image')) {
            parent::uploadImage($create);
        }
    }

    /**
     * Update clients and images
     *
     * @param object $request
     * @param int $id
     * @var string
     */
    public function toUpdate($request, int $id)
    {
        //Update
        $update = $this->findOrFail($id);
        if($update->update($request->all())) {
            self::syncRelationships($update);
        }

        //Create/Update image
        if (request()->has('_image')) {
            parent::uploadImage($update, $id);
        }
    }

    /**
     * Sync with all the relationships
     *
     * @return  boolean
     */
    private function syncRelationships($model)
    {
        $model->module()->sync(request('modules'));
        $model->region()->sync(request('regions'));
        $model->option()->sync(request('options'));
    }

    /*
    |--------------------------------------------------------------------------
    | Auxiliar helpers
    |--------------------------------------------------------------------------
    */

   /**
    * Get data from all the relationships, through pivot tables
    * This is used for the checkbox in the client form
    *
    * @return  boolean
    */
   public function dataFromRelationships($data = null) : array
   {
        //Default value
        $default = collect([]);

        //Get all the data
        return [
            'modules' => [
                'all'       => app(Module::class)->all(),
                'selected'  => optional($data)->moduleIdList() ?? $default
            ],
            'options' => [
                'all'       => [
                    'plot' => app(Option::class)->whereOptionCategory('plot')->get(),
                    'crop' => app(Option::class)->whereOptionCategory('crop')->get(),
                    'analysis' => app(Option::class)->whereOptionCategory('analysis')->get(),
                ],
                'selected'  => optional($data)->optionIdList() ?? $default
            ],
            'regions' => [
                'all'       => app(Region::class)->all(),
                'selected'  => optional($data)->regionIdList() ?? $default
            ],
        ];
   }
}
