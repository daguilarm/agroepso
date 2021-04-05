<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilesRequest extends FormRequest
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
        return [
            'name'              => 'required|max:150',
            'profile_address'   => 'max:150',
            'profile_city'      => 'max:100',
            'profile_region'    => 'max:100',
            'profile_state'     => 'max:100',
            'profile_zip'       => 'max:20',
            'profile_telephone' => 'max:30',
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
            'name'              => trans('persona.contact.name'),
            'profile_address'   => trans('persona.contact.address'),
            'profile_city'      => trans('persona.contact.city'),
            'profile_region'    => trans('persona.contact.region'),
            'profile_state'     => trans('persona.contact.state'),
            'profile_zip'       => trans('persona.contact.zip'),
            'profile_telephone' => trans('persona.contact.telephone'),

        ];
    }
}
