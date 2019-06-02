<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostPhotoUploadRequest extends FormRequest
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
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(){
        return [
            'file.mimes' => 'پسوند تصویر تنها می تواند gif ، jpg ، png ، jpeg و svg باشد',
            'file.max' => 'حجم فایل زیاد است',
        ];
    }
}
