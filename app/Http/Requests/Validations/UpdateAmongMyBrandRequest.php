<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateAmongMyBrandRequest extends Request
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
        $id = Request::segment(count(Request::segments())); //Current model ID

        return [
            'name' => 'required',
            // 'order' => 'required',
            'about_my_work' => 'required',
            'about_brand' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif|max:'.config('system_settings.max_img_size_limit_kb'),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.max' => trans('validation.brand_logo_max'),
            'image.mimes' => trans('validation.brand_logo_mimes'),
        ];
    }
}
