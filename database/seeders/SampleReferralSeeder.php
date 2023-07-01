<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('referral')->insert(
            array(
                [
                    'r_fname' => null,
                    'r_mname' => null,
                    'r_lname' => null,
                    'r_branch_loc_id' => null,
                    'r_branch_id' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            )
        );

        DB::table('uploaded_file')->insert(
            array(
                [
                    'signature_img' => '64799bd55443f-1685691349signature-rey.jpg',
                    'identification_img' => '64799bde9a93f-1685691358id-rey.jpg', 
                    'birth_cert_img' => '64799be78e26b-1685691367birth-cert.jpg', 
                    'receipt_img' => '64799bf503d01-1685691381gcash-rey.jpg'
                ]
            )
        );
    }
}
