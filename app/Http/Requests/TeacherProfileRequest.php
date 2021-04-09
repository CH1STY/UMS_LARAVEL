<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherProfileRequest extends FormRequest
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
            'name' => 'min:1|max:30',
            'username' => 'unique:teachers',
            'email' => 'email|max:50|min:10',
            'phone' => 'min:11|max:15',
            'profile_pic' => 'mimes:jpg,png|max:5000',
        ];
    }
}
