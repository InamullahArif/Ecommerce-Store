<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['name' => 'user_module'],
            ['name' => 'role_module'],
            ['name' => 'assignment_module'],
        ];
        DB::table('permissions_modules')->insert($modules);
    }
}
