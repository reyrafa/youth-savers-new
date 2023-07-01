<?php

namespace Database\Factories;

use App\Models\DepositorModel;
use App\Models\GuardianModel;
use Illuminate\Database\Eloquent\Factories\Factory;


class GuardianModelFactory extends Factory
{
    protected $model = GuardianModel::class;

    private static $currentUserId = 1;

    public function definition()
    {
        $number = '09' . $this->faker->randomNumber(9, true);

        return [
            'depositor_id' => self::$currentUserId++,
            'g_fname' => $this->faker->firstName,
            'g_lname' => $this->faker->lastName,
            'g_mname' => $this->faker->lastName,
            'g_suffix' => null,
            'g_birth_date' => $this->faker->dateTimeBetween('-80 years', '-16 years')->format('Y-m-d'),
            'g_gender' => $this->faker->randomElement(['Male', 'Female']),
            'g_depositor_relation' => $this->faker->randomElement(['mother', 'father', 'sister', 'grand mother']),
            'g_civil_status' => $this->faker->randomElement(['Married', 'Single', 'Divorced']),
            'g_member_or_not' => $this->faker->randomElement(['Yes', 'No']),
            'g_home_address' => $this->faker->address,
            'g_present_address' => $this->faker->address,
            'g_contact_num' => $number,
            'g_email_add' => $this->faker->email,
        ];
    }
}
