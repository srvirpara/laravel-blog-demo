<?php

namespace App\Http\Requests\Backend\Blogs;

use App\Http\Requests\Request;

/**
 * Class StoreBlogsRequest.
 */
class StoreBlogsRequest extends Request
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
        return [
            'name'           => 'required|max:191',
            'content'        => 'required',
            'categories'     => 'required',
            'tags'           => 'required',
        ];
    }

    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please insert Blog Title',
            'name.max'      => 'Blog Title may not be greater than 191 characters.',
        ];
    }
}
