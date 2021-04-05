<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehousesRequest extends FormRequest
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
            'warehouse_ref'         => 'required|max:20',
            'client_id'             => 'required|integer',
            'warehouse_name'        => 'required|max:150',
            'plant_id'              => 'sometimes|integer',
            'warehouse_nif'         => 'max:50',
            'warehouse_contact'     => 'max:150',
            'warehouse_address'     => 'max:150',
            'warehouse_city'        => 'max:100',
            'warehouse_state'       => 'max:100',
            'warehouse_region'      => 'max:100',
            'warehouse_zip'         => 'max:10',
            'warehouse_telephone'   => 'max:20',
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
            'warehouse_ref'         => trans('system.code'),
            'client_id'             => trans_title('clients'),
            'plant_id'              => trans_title('plants'),
            'warehouse_name'        => trans_title('plants'),
            'warehouse_email'       => trans('persona.contact.email'),
            'warehouse_nif'         => trans('persona.contact.nif'),
            'warehouse_contact'     => trans('persona.contact.contact'),
            'warehouse_address'     => trans('persona.contact.address'),
            'warehouse_city'        => trans_title('cities'),
            'warehouse_state'       => trans_title('states'),
            'warehouse_region'      => trans_title('regions'),
            'warehouse_zip'         => trans_title('persona.contact.zip'),
            'warehouse_telephone'   => trans_title('persona.contact.telephone'),
        ];
    }
}
