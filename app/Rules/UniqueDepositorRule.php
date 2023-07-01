<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueDepositorRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $fname = request()->input('depositor.fname');
        $lname = request()->input('depositor.lname');
        $mname = request()->input('depositor.mname');

        $count = DB::table('depositor')
            ->where('fname', $fname)
            ->where('lname', $lname)
            ->where('mname', $mname)
            ->count();

        return $count === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Depositor already exist. Please call this number (096********) for assistance.';
    }
}
