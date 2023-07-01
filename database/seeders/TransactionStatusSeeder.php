<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_status')->insert(
            array(['status_name' => 'pending'],
            ['status_name' => 'verified', ],
            ['status_name' => 'approved'],
            ['status_name' => 'rejected'])
        );
    }
}
