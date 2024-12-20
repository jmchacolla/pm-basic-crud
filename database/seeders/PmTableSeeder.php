<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class PmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pm_table')->insert([
            'uuid' => Str::uuid()->toString(),
            'name' => 'name_'. Str::random(10),
            'description' => 'desc_' . Str::random(10),
            'code' => 'COD_' . Str::random(10),
            'status' => 'active',
        ]);
    }
}
