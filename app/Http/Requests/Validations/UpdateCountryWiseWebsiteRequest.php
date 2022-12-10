<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateCountryWiseWebsiteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
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
            'country_id' => 'required|unique:country_wise_websites,country_id,'.$id,
            'website' => 'required'
        ];
    }
}
