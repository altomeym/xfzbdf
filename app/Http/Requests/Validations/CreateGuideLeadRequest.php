<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateGuideLeadRequest extends Request
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
        Request::merge(['author_id' => Request::user()->id]); //Set user_id

        return [
            'label' => 'required',
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:guide_leads',
            'description' => 'required',
            'pages' => 'required',
            'type' => 'required|in:pdf,video',
            // 'link' => 'required',
            'btn_text' => 'required',
            'bg_color' => 'required',
            'color' => 'required',
            'offer_text_1' => 'nullable|max:10',
            'offer_text_2' => 'nullable|max:30',
            'offer_text_3' => 'nullable|max:10',
            'is_featured' => 'required|in:1,0',
            // 'image' => 'mimes:jpg,jpeg,png,gif',
        ];
    }
}
