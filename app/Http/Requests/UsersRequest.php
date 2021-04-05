<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
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
        //Updated case
        if($this->method() == 'PATCH') {
            $validate = [
                'user_ref'              => 'required|max:20',
                'name'                  => 'required|max:150',
                'email'                 => 'required|email|max:150|unique:users,email,' . $this->user,
                'client_id'             => 'required:integer',
                'active'                => 'required', Rule::in(booleanValues()),
            ];
            //If password exists
            if(!is_null(request('password')) && strlen(request('password'))) {
                return array_merge($validate, ['password' => 'sometimes|required|confirmed|min:6']);
            }
            //Without password
            return $validate;
        }
        //Created case
        return [
            'user_ref'              => 'required|max:20',
            'name'                  => 'required|max:150',
            'email'                 => 'required|email|max:150|unique:users,email,' . $this->user,
            'password'              => 'required|confirmed|min:6',
            'client_id'             => 'required:integer',
            'active'                => 'required', Rule::in(booleanValues()),
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
            'user_ref'                  => trans('system.code'),
            'name'                      => trans('persona.contact.name'),
            'email'                     => trans('persona.contact.email'),
            'password'                  => trans('auth.password'),
            'password_confirmation'     => trans('auth.password:confirmation'),
            'client_id'                 => trans_title('clients'),
            'active'                    => trans('persona.contact.active')
        ];
    }
}
