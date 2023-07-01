<?php

namespace Database\Factories;

use App\Models\BranchLocationModel;
use App\Models\DepositorModel;
use App\Models\GuardianModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepositorModelFactory extends Factory
{
    protected $model = DepositorModel::class;
    public function definition()
    {
        $number = '09' . $this->faker->randomNumber(9, true);
        $fname = $this->faker->firstName;
        $mname = $this->faker->lastName;
        $lname = $this->faker->lastName;
        $fullname = $fname . " ". $mname . " ". $lname;
        return [
            'fname' => $fname,
            'mname' => $mname,
            'lname' => $lname,
            'fullname' => $fullname,
            'suffix' => null,
            'birth_date' => $this->faker->dateTimeBetween('-17 years', '-7 years')->format('Y-m-d'),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'home_address' => $this->faker->address,
            'contact_number' => $number,
            'email_add' => $this->faker->email,
            'branch_loc_id' => 1,
            'branch_id' => $this->faker->randomElement([1, 2]),
            'referral_id' => 1,
            'uploaded_file_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

   
}
