<?php

namespace Database\Factories;

use App\Models\DepositorModel;
use App\Models\GuardianModel;
use App\Models\TransactionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionModel>
 */
class TransactionModelFactory extends Factory
{
    protected $model = TransactionModel::class;
    private static $currentUserId = 1;
    public function definition()
    {
        $random_lvl = $this->faker->randomElement([1, 2]);
        $random_status = ($random_lvl == 1) ? $this->faker->randomElement([1]) : $this->faker->randomElement([2,3]);

        return [
            'depositor_id' =>
            self::$currentUserId++, //DepositorModel::factory()->create()->id,
            'level_id' => $random_lvl,
            'status_id' => $random_status,
            'verified_by' => $random_status == 2 || $random_status == 3 ? 1 : null,
            'approved_by' => $random_status == 3 ? 2 : null,
            'disapproved_by' => $random_status == 4 ? 1 : null,
            'verified_at' => $random_status == 2 || $random_status == 3 ? now() : null,
            'approved_at' => $random_status == 3 ? now() : null,
            'disapproved_at' => $random_status == 4 ? now() : null,
            'created_at' => now(),
            'updated_at' => now()

        ];
    }


    /* public function configure()
    {
        return $this->afterCreating(function (TransactionModel $transaction) {
            GuardianModel::factory()->create([
                'depositor_id' => $transaction->depositor_id,
            ]);
        });
    }*/
}
