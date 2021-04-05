<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlotsRequest extends FormRequest
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
            'client_id'                     => 'required|integer',
            'user_id'                       => 'required|integer',
            'crop_id'                       => 'required|integer',
            'plot_ref'                      => 'required|max:20',
            'plot_active'                   => 'required', Rule::in(booleanValues()),
            'geolocation_geo_sigpac_region' => 'required|numeric',
            'geolocation_geo_sigpac_city'   => 'required|numeric',
            'geolocation_geo_sigpac_polygon'=> 'required|numeric',
            'geolocation_geo_sigpac_plot'   => 'required|numeric',
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
            'client_id'                     => trans_title('clients', 'singular'),
            'user_id'                       => trans('auth.user'),
            'crop_id'                       => trans_title('crops', 'singular'),
            'plot_ref'                      => trans('system.code'),
            'plot_active'                   => trans('persona.contact.active'),
            'plot_area'                     => sections('plots.area'),
            'plot_percent_cultivated_land'  => sections('plots.cultivated_land'),
            'plot_framework_x'              => sections('plots.framework_x'),
            'plot_framework_y'              => sections('plots.framework_y'),
            'plot_green_cover'              => sections('plots.green_cover'),
            'plot_pond'                     => sections('plots.pond'),
            'plot_road'                     => sections('plots.road'),
            'plot_crop_training'            => sections('plots.training'),
            'geolocation_geo_sigpac_region' => sections('plots.sigpac.region'),
            'geolocation_geo_sigpac_city'   => sections('plots.sigpac.city'),
            'geolocation_geo_sigpac_polygon'=> sections('plots.sigpac.polygon'),
            'geolocation_geo_sigpac_plot'   => sections('plots.sigpac.plot'),
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
