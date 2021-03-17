<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createAccountRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[\pL\s.,\-]+$/u|min:4|max:35',
            'username' => 'required|alpha_num|min:4|max:10|unique:admins,username|unique:accounts,username|
                           unique:teachers,username|unique:students,username|unique:admins,admin_id|unique:accounts,account_id|
                           unique:teachers,teacher_id|unique:students,student_id',
            'email' => 'required|email|max:50|unique:admins,email|unique:accounts,email|
                            unique:teachers,email|unique:students,email',
            'phone' => 'required|numeric|digits_between:11,15|unique:admins,phone|unique:accounts,phone|
                            unique:teachers,phone|unique:students,phone',
            'password' => 'required|confirmed|min:6|max:30',
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50', 
            'salary' => 'required|numeric|min:0|max:100000',
            'university_id' => 'required|exists:universities,university_id',
            'birthdate' => 'required|date|before:2002/01/01',
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'Username Already Taken Not Available!',
            'phone.unique' => 'Phone Number Already unique Not Available!',
            
        ];
    }
}
