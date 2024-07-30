<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            ['name' => 'XS', 'created_at' => Carbon::now()],
            ['name' => 'S','created_at' => Carbon::now()],
            ['name' => 'M','created_at' => Carbon::now()],
            ['name' => 'L','created_at' => Carbon::now()],
            ['name' => 'XL','created_at' => Carbon::now()],
            ['name' => 'XXL','created_at' => Carbon::now()],
        ];
        DB::table('sizes')->insert($sizes);
        
    }
}
