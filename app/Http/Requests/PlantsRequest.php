<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantsRequest extends FormRequest
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
            'plant_ref'         => 'required|max:20',
            'client_id'         => 'required|integer',
            'plant_name'        => 'required|max:150',
            'plant_nif'         => 'sometimes|max:50',
            'plant_email'       => 'sometimes|nullable|email|max:150',
            'plant_contact'     => 'max:150',
            'plant_address'     => 'max:150',
            'plant_city'        => 'max:100',
            'plant_state'       => 'max:100',
            'plant_region'      => 'max:100',
            'plant_zip'         => 'max:10',
            'plant_telephone'   => 'max:20',
            'plant_email_alt'       => 'sometimes|nullable|max:150',
            'plant_contact_alt'     => 'max:150',
            'plant_address_alt'     => 'max:150',
            'plant_nif_alt'         => 'max:50',
            'plant_city_alt'        => 'max:100',
            'plant_state_alt'       => 'max:100',
            'plant_region_alt'      => 'max:100',
            'plant_zip_alt'         => 'max:10',
            'plant_telephone_alt'   => 'max:20',
            'plant_email_alt'       => 'max:150',
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
            'plant_ref'         => trans('system.code'),
            'client_id'         => trans_title('clients'),
            'plant_name'        => trans_title('plants'),
            'plant_email'       => trans('persona.contact.email'),
            'plant_nif'         => trans('persona.contact.nif'),
            'plant_contact'     => trans('persona.contact.contact'),
            'plant_address'     => trans('persona.contact.address'),
            'plant_city'        => trans_title('cities'),
            'plant_state'       => trans_title('states'),
            'plant_region'      => trans_title('regions'),
            'plant_zip'         => trans_title('persona.contact.zip'),
            'plant_telephone'   => trans_title('persona.contact.telephone'),
            'plant_email_alt'     => trans('persona.contact.email'),
            'plant_nif_alt'       => trans('persona.contact.nif'),
            'plant_contact_alt'   => trans('persona.contact.contact'),
            'plant_address_alt'   => trans('persona.contact.address'),
            'plant_city_alt'      => trans_title('cities'),
            'plant_state_alt'     => trans_title('states'),
            'plant_region_alt'    => trans_title('regions'),
            'plant_zip_alt'       => trans_title('persona.contact.zip'),
            'plant_telephone_alt' => trans_title('persona.contact.telephone'),
            'plant_observations'  => trans_title('system.observations'),
        ];
    }
}
