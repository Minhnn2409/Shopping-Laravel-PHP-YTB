<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'name' => 'bail|required',
            'description' => 'required',
            'image_path' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên slider không được bỏ trống',
//            'name.unique' => 'Tên slider không được bỏ trùng',
//            'name.max' => 'Tên slider không được quá 255 ký tự',
//            'name.min' => 'Tên slider không được dưới 10 ký tự',
            'description.required' => 'Mô tả slider không được bỏ trống',
            'image_path.required' => 'Ảnh không được bỏ trống',
        ];
    }
}
