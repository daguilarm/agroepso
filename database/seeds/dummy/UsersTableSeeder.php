<?php

use App\Models\Cities\City;
use App\Models\Plots\Plot;
use App\Models\Profiles\Profile;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    private $total = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        // Users
        for($x = 0; $x <= $this->total; $x++) {
            $user = factory(User::class)->create();
            $user->assignRole('user');
            factory(Profile::class)->create(['user_id' => $user->id]);
        }
    }
}
