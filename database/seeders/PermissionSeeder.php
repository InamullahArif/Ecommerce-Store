<?php

namespace Database\Seeders;

use App\Models\PermissionsModule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_module = PermissionsModule::where('name','user_module')->get();
        // dd($user_module);
        $role_module = PermissionsModule::where('name','role_module')->get();
        $assignment_module = PermissionsModule::where('name','assignment_module')->get();
        $one = $user_module->pluck('id')->toArray();
        $two = $role_module->pluck('id')->toArray();
        $three = $assignment_module->pluck('id')->toArray();
        // dd($one[0],$two[0],$three[0]);
        // dd($user_module,$role_module,$assignment_module);
        $permissions = [
            ['name' => 'view_users', 'guard_name' => 'web','module_id'=>$one[0]],
            ['name' => 'create_users', 'guard_name' => 'web','module_id'=>$one[0]],
            ['name' => 'edit_users', 'guard_name' => 'web','module_id'=>$one[0]],
            ['name' => 'delete_users', 'guard_name' => 'web','module_id'=>$one[0]],
            ['name' => 'create_role', 'guard_name' => 'web','module_id'=> $two[0]],
            ['name' => 'view_roles', 'guard_name' => 'web','module_id'=> $two[0]],
            ['name' => 'edit_role', 'guard_name' => 'web','module_id'=>$two[0]],
            ['name' => 'delete_role', 'guard_name' => 'web','module_id'=>$two[0]],
            ['name' => 'assign_user', 'guard_name' => 'web','module_id'=> $three[0]],
            ['name' => 'assign_role', 'guard_name' => 'web','module_id'=> $three[0]],
        ];
        DB::table('permissions')->insert($permissions);
    }
}
