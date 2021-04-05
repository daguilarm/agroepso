<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        //
        Permission::create(['name' => 'edit client']);
        Permission::create(['name' => 'delete client']);
        Permission::create(['name' => 'view client']);
        Permission::create(['name' => 'create client']);
        //
        Permission::create(['name' => 'edit plant']);
        Permission::create(['name' => 'delete plant']);
        Permission::create(['name' => 'view plant']);
        Permission::create(['name' => 'create plant']);
        //
        Permission::create(['name' => 'edit warehouse']);
        Permission::create(['name' => 'delete warehouse']);
        Permission::create(['name' => 'view warehouse']);
        Permission::create(['name' => 'create warehouse']);
        //
        Permission::create(['name' => 'edit inspection']);
        Permission::create(['name' => 'delete inspection']);
        Permission::create(['name' => 'view inspection']);
        Permission::create(['name' => 'create inspection']);
        //
        Permission::create(['name' => 'edit plot']);
        Permission::create(['name' => 'delete plot']);
        Permission::create(['name' => 'view plot']);
        Permission::create(['name' => 'create plot']);
        Permission::create(['name' => 'reset plot']);
        //
        Permission::create(['name' => 'edit certificate']);
        Permission::create(['name' => 'delete certificate']);
        Permission::create(['name' => 'view certificate']);
        Permission::create(['name' => 'create certificate']);
        //
        Permission::create(['name' => 'edit worker']);
        Permission::create(['name' => 'delete worker']);
        Permission::create(['name' => 'view worker']);
        Permission::create(['name' => 'create worker']);
        //
        Permission::create(['name' => 'edit machine']);
        Permission::create(['name' => 'delete machine']);
        Permission::create(['name' => 'view machine']);
        Permission::create(['name' => 'create machine']);
        //
        Permission::create(['name' => 'edit admin-gv']);
        Permission::create(['name' => 'delete admin-gv']);
        Permission::create(['name' => 'view admin-gv']);
        Permission::create(['name' => 'create admin-gv']);
        //
        Permission::create(['name' => 'edit config-dop']);
        Permission::create(['name' => 'delete config-dop']);
        Permission::create(['name' => 'view config-dop']);
        Permission::create(['name' => 'create config-dop']);
        //
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        //
        Permission::create(['name' => 'edit label']);
        Permission::create(['name' => 'delete label']);
        Permission::create(['name' => 'view label']);
        Permission::create(['name' => 'create label']);
        //
        Permission::create(['name' => 'upload excel']);
        //
        Permission::create(['name' => 'edit harvest']);
        Permission::create(['name' => 'delete harvest']);
        Permission::create(['name' => 'view harvest']);
        Permission::create(['name' => 'create harvest']);
        //

        //Create roles
        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());
        $admin->revokePermissionTo([
            'create harvest', 'edit harvest', 'delete harvest',
            'create inspection', 'edit inspection', 'delete inspection',
            'create certificate', 'edit certificate', 'delete certificate',
        ]);

        $adminGV = Role::create(['name' => 'admin-gv']);
        $adminGV->syncPermissions([
            'view user',
            'view client',
            'view plant',
            'view warehouse',
            'view inspection',
            'view plot',
            'view worker',
            'view certificate',
            'view machine',
            'view label',
            'view admin-gv', 'create admin-gv', 'edit admin-gv', 'delete admin-gv',
            'view harvest',
        ]);

        $dop = Role::create(['name' => 'dop']);
        $dop->syncPermissions([
            'view plant', 'create plant', 'edit plant', 'delete plant',
            'view warehouse', 'create warehouse', 'edit warehouse', 'delete warehouse',
            'view user', 'create user', 'edit user', 'delete user',
            'view inspection', 'create inspection', 'edit inspection', 'delete inspection',
            'view plot', 'create plot', 'edit plot', 'delete plot', 'reset plot',
            'view worker', 'create worker', 'edit worker', 'delete worker',
            'view certificate', 'create certificate', 'edit certificate', 'delete certificate',
            'view machine', 'create machine', 'edit machine', 'delete machine',
            'view config-dop', 'create config-dop', 'edit config-dop',
            'view label', 'create label', 'edit label', 'delete label',
            'upload excel',
            'view harvest', 'create harvest', 'edit harvest', 'delete harvest',
        ]);

        $inspector = Role::create(['name' => 'inspector']);
        $inspector->syncPermissions([
            'view user',
            'view plant',
            'view warehouse',
            'view inspection', 'create inspection', 'edit inspection', 'delete inspection',
            'view certificate', 'create certificate', 'edit certificate', 'delete certificate',
            'view label',
            'view plot', 'reset plot',
            'view harvest',
        ]);

        $coop = Role::create(['name' => 'coop']);
        $coop->syncPermissions([
            'view user',
            'view plot',
            'view worker', 'create worker', 'edit worker', 'delete worker',
            'view machine', 'create machine', 'edit machine', 'delete machine',
            'view label', 'create label', 'edit label', 'delete label',
            'view harvest', 'create harvest', 'edit harvest', 'delete harvest',
            'view certificate',
        ]);

        $user = Role::create(['name' => 'user']);
        $user->syncPermissions([
            'view plot',
            'view worker', 'create worker', 'edit worker', 'delete worker',
            'view machine', 'create machine', 'edit machine', 'delete machine',
            'view label', 'create label', 'edit label', 'delete label',
            'view harvest', 'create harvest', 'edit harvest', 'delete harvest',
            'view certificate',
        ]);

        $comercial = Role::create(['name' => 'comercial']);
        $comercial->syncPermissions([
            'view plot',
            'view harvest',
        ]);
    }
}
