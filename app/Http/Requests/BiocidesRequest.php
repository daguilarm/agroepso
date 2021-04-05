<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiocidesRequest extends FormRequest
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
     *
     * 'date'   => 'required|date_format:d/m/Y|regex:/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/',
     * 'email'  => 'required|email|unique:users,email',
     * '_image' => 'sometimes|mimes:jpg,png,jpeg,gif,svg|max:1000',
     */
    public function rules()
    {
        return [
            'biocide_num'       => 'required',
            'biocide_name'      => 'required',
            'biocide_company'   => 'required',
            'biocide_formula'   => 'required',
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
            'biocide_num'       => sections('biocides.register'),
            'biocide_name'      => trans_title('biocides', 'singular'),
            'biocide_company'   => trans('financials.company'),
            'biocide_formula'   => sections('biocides.formula'),
        ];
    }
}
