<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CropsRequest extends FormRequest
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
            'crop_name'                 => 'required',
            'crop_description'          => 'required',
            'crop_key'                  => 'required',
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
            'crop_name'             => trans_title('crops'),
            'crop_description'      => trans('system.description'),
            'crop_key'              => sections('crops.key'),
        ];
    }

    /**
     * Customize response
     *
     * @return array
     */
    // public function response(array $errors)
    // {
    //     // If you want to customize what happens on a failed validation,
    //     // override this method.
    //     $errors[] = "Se ha producido un error al añadir su parcela. Los campos anteriormente nombrados, se encontraban vacios.";
    //     return redirect()->route("dashboard.users.plots.geolocate")->withErrors($errors);
    // }
}
