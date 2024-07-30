<?php

namespace Database\Seeders;

use App\Contracts\IPermissions;
use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'SuperAdmin',
                'email' => 'superadmin@awn.com',
                'password' => bcrypt('root@123'),

            ],
        ];
        DB::table('users')->insert($users);

        $superAdminRole = Role::findOrFail(1);
        // $adminRole = Role::findOrFail(2);

        $UsersPermission = Permission::all();
        $viewUserPermission=$UsersPermission->where('name',IPermissions::VIEW_USERS)->first();;
        // dd($viewUserPermission->id);
        // $createUsersPermission = Permission::where('name', 'create_users')->first();
        // $editUsersPermission = Permission::where('name', 'edit_users')->first();
        // $deleteUsersPermission = Permission::where('name', 'delete_users')->first();

        $user = User::findOrFail(1);

        $superAdminRole->permissions()->sync($UsersPermission->pluck('id')->toArray());
        // $adminRole->permissions()->sync([$viewUserPermission->id]);
       
        $user->permissions()->sync($UsersPermission->pluck('id')->toArray());
        $user->roles()->sync([$superAdminRole->id]);
        $user->image()->create([
            'name' => 'user_images/user.jpg', 
        ]);
    }
}
