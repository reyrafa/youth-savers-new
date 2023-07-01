<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'company_id' => '55555',
            'password' => bcrypt('#adminUser'),
            'user_type_id' => '1',
            'user_status_id' => '1',
            'created_at' => now(),
            'updated_at' => now()

        ]);
    }
}
