<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFileUploadRequest extends FormRequest
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
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,rar,zip,rtf,PDF,DOC,DOCX,XLS,XLSX,PPT,PPTX,RAR,ZIP,RTF|max:10240',
        ];
    }

    public function messages(){
        return [
            'file.mimes' => 'پسوند فایل ها تنها می تواند XLS ، XLSX ، DOCX ، DOC ، PDF ، PPT ، PPTX ، RAR ، ZIP و RTF باشد',
            'file.max' => 'حجم فایل زیاد است',
        ];
    }
}
