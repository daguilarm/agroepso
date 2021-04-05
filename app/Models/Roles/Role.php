<?php

namespace App\Models\Roles;

use Spatie\Permission\Models\Role as Model;
use DB;

class Role extends Model {

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toUpdate($request, int $id)
    {
        DB::transaction(function () use ($request, $id) {
            //Update roles and permissions
            $role = $this->findOrFail($id);
            $role->update($request->except(['permissions', 'itemID']));
            $role->syncPermissions($request->permissions);
        });
    }

    /**
     * Store the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function toStore($request)
    {
        DB::transaction(function () use ($request) {
            $role = $this->create($request->except(['permissions', 'itemID']));
            $role->syncPermissions($request->permissions);
        });
    }

    /**
     * Get all the permissions for a role
     * 
     * @param  string  $model
     * @return \Illuminate\Http\Response
     */
    public function permissionsByRole($model)
    {
        return $this->findByName($model->name)->permissions->pluck('name');
    }
}