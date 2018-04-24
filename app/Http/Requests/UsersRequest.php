<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name'     => 'required',
                    'email'    => 'required|unique:users',
                    'password' => 'required|confirmed',
                    'type'     => 'required|in:user,admin',
                    'image'     => 'sometimes|nullable|image',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'     => 'required',
                    'email'    => 'required|unique:users,email,'.$this->route()->parameter('user').',id',
                    'type'     => 'required|in:user,admin',
                    'image'     => 'sometimes|nullable|image',
                    'password' => 'sometimes|nullable|confirmed', 
                ];
            }
            default:break;
        }


    }


    public function attributes()
    {
        return [
            'name'     => trans('main.name'),
            'email'    => trans('main.email'),
            'password' => trans('main.password'),
            'type'     => trans('main.type'),
        ];
    }
}
