<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitiesRequest extends FormRequest
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
            'city_name'     => 'required',
            'city_lat'      => 'required|numeric|between:-90,90', 
            'city_lng'      => 'required|numeric|between:-180,180',
            'country_id'    => 'required|integer',
            'state_id'      => 'required|integer',
            'region_id'     => 'required|integer',
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
            'city_name'                 => trans('persona.contact.city'),
            'city_lat'                  => trans('geolocation.lat'),
            'city_lng'                  => trans('geolocation.lng'),
            'client_id'                 => trans_title('clients', 'singular'),
            'country_id'                => trans('persona.contact.country'),
            'state_id'                  => trans('persona.contact.state'),
            'region_id'                 => trans('persona.contact.region'),
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
