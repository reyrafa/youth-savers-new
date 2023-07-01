<?php

namespace Database\Seeders;

use App\Models\DepositorModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleDepositorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DepositorModel::factory(500)->create();
    }
}
