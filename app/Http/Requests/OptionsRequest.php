<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionsRequest extends FormRequest
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
            'option_name'           => 'required',
            'option_key'            => 'required',
            'option_category'       => 'required',
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
            'option_name'       => trans_title('options'),
            'option_key'        => sections('options.key'),
            'option_category'   => trans('system.category'),
        ];
    }
}
