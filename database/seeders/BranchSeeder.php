<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branch_location')->insert(
            array(
                ['location' => 'CDO'],
                ['location' => 'MISAMIS ORIENTAL'],
                ['location' => 'BUKIDNON'],
                ['location' => 'CARAGA'],
                ['location' => 'BOHOL'],
                ['location' => 'DAVAO'],
                ['location' => 'HEAD OFFICE']

            )
        );


        DB::table('branch')->insert(
            array(
                ['branch_name' => 'YACAPIN', 'branch_loc_id' => 1],
                ['branch_name' => 'CARMEN', 'branch_loc_id' => 1],
                ['branch_name' => 'AGORA', 'branch_loc_id' => 1],
                ['branch_name' => 'PUERTO', 'branch_loc_id' => 1],
                ['branch_name' => 'BULUA', 'branch_loc_id' => 1],
                ['branch_name' => 'COGON', 'branch_loc_id' => 1],
                ['branch_name' => 'GINGOOG', 'branch_loc_id' => 2],
                ['branch_name' => 'EL SALVADOR', 'branch_loc_id' => 2],
                ['branch_name' => 'TALAKAG', 'branch_loc_id' => 3],
                ['branch_name' => 'BAUNGON', 'branch_loc_id' => 3],
                ['branch_name' => 'MANOLO', 'branch_loc_id' => 3],
                ['branch_name' => 'AGLAYAN', 'branch_loc_id' => 3],
                ['branch_name' => 'VALENCIA', 'branch_loc_id' => 3],
                ['branch_name' => 'MARAMAG', 'branch_loc_id' => 3],
                ['branch_name' => 'DON CARLOS', 'branch_loc_id' => 3],
                ['branch_name' => 'BUTUAN', 'branch_loc_id' => 4],
                ['branch_name' => 'UBAY', 'branch_loc_id' => 5],
                ['branch_name' => 'TAGBILIRAN', 'branch_loc_id' => 5],
                ['branch_name' => 'BALINGASAG', 'branch_loc_id' => 2],
                ['branch_name' => 'TUBIGON', 'branch_loc_id' => 5],
                ['branch_name' => 'TORIL', 'branch_loc_id' => 6],
                ['branch_name' => 'ILUSTRE', 'branch_loc_id' => 6],
                ['branch_name' => 'HEAD OFFICE', 'branch_loc_id' => 7]
            )
        );
    }
}
