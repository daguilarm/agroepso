<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Only Admins or superior can make a request
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Set the default validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        //Created case
        return [
            'upload_excel' => 'required|max:10240',
            'client_id' => 'sometimes|integer',
        ];
    }

    /**
     * Customize form fields for errors
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'upload_excel' => trans('system.file'),
            'client_id' => trans_title('clients'),
        ];
    }
}
