<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class OnlineApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    // 'required|date|before_or_equal:' . now()->subYears(7)->format('Y-m-d') . 'after_or_equal:' . now()->subYears(17)->format('Y-m-d'),
    {
        $currentYear = Carbon::now()->year;
        $minYear = $currentYear - 17;
        $maxYear = $currentYear - 7;
        return [


            'depositor.fname' => 'required|string',
            'depositor.mname' => 'required|string',
            'depositor.lname' => 'required|string',
            'depositor.suffix' => 'nullable|string',
            'depositor.birth_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) use ($minYear, $maxYear) {
                    $dateOfBirth = Carbon::createFromFormat('Y-m-d', $value);
                    if ($dateOfBirth->lt(Carbon::createFromDate($minYear, 1, 1)) || $dateOfBirth->gt(Carbon::createFromDate($maxYear, 12, 31))) {
                        $fail("The $attribute should be between $minYear and $maxYear.");
                    }
                },
            ],
            'depositor.gender' => 'required|string',
            'depositor.home_address' => 'required|string',
            'depositor.contact_number' => 'required|string',
            'depositor.email_add' => 'required|email',
            'depositor.branch_loc_id' => 'required',
            'depositor.branch_id' => 'required',

            //guardian

            'guardian.depositor_id',
            'guardian.g_fname' => 'required|string',
            'guardian.g_mname' => 'required|string',
            'guardian.g_lname' => 'required|string',
            'guardian.g_suffix' => 'nullable|string',
            'guardian.g_birth_date' => 'required|date',
            'guardian.g_gender' => 'required|string',
            'guardian.g_depositor_relation' => 'required|string',
            'guardian.g_civil_status' => 'required|string',
            'guardian.g_member_or_not' => 'required|string',
            'guardian.g_home_address' => 'required|string',
            'guardian.g_present_address' => 'required|string',
            'guardian.g_contact_num' => 'required',
            'guardian.g_email_add' => 'nullable|email',

            //files
            'uploaded_file.signature_img' => 'required|string',
            'uploaded_file.identification_img' => 'required|string',
            'uploaded_file.birth_cert_img' => 'required|string',
            'uploaded_file.receipt_img' => 'required|string',

            //referral
            'referral.r_fname' => 'nullable|string',
            'referral.r_mname' => 'nullable|string',
            'referral.r_lname' => 'nullable|string',
            'referral.r_branch_loc_id' => 'nullable|integer',
            'referral.r_branch_id' => 'nullable|integer',

        ];
    }
}
