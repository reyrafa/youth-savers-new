<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficerRequest extends FormRequest
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
    {
        $rules = [
            
            'users.password' => 'required',
            'users.user_type_id' => 'required',
            'users.user_status_id' => 'required',

            'officer.fname' => 'required|string',
            'officer.mname' => 'required|string',
            'officer.lname' => 'required|string',
            'officer.branch_id' => 'required|integer'

        ];

        if($this->route()->getActionMethod() === 'store'){
            $rules['users.company_id'] = 'required|unique:users';
        }
        else if($this->route()->getActionMethod() === 'update'){
            $rules['users.company_id'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'users.company_id.unique' => 'The Company ID is already taken.',
        ];
    }
}
