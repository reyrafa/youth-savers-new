<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                ['company_id' => '8986', 'password' => bcrypt('jenny12'), 'user_type_id' => '2', 'user_status_id' => '1', 'created_at' => now(), 'updated_at' => now()],
                ['company_id' => '8586', 'password' => bcrypt('oshin12'), 'user_type_id' => '3', 'user_status_id' => '1', 'created_at' => now(), 'updated_at' => now()],
                ['company_id' => '8685', 'password' => bcrypt('user03'), 'user_type_id' => '4', 'user_status_id' => '1', 'created_at' => now(), 'updated_at' => now()],
            )
        );

        DB::table('officer')->insert(array(
            ['uid' => '2', 'branch_id' => '23', 'company_id' => '8986', 'fname' => 'Jenny', 'mname' => 'P.', 'lname' => 'Suaffield', 'created_at' => now(), 'updated_at' => now()],
            ['uid' => '3', 'branch_id' => '1', 'company_id' => '8586', 'fname' => 'Oshin', 'mname' => 'C.', 'lname' => 'Macahilos', 'created_at' => now(), 'updated_at' => now()],
            ['uid' => '4', 'branch_id' => '23', 'company_id' => '8685', 'fname' => 'Herbert', 'mname' => 'P.', 'lname' => 'Aratan', 'created_at' => now(), 'updated_at' => now()],
        ));
    }
}
