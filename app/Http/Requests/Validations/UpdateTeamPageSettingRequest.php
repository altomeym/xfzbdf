<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateTeamPageSettingRequest extends Request
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
           'title' => 'required|max:255',
           'description' => 'required|max:255',
           'meta_title' => 'nullable|max:255',
           'meta_description' => 'nullable|max:255',
           'meta_keywords' => 'nullable|max:255',
        ];
    }
}
