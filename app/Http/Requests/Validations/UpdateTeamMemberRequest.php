<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateTeamMemberRequest extends Request
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
           'name' => 'required|max:255',
           'designation' => 'required|max:255',
           'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ];
    }
}
