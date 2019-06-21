<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEducationInformationRequest extends FormRequest
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
            'description' => ['max:1000' , 'min:15' , 'string' , 'nullable'],
        ];
    }

    public function messages(){
        return [
            'description.min' => 'متن درخواست ویرایش اطلاعات تحصیلی خیلی کوتاه است',
        ];
    }
}
