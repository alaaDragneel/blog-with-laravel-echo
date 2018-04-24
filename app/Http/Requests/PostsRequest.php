<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
{
    /**
     * Determine if the post is authorized to make this request.
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
                    'title'             => 'required',
                    'body'              => 'required',
                    'image'             => 'required|image',
                    'slug'              => 'required|unique:posts,slug',
                    'later_publish'     => 'required|in:yes,no',
                    'publish_date'      => 'sometimes|nullable|date|date_format:"Y-m-d"',
                    'status'            => 'required|in:approved,rejected,pending',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'             => 'required',
                    'body'              => 'required',
                    'image'             => 'sometimes|nullable|image',
                    'slug'              => 'required|unique:posts,slug,'.$this->route()->parameter('post').',id',
                    'later_publish'     => 'required',
                    'publish_date'      => 'sometimes|nullable|date|date_format:"Y-m-d"',
                    'status'            => 'required|in:approved,rejected,pending',
                ];
            }
            default:break;
        }


    }


    public function attributes()
    {
        return [
            'title'             => trans('main.title'),
            'body'              => trans('main.body'),
            'image'             => trans('main.image'),
            'slug'              => trans('main.slug'),
            'later_publish'     => trans('main.later_publish'),
            'publish_date_time' => trans('main.publish_date_time'),
            'status'            => trans('main.status'),
        ];
    }
}
