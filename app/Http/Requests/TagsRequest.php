<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
{
    /**
     * Determine if the tag is authorized to make this request.
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
                    'name'     => 'required|unique:tags,name',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'     => 'required|unique:tags,name,'.$this->route()->parameter('tag').',id',
                ];
            }
            default:break;
        }


    }


    public function attributes()
    {
        return [
            'name'     => trans('main.name'),
        ];
    }
}
