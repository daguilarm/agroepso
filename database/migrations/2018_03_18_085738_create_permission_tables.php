<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * Role structure 
     *
     *      Role: Admin
     *         Permissions: 'view agronomic', 'create agronomic', 'edit agronomic', 'delete agronomic' // Manage the agronomic data
     *                      'view inspector', 'create inspector', 'edit inspector', 'delete inspector', // Manage the inspector data
     *                      'view plot', 'create plot', 'edit plot', 'delete plot' // Manage the plot data
     *                      'view certificate', 'create certificate', 'edit certificate', 'delete certificate' // Manage the certificate data
     *                      'view workers', 'create workers', 'edit workers', 'delete workers' // Manage the workers data
     *                      'view machine', 'create machine', 'edit machine', 'delete machine' // Manage the machine data
     *                      'admin-gv' // Access to stats and private documents for the government
     *                      'admin' // Administration configuration and tools
     *                      'view user', 'create user', 'edit user', 'delete user' // Manage the user data
     * 
     *      Role: Admin-gv
     *         Permissions: 'view agronomic', // Show the agronomic data 
     *                      'view inspector', // Show the inspector data
     *                      'view plot',  // Show the plot data
     *                      'view workers', // Show the workers data
     *                      'view certificate' //Show the certificate data
     *                      'view machine',  // Show the machine data
     *                      'admin-gv', // Access to stats and private documents for the government
     *                      'view user', // Show the users data
     * 
     *      Role: Dop
     *         Permissions: 'view agronomic', 'create agronomic', 'edit agronomic', 'delete agronomic' // Manage the agronomic data below to him     
     *                      'view inspector', 'create inspector', 'edit inspector', 'delete inspector', // Manage the inspector data below to him   
     *                      'view plot', 'create plot', 'edit plot', 'delete plot' // Manage the plot data below to him   
     *                      'view workers', 'create workers', 'edit workers', 'delete workers' // Manage the workers data below to him   
     *                      'view certificate', 'create certificate', 'edit certificate', 'delete certificate' // Manage the certificate data below to him   
     *                      'view machine', 'create machine', 'edit machine', 'delete machine' // Manage the machine data below to him   
     *                      'config dop' // Load modules and configure preferences
     *                      'view user', 'create user', 'edit user', 'delete user' // Manage the user data below to him   
     *          
     *      Role: Surveyor
     *          Permissions: 'view agronomic' // See the agronomic data for an user(s)
     *                       'view inspector', 'create inspector', 'edit inspector', 'delete inspector', // Manage the inspector data below to him       
     *                       'view plot'  // See the plot data below to him  
     *                       'view user', // Show the users data below to him    
     *          
     *      Role: Coop
     *          Permissions: 'view agronomic', 'create agronomic', 'edit agronomic', 'delete agronomic' // Manage all the agronomic data of all the users that it manage
     *                       'view plot', 'create plot', 'edit plot', 'delete plot' // Manage all the plot data of all the users that it manage
     *                       'view workers', 'create workers', 'edit workers', 'delete workers' // Manage the workers data of all the users that it manage
     *                       'view machine', 'create machine', 'edit machine', 'delete machine' // Manage the machine data of all the users that it manage
     *                       'view user', // Show the users data that it manage
     *          
     *      Role: User
     *          Permissions: 'view agronomic', 'create agronomic', 'edit agronomic', 'delete agronomic' // Manage his own agronomic data
     *                       'view plot', 'create plot', 'edit plot', 'delete plot' // Manage his own plot data
     *                       'view workers', 'create workers', 'edit workers', 'delete workers' // Manage his own workers
     *                       'view machine', 'create machine', 'edit machine', 'delete machine' // Manage his own machines
     *          
     *      Role: comercial
     *          Permissions: 'view agronomic', // See the agronomic data for an user(s) by delegation
     *                       'view plot'  // See the plot data for an user(s) by delegation
     *          
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->integer('permission_id')->unsigned();
            $table->morphs('model');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'model_id', 'model_type']);
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames) {
            $table->integer('role_id')->unsigned();
            $table->morphs('model');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);

            app('cache')->forget('spatie.permission.cache');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
