<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class applyCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course1_id' => 'required|exists:courses,course_id',
            'course2_id' => 'required|exists:courses,course_id',
            'course3_id' => 'required|exists:courses,course_id',
            'course4_id' => 'required|exists:courses,course_id',
        ];
    }
}
