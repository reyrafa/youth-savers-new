<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_status')->insert(
            array(
                ['status_name' => 'Active',],
                ['status_name' => 'Disabled'])
        );

        DB::table('user_type')->insert(
            array(
                ['type_name' => 'admin',],
                ['type_name' => 'ols officer'],
                ['type_name' => 'new accounts',],
                ['type_name' => 'HO personnel']
                )
        );
    }
}
