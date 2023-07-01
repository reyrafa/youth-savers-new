<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TransactionModel;
use Database\Factories\TransactionFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([

            BranchSeeder::class,
            TypeStatusSeeder::class,
            AdminSeeder::class,
            LevelSeeder::class,
            TransactionStatusSeeder::class,
            SampleOfficerSeeder::class,
            SampleReferralSeeder::class,
            SampleDepositorSeeder::class,
            SampleGuardianSeeder::class,
           SampleTransactionSeeder::class
            
        ]);

        
    }
}
